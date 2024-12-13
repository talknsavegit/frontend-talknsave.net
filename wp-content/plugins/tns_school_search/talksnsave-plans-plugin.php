<?php
/*
Plugin Name: TalkNSave school search shortcode student short-term search box v2
*/
global $tns_db_connection2;
if($_SERVER['SERVER_ADDR']=='192.168.254.9') {    
    ini_set('display_errors', 'On');    
    error_reporting(E_ALL);
}
if (!(isset($tns_db_connection2) && $tns_db_connection2 != null && $tns_db_connection2->ping())) {
    $tns_db_connection2 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);    
    mysqli_select_db($tns_db_connection2, DB_NAME);
}
function tns_school_search_shortcode_init(){    
    function tns_school_search_shortcode2($atts = [], $content = null) {        
        require('templates/school_search_box.php');        
        $content.=(new SchoolSearchBox())->main();        
        return $content;    
    }    
    add_shortcode('tns_school_search2', 'tns_school_search_shortcode2');
}
add_action('init', 'tns_school_search_shortcode_init');
?>