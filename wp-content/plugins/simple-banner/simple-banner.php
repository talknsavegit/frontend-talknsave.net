<?php
/**
 * Plugin Name: Simple Banner
 * Plugin URI: https://github.com/rpetersen29/simple-banner
 * Description: Display a simple banner at the top or bottom of your website. Now with multi-banner support
 * Version: 3.0.3
 * Author: Ryan Petersen
 * Author URI: http://rpetersen29.github.io/
 * License: GPLv3
 *
 * @package Simple Banner
 * @version 3.0.3
 * @author Ryan Petersen <rpetersen.dev@gmail.com>
 */
define ('SB_VERSION', '3.0.3');

register_activation_hook( __FILE__, 'simple_banner_activate' );
function simple_banner_activate() {
	add_action('admin_menu', 'simple_banner_menu');
}

// Disabled Pages/Posts functions
function get_disabled_pages_array($banner_id) {
	return array_filter(explode(',', get_option('disabled_pages_array' . $banner_id)));
}
function get_post_object() {
	return get_posts(array('include' => array(get_the_ID())));
}
function get_is_current_page_a_post() {
	return !empty(get_post_object());
}
function get_disabled_on_posts($banner_id) {
	return get_option('disabled_on_posts' . $banner_id);
}
function get_is_removed_before_date($banner_id) {
	$start_after_date = get_option('simple_banner_start_after_date' . $banner_id);
	
	if (!$start_after_date) return false;

	$curr_date = new DateTime('now', new DateTimeZone('UTC'));
	$start_date = new DateTime($start_after_date);

	// Compare the dates
	if ($curr_date < $start_date) {
		return true;
	}
	return false;
}
function get_is_removed_after_date($banner_id) {
	$remove_after_date = get_option('simple_banner_remove_after_date' . $banner_id);
	
	if (!$remove_after_date) return false;

	$curr_date = new DateTime('now', new DateTimeZone('UTC'));
	$end_date = new DateTime($remove_after_date);

	// Compare the dates
	if ($curr_date > $end_date) {
		return true;
	}
	return false;
}
function get_disabled_on_current_page($banner_id) {
	$disabled_on_current_page = (!empty(get_disabled_pages_array($banner_id)) && in_array(get_the_ID(), get_disabled_pages_array($banner_id)))
								|| (get_disabled_on_posts($banner_id) && get_is_current_page_a_post()) || get_is_removed_before_date($banner_id) || get_is_removed_after_date($banner_id);
	return $disabled_on_current_page;
}


