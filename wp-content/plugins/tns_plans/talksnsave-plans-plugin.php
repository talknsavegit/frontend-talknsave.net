<?php
/*
Plugin Name: TalkNSave billing plans shortcodes student short-term v2
*/

//ini_set('error_reporting',E_ALL);
require_once(ABSPATH . 'wp-config.php');
global $tns_db_connection2;

if (!(isset($tns_db_connection2) && $tns_db_connection2 != null && $tns_db_connection2->ping())) {

    $tns_db_connection2 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);    
    mysqli_select_db($tns_db_connection2, DB_NAME);
}

function tns_plans_shortcodes_init2(){    

    function tns_schools_shortcode2($atts = [], $content = null)    {        

        require('templates/schools.php');        
        $content.=(new Schools())->main();        
        return $content;    
    }    
    add_shortcode('tns_schools2', 'tns_schools_shortcode2');
}
add_action('init', 'tns_plans_shortcodes_init2');
?>