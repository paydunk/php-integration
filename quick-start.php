<?php
/*
/* be sure to update the status, client_id and client_secret values (lines 31, 35 and 36)!
/* run your transaction here using the following information POSTED from the Paydunk API

-"expiration_date": "01/20", // string - expiration date on card. Format: MM/YY
-"card_number": "1111111111111111", //- string - credit card number
-"cvv": "123", // string - 3-4 digit code found on back of card
-"shipping_name": "Rolo Tomassi", // string - full name
-"shipping_email": "rolo.tomassi@test.com", // string - email
-"shipping_address_1": "55 Broadway", // string - address line one
-"shipping_address_2": "Suite 7b", // string (optional) - address line two
-"shipping_city": "New York", // string - city name
-"shipping_state": "NY", // string - state abbreviation
-"shipping_zip": "10006" // string - 5 digit postal code
-"billing_name": "Kaiser Sose", // string - full name
-"billing_email": "kaiser.sose@test.com", // string - email
-"billing_phone": "1-111-1111", // string - phone
-"billing_address_1": "55 Broadway", // string - address line one
-"billing_address_2": "Suite 7b", // string (optional) - address line two
-"billing_city": "New York", // string - city name
-"billing_state": "NY", // string - state abbreviation
-"billing_zip": "10006" // string - 5 digit postal code
-"email": "helperbot@domandtom.com", // string - email address of paydunk user associated with transaction
-"transaction_uuid": "2e6bde48-ad8d-11e4-9b26-b8e856352ede" // string - 36 digit uuid number of the transaction
-"order_number": "14324" // string - order number created by merchant site in order to perform transaction

*/

//set the transaction status - must be "success", "cancelled", or "error"
$status = "success";

//set data for PUT request
$bodyparams = array(
			"client_id" => "7k2f9w57LmFfzU7eP3AQEZW19H5qj8XRwEE73VfB", // your APP ID goes here!!!
			"client_secret" => "r4iHTxQL8TOWa0QJ6EsnGtzheXog2twTlfq7xfRp", // your APP SECRET goes here!!!
			"status" => $status);

//sends the PUT request to the Paydunk API
function CallAPI($method, $url, $data = false){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PUT, 1);		
		$update_json = json_encode($data);	
		curl_setopt($curl, CURLOPT_URL, $url . "?" . http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSLVERSION, 4);
		$result = curl_exec($curl);  
		$api_response_info = curl_getinfo($curl);
		curl_close($curl);
		return $result;
}
//get the transaction_uuid from Paydunk & call the the Paydunk API
$transaction_uuid = $_POST['transaction_uuid'];
if (isset($transaction_uuid)) {
	$url = "https://api.paydunk.com/api/v1/transactions/".$transaction_uuid;
	CallAPI("PUT", $url, $bodyparams);
	header("Location: test2.html?".$_POST['email']);	
}
?>