add_action( 'wp_enqueue_scripts', 'simple_banner' );
function simple_banner() {
    // Enqueue the style
	wp_register_style('simple-banner-style',  plugin_dir_url( __FILE__ ) .'simple-banner.css', '', SB_VERSION);
    wp_enqueue_style('simple-banner-style');


	// Set Script parameters
    $script_params = array(
		// General settings
		'pro_version_enabled' => get_option('pro_version_enabled'),
		// debug specific parameters
		'debug_mode' => get_option('simple_banner_debug_mode'),
		'id' => get_the_ID(),
		'version' => SB_VERSION,
	);
	$banner_params = array();
    for ($i = 1; $i <= get_num_banners(); $i++) {
    	$banner_id = get_banner_id($i);

		$disabled_on_current_page = get_disabled_on_current_page($banner_id);

		$banner_params[] = array(
			'hide_simple_banner' => get_option('hide_simple_banner' . $banner_id),
			'simple_banner_prepend_element' => get_option('simple_banner_prepend_element' . $banner_id),
			'simple_banner_position' => get_option('simple_banner_position' . $banner_id),
			'header_margin' => $i === 1 ? get_option('header_margin' . $banner_id) : '',
			'header_padding' => $i === 1 ? get_option('header_padding' . $banner_id) : '',
			'wp_body_open_enabled' => $i === 1 ? get_option('wp_body_open_enabled' . $banner_id) : '',
			'wp_body_open' => function_exists('wp_body_open'),
			'simple_banner_z_index' => get_option('simple_banner_z_index' . $banner_id),
			'simple_banner_text' => get_option('simple_banner_text' . $banner_id),
			'disabled_on_current_page' => $disabled_on_current_page,
			'disabled_pages_array' => get_disabled_pages_array($banner_id),
			'is_current_page_a_post' => get_is_current_page_a_post(),
			'disabled_on_posts' => get_disabled_on_posts($banner_id),
			'simple_banner_disabled_page_paths' => get_option('simple_banner_disabled_page_paths' . $banner_id),
			'simple_banner_font_size' => get_option('simple_banner_font_size' . $banner_id),
			'simple_banner_color' => get_option('simple_banner_color' . $banner_id),
			'simple_banner_text_color' => get_option('simple_banner_text_color' . $banner_id),
			'simple_banner_link_color' => get_option('simple_banner_link_color' . $banner_id),
			'simple_banner_close_color' => get_option('simple_banner_close_color' . $banner_id),
			'simple_banner_text' => $disabled_on_current_page ? '' : get_option('simple_banner_text' . $banner_id),
			'simple_banner_custom_css' => get_option('simple_banner_custom_css' . $banner_id),
			'simple_banner_scrolling_custom_css' => get_option('simple_banner_scrolling_custom_css' . $banner_id),
			'simple_banner_text_custom_css' => get_option('simple_banner_text_custom_css' . $banner_id),
			'simple_banner_button_css' => get_option('simple_banner_button_css' . $banner_id),
			'site_custom_css' => get_option('site_custom_css' . $banner_id),
			'keep_site_custom_css' => get_option('keep_site_custom_css' . $banner_id),
			'site_custom_js' => get_option('site_custom_js' . $banner_id),
			'keep_site_custom_js' => get_option('keep_site_custom_js' . $banner_id),
			'close_button_enabled' => get_option('close_button_enabled' . $banner_id),
			'close_button_expiration' => get_option('close_button_expiration' . $banner_id),
			'close_button_cookie_set' => isset($_COOKIE['simplebannerclosed' . $banner_id]),
			'current_date' => new DateTime('now', new DateTimeZone('UTC')),
			'start_date' => new DateTime(get_option('simple_banner_start_after_date' . $banner_id)),
			'end_date' => new DateTime(get_option('simple_banner_remove_after_date' . $banner_id)),
			'simple_banner_start_after_date' => get_option('simple_banner_start_after_date' . $banner_id),
			'simple_banner_remove_after_date' => get_option('simple_banner_remove_after_date' . $banner_id),
			'simple_banner_insert_inside_element' => get_option('simple_banner_insert_inside_element' . $banner_id),
		);
	}
	$script_params['banner_params'] = $banner_params;
	// Enqueue the script
    wp_register_script('simple-banner-script', plugin_dir_url( __FILE__ ) . 'simple-banner.js', array( 'jquery' ), SB_VERSION);
    wp_add_inline_script('simple-banner-script', 'const simpleBannerScriptParams = ' . wp_json_encode($script_params), 'before');
    wp_enqueue_script('simple-banner-script');
}

// Use `wp_body_open` action
// For now only enabled on Banner #1
if ( function_exists( 'wp_body_open' ) && get_option('wp_body_open_enabled') ) {
	add_action( 'wp_body_open', 'simple_banner_body_open' );
}
function simple_banner_body_open() {
	// Forcing the banner id concept for refactoring later with multiple ids
	$banner_id = get_banner_id(1);
	// if not disabled use wp_body_open
	$disabled_on_current_page = get_disabled_on_current_page($banner_id);
	$close_button_enabled = get_option('close_button_enabled' . $banner_id);
	$closed_cookie = $close_button_enabled && isset($_COOKIE['simplebannerclosed']);
	$closed_button = $close_button_enabled ? '<button id="simple-banner-close-button" class="simple-banner-button">&#x2715;</button>' : '';

	if (!$disabled_on_current_page && !$closed_cookie) {
		echo '<div id="simple-banner" class="simple-banner"><div class="simple-banner-text"><span>' 
		. get_option('simple_banner_text' . $banner_id) 
		. '</span></div>' 
		. $closed_button 
		. '</div>';
	}
}


// Prevent CSS removal from optimizer plugins by putting a dummy item in the DOM
add_action( 'wp_footer', 'prevent_css_removal');
function prevent_css_removal(){
	echo '<div class="simple-banner simple-banner-text" style="display:none !important"></div>';
}

