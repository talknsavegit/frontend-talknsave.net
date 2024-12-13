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


$bundle_id = $b;
$link_id = $linkid;

$bundleIDs = explode(',', $bundle_id);
$linkIDs = explode(',', $link_id);

$planCount = count($bundleIDs);
$postObj = "[";
for ($x = 0; $x < $planCount; $x++) {
    $postObj .= "{";
    $postObj .= "'linkid':" . $linkIDs[$x] . ",";
	$postObj .= "'coupon':'" . $coupon . "',";
    $postObj .= "'b':" . $bundleIDs[$x];
    $postObj .= "},";
}
$postObj = rtrim($postObj, ',');
$postObj .= "]";

//return var_dump($postObj);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://wpapi.talknsave.us/api/Couponcode',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postObj,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$data = curl_exec($curl);
curl_close($curl);
$netJSON = json_decode($data, true);
echo $netJSON;
?>