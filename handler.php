
<?php

/**
 *  Demo handler for your projects
 *
 * @link http://help.unitpay.ru/article/35-confirmation-payment
 */

/**
 * Typical sample of order
 */

// Project Data
$projectId  = 19884;
$secretKey  = '4cc1c419fe7a19d3dea5035525116ad0';
$publicId   = '19884-70f49';

// My item Info
$itemName = 'Iphone 6 Skin Cover';

// My Order Data
$orderId        = 'a183f94-1434-1e44';
$orderSum       = 900;
$orderDesc      = 'Payment for game currency, server "'.$itemName.'"';
$orderCurrency  = 'RUB';


if(isset($_GET['params'])){
    list($method, $params) = array($_GET['method'], $_GET['params']);

    $dbc = mysqli_connect('195.154.240.178', 'gdwarf', 'lvfBflwr5B', 'gredydwarf');
    $query = "SELECT * FROM oc_order WHERE order_id = '" . $params['account'] . "'";
    $data = mysqli_query($dbc, $query);

    $row = mysqli_fetch_array($data);

            if ($params['orderCurrency'] === 'RUB'){
               $orderSum = $row['total'];
            } else {
                $orderSum = $row['total_usd'];
            }

          $orderCurrency = $params['orderCurrency'];
          $orderId = $row['order_id'];
              if ($method == 'error') {
                    $order_status_id = 7;
                } else if ($method == 'pay') {
                    $order_status_id = 2;
                    setcookie('last_order_id', $order_id, time() + (60 * 60 * 24 * 30));// на 30 дней
                } else {
                    $order_status_id = 1;
                }                
                    $query = "UPDATE oc_order SET
                            order_status_id = '".  $order_status_id . "',
                            payment_address_1 = '" . $params['unitpayId'] . "',
                            date_modified = NOW(),
                            date_pay = NOW()  
                            WHERE order_id = '" . $params['account'] . "'";
                    $data = mysqli_query($dbc, $query);
               
    // Confirm success with the user
   
        /*
    Simple HTTP POST.
    Простой пример, показывающий использования метода POST и cURL.
    Прежде чем использовать данный код убедитесь, что на Вашем хостинге есть cURL.
    ©oded by BuH@LicH at sysman.ru 2007
    thx to Miscђka
    */
    

    $url = "http://g2.altcoders.com/index.php?route=checkout/checkout/sendmail&order_id=" . $orderId ; // URL на которы посылаем запрос

    
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL,$url); // Устанавливаем URL на который посылать запрос  
    curl_setopt($ch, CURLOPT_HEADER, 1); //  Результат будет содержать заголовки
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // Результат будет возвращём в переменную, а не выведен.
    curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Таймаут после 4 секунд 
    curl_setopt($ch, CURLOPT_POST, 1); // Устанавливаем метод POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, "order_status_id=" . $order_status_id . "&notify=1&override=0&append=0&comment=1"); // посылаемые значения
    $result = curl_exec($ch);  

    curl_close($ch);

    echo $result;

    if (strpos($result,'302 F')!== FALSE) echo "<b>Good!</b>";
    else echo "<b>Bad</b>";
     mysqli_close($dbc);
}

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
	    '95.68.219.215',
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
    public function form($publicKey, $sum, $account, $desc, $currency = 'RUB', $locale = 'ru')
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
        $params['locale'] = $locale;

        return $this->formUrl.$publicKey.'?'.http_build_query($params);
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

$unitPay = new UnitPay($secretKey);

try {
    // Validate request (check ip address, signature and etc)
    $unitPay->checkHandlerRequest();

    list($method, $params) = array($_GET['method'], $_GET['params']);

    // Very important! Validate request with your order data, before complete order
    if (
        $params['orderSum'] != $orderSum ||
        $params['orderCurrency'] != $orderCurrency ||
        $params['account'] != $orderId ||
        $params['projectId'] != $projectId
    ) {
        // logging data and throw exception
        throw new InvalidArgumentException('Order validation Error!');
    }

    switch ($method) {
        // Just check order (check server status, check order in DB and etc)
        case 'check':
            print $unitPay->getSuccessHandlerResponse('Check Success. Ready to pay.');
            break;
        // Method Pay means that the money received
        case 'pay':
            // Please complete order
            print $unitPay->getSuccessHandlerResponse('Pay Success');
            break;
        // Method Error means that an error has occurred.
        case 'error':
            // Please log error text.
            print $unitPay->getSuccessHandlerResponse('Error logged');
            break;
        // Method Refund means that the money returned to the client
        case 'refund':
            // Please cancel the order
            print $unitPay->getSuccessHandlerResponse('Order canceled');
            break;
    }
// Oops! Something went wrong.
} catch (Exception $e) {
    print $unitPay->getErrorHandlerResponse($e->getMessage());
}


