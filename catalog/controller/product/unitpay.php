<?php
header('Content-Type: text/html; charset=UTF-8');
		//данные заказа для платежной системы
		/**
		 * Typical sample of order
		 */

		// Project Data
		$projectId  = 19884;
		$secretKey  = '4cc1c419fe7a19d3dea5035525116ad0';
		$publicId   = '19884-70f49';

		// My item Info
		$itemName = $_POST['server_id'];

		// My Order Data
		$orderId        = $_POST['order_id'];
		$orderSum       = $_POST['total_price'];
		$orderDesc      = 'Payment for game currency, server "'.$itemName.'"';
		$product_id = $_POST['product_id'];
		$phone = $_POST['phone'];
		$orderCurrency  = $_POST['currency'];
		$paymentType  = $_POST['paymentType'];
		$resultUrl = 'http://greedydwarf.com/index.php?route=product/product&product_id='.$product_id;
		

		

		// Интеграция системы оплаты
		/**
		 * UnitPay Payment Module
		 *
		 * NOTICE OF LICENSE
		 *
		 * This source file is subject to the Open Software License (OSL 3.0)
		 * that is available through the world-wide-web at this URL:
		 * http://opensource.org/licenses/osl-3.0.php
		 *
		 * @category        UnitPay
		 * @package         unitpay/unitpay
		 * @version         1.0.0
		 * @author          UnitPay
		 * @copyright       Copyright (c) 2015 UnitPay
		 * @license         http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
		 *
		 * EXTENSION INFORMATION
		 *
		 * UNITPAY API       https://unitpay.ru/doc
		 *
		 */

		/**
		 * Payment method UnitPay process
		 *
		 * @author      UnitPay <support@unitpay.ru>
		 */
		class UnitPay
		{
		    private $supportedCurrencies = array('EUR','UAH', 'BYR', 'USD','RUB');
		    private $supportedUnitpayMethods = array('initPayment', 'getPayment');
		    private $requiredUnitpayMethodsParams = array(
		        'initPayment' => array('desc', 'account', 'sum'),
		        'getPayment' => array('paymentId')
		    );
		    private $supportedPartnerMethods = array('check', 'pay', 'error');
		    private $supportedUnitpayIp = array(
		        '31.186.100.49',
		        '178.132.203.105',
		        '127.0.0.1' // for debug
		    );
		    private $apiUrl = 'https://unitpay.ru/api';
		    private $formUrl = 'https://unitpay.ru/pay/';
		    private $secretKey;

		    public function __construct($secretKey = null)
		    {
		        $this->secretKey = $secretKey;

		    }

		    /**
		     * Create digital signature
		     *
		     * @param array $params
		     *
		     * @return string
		     */
		    private function getMd5sign($params)
		    {
		        ksort($params);
		        unset($params['sign']);

		        return md5(join(null, $params).$this->secretKey);
		    }

		    /**
		     * Get URL for pay through the form
		     *
		     * @param $publicKey
		     * @param $sum
		     * @param $account
		     * @param $desc
		     * @param string $currency
		     * @param string $locale
		     *
		     * @return string
		     */
		    public function form($publicKey, $sum, $account, $desc, $currency = 'RUB', $paymentType , $resultUrl , $phone , $locale = 'ru')
		    {
		        $params = [
		            'account' => $account,
		            'currency' => $currency,
		            'desc' => $desc,
		            'sum' => $sum,
		        ];
		        if ($this->secretKey) {
		            $params['sign'] = $this->getMd5sign($params);
		        }

		        $params['resultUrl'] = $resultUrl;
		        $params['phone'] = $phone;
		        $params['hideMenu'] = 'true';
		        $params['hideOtherMethods'] = 'true';
		        
		        
		        return $this->formUrl.$publicKey.'/'.$paymentType .'?'.http_build_query($params);
		    }

		    /**
		     * Call API
		     *
		     * @param $method
		     * @param array $params
		     *
		     * @return object
		     *
		     * @throws InvalidArgumentException
		     * @throws UnexpectedValueException
		     */
		    public function api($method, $params = array())
		    {
		        if (!in_array($method, $this->supportedUnitpayMethods)) {
		            throw new UnexpectedValueException('Method is not supported');
		        }
		        if (isset($this->requiredUnitpayMethodsParams[$method])) {
		            foreach ($this->requiredUnitpayMethodsParams[$method] as $rParam) {
		                if (!isset($params[$rParam])) {
		                    throw new InvalidArgumentException('Param '.$rParam.' is null');
		                }
		            }
		        }
		        $params['secretKey'] = $this->secretKey;
		        if (empty($params['secretKey'])) {
		            throw new InvalidArgumentException('SecretKey is null');
		        }

		        $requestUrl = $this->apiUrl.'?'.http_build_query([
		            'method' => $method,
		            'params' => $params
		        ], null, '&', PHP_QUERY_RFC3986);

		        $response = json_decode(file_get_contents($requestUrl));
		        if (!is_object($response)) {
		            throw new InvalidArgumentException('Temporary server error. Please try again later.');
		        }

		        return $response;
		    }

		    /**
		     * Check request on handler from UnitPay
		     *
		     * @return bool
		     *
		     * @throws InvalidArgumentException
		     * @throws UnexpectedValueException
		     */
		    public function checkHandlerRequest()
		    {
		        $ip = $_SERVER['REMOTE_ADDR'];
		        if (!isset($_GET['method'])) {
		            throw new InvalidArgumentException('Method is null');
		        }
		        if (!isset($_GET['params'])) {
		            throw new InvalidArgumentException('Params is null');
		        }
		        list($method, $params) = array($_GET['method'], $_GET['params']);

		        if (!in_array($method, $this->supportedPartnerMethods)) {
		            throw new UnexpectedValueException('Method is not supported');
		        }

		        if ($params['sign'] != $this->getMd5sign($params)) {
		            throw new InvalidArgumentException('Wrong signature');
		        }

		        /**
		         * IP address check
		         * @link https://unitpay.ru/doc#overview
		         */
		        if (!in_array($ip, $this->supportedUnitpayIp)) {
		            throw new InvalidArgumentException('IP address Error');
		        }

		        return true;
		    }

		    /**
		     * Response for UnitPay if handle success
		     *
		     * @param $message
		     *
		     * @return string
		     */
		    public function getSuccessHandlerResponse($message)
		    {
		        return json_encode(array(
		            "result" => array(
		                "message" => $message
		            )
		        ));
		    }

		    /**
		     * Response for UnitPay if handle error
		     *
		     * @param $message
		     *
		     * @return string
		     */
		    public function getErrorHandlerResponse($message)
		    {
		        return json_encode(array(
		            "error" => array(
		                "message" => $message
		            )
		        ));
		    }
		}

		// Инициализация платежной формы

		/**
		 * Payment form
		 *
		 * @link http://help.unitpay.ru/article/31-creating-payment-from-payment-form
		 */


$unitPay = new UnitPay($secretKey);

$redirectUrl = $unitPay->form(
    $publicId,
    $orderSum,
    $orderId,
    $orderDesc,
    $orderCurrency,
    $paymentType,
    $resultUrl,
    $phone 
);

header("Location: " . $redirectUrl);


?>
