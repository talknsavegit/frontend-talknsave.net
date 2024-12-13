<?php 

require_once('vendor/autoload.php');

class Invoice{
    var $client, $call;
	
    function init(){
         
        $api = "https://websvcs-new.talknsave.net/IH_EXT_WS/BillingInfo.asmx?WSDL";
        // Config
     
		
		$this->client = new nusoap_client($api, 'WSDL');
		$this->client->soap_defencoding = 'UTF-8';
		$this->client->decode_utf8 = FALSE;
		$this->client->timeout = 0;
		$this->client->response_timeout = 300;
    	

    }
    
    function getRentalInfo($rental){
     
        $requestParams = array(
            "intRentalCode"=>$rental
        );
        
        $response = $this->client->call("WSC_GetRentalDataset",$requestParams);
        
        $records = $response['WSC_GetRentalDatasetResult']['diffgram'];

       

        if(count($records) > 0){

            return $records;
        }else{
            return false;
        }
    }
	
	
	
  function getBillsList($rental){
    

        $requestParams = array(
            "intRentalCode"=>$rental
        );
        $response = $this->client->call("GetBillsList",$requestParams);
       
        $records = $response['GetBillsListResult']['diffgram'];
        if(count($records) > 0){
            return $records;
        }else{
            return false;
        }
    }
    function call($id){
        
         
        $requestParams = array(
            'intBillID' => $id
        );
        $response = $this->client->call("GetBillTables",$requestParams);
       return $response['GetBillTablesResult']['diffgram'];

    }

    function callDetails($id){
     

        $curl = curl_init();
        $url = "https://wpapi.talknsave.net/api/call?billdID=".$id;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'secret: 1j_919mSpckJYIHT8ac_RJfVyOdDqVqSAkrJPRygnzIM',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
		 
        if(!$result){

            return array();
        }
        curl_close($curl);
        
        return json_decode($result,true);
    }
	
	    function KNTCallDetails($id){

        $curl = curl_init();
        $url = "https://wpapi.talknsave.net/api/call?KNTbilldID=".$id;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'secret: 1j_919mSpckJYIHT8ac_RJfVyOdDqVqSAkrJPRygnzIM',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        if(!$result){
            return array();
        }
        curl_close($curl);
        return json_decode($result,true);
    }

    function get($id){
    	
		
        $requestParams = array(
            'intBillID' => $id
        );
        $response = $this->getRentalInfo($id);
		
            $response = $this->client->call("GetBillDataset",$requestParams);
          
            $calls = $this->callDetails($id);
           	
		if($response['GetBillDatasetResult']['diffgram']['NewDataSet'] == ""){
            return false;
        }
            $response['GetBillDatasetResult']['diffgram']['NewDataSet']['calls'] = $calls;
            $records = $response['GetBillDatasetResult']['diffgram']['NewDataSet']; 
		
         if(count($records) > 0){
            return $records;
        }else{
            return false;
        }
    }

    function getKNTbills($billcode){
    

        $requestParams = array(
            "intBillCode"=>$billcode
        );
        $response = $this->client->call("GetKNTBillTables",$requestParams);
		$calls = $this->KNTCallDetails($billcode);
        $records = $response['GetKNTBillTablesResult']['diffgram'];
		
        if(count($records) > 0){
            return $records;
        }else{
            return false;
        }
    }

    //getting bill informations
    function getPayments($billId)
    {
     
   
        $requestParams = array(
            "intBillId"=>$billId
        );
        $response = $this->client->call("GetPaymentsByBill",$requestParams);
        $records = $response['GetPaymentsByBillResult']['diffgram']['Root'];
	
        if(count($records) > 0){
            return $records;
        }else{
            return false;
        }
    }
}

$invoice = new Invoice();
?>