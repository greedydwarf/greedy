<?php 
require_once "paypal.php";

//Our request parameters
if(isset($_POST)){
  $requestParams = array(
     'RETURNURL' => 'http://g2.altcoders.com/check',
     'CANCELURL' => 'http://g2.altcoders.com/'
  );

  $custom = json_decode($_POST['custom']);

    
  $order_id = $custom->user_id;
  $product_id = $custom->product_id;

  $orderParams = array(
     'PAYMENTREQUEST_0_AMT' => $_POST['amount'],
     'PAYMENTREQUEST_0_SHIPPINGAMT' => '0',
     'PAYMENTREQUEST_0_CURRENCYCODE' => $_POST['currency_code'],
     'PAYMENTREQUEST_0_INVNUM' => $order_id,
     'PAYMENTREQUEST_0_ITEMAMT' => $_POST['amount']
  );

  $item = array(
     'L_PAYMENTREQUEST_0_NAME0' => $_POST['item_name'],
     'L_PAYMENTREQUEST_0_DESC0' => 'Game currency',
     'L_PAYMENTREQUEST_0_AMT0' => $_POST['amount'],
     'L_PAYMENTREQUEST_0_QTY0' => $_POST['quantity']
  );

  $paypal = new Paypal();
  $response = $paypal -> request('SetExpressCheckout',$requestParams + $orderParams + $item);

  if(is_array($response) && $response['ACK'] == 'Success') { //Request successful
        $token = $response['TOKEN'];
        header( 'Location: https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) );
  }
}

