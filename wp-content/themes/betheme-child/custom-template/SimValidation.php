<?php 
$path = "http://wpapi.talknsave.us/api/sim?SIMNumber=8997250400009244136";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $path);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

$data = curl_exec($ch);
curl_close($ch);
$data = json_decode($data, true);
echo $data; 
?>