// Add custom CSS/JS
add_action( 'wp_head', 'simple_banner_custom_options');
function simple_banner_custom_options()
{
	$pro_enabled = get_option('pro_version_enabled');
    for ($i = 1; $i <= get_num_banners(); $i++) {
    	// TODO: Make this all one script
    	$banner_id = get_banner_id($i);

		$closed_cookie = get_option('close_button_enabled' . $banner_id) && isset($_COOKIE['simplebannerclosed' . $banner_id]);

		$disabled_on_current_page = get_disabled_on_current_page($banner_id);
		$banner_is_disabled = $disabled_on_current_page || get_option('hide_simple_banner' . $banner_id) == "yes";

		if ($banner_is_disabled || $closed_cookie){
			echo '<style id="simple-banner-hide" type="text/css">.simple-banner'.$banner_id.'{display:none;}</style>';
		}

		if ($i === 1 && !$banner_is_disabled && !$closed_cookie && get_option('header_margin' . $banner_id) != ""){
			echo '<style id="simple-banner-header-margin'.$banner_id.'" type="text/css">header{margin-top:' . get_option('header_margin' . $banner_id) . ';}</style>';
		}

		if ($i === 1 && !$banner_is_disabled && !$closed_cookie && get_option('header_padding' . $banner_id) != ""){
			echo '<style id="simple-banner-header-padding'.$banner_id.'" type="text/css" >header{padding-top:' . get_option('header_padding' . $banner_id) . ';}</style>';
		}

		if (get_option('simple_banner_position' . $banner_id) != ""){
			if (get_option('simple_banner_position' . $banner_id) == 'footer'){
				echo '<style id="simple-banner-position'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{position:fixed;bottom:0;}</style>';
			} else {
				echo '<style id="simple-banner-position'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{position:' . get_option('simple_banner_position' . $banner_id) . ';}</style>';
			}
		}

		if (get_option('simple_banner_font_size' . $banner_id) != ""){
			echo '<style id="simple-banner-font-size'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.'{font-size:' . get_option('simple_banner_font_size' . $banner_id) . ';}</style>';
		}

		if (get_option('simple_banner_color' . $banner_id) != ""){
			echo '<style id="simple-banner-background-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{background:' . get_option('simple_banner_color' . $banner_id) . ';}</style>';
		} else {
			echo '<style id="simple-banner-background-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{background: #024985;}</style>';
		}

		if (get_option('simple_banner_text_color' . $banner_id) != ""){
			echo '<style id="simple-banner-text-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.'{color:' . get_option('simple_banner_text_color' . $banner_id) . ';}</style>';
		} else {
			echo '<style id="simple-banner-text-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.'{color: #ffffff;}</style>';
		}

		if (get_option('simple_banner_link_color' . $banner_id) != ""){
			echo '<style id="simple-banner-link-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.' a{color:' . get_option('simple_banner_link_color' . $banner_id) . ';}</style>';
		} else {
			echo '<style id="simple-banner-link-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.' a{color:#f16521;}</style>';
		}

		if (get_option('simple_banner_z_index' . $banner_id) != ""){
			echo '<style id="simple-banner-z-index'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{z-index:' . get_option('simple_banner_z_index' . $banner_id) . ';}</style>';
		} else {
			echo '<style id="simple-banner-z-index'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{z-index: 99999;}</style>';
		}

		if (get_option('simple_banner_close_color' . $banner_id) != ""){
			echo '<style id="simple-banner-close-color'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-button'.$banner_id.'{color:' . get_option('simple_banner_close_color' . $banner_id) . ';}</style>';
		}

		if (get_option('simple_banner_custom_css' . $banner_id) != ""){
			echo '<style id="simple-banner-custom-css'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.'{'. get_option('simple_banner_custom_css' . $banner_id) . '}</style>';
		}

		if (get_option('simple_banner_scrolling_custom_css'.$banner_id.'' . $banner_id) != ""){
			echo '<style id="simple-banner-scrolling-custom-css" type="text/css">.simple-banner'.$banner_id.'.simple-banner-scrolling'.$banner_id.'{'. get_option('simple_banner_scrolling_custom_css' . $banner_id) . '}</style>';
		}

		if (get_option('simple_banner_text_custom_css' . $banner_id) != ""){
			echo '<style id="simple-banner-text-custom-css'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-text'.$banner_id.'{'. get_option('simple_banner_text_custom_css' . $banner_id) . '}</style>';
		}

		if (get_option('simple_banner_button_css' . $banner_id) != ""){
			echo '<style id="simple-banner-button-css'.$banner_id.'" type="text/css">.simple-banner'.$banner_id.' .simple-banner-button'.$banner_id.'{'. get_option('simple_banner_button_css' . $banner_id) . '}</style>';
		}

		$remove_site_custom_css = ($banner_is_disabled || $closed_cookie) && get_option('keep_site_custom_css' . $banner_id) == "";
		if (!$remove_site_custom_css && get_option('site_custom_css' . $banner_id) != "" && $pro_enabled) {
			echo '<style id="simple-banner-site-custom-css'.$banner_id.''.$banner_id.'" type="text/css">'. get_option('site_custom_css' . $banner_id) . '</style>';
		} else if ($i === 1) {
			// put a dummy element to see if css is being bundled
			echo '<style id="simple-banner-site-custom-css-dummy'.$banner_id.'" type="text/css"></style>';
		}

		$remove_site_custom_js = ($banner_is_disabled || $closed_cookie) && get_option('keep_site_custom_js' . $banner_id) == "";
		if (!$remove_site_custom_js && get_option('site_custom_js' . $banner_id) != "" && $pro_enabled) {
			echo '<script id="simple-banner-site-custom-js'.$banner_id.''.$banner_id.'" type="text/javascript">'. get_option('site_custom_js' . $banner_id) . '</script>';
		} else if ($i === 1) {
			// put a dummy element to see if scripts are being bundled
			echo '<script id="simple-banner-site-custom-js-dummy'.$banner_id.'" type="text/javascript"></script>';
		}
	}
}

add_action('admin_menu', 'simple_banner_menu');
function simple_banner_menu() {
	$manage_simple_banner = 'manage_simple_banner';
	$manage_options = 'manage_options';

	$permissions_array = get_option('permissions_array');

	// Add permissions for other roles
	foreach (get_editable_roles() as $role_name => $role_info) {
		if ( $role_name !== 'administrator') {
			if (in_array($role_name, explode(",", $permissions_array))) {
				$add_role = get_role( $role_name );
				$add_role->add_cap( $manage_simple_banner );
				$add_role->add_cap( $manage_options );
			} else {
				$remove_role = get_role( $role_name );
				// only remove capabilities if they were previously added
				if ($remove_role->has_cap( $manage_simple_banner )){
					$remove_role->remove_cap( $manage_simple_banner );
					$remove_role->remove_cap( $manage_options );
				}
			}
		}
	}

	add_menu_page('Simple Banner Settings', 'Simple Banner', $manage_options, 'simple-banner-settings', 'simple_banner_settings_page', 'dashicons-megaphone');
}


//script input sanitization function
function theme_slug_sanitize_js_code($input){
    return base64_encode($input);
}

//output escape function    
function theme_slug_escape_js_output($input){
    return esc_textarea( base64_decode($input) );
}

// get number of banners
function get_num_banners(){
    return get_option('pro_version_enabled') ? 5 : 1;
}
function get_banner_id($i){
    return $i === 1 ? '' : '_' . $i;
}

add_action( 'admin_init', 'simple_banner_settings' );
function simple_banner_settings() {
	// Register common settings
	register_setting( 'simple-banner-settings-group', 'pro_version_activation_code',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'pro_version_enabled',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'simple_banner_pro_license_key',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'simple_banner_debug_mode',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'permissions_array',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
    // Register banner 1 only settings
	register_setting( 'simple-banner-settings-group', 'header_margin',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'header_padding',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );
	register_setting( 'simple-banner-settings-group', 'wp_body_open_enabled',
		array(
	    	'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
    );

    for ($i = 1; $i <= get_num_banners(); $i++) {
    	/** 
    	 * Settings for first banner will have no suffix for backwards compatibility
    	 * and banners added afterwards will have _{NUMBER}
    	 */
    	$banner_id = get_banner_id($i);

		register_setting( 'simple-banner-settings-group', 'hide_simple_banner' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_prepend_element' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_font_size' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_color' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_text_color' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_link_color' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_close_color' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_text' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_kses_post'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_custom_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_scrolling_custom_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_text_custom_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_button_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_position' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_z_index' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'disabled_on_posts' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'disabled_pages_array' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'site_custom_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'keep_site_custom_css' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'site_custom_js' . $banner_id);
		register_setting( 'simple-banner-settings-group', 'keep_site_custom_js' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'close_button_enabled' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'close_button_expiration' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_start_after_date' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_remove_after_date' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_insert_inside_element' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_strip_all_tags'
			)
	    );
		register_setting( 'simple-banner-settings-group', 'simple_banner_disabled_page_paths' . $banner_id,
			array(
		    	'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
	    );
	}
}

function is_license_verified(){
	$license_key = esc_attr( get_option('simple_banner_pro_license_key') );
	// null check for license
	if (!$license_key){
		return false;
	}

	$is_pro_currently_enabled = esc_attr( get_option('pro_version_enabled') );

    $url = 'https://api.gumroad.com/v2/licenses/verify';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$data = array(
	    'product_id' => 'vg6aCpxipQHuI5yvYzSVEA==',
	    'license_key' => $license_key,
	    'increment_uses_count' => 'false',
	);

	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	
	// execute request and get response
	$result = curl_exec($ch);
	// Keeping for backwards compatibility
	// This function has no effect. Prior to PHP 8.0.0, this function was used to close the resource.
	curl_close($ch);

	// TODO: Figure out what to do with these
	// also get the error and response code
	// $errors = curl_error($ch);
	// $json_errors = json_decode($errors);
	// gumroad returns a 404 on invalid license code
	// e.g. {"success":false,"message":"That license does not exist for the provided product."}
	// $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	$json = json_decode($result);
	$success = $json->{'success'};

	// check if license is active
	// if error or unknown response return current value
	if ($success === true) {
		// now check if cancelled, failed, or ended
		$subscription_cancelled_at = $json->{'purchase'}->{'subscription_cancelled_at'};
		$subscription_failed_at = $json->{'purchase'}->{'subscription_failed_at'};
		$subscription_ended_at = $json->{'purchase'}->{'subscription_ended_at'};
		$curr_date = new DateTime('now');

		if ($subscription_cancelled_at) {
			$cancelled_date = new DateTime($subscription_cancelled_at);

			// Compare the dates
			if ($curr_date > $cancelled_date) {
			    return false;
			}
		}
		if ($subscription_failed_at) {
			$failed_date = new DateTime($subscription_failed_at);

			// Compare the dates
			if ($curr_date > $failed_date) {
			    return false;
			}
		}
		if ($subscription_ended_at) {
			$ended_date = new DateTime($subscription_ended_at);

			// Compare the dates
			if ($curr_date > $ended_date) {
			    return false;
			}
		}
		return true;
	} else if ($success === false) {
		return false;
	}
	return $is_pro_currently_enabled;
}

function simple_banner_settings_page() {
	?>
	<?php
		$is_verified = is_license_verified();
		update_option('pro_version_enabled', $is_verified);
	?>

	<style type="text/css" id="settings_stylesheet">
		.simple-banner-settings-form th {width: 30%;}
		.simple-banner-settings-form th div {font-size: 13px;font-weight: 400;}
		.simple-banner-settings-form th div code {font-size: 12px;}
		#mobile-alert {
			padding: 10px;
			margin: 10px 0;
			border: 2px solid red;
			border-radius: 10px;
			background-color: white;
			color: red;
			font-size: medium;
			font-weight: bold;
			text-align: center;
		}
	</style>

	<div class="wrap">
		<div style="display: flex;justify-content: space-between;">
			<h1 style="font-weight: 700;">Simple Banner Settings</h1>
			<a class="button button-primary button-hero" style="font-weight: 700;" href="https://www.paypal.me/rpetersenDev" target="_blank">DONATE</a>
		</div>

		<p>Links in the banner text must be typed in with HTML <code>&lt;a&gt;</code> tags.
		<br />e.g. <code>This is a &lt;a href=&#34;http:&#47;&#47;www.wordpress.com&#34;&gt;Link to Wordpress&lt;&#47;a&gt;</code>.</p>

		<!-- Preview Banner -->
		<?php
            for ($i = 1; $i <= get_num_banners(); $i++) {
				$banner_id = get_banner_id($i);
                include 'preview_banner.php';
            }
       	?>
		<br>
		<span><b><i>Note: Font and text styles subject to change based on chosen theme CSS.</i></b></span>

		<!-- Settings Form -->
		<form class="simple-banner-settings-form" method="post" action="options.php">
			<?php settings_fields( 'simple-banner-settings-group' ); ?>

			<div style="margin-bottom:10px;">
				<h3 style="margin-bottom:0.2em;">Multi-banner support <span style="color: limegreen;">EXPERIMENTAL</span></h3>
				<div style="margin-bottom:1em;">Display up to 5 banners on your site.</div>

				<div style="display:flex;align-items:center;gap:5px;padding: 10px;border: 2px solid gold;border-radius: 10px;background-color: #fafafa;">
					<span style="font-size: 14px;font-weight: bold;">Select Banner</span>
	                <!-- Put select box here -->
	                <select id="banner_selector">
					  <?php
                        for ($i = 1; $i <= get_num_banners(); $i++) {
                        	if ($i === 1) {
                        		echo '<option value="">Banner #1</option>';
                        	} else {
                            	echo '<option value="_' . $i . '">Banner #'. $i . '</option>';
                        	}
                        }
	                   ?>
					</select>

					<?php
			            if (!get_option('pro_version_enabled')) {
			                echo '<a class="button-primary" href="https://rpetersendev.gumroad.com/l/simple-banner" target="_blank">Purchase Pro License</a>';
			            }
			        ?>
                </div>
			</div>

			<?php
                for ($i = 1; $i <= get_num_banners(); $i++) {
    				$banner_id = get_banner_id($i);
                    include 'free_features.php';
                }
           	?>

			<div id="mobile-alert">
				Always make sure you test your banner in mobile views, theme headers often change their css for mobile.
			</div>

			<?php
                for ($i = 1; $i <= get_num_banners(); $i++) {
    				$banner_id = get_banner_id($i);
                    include 'pro_features.php';
                }
           	?>

           	<?php include 'pro_features_general_settings.php' ?>

			<!-- Save Changes Button -->
			<?php submit_button(); ?>
		</form>
	</div>

	<!-- Script to apply styles to Preview Banner -->
	<script type="text/javascript">
		// Simple Banner Default Stylesheet
		const simple_banner_css = document.createElement('link');
		simple_banner_css.id = 'simple-banner-stylesheet';
		simple_banner_css.rel = 'stylesheet';
		simple_banner_css.href = "<?php echo plugin_dir_url( __FILE__ ) .'simple-banner.css' ?>";
		document.getElementsByTagName('head')[0].appendChild(simple_banner_css);

		// START MULTI BANNER
		const num_banners = <?php echo get_num_banners(); ?>;

		for (let i = 1; i <= num_banners; i++) {
			const banner_id = i === 1 ? '' : `_${i}`;

			const style_font_size = document.createElement('style');
			const style_background_color = document.createElement('style');
			const style_link_color = document.createElement('style');
			const style_text_color = document.createElement('style');
			const style_close_color = document.createElement('style');
			const style_custom_css = document.createElement('style');
			const style_custom_text_css = document.createElement('style');
			const style_custom_button_css = document.createElement('style');

			// Banner Text
			const hrefRegex = /href\=[\'\"](?!http|https)([^\/].*?)[\'\"]/gsi;
			const scriptStyleRegex = /<(script|style)[^>]*?>.*?<\/(script|style)>/gsi;
			function stripBannerText(string) {
				let strippedString = string;
				while (strippedString.match(scriptStyleRegex)) { 
				    strippedString = strippedString.replace(scriptStyleRegex, '')
				};
				return strippedString.replace(hrefRegex, "href=\"https://$1\"");
			}
			document.getElementById(`preview_banner_text${banner_id}`).innerHTML = document.getElementById(`simple_banner_text${banner_id}`).value != "" ? 
							'<span>'+stripBannerText(document.getElementById(`simple_banner_text${banner_id}`).value)+'</span>' : 
							'<span>This is what your banner will look like with a <a href="/">link</a>.</span>';
			document.getElementById(`simple_banner_text${banner_id}`).onchange=function(e){
				document.getElementById(`preview_banner_text${banner_id}`).innerHTML = e.target.value != "" ? '<span>'+stripBannerText(e.target.value)+'</span>' : '<span>This is what your banner will look like with a <a href="/">link</a>.</span>';
			};

			// Close Button
			const closeButton = `<button id="simple-banner-close-button${banner_id}" class="simple-banner-button${banner_id}">✕</button>`;
			const closeButtonChecked = document.getElementById(`close_button_enabled${banner_id}`).checked;
			const closeButtonInitialValue = closeButtonChecked ? closeButton : '';
			document.getElementById(`preview_banner${banner_id}`).innerHTML = document.getElementById(`preview_banner${banner_id}`).innerHTML + closeButtonInitialValue;
			document.getElementById(`close_button_enabled${banner_id}`).onchange=function(e){
				const str = document.getElementById(`preview_banner${banner_id}`).innerHTML; 
				if (e.target.checked) {
					document.getElementById(`preview_banner${banner_id}`).innerHTML = str + closeButton;
				} else {
					const res = str.replace(closeButton, '');
					document.getElementById(`preview_banner${banner_id}`).innerHTML = res;
				}
			};

			// Font Size
			style_font_size.type = 'text/css';
			style_font_size.id = `preview_banner_font_size${banner_id}`;
			style_font_size.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-text${banner_id}{font-size:` + (document.getElementById(`simple_banner_font_size${banner_id}`).value || '1em') + ';line-height:1.55;}'));
			document.getElementsByTagName('head')[0].appendChild(style_font_size);

			document.getElementById(`simple_banner_font_size${banner_id}`).onchange=function(e){
				const child = document.getElementById(`preview_banner_font_size${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_font_size${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-text${banner_id}{font-size:` + (document.getElementById(`simple_banner_font_size${banner_id}`).value || '1em') + ';line-height:1.55;}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};

			// Background Color
			style_background_color.type = 'text/css';
			style_background_color.id = `preview_banner_background_color${banner_id}`;
			style_background_color.appendChild(document.createTextNode(`.simple-banner${banner_id}{background:` + (document.getElementById(`simple_banner_color${banner_id}`).value || '#024985') + '}'));
			document.getElementsByTagName('head')[0].appendChild(style_background_color);

			document.getElementById(`simple_banner_color${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_color_show${banner_id}`).value = e.target.value || '#024985';
				const child = document.getElementById(`preview_banner_background_color${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_background_color${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id}{background:` + (document.getElementById(`simple_banner_color${banner_id}`).value || '#024985') + '}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};
			document.getElementById(`simple_banner_color_show${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_color${banner_id}`).value = e.target.value;
				document.getElementById(`simple_banner_color${banner_id}`).dispatchEvent(new Event('change'));
			};

			// Text Color
			style_text_color.type = 'text/css';
			style_text_color.id = `preview_banner_text_color${banner_id}`;
			style_text_color.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-text${banner_id}{color:` + (document.getElementById(`simple_banner_text_color${banner_id}`).value || '#ffffff') + '}'));
			document.getElementsByTagName('head')[0].appendChild(style_text_color);

			document.getElementById(`simple_banner_text_color${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_text_color_show${banner_id}`).value = e.target.value || '#ffffff';
				const child = document.getElementById(`preview_banner_text_color${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_text_color${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-text${banner_id}{color:` + (document.getElementById(`simple_banner_text_color${banner_id}`).value || '#ffffff') + '}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};
			document.getElementById(`simple_banner_text_color_show${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_text_color${banner_id}`).value = e.target.value;
				document.getElementById(`simple_banner_text_color${banner_id}`).dispatchEvent(new Event('change'));
			};

			// Link Color
			style_link_color.type = 'text/css';
			style_link_color.id = `preview_banner_link_color${banner_id}`;
			style_link_color.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-text${banner_id} a{color:` + (document.getElementById(`simple_banner_link_color${banner_id}`).value || '#f16521') + '}'));
			document.getElementsByTagName('head')[0].appendChild(style_link_color);

			document.getElementById(`simple_banner_link_color${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_link_color_show${banner_id}`).value = e.target.value || '#f16521';
				const child = document.getElementById(`preview_banner_link_color${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_link_color${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-text${banner_id} a{color:` + (document.getElementById(`simple_banner_link_color${banner_id}`).value || '#f16521') + '}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};
			document.getElementById(`simple_banner_link_color_show${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_link_color${banner_id}`).value = e.target.value;
				document.getElementById(`simple_banner_link_color${banner_id}`).dispatchEvent(new Event('change'));
			};

			// Close Color
			style_close_color.type = 'text/css';
			style_close_color.id = `preview_banner_close_color${banner_id}`;
			style_close_color.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-button${banner_id}{color:` + (document.getElementById(`simple_banner_close_color${banner_id}`).value || 'black') + '}'));
			document.getElementsByTagName('head')[0].appendChild(style_close_color);

			document.getElementById(`simple_banner_close_color${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_close_color_show${banner_id}`).value = e.target.value || 'black';
				const child = document.getElementById(`preview_banner_close_color${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_close_color${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-button${banner_id}{color:` + (document.getElementById(`simple_banner_close_color${banner_id}`).value || 'black') + '}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};
			document.getElementById(`simple_banner_close_color_show${banner_id}`).onchange=function(e){
				document.getElementById(`simple_banner_close_color${banner_id}`).value = e.target.value;
				document.getElementById(`simple_banner_close_color${banner_id}`).dispatchEvent(new Event('change'));
			};

			// Custom CSS
			style_custom_css.type = 'text/css';
			style_custom_css.id = `preview_banner_custom_stylesheet${banner_id}`;
			style_custom_css.appendChild(document.createTextNode(`.simple-banner${banner_id}{`+document.getElementById(`simple_banner_custom_css${banner_id}`).value+'}'));
			document.getElementsByTagName('head')[0].appendChild(style_custom_css);

			document.getElementById(`simple_banner_custom_css${banner_id}`).onchange=function(){
				const child = document.getElementById(`preview_banner_custom_stylesheet${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_custom_stylesheet${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id}{`+document.getElementById(`simple_banner_custom_css${banner_id}`).value+'}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};

			// Custom Text CSS
			style_custom_text_css.type = 'text/css';
			style_custom_text_css.id = `preview_banner_custom_text_stylesheet${banner_id}`;
			style_custom_text_css.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-text${banner_id}{`+document.getElementById(`simple_banner_text_custom_css${banner_id}`).value+'}'));
			document.getElementsByTagName('head')[0].appendChild(style_custom_text_css);

			document.getElementById(`simple_banner_text_custom_css${banner_id}`).onchange=function(){
				const child = document.getElementById(`preview_banner_custom_text_stylesheet${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_custom_text_stylesheet${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-text${banner_id}{`+document.getElementById(`simple_banner_text_custom_css${banner_id}`).value+'}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};

			// Custom Button CSS
			style_custom_button_css.type = 'text/css';
			style_custom_button_css.id = `preview_banner_custom_button_stylesheet${banner_id}`;
			style_custom_button_css.appendChild(document.createTextNode(`.simple-banner${banner_id} .simple-banner-button${banner_id}{`+document.getElementById(`simple_banner_button_css${banner_id}`).value+'}'));
			document.getElementsByTagName('head')[0].appendChild(style_custom_button_css);

			document.getElementById(`simple_banner_button_css${banner_id}`).onchange=function(){
				const child = document.getElementById(`preview_banner_custom_button_stylesheet${banner_id}`);
				if (child){child.innerText = "";child.id='';}

				const style_dynamic = document.createElement('style');
				style_dynamic.type = 'text/css';
				style_dynamic.id = `preview_banner_custom_button_stylesheet${banner_id}`;
				style_dynamic.appendChild(
					document.createTextNode(
						`.simple-banner${banner_id} .simple-banner-button${banner_id}{`+document.getElementById(`simple_banner_button_css${banner_id}`).value+'}'
					)
				);
				document.getElementsByTagName('head')[0].appendChild(style_dynamic);
			};

			// Disabled Pages
			document.getElementById(`simple_banner_pro_disabled_pages${banner_id}`).onclick=function(e){
				let disabledPagesArray = [];
				Array.from(document.getElementById(`simple_banner_pro_disabled_pages${banner_id}`).getElementsByTagName('input')).forEach(function(e) {
					if (e.checked) {
						disabledPagesArray.push(e.value);
					}
				});
				document.getElementById(`disabled_pages_array${banner_id}`).value = disabledPagesArray;
			};
		}


		// Fixed Preview Banner on scroll
		function fixedBanner() {
			for (let i = 1; i <= num_banners; i++) {
				const banner_id = i === 1 ? '' : `_${i}`;		
				const elementContainer = document.getElementById(`preview_banner_outer_container${banner_id}`);
				const elementTarget = document.getElementById(`preview_banner_inner_container${banner_id}`);
				if (window.scrollY > (elementContainer.offsetTop)) {
					elementTarget.style.position = 'fixed';
					elementTarget.style.width = '83.111%';
					elementTarget.style.top = '40px';
				} else {
					elementTarget.style.position = 'relative';
					elementTarget.style.width = '100%';
					elementTarget.style.top = '0';
				}
			}
		}
		window.onscroll = fixedBanner;

		// remove banner text newlines on submit
		document.getElementById('submit').onclick=function(e){
			for (let i = 1; i <= num_banners; i++) {
				const banner_id = i === 1 ? '' : `_${i}`;
				document.getElementById(`simple_banner_text${banner_id}`).value = document.getElementById(`simple_banner_text${banner_id}`).value.replace(/\n/g, "");
			}
		};

		// Permissions
		document.getElementById('simple_banner_pro_permissions').onclick=function(e){
			let permissionsArray = [];
			Array.from(document.getElementById('simple_banner_pro_permissions').getElementsByTagName('input')).forEach(function(e) {
				if (e.checked) {
					permissionsArray.push(e.value);
				}
			});
			document.getElementById('permissions_array').value = permissionsArray;
		};

		// Switch Banners
		document.getElementById('banner_selector').onchange=function(e){
			document.querySelectorAll('.simple-banner-settings-section').forEach(section => section.style.display = 'none');
			document.getElementById(`free_section${e.target.value}`).style.display = 'block';
			document.getElementById(`pro_section${e.target.value}`).style.display = 'block';
			document.getElementById(`preview_banner_outer_container${e.target.value}`).style.display = 'block';
		}
	</script>
	<?php
}
?>
