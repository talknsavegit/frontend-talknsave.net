<?php
require ('Invoice.php');
require __DIR__ . '/vendor/autoload.php';
use Knp\Snappy\Pdf;

function auto_accept_cookies() {
    setcookie('cookie_accepted', 'true', time() + 31536000, '/');
}
add_action('init', 'auto_accept_cookies');


add_action('wp',function(){
        global $invoice;
        if(is_page('invoice')):
           
            if(!empty($_GET['billid']) && (!empty($_GET['rc']) || !empty($_GET['code']))){

                $bill = $_GET['billid'];
                $code = $_GET['rc'];
                $phone = $_GET['code'];
				     
                $invoice->init();
                // $bill_id = $bills['Root']['tblBills'][]['BillID'];
                $data = $invoice->get($bill);
				
				 if(!$data){
                    echo 'Record not found!';
					 exit;
				 }
				function isRealObject($arrOrObject) {
					$keys = array_keys($arrOrObject);
					return implode('', $keys) != implode(range(0, count($keys)-1));
				}
				$getBillsListData = $invoice->getBillsList($data['tblBills']['RentalCode']);
				$lastBill = 0;
				if(isRealObject($getBillsListData['NewDataSet']['tblBills'])){
					$lastBill = $getBillsListData['NewDataSet']['tblBills']['BillID'];
				}else{
					$lastBill = $getBillsListData['NewDataSet']['tblBills'][count($getBillsListData['NewDataSet']['tblBills'])-1]['BillID'];
				}
// 				 echo "<pre>";
//                 print_r( $data[''PastLastUsage]);
//                 echo "</pre>";
//                 exit;
				
				$finalBillPhone = $data['tblBills']['PhoneNumber'];
				$finalBillRc = $data['tblBills']['RentalCode'];
				$finalInvoicedata = $invoice->getRentalInfo($finalBillRc);
				$isFinalInvoiceActive = true;
				if($finalInvoicedata == "" || $finalInvoicedata['Root']['tblRentals']['ShortTermCollectionRental'] == "false" || ($finalInvoicedata['Root']['tblRentals']['ReturnedDate'] == null && $finalInvoicedata['Root']['tblRentals']['ReturnedBaseCode'] == null) || $lastBill != $bill || $lastBill == 0){
				$isFinalInvoiceActive = false;
				}
				
                if($data['tblBills']['RentalCode'] != $code && $phone == ''){
                    echo 'Record not found!';
        
                }
                elseif($data['tblBills']['PhoneNumber'] != $phone && $code == '')
                {
                    echo 'Record not found!';
        
                }
                else{
					
                    if(!empty($_GET['pdf'])){
								$myProjectDirectory = get_stylesheet_directory(); 
								 //$snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'); // for 32bit architecture
								// $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
                                $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
								$snappy->setOption('viewport-size','2250x1080');
								$snappy->setOption('cache-dir', $myProjectDirectory.'/scss/');
								header('Content-Type: application/pdf');
								header('Content-Disposition: attachment; filename="talknsave-invoice-'.$bill.'.pdf"');

								if($phone == '')
								{
								echo $snappy->getOutput(home_url().'/invoice/?billid='.$bill.'&rc='.$code.'&pdfs=1');
								}
								if($code == ''){
								echo $snappy->getOutput(home_url().'/invoice/?billid='.$bill.'&code='.$phone.'&pdfs=1');
								}
                    }else if ($isFinalInvoiceActive && $data['tblBills']['PastLastUsage'] >=0 && $data['tblBills']['Shorttermcollectionrental'] == 1){
						echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.home_url().'/final-invoice/?rc='.$finalBillRc.'&code='.$finalBillPhone.'">';
                        //get_template_part('custom-template/page','final',$data);
                    } else {
						
						 get_template_part('custom-template/page','invoice',$data);
					}
                }
                exit;
            }
        endif;
    
});

