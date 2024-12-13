<?php

$PAGE2URL = "/schools-new/"."?b=".$_GET['bundle_id'];

if (!session_id())

    session_start();

if(array_key_exists('bundle_id',$_GET)){

    $_SESSION['bundle_id'] = $_GET['bundle_id'];

}

header('Location: '.$PAGE2URL);

die();

?>