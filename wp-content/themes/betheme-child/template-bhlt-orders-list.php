<?php
/**
 * Template Name: Bhlt Order Listing
 *
 * @package Betheme
 * @author Muffin Group
 * @link https://muffingroup.com
 */
// die();
// return;
// get_header();
get_template_part('includes/header', 'modernera');
?>

<?php
// global $woocommerce;
// $items = $woocommerce->cart->get_cart();
// foreach ($items as $item => $values) {
//     //$_product =  wc_get_product( $values['data']->get_id() );
//     $_product_id = $values['data']->get_id();
//     continue;
// }
// $bundle_id = get_field('bundle_id', $_product_id);
// $link_id = get_field('link_id', $_product_id);

$path = "http://wpapi.talknsave.net/api/bhlt";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $path);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

$data = curl_exec($ch);
curl_close($ch);
$data = json_decode($data, true);

// echo '<pre>';
// print_r($data);
// echo '</pre>';

?>
<style>
	#Footer{
		display:none;
	}
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 98%;
  table-layout: fixed;
	    margin-left: 12px;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
/* general styling */
body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}
	.d-none{
		display:none !important;
	}
	.authContainer{
		display: flex;
    	justify-content: center;
   		margin-top: 31px;
	}
	.error-message{
		color: red;
    font-size: 16px;
    font-weight: 600;
	}
</style>

<div class="authContainer">
	<div>
		<label>Please enter password:</label>
		<input type="password" class="userSecretkey">
		<p class="error-message d-none">Please enter valid password!</p>
		<button class="validatePassword">Verify</button>
	</div>
</div>

<table class="d-none order-data-container">
  <caption>BHLT Orders List</caption>
  <thead>
    <tr>
      <th scope="col">Order #</th>
      <th scope="col">User Name</th>
      <th scope="col">Talmid's Name</th>
      <th scope="col">Father's Name</th>
		<th scope="col">Name of Yeshiva in the US</th>
		<th scope="col">Name of His Rabbi in the US</th>
		<th scope="col">The Yeshiva you will be attending in Israel</th>
    </tr>
  </thead>
  <tbody class="bhlt-data">
	 
    
  </tbody>
</table>


<script>
$(document).ready(function(){
	$('.validatePassword').click(function(){
		var inputValue=$('.userSecretkey').val();
		$.post('https://talknsave.net/wp-content/themes/betheme-child/bhlt.php', {
                    value: inputValue
                },
                function(msg) {
					console.log(msg);
					if(msg !='false'){
						$('.authContainer').addClass('d-none');
						$('.order-data-container').removeClass('d-none');
						$('.bhlt-data').append(msg);
					}else{
						$('.error-message').removeClass('d-none');
					}
                });
        });
});
</script>
<?php
get_footer();
