<?php

// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);

// Set to 0 once you're ready to go live
define("USE_SANDBOX", 1);


define("LOG_FILE", "./ipn.log");


// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');

$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
	
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data

if(USE_SANDBOX == true) {
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_SSLVERSION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

$cert = "./cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;

} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
		}
		curl_close($ch);
}

// Inspect IPN validation result and act accordingly

// Split response headers and payload, a better way for strcmp
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
	
if (strcmp ($res, "VERIFIED") == 0) {
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.

	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	$custom = json_decode($_POST['custom']);

	
	$order_id = $custom->user_id;
	$product_id = $custom->product_id;
	
	


	if ($payment_status == 'Pending') {
		$dbc = mysqli_connect('195.154.240.178', 'gdwarf', 'lvfBflwr5B', 'gredydwarf');
		$query_1 = "SELECT * FROM oc_order WHERE payment_address_1 = '" . $txn_id . "'";
		$data_1 = mysqli_query($dbc, $query_1);
		if (mysqli_num_rows($data_1) == 0 && $receiver_email == 'fubolg_ua-facilitator@ukr.net') {
			$query = "SELECT * FROM oc_order WHERE order_id = '" . $order_id . "'";
		    $data = mysqli_query($dbc, $query);

		    $row = mysqli_fetch_array($data);

		    if ($payment_currency === 'RUB'){
		        $orderSum = $row['total'];
		    } else {
		        $orderSum = $row['total_usd'];
		    }
		    echo $orderSum;
		    if ($payment_amount == $orderSum){
		    	$order_status_id = 2;
		                    
		    	$query = "UPDATE oc_order SET
		              order_status_id = '".  $order_status_id . "',
		              payment_address_1 = '" . $txn_id . "',
		              date_modified = NOW(),
		              date_pay = NOW()  
		              WHERE order_id = '" . $order_id . "'";
		       $data =  mysqli_query($dbc, $query);

		    }
  
		    mysqli_close($dbc);
		    //создаем куки для страницы чека
		    setcookie('last_order_id', $order_id, time() + (60 * 60 * 24 * 30));
		    // Confirm success with the user
		   
		        /*
		    Simple HTTP POST.
		    
		 
		    */

		    $url = "http://g2.altcoders.com/index.php?route=checkout/checkout/sendmail&order_id=" . $order_id ; // URL на которы посылаем запрос

		    
		    $ch1 = curl_init();  
		    curl_setopt($ch1, CURLOPT_URL,$url); // Устанавливаем URL на который посылать запрос  
		    curl_setopt($ch1, CURLOPT_SSLVERSION, 1);
		    curl_setopt($ch1, CURLOPT_HEADER, 1); //  Результат будет содержать заголовки
		    curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1); // Результат будет возвращём в переменную, а не выведен.
		    curl_setopt($ch1, CURLOPT_TIMEOUT, 3); // Таймаут после 4 секунд 
		    curl_setopt($ch1, CURLOPT_POST, 1); // Устанавливаем метод POST
		    curl_setopt($ch1, CURLOPT_POSTFIELDS, "order_status_id=" . $order_status_id . "&notify=1&override=0&append=0&comment=1"); // посылаемые значения
		    $result = curl_exec($ch1);  

		    curl_close($ch1);

		    

		    if (strpos($result,'302 F')!== FALSE) echo "<b>Good!</b>";
		    else echo "<b>Bad</b>";
		}
	    
	     

	}
	
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
	}
} else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	// Add business logic here which deals with invalid IPN messages
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
	}
}

?>
