<?php
/**
 * Plugin Name: Clip - Add-on for Go Pricing
 * Plugin URI:  http://go-pricing.com/add-ons/clip
 * Description: By using 'Clip - Add-on for Go Pricing' you can get pricing tables done way faster than before. You can add a Row or the entire content of a Column to the Clipboard by simply one click, they also can be reloaded using the Drag & Drop tool
 * Version:     2.0.0
 * Author:      Granth
 * Author URI:  http://granthweb.com
 * Text Domain: go_pricing_clip_textdomain
 * Domain Path: /lang
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;

// Prevent redeclaring class
if ( class_exists( 'GW_GoPricing_Clip' ) ) wp_die ( __( 'GW_GoPricing_Clip class has been declared!', 'go_pricing_clip_textdomain' ) );	

// Include & init main class
include_once( plugin_dir_path( __FILE__ ) . 'includes/class_clip.php' );
add_action( 'go_pricing_init', 'go_pricing_clip_init' );
function go_pricing_clip_init() {
	GW_GoPricing_Clip::instance( __FILE__ );
}

// Register activation / deactivation / uninstall hooks
register_activation_hook( __FILE__, array( 'GW_GoPricing_Clip', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'GW_GoPricing_Clip', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( 'GW_GoPricing_Clip', 'uninstall' ) );

// Activation error admin notice
add_action( 'admin_notices', array( 'GW_GoPricing_Clip', 'activate_error' ) );

?>