add_action('wp',function(){
    global $invoice;
    if(is_page('final-invoice')):
       
        if(!empty($_GET['rc']) && !empty($_GET['code'])  ){
              
            $code = $_GET['rc'];
            $phone = $_GET['code'];
            $invoice->init();
            $data = $invoice->getRentalInfo($code);
            //$callpackage = $invoice->getCallsPackage($code);
            
            
            // $rentalcode = $data['root']['tblRentals']['RentalCode'];
            // echo $rentalcode;
            //exit;
        //     echo "<pre>";
        //    print_r($data);
        //   echo "</pre>";

            if($data['Root']['tblRentals']['PhoneNumber'] != $phone){
                echo 'Record not found!';
                exit;
    
            }else{

                if(!empty($_GET['pdf'])){

                    
                    $myProjectDirectory = get_stylesheet_directory();                    
                    // $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'); // for 32bit architecture
                    // $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'); //just for backup
                    $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
                    $snappy->setOption('viewport-size','2250x1080');
                    $snappy->setOption('cache-dir', $myProjectDirectory.'/scss/');
                    
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="talknsave-invoice-'.$code.'.pdf"');

                    echo $snappy->getOutput(home_url().'/final/?rc='.$code.'&code='.$phone.'&pdfs=1');
                }else{
                    get_template_part('custom-template/page','final',$data);
                }
                
            //}
            
            exit;
        }
    }
    
    endif;

});

add_action('wp',function(){
    global $invoice;
    if(is_page('knt-invoice')){
       
        if(!empty($_GET['KNTBillId']) && !empty($_GET['SubId'])  ){
              
            $code = $_GET['KNTBillId'];
            $subid = $_GET['SubId'];
            $invoice->init();
            $kntdata = $invoice->getKNTbills($code);
			$calldata = $invoice->KNTCallDetails($code);
            $data = $invoice->getRentalInfo($kntdata['Bills']['tblDW_KNT_MonthlyBills']['RentalCode']);
            if($kntdata['Bills']['tblDW_KNT_MonthlyBills']['SubscriptionCode'] != $subid){
                echo 'Record not found!';

            }else{
                get_template_part('custom-template/page','knt',["data"=>$data,"kntdata"=>$kntdata,"calldata"=>$calldata]); 
            }
            exit;
        }
    }
});


add_action('wp',function(){
    global $invoice;
    if(is_page('total-bill')):
       
        if(!empty($_GET['rc']) && !empty($_GET['code']) ){
              
            $code = $_GET['rc'];
            $phone = $_GET['code'];
            $invoice->init();
            $data = $invoice->getRentalInfo($code);
            
            // $rentalcode = $data['root']['tblRentals']['RentalCode'];
            // echo $rentalcode;
            //exit;
        //     echo "<pre>";
        //    print_r($data);
        //   echo "</pre>";

            if($data['Root']['tblRentals']['PhoneNumber'] != $phone){
                echo 'Record not found!';
                exit;
    
            }else{

                if(!empty($_GET['pdf'])){

                    
                    $myProjectDirectory = get_stylesheet_directory();                    
                    // $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'); // for 32bit architecture
                    // $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');  just for backup
                    $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
                    $snappy->setOption('viewport-size','2250x1080');
                    $snappy->setOption('cache-dir', $myProjectDirectory.'/scss/');
                    
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="talknsave-invoice-'.$code.'.pdf"');

                    echo $snappy->getOutput(home_url().'/total-bill/?rc='.$code.'&code='.$phone.'&pdfs=1');
                }else{
                    get_template_part('custom-template/page','total-bill',$data);
                }
                
            //}
            
            exit;
        }
    }
    
    endif;

});


