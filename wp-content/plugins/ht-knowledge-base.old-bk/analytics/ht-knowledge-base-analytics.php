<?php
/**
* Analytics module
* Displays analytics information for the knowledge base
*
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'HKB_Analytics_Module' )) {
  
  //hkb store url
  if(!defined('HT_KB_STORE_URL')){
    define('HT_KB_STORE_URL', 'https://herothemes.com/plugins/heroic-wordpress-knowledge-base/');
  }


  if(!defined('HT_KB_ANALYTICS_BEGIN_DATE_META_KEY')){
    define('HT_KB_ANALYTICS_BEGIN_DATE_META_KEY', '_ht_kb_analytics_begin_date');
  }

  if(!defined('HT_KB_ANALYTICS_END_DATE_META_KEY')){
    define('HT_KB_ANALYTICS_END_DATE_META_KEY', '_ht_kb_analytics_end_date');
  }

  if(!defined('HT_KB_ANALYTICS_ACTIVE_PERIOD_META_KEY')){
    define('HT_KB_ANALYTICS_ACTIVE_PERIOD_META_KEY', '_ht_kb_analytics_active_period');
  }

  if(!defined('HT_KB_ANALYTICS_CLEAR_DATE_META_KEY')){
    define('HT_KB_ANALYTICS_CLEAR_DATE_META_KEY', '_ht_kb_analytics_clear_date');
  }


  class HKB_Analytics_Module {

    
    function __construct() {
        
        //add custom menu page
        add_action( 'admin_menu',  array( $this, 'ht_hkba_register_menu_page' ), 30 );
        
        //enqueue Admin Scripts
        add_action( 'admin_enqueue_scripts' , array( $this, 'hkba_admin_scripts' ) );
        
        //remove any date meta on login   
        add_action( 'wp_login', array( $this, 'ht_hkba_user_login' ), 10, 2 );


        //includes
        include_once('inc/dynamic-stats.php');
        include_once('inc/static-stats.php');
        include_once('inc/analytics-dashboard-widgets.php');
        @include_once('inc/test-data.php');
    }

    //register menu page
    function ht_hkba_register_menu_page() {
        //check analytics features are supported by the theme
        if(apply_filters('hkb_analytics_supported', true)){
            //add analytics menu page
            add_submenu_page( 'edit.php?post_type=ht_kb', __('Heroic Knowledge Base Analytics', 'ht-knowledge-base'), __('Analytics', 'ht-knowledge-base'), apply_filters( 'hkba_analytics_page_capability', 'manage_options' ), 'hkb-analytics', array($this, 'ht_hkba_page_callback'));
        }
    }

    //check for core plugin core
    function ht_hkba_check_for_plugin_class() {
        if( ! class_exists( 'HT_Knowledge_Base' ) ) {
            return new WP_Error( 'missing plugin core', sprintf( __( 'Looks like you are missing Heroic Knowledge Base. This plugin will not work without it, please re-download or purchase it from <a href="%s">the store.</a>', 'ht-knowledge-base'), HT_KB_STORE_URL ) );
        }
        $ht_knowledge_base_anayltics_db_version_ok = false;
        $db_version = get_option('hkb_analytics_search_atomic_db_version');
        if(FALSE===$db_version){
            //do nothing
        } else {
            $ht_knowledge_base_anayltics_db_version_ok = true;
        }
        if( ! $ht_knowledge_base_anayltics_db_version_ok ) {
            return new WP_Error( 'old plugin version', sprintf( __( 'Looks like you are running and older version of the Heroic Knowledge Base plugin, upgrade your plugin for the analytics module to work correctly', 'ht-knowledge-base'), HT_KB_STORE_URL ) );
        }
      }

    //add menu page
    function ht_hkba_page_callback() {
        //if it has been > 6hours since we last accessed this page, clear the user meta
        $user_ID = get_current_user_id();
        $last_clear_time = get_user_meta( $user_ID, HT_KB_ANALYTICS_CLEAR_DATE_META_KEY, true);
        //clear after 6 hours
        if( empty( $last_clear_time ) ||  ( $last_clear_time + ( 60*60*6 ) > time() ) ){
            //do nothing
        } else {
            //clear the user meta timestamps
            $this->ht_hkba_expire_user_dates_meta();
        }

        $dir = plugin_dir_path( __FILE__ );
        include( $dir . 'inc/analytics-admin-page.php' );
    }



    //scripts
    function hkba_admin_scripts() {
        //enqueue scripts
        if(isset($_GET['page']) && 'hkb-analytics' ===  $_GET['page']) {
            wp_enqueue_script( 'lib-google-charts', plugins_url('/js/chart.js',__FILE__), array(), '1.0.0', false );
            //enqueue script
            wp_enqueue_script( 'data-tables-script', plugins_url( '/js/datatables.min.js', __FILE__  ), array('jquery'), '1.10.7', true );

            wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );

            $ht_analytics_js_src = (HKB_DEBUG_SCRIPTS) ? '/js/ht-analytics.js' : '/js/ht-analytics.min.js';
            wp_enqueue_script( 'ht-analytics', plugins_url($ht_analytics_js_src,__FILE__), array('jquery', 'data-tables-script', 'jquery-ui-core', 'jquery-ui-datepicker', 'backbone', 'underscore'), '1.0.0', true );
        
            wp_enqueue_style( 'data-tables-style', plugins_url( '/css/datatables.css',  __FILE__  ) );

            wp_enqueue_style( 'jquery-ui-datepicker' );

            wp_register_style('jquery-ui', plugins_url('/css/jquery-ui.css',__FILE__ ) );
            wp_enqueue_style( 'jquery-ui' );

            wp_enqueue_style( 'analytics-admin-style',plugins_url('/css/analytics.css',__FILE__ ) );

            $user_ID = get_current_user_id();
            //get user meta
            $user_begin_date = get_user_meta( $user_ID, HT_KB_ANALYTICS_BEGIN_DATE_META_KEY, true);
            $user_end_date = get_user_meta( $user_ID, HT_KB_ANALYTICS_END_DATE_META_KEY, true);
            $user_active_period = get_user_meta( $user_ID, HT_KB_ANALYTICS_ACTIVE_PERIOD_META_KEY, true);

            $begin_date_offset = apply_filters('hkb_analytics_begin_date_offset', 0  );
            $end_date_offset = apply_filters('hkb_analytics_end_date_offset', DAY_IN_SECONDS );

            //tab
            $tab = isset($_GET['tab']) ? sanitize_text_field( $_GET['tab'] ) : '';

            //ensure tab isn't empty
            $tab = (empty($tab)) ? 'dashboard' : $tab;

            //analytics history days limit
            $analytics_history_days_limit = apply_filters('hkb_analytics_history_days_limit', 3650);

            wp_localize_script( 'ht-analytics', 'hkbAnalyticsChart', array( 'notEnoughResultsString' => __('Not enough data to report on', 'ht-knowledge-base'), 
                                                                            'noResultsString' => __('No Results', 'ht-knowledge-base'), 
                                                                            'returnedResultsString' => __('Returned Results', 'ht-knowledge-base'), 
                                                                            'dateFormat' => 'MM dd, yy', 
                                                                            'userBeginDate' => $user_begin_date,
                                                                            'userEndDate' => $user_end_date,
                                                                            'userActivePeriod' => $user_active_period,
                                                                            'beginDateOffset' => $begin_date_offset,
                                                                            'endDateOffset' => $end_date_offset,
                                                                            'analyticsHistoryDaysLimit' => $analytics_history_days_limit, 
                                                                            'tab' => $tab 
                                                                        ) );
        }
    }


    function ht_hkba_user_login($user_login, $user){
        //expire dates
        $this->ht_hkba_expire_user_dates_meta($user->ID);
    }

    //remove date meta
    function ht_hkba_expire_user_dates_meta($user_ID = null){
        $user_ID = (isset($user_ID)) ? $user_ID : get_current_user_id();
        delete_user_meta( $user_ID, HT_KB_ANALYTICS_BEGIN_DATE_META_KEY );
        delete_user_meta( $user_ID, HT_KB_ANALYTICS_END_DATE_META_KEY );
        delete_user_meta( $user_ID, HT_KB_ANALYTICS_ACTIVE_PERIOD_META_KEY );
        update_user_meta( $user_ID, HT_KB_ANALYTICS_CLEAR_DATE_META_KEY, time() );
    }


  }
}

//Run the Plugin
if( class_exists( 'HKB_Analytics_Module')) {
    $ht_hkba_init = new HKB_Analytics_Module();
}