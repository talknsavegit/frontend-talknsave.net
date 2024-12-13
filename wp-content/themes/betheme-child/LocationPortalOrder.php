<?php

  $PostData = $_POST["SaveApiData"];
// 	$PostData['bitUSA_SIM_Order'] = 1;
//   $PostResult = json_decode($PostData);
// var_dump($PostData);
// return;

// set post fields

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://wpapi.talknsave.net/LocationPortalOrder/LocationPortalOrderPlaceAndPay',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$PostData,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>