add_action('wp_enqueue_scripts', 'enqueue_custom_script');
function enqueue_custom_script() {

    wp_enqueue_style('magnific-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css');
    wp_enqueue_script('magnific-js','https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js',array('jquery'),'1.0.0',true);
    
    
    
    //wp_enqueue_script('datepicker-js', get_stylesheet_directory_uri(). '/js/datepicker.min.js',array('jquery'),'1.0.0',true);
    wp_enqueue_script('jquery-cookie',get_stylesheet_directory_uri().'/js/jquery.cookie.js',array('jquery'),'1.0.0',true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri(). '/js/customScript.js', array('jquery'),'1.0.4',true);
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri(). '/js/custom.js', array('jquery'),'1.1.3',true);
    //wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri().'/css/bootstrap.min.css');
    //wp_enqueue_style('datepicker-css', get_stylesheet_directory_uri().'/css/datepicker.css');

    // wp_enqueue_script('custom-js', get_stylesheet_directory_uri(). '/js/custom.js', ['jquery']);
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri().'/css/custom.css?v=1.06');
    wp_enqueue_style('main-css', get_stylesheet_directory_uri().'/assets/css/main.css');

    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
    wp_register_style( 'jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui-css' );  
	
}

add_action( 'wp_footer', 'add_custom_loader' );
function add_custom_loader() {
    echo '<div class="loader"><img src="/wp-content/uploads/2016/11/loader.gif" class="loader-icon" /></div><div id="cart-popup" class="white-popup mfp-hide">';
    //get_popup_template();
    echo "</div>";
}



add_filter( 'gform_review_page', 'add_review_page', 10, 3 );
function add_review_page( $review_page, $form, $entry ) {
    // Enable the review page
    $review_page['is_enabled'] = true;
    if ( $entry ) {
        // Populate the review page.
        $review_page['content'] = get_template_part('custom-template/page','form');;
        $review_page['content'] .= GFCommon::replace_variables( '{all_fields}', $form, $entry );
    }
    return $review_page;
}

// NOTE: Update the '221' to the ID of your form.
add_filter( 'gform_review_page_222', 'change_review_page_button', 10, 3 );
function change_review_page_button( $review_page, $form, $entry ) {
    $review_page['nextButton']['text'] = 'Review & Submit';
    return $review_page;
}


// Disable auto-complete on form.
add_filter( 'gform_form_tag', function( $form_tag ) {
	return str_replace( '>', ' autocomplete="off">', $form_tag );
}, 11 );

// Diable auto-complete on each field.
add_filter( 'gform_field_content', function( $input ) {
	return preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input );
}, 11 ); 

add_shortcode( 'custom_checkout', 'custom_checkout_func' );
function custom_checkout_func() {
    get_template_part('custom-template/page','custom-checkout');
}







// checkout form
add_filter( 'gform_pre_render_2', 'pc_add_product_fields' );

function pc_add_product_fields($form){
   
    
    $props = array( 
		'id' => 123,
		'label' => 'My Field Label',
		'type' => 'text'
	);
	$field = GF_Fields::create( $props );
	array_push( $form['fields'], $field );
	return $form;
}





// Allow SVG start
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' ); // Allow SVG end ---



  add_shortcode('plans','showPlans');  // plans shortCode start
  function showPlans(){
    global $post;
    ob_start();
    $plans = get_field('plans', $post->ID);
    ?>
    <div class="plans row">
    <?php
    foreach($plans as $plan){
        ?>
        <div class="col">
        <?php
        // echo $plan->post_title;
        $icon = get_field('icon', $plan->ID);
        echo("<div class='icon'><img src='$icon'/></div>");
        // print_r($icon);
        // print_r( get_field('plan_name', $plan->ID));
        // print_r( get_field('price', $plan->ID));
        // print_r( get_field('vat_rate', $plan->ID));
        // print_r( get_field('data', $plan->ID));
        // print_r( get_field('local', $plan->ID));
        // print_r( get_field('intl', $plan->ID));
        // print_r( get_field('button', $plan->ID));

        $planName = get_field('plan_name', $plan->ID);
        $price = get_field('price', $plan->ID);
        $vatRate = get_field('vat_rate', $plan->ID);
        $data = get_field('data', $plan->ID);
        $local = get_field('local', $plan->ID);
        $intl = get_field('intl', $plan->ID);
        $free_shipping = get_field('free_shipping', $plan->ID);
        $simortext = get_field('simortext', $plan->ID);
        $extra = get_field('extra', $plan->ID);
        $button = get_field('button', $plan->ID);

        echo("<div class='plan'>$planName</div>");
        echo("<div class='price'>$price</div>");
        echo("<div class='vat'>$vatRate</div>");
        echo("<div class='data'>$data</div>");
        echo("<div class='local'>$local</div>");
        echo("<div class='intl'>$intl</div>");
        echo("<div class='free_shipping'>$free_shipping</div>");
        echo("<div class='simortext'>$simortext</div>");
        echo("<div class='extra'>$extra</div>");
        echo("<a href='$button' class='button'>Order Now</a>");
        
        ?>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  } // plans shortCode end ---

function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );

