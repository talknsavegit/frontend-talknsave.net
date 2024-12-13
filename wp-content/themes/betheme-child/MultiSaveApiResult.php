<?php

  $PostData = $_POST["SaveApiData"];
//   $PostResult = json_decode($PostData);
// var_dump($PostData);
// return;

// set post fields

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://wpapi.talknsave.net/api/MultipleOrder',
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


// $response = curl_exec($curl);
// $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// curl_close($curl);
// if ($httpStatusCode != 200) {
//     echo json_encode(['success'=>false,'msg'=>$response]);
// } else {
//     echo json_encode(['success'=>true,'msg'=>$response]);
// }

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>