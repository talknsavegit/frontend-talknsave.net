<?php
require ('Invoice.php');
use Knp\Snappy\Pdf;

add_action('wp',function(){
        global $invoice;
        if(is_page('invoice')):
             
            if(!empty($_GET['billid']) && !empty($_GET['code'])){
                //ini_set('display_errors','On');
                $bill = $_GET['billid'];
                $code = $_GET['code'];
                $invoice->init();
                $data = $invoice->get($bill);
                if($data['tblBills']['PhoneNumber'] != $code){
                    echo 'Record not found!';
                }else{

                    if(!empty($_GET['pdf'])){
                        $myProjectDirectory = get_stylesheet_directory();                    
                        //$snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'); // for 32bit architecture
                        $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
                        $snappy->setOption('viewport-size','2250x1080');
                        $snappy->setOption('cache-dir', $myProjectDirectory.'/scss/');
                        
                        header('Content-Type: application/pdf');
                        header('Content-Disposition: attachment; filename="talknsave-invoice-'.$bill.'.pdf"');
                        echo $snappy->getOutput(home_url().'/invoice/?billid='.$bill.'&code='.$code.'&pdfs=1');
                    }else{
                        get_template_part('custom-template/page','invoice',$data);
                    }
                    
                }
                
                exit;
            }
        
        endif;
    
});


add_action('wp_enqueue_scripts', 'enqueue_custom_script');
function enqueue_custom_script() {

    wp_enqueue_style('magnific-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css');
    wp_enqueue_script('magnific-js','https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js',array('jquery'),'1.0.0',true);
    
    
    
    //wp_enqueue_script('datepicker-js', get_stylesheet_directory_uri(). '/js/datepicker.min.js',array('jquery'),'1.0.0',true);

    wp_enqueue_script('custom-js', get_stylesheet_directory_uri(). '/js/customScript.js', array('jquery'),'1.0.3',true);
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri(). '/js/custom.js', array('jquery'),'1.1.1',true);
    //wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri().'/css/bootstrap.min.css');
    //wp_enqueue_style('datepicker-css', get_stylesheet_directory_uri().'/css/datepicker.css');

    // wp_enqueue_script('custom-js', get_stylesheet_directory_uri(). '/js/custom.js', ['jquery']);
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri().'/css/custom.css?v=1.06');

    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
    wp_register_style( 'jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui-css' );  
	
}

add_action( 'wp_footer', 'add_custom_loader' );
function add_custom_loader() {
    echo '<div class="loader"><img src="https://dev.newedgedesign.com/talknsave/wp-content/uploads/2021/01/talknsave-loader.gif" class="loader-icon" /></div><div id="cart-popup" class="white-popup mfp-hide">';
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
