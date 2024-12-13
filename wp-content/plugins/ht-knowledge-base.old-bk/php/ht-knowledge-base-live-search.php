<?php
/**
* Live search extension
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'HT_Knowledge_Base_Live_Search' ) ){
	class HT_Knowledge_Base_Live_Search {

		public $add_script;

		//Constructor
		function __construct(){
			add_filter( 'search_template', array($this, 'ht_knowledge_base_live_search_template') );
			//register scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'ht_knowledge_base_live_search_register_scripts' ) );	
			//add filter to print editor styles and scripts
			add_action( 'wp_footer', array( $this, 'ht_knowledge_base_live_search_print_scripts' ) );
			//add filter for hkb_search_url (used to display search url)
			add_filter( 'hkb_search_url', array( $this, 'ht_knowledge_base_search_url_filter' ), 10, 2 );
		}

		/**
		* Search results url filter
		*/
		function ht_knowledge_base_search_url_filter( $s=false, $ajax = false ){
			$search_url = '?';
			if($ajax){
				$search_url .= 'ajax=1&';
			} else {
				//no action required
			}
			$search_url .= 'ht-kb-search=1&';
			
			//if wpml is installed append language code if not in default language
			global $sitepress;
			if(defined('ICL_LANGUAGE_CODE') && isset($sitepress)){
				$default_lang = $sitepress->get_default_language();
				$url_format = $sitepress->get_setting( 'language_negotiation_type');

				switch ($url_format) {
					case 1:
						//directory, eg example.com/en/?s=test
						if($default_lang != ICL_LANGUAGE_CODE ){
							$search_url = ICL_LANGUAGE_CODE . '/' . $search_url;
						}
						break;
					case 2:
						//subdomain, eg en.example.com/?s=test
						//no modification required?
						break;						
					case 3:
						//parameter, eg example.com/?s=test&lang=en
						if($default_lang != ICL_LANGUAGE_CODE ){
							$search_url .= 'lang=' . ICL_LANGUAGE_CODE . '&';
						}
						break;					
					default:
						break;
				}
								
			}

			//polylang beta support (note polylang not yet fully supported)
			elseif(defined('ICL_LANGUAGE_CODE') && function_exists('pll_current_language')){
				$language = pll_current_language();
				$search_url .= 'lang=' . $language . '&';								
			}
			
			$search_url .= 's=';
			if($s){
				$search_url .= urlencode($s);
			}

			//apply filters
			$search_url = apply_filters('ht_kb_search_url', $search_url);

			return apply_filters( 'ht_kb_search_home_url', home_url( $search_url ) );
		}

		/**
		* Live search results functionality
		*/
		function ht_knowledge_base_live_search_template( $template ){
			//ensure this is a live search
			$ht_kb_search = ( array_key_exists('ht-kb-search', $_REQUEST) ) ? true : false;
			if( $ht_kb_search == false )
				return $template;

			if(!empty($_GET['ajax']) ? $_GET['ajax'] : null) { // Is Live Search 
				//check custom search

				//search string
				global $s;
				// Get FAQ cpt
				$ht_kb_cpt = 'ht_kb';

				if( is_string($s) && strlen($s) > apply_filters( 'ht_kb_livesearch_trigger_length', 3 ) ){
					hkb_get_template_part('hkb-search-ajax');
					wp_reset_query();

				}

				//required to stop 
				die();
			} else {
				//non ajax search
				return $template;
			}
		}

		/**
		* Enqueue the javascript for live search
		*/
		function ht_knowledge_base_live_search_register_scripts(){
			global $wp_customize;

			//register live search script
			wp_register_script('ht-kb-live-search-plugin', plugins_url( 'js/jquery.livesearch.js', dirname( __FILE__ ) ), array( 'jquery' ), false, true);
			$hkb_livesearch_js_src = (HKB_DEBUG_SCRIPTS) ? 'js/hkb-livesearch-js.js' : 'js/hkb-livesearch-js.min.js';
			wp_register_script('ht-kb-live-search', plugins_url( $hkb_livesearch_js_src, dirname( __FILE__ ) ), array( 'jquery', 'ht-kb-live-search-plugin' ), false, true);
			//don't focus search if in WP Customizer
			if ( !isset( $wp_customize ) ) {
				$focus_searchbox = !ht_kb_is_ht_kb_search() && hkb_focus_on_search_box();
			} else {
				$focus_searchbox = false;
			}
			$search_url = apply_filters('hkb_search_url', false, true);
			wp_localize_script( 'ht-kb-live-search', 'hkbJSSettings', array( 'liveSearchUrl' => $search_url, 'focusSearchBox' => $focus_searchbox ) );
		}

		/**
		* Print the javascript for live search
		*/
		function ht_knowledge_base_live_search_print_scripts() {
			if ( ! $this->add_script )
				return;

			wp_print_scripts('ht-kb-live-search-plugin');
			wp_print_scripts('ht-kb-live-search');
		}


		/**
		* Activate live search
		*/
		function ht_knowledge_base_activate_live_search(){
			$this->add_script = true;			
		}



    }//end class
}//end class test

//run the module
if(class_exists('HT_Knowledge_Base_Live_Search')){
	global $ht_knowledge_base_live_search_init;	
	$ht_knowledge_base_live_search_init = new HT_Knowledge_Base_Live_Search();
	
	function ht_knowledge_base_activate_live_search(){
		global $ht_knowledge_base_live_search_init;		
		$ht_knowledge_base_live_search_init->ht_knowledge_base_activate_live_search();
	}
}