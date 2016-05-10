<?php
require_once "paypalAPI-Express/paypal.php";
class ControllerCheckoutCheck extends Controller {
	public function index() {
		

		$this->load->language('checkout/checkout');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('localisation/language');

		

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/check', '', 'SSL')
		);

		if( isset($_GET['token']) && !empty($_GET['token']) ) { // Token parameter exists
		   // Get checkout details, including buyer information.
		   // We can save it for future reference or cross-check with the data we have
		   $paypal = new Paypal();
		   $checkoutDetails = $paypal -> request('GetExpressCheckoutDetails', array('TOKEN' => $_GET['token']));
		
		   // Complete the checkout transaction
		   $requestParams = array(
		   	  'TOKEN' => $_GET['token'],
		      'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
		      'PAYERID' => $_GET['PayerID']
		   );


			$orderParams = array(
			   'PAYMENTREQUEST_0_AMT' => $checkoutDetails['PAYMENTREQUEST_0_AMT'],
			   'PAYMENTREQUEST_0_SHIPPINGAMT' => $checkoutDetails['PAYMENTREQUEST_0_SHIPPINGAMT'],
			   'PAYMENTREQUEST_0_CURRENCYCODE' => $checkoutDetails['PAYMENTREQUEST_0_CURRENCYCODE'],
			   'PAYMENTREQUEST_0_INVNUM' => $checkoutDetails['PAYMENTREQUEST_0_INVNUM'],
			   'PAYMENTREQUEST_0_ITEMAMT' => $checkoutDetails['PAYMENTREQUEST_0_ITEMAMT']
			);

			$item = array(
			   'L_PAYMENTREQUEST_0_NAME0' => $checkoutDetails['L_PAYMENTREQUEST_0_NAME0'],
			   'L_PAYMENTREQUEST_0_DESC0' => $checkoutDetails['L_PAYMENTREQUEST_0_DESC0'],
			   'L_PAYMENTREQUEST_0_AMT0' => $checkoutDetails['L_PAYMENTREQUEST_0_AMT0'],
			   'L_PAYMENTREQUEST_0_QTY0' => $checkoutDetails['L_PAYMENTREQUEST_0_QTY0']
			);

		   $response = $paypal -> request('DoExpressCheckoutPayment',$requestParams + $orderParams + $item);
		  
		   
		   if( is_array($response) && $response['ACK'] == 'Success') { // Payment successful
		      // We'll fetch the transaction ID for internal bookkeeping
		      $transactionId = $response['PAYMENTINFO_0_TRANSACTIONID'];

				$dbc = mysqli_connect('195.154.240.178', 'gdwarf', 'lvfBflwr5B', 'gredydwarf');
				$query_1 = "SELECT * FROM oc_order WHERE payment_address_1 = '" . $transactionId . "'";
				$data_1 = mysqli_query($dbc, $query_1);
				if (mysqli_num_rows($data_1) == 0) {
					$query_2 = "SELECT * FROM oc_order WHERE order_id = '" . $checkoutDetails['PAYMENTREQUEST_0_INVNUM'] . "'";
				    $data_2 = mysqli_query($dbc, $query_2);

				    $row = mysqli_fetch_array($data_2);

				    
				    if ($response['PAYMENTINFO_0_CURRENCYCODE'] === 'RUB'){
				        $orderSum = $row['total'];
				    } else {
				        $orderSum = $row['total_usd'];
				    }
				    
				    
				    if ($response['PAYMENTINFO_0_AMT'] == $orderSum){
				    	$order_status_id = 2;
				    	
				                    
				    	$query = "UPDATE oc_order SET
				              order_status_id = '".  $order_status_id . "',
				              payment_address_1 = '" . $transactionId . "',
				              date_modified = NOW(),
				              date_pay = NOW()  
				              WHERE order_id = '" . $checkoutDetails['PAYMENTREQUEST_0_INVNUM'] . "'";
				       $data_3 =  mysqli_query($dbc, $query);

				    }
		  
				    
				    //создаем куки для страницы чека
				    
				   
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
				}
				mysqli_close($dbc);
			
		   }
		}

