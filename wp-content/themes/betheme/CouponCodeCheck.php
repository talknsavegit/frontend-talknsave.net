<?php 

$coupon='';
$linkid='';
$b='';
if(isset($_GET['coupon'])){
    $coupon=$_GET['coupon'];
}
if(isset($_GET['linkid'])){
    $linkid=$_GET['linkid'];
}
if(isset($_GET['b'])){
    $b=$_GET['b'];
}


$path = "http://wpapi.talknsave.us/api/CouponCode?coupon=".$coupon."&b=".$b."&linkid=".$linkid;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $path);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

$data = curl_exec($ch);
curl_close($ch);
$data = json_decode($data, true); 
$netJSON = json_encode($data);
echo $netJSON;
?>