// Update alt text of the images in Library
function update_alt_text_for_existing_images() {
    $images = get_posts(array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1,
    ));

    foreach ($images as $image) {
        $image_id = $image->ID;
        $image_title = get_the_title($image_id);
        $alt_text = $image_title; // Use the image title as the alt text
        update_post_meta($image_id, '_wp_attachment_image_alt', $alt_text);
    }
}

add_action('admin_init', 'update_alt_text_for_existing_images');

// Update alt tag if image don't have alt tag
function add_image_name_as_alt_text($content) {
    // Get all image tags from the content using a regular expression
    preg_match_all('/<img\s+[^>]*>/', $content, $matches);

    if (isset($matches[0]) && !empty($matches[0])) {
        foreach ($matches[0] as $img_tag) {
            // Check if the alt attribute is missing in the image tag
            if (strpos($img_tag, 'alt=') === false) {
                // Get the image filename from the src attribute
                preg_match('/src="([^"]+)"/', $img_tag, $src_match);
                if (isset($src_match[1])) {
                    $image_src = $src_match[1];
                    $image_filename = basename($image_src);

                    // Add the alt attribute with the image filename as alt text
                    $updated_img_tag = str_replace('<img ', '<img alt="' . esc_attr($image_filename) . '" ', $img_tag);

                    // Replace the old image tag with the updated one in the content
                    $content = str_replace($img_tag, $updated_img_tag, $content);
                }
            }
        }
    }

    return $content;
}

// update images alt tag in header and footer
function add_js_for_header_and_footer() {
    ?>
    <script>
        // Function to add image filename as alt text to img tags
        function addAltTextToImagesInHeaderAndFooter() {
            const headerImages = document.querySelectorAll('header img');
            const footerImages = document.querySelectorAll('footer img');
            const otherImages = document.querySelectorAll('img[data-src]');

            function addAltTextToImages(images) {
                images.forEach(img => {
                    if (!img.alt) {
                        const imageSrc = img.src || img.getAttribute('data-src');
                        const imageFilename = imageSrc.substring(imageSrc.lastIndexOf('/') + 1);
                        img.alt = imageFilename;
                    }
                });
            }

            addAltTextToImages(headerImages);
            addAltTextToImages(footerImages);
            addAltTextToImages(otherImages);
        }

        document.addEventListener('DOMContentLoaded', addAltTextToImagesInHeaderAndFooter);
    </script>
    <?php
}
add_action('wp_footer', 'add_js_for_header_and_footer');



// Hook the function to the_content filter to apply it to the entire content
add_filter('the_content', 'add_image_name_as_alt_text');
add_filter('the_excerpt', 'add_image_name_as_alt_text', 99);