		if (isset($this->request->get['order_id'])){
			$order_id = $this->request->get['order_id'];
		} else if (isset($_COOKIE['last_order_id'])){
			$order_id = $_COOKIE['last_order_id'];
		} else {
			$order_id = 0;
		}

		



		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($order_id);


		if (isset($_COOKIE['customer_id']) && $order_info['customer_id'] == $_COOKIE['customer_id'] || (isset($_COOKIE['last_order_id']) &&  $order_id == $_COOKIE['last_order_id'])) {
			 
			

			$data['order_id'] = $order_id;

			$data['nick_name'] = $order_info['firstname'];
			$data['server_name'] = $order_info['lastname'];
			$data['payment_num'] = $order_info['payment_address_1'];
			$data['payment_method'] = $order_info['payment_method'];
			if ($order_info['language_id'] == 1){
				$data['currency_code'] = 'RUB';
			} else {
				$data['currency_code'] = 'USD';
			}
			
			$data['date_pay'] = $order_info['date_pay'];

			$order_products = $this->model_checkout_order->getOrderProducts($order_id);

			$data['product_name'] = $order_products[0]['name'];
			$data['game_currency'] = $order_products[0]['model'];
			$data['quantity'] = $order_products[0]['quantity'];
			if ($order_info['language_id'] == 1){
				$data['total'] = $order_products[0]['total'];
			} else {
				$data['total'] = $order_products[0]['total_usd'];
			}
			
			
			$data['quantity'] = $order_products[0]['quantity'];
			
			$this->load->model('catalog/information');

								
			
			$data['language_id'] = $order_info['language_id'];
			
			foreach ($data['languages'] as $language) {

				$data['order_status'][$language['language_id']] = $this->model_catalog_information->getOrderStatus($order_id, $language['language_id']);
				
				$data['text_product'][$language['language_id']] = $this->config->get('config_mail_check_product' . $language['language_id']);
				$data['text_quantity'][$language['language_id']] = $this->config->get('config_mail_check_quantity' . $language['language_id']);
				$data['text_sum'][$language['language_id']] = $this->config->get('config_mail_check_sum' . $language['language_id']);
				$data['text_order_status'][$language['language_id']] = $this->config->get('config_mail_check_status' . $language['language_id']);
				$data['text_server'][$language['language_id']] = $this->config->get('config_mail_check_server' . $language['language_id']);
				$data['text_nick_name'][$language['language_id']] = $this->config->get('config_mail_check_nick' . $language['language_id']);
				$data['text_payment_method'][$language['language_id']] = $this->config->get('config_mail_check_payment_method' . $language['language_id']);
				$data['text_payment_date'][$language['language_id']] = $this->config->get('config_mail_check_payment_date' . $language['language_id']);
				$data['text_currency'][$language['language_id']] = $this->config->get('config_mail_check_currency' . $language['language_id']);
				$data['text_payment_num'][$language['language_id']] = $this->config->get('config_mail_check_payment_num' . $language['language_id']);
				$data['text_payment_info'][$language['language_id']] = $this->config->get('config_mail_check_payment_info' . $language['language_id']);
				$data['text_order_info'][$language['language_id']] = $this->config->get('config_mail_check_order_info' . $language['language_id']);
				$data['text_order'][$language['language_id']] = $this->config->get('config_mail_check_order' . $language['language_id']);
				$data['text_payment_sum'][$language['language_id']] = $this->config->get('config_mail_check_payment_sum' . $language['language_id']);
				$data['text_my_orders'][$language['language_id']] = $this->config->get('config_mail_check_my_orders' . $language['language_id']);
			
				
			}
						
			if (isset($_COOKIE['last_order_id']) && $order_id == $_COOKIE['last_order_id']){
				setcookie('last_order_id', $order_id, time() - (60 * 60 * 24 * 30));
			}
		} else {
			$data['text_no_informatuon'] = 'XXXXXX';
		}	

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/check.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/check.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/check.tpl', $data));
		}
	}
}