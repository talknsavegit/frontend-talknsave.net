<?php

  $value = $_POST["value"];
//   $PostResult = json_decode($PostData);
//var_dump($PostData);
//return;

if($value == '48Aj$Pt#N6E@GbS1^oh'){
	$path = "http://wpapi.talknsave.net/api/bhlt";

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $path);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');

	$data = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($data, true);
	$htmlContent='';
	 foreach ($data as $order){
	  $tag=str_replace("[","",$order['Tag']);
		 $tag=str_replace("]","",$tag);
		 $tagmyArray = explode(',', $tag);
		$htmlContent .= '<tr>
      <td data-label="Online Order code"> '.$order['OnlineOrderCode'].'</td>
      <td data-label="user Name">'. $order['UserName'].'</td>
      <td data-label="Talmid Name">'. $tagmyArray[0] .'</td>
      <td data-label="Father`s Name">'. $tagmyArray[1]  .'</td>
		<td data-label="Name of Yeshiva in the US">'. $tagmyArray[2] .'</td>
      <td data-label="Name of His Rabbi in the US">'. $tagmyArray[3] .'</td>
      <td data-label="The Yeshiva you will be attending in Israel">'. $tagmyArray[4] .'</td></tr>' ;
	}
	echo $htmlContent;
}else{
	echo "false";
}

?>