// Update Aria-labels a tag
// Function to add aria-label attribute to anchor tags in content
// Function to add aria-label in images attribute to anchor tags in content
function add_aria_label_to_content_links($content) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    // Target anchor tags in the content
    $anchor_tags = $xpath->query('//a[not(@aria-label)]');

    if ($anchor_tags->length > 0) {
        foreach ($anchor_tags as $anchor) {
            $href_value = $anchor->getAttribute('href');
            $aria_label = empty($href_value) || $href_value === '#' ? 'no-link' : $href_value;
            $anchor->setAttribute('aria-label', $aria_label);
        }
    }

    return $dom->saveHTML();
}

// Hook the function to the_content filter to apply it to the entire content
add_filter('the_content', 'add_aria_label_to_content_links', 99);

// Hook the function to the_excerpt filter to apply it to the blog page (excerpts)
add_filter('the_excerpt', 'add_aria_label_to_content_links', 99);

// Add Aria-label in images in the header footer tags
function add_aria_label_script() {
  ?>
  <script>
    // Function to add aria-label attribute to anchor tags
    function addAriaLabelToLinks(selector) {
      const anchorTags = document.querySelectorAll(selector);
      anchorTags.forEach((anchor) => {
        const hrefValue = anchor.getAttribute('href');
        const ariaLabel = hrefValue && hrefValue !== '#' ? hrefValue : 'no-link';
        anchor.setAttribute('aria-label', ariaLabel);
      });
    }

    // Call the function to add aria-label to anchor tags in the header
    document.addEventListener('DOMContentLoaded', function () {
      addAriaLabelToLinks('header a');
    });

    // Call the function to add aria-label to anchor tags in the footer
    window.addEventListener('load', function () {
      addAriaLabelToLinks('footer a');
    });
  </script>
  <?php
}

// Hook the function to wp_footer action to add the script to the footer
add_action('wp_footer', 'add_aria_label_script');

// add aria-label in the inputs
function add_aria_label_to_input_fields($content) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
    libxml_use_internal_errors(false);

    $inputFields = $dom->getElementsByTagName('input');

    foreach ($inputFields as $input) {
        $ariaLabel = '';

        if ($input->hasAttribute('value')) {
            $ariaLabel .= $input->getAttribute('value') . ' ';
        }

        if ($input->hasAttribute('type')) {
            $ariaLabel .= $input->getAttribute('type') . ' ';
        }

        if ($input->hasAttribute('placeholder')) {
            $ariaLabel .= $input->getAttribute('placeholder') . ' ';
        }

        // Trim any extra spaces and set the aria-label attribute
        $ariaLabel = trim($ariaLabel);
        if ($ariaLabel !== '') {
            $input->setAttribute('aria-label', $ariaLabel);
        }
    }

    $updatedContent = $dom->saveHTML();
    return $updatedContent;
}
add_filter('the_content', 'add_aria_label_to_input_fields');
add_filter('the_excerpt', 'add_aria_label_to_input_fields', 99);
// Check if the function 'add_aria_label_to_input_header_footer' is not already defined
if (!function_exists('add_aria_label_to_input_header_footer')) {
    function add_aria_label_to_input_header_footer() {
        ?>
        <script>
            function addAriaLabelToInputFields(selector) {
                const inputFields = document.querySelectorAll(selector);

                inputFields.forEach(input => {
                    let ariaLabel = '';

                    if (input.hasAttribute('value')) {
                        ariaLabel += input.getAttribute('value') + ' ';
                    }

                    if (input.hasAttribute('type')) {
                        ariaLabel += input.getAttribute('type') + ' ';
                    }

                    if (input.hasAttribute('placeholder')) {
                        ariaLabel += input.getAttribute('placeholder') + ' ';
                    }

                    ariaLabel = ariaLabel.trim();
                    if (ariaLabel !== '') {
                        input.setAttribute('aria-label', ariaLabel);
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                // Add aria-label to input fields in header
                addAriaLabelToInputFields('header input');

                // Add aria-label to input fields in footer
                addAriaLabelToInputFields('footer input');
            });
        </script>
        <?php
    }
}

add_action('wp_footer', 'add_aria_label_to_input_header_footer');

function add_custom_js() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'add_custom_js');


