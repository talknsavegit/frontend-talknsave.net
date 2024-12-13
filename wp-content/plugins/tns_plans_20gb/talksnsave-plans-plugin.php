<?php
/*
Plugin Name: TalkNSave billing plans shortcodes student short-term 20gb v2
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

function tns_plans20gb_shortcodes_init2(){    

    function tns_schools20gb_shortcode2($atts = [], $content = null)    {        

        require('templates/schools20gb.php');        
        $content .= (new Schools20gb())->main();        
        return $content;    
    }    
    add_shortcode('tns_schools20gb2', 'tns_schools20gb_shortcode2');
}
add_action('init', 'tns_plans20gb_shortcodes_init2');
?>