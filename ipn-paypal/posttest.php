<?php 
 $url = "http://g2.altcoders.com/ipn-paypal/paypal_ipn.php";
        
        $ch1 = curl_init();  
        curl_setopt($ch1, CURLOPT_URL,$url); // Устанавливаем URL на который посылать запрос  
        curl_setopt($ch1, CURLOPT_HEADER, 1); //  Результат будет содержать заголовки
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1); // Результат будет возвращём в переменную, а не выведен.
        curl_setopt($ch1, CURLOPT_TIMEOUT, 3); // Таймаут после 4 секунд 
        curl_setopt($ch1, CURLOPT_POST, 1); // Устанавливаем метод POST
        curl_setopt($ch1, CURLOPT_POSTFIELDS, "mc_gross=37.50&protection_eligibility=Ineligible&payer_id=J86MHHMUDEHZU&tax=0.00&payment_date=07%3A04%3A48+Mar+30%2C+2015+PDT&
        payment_status=Completed&charset=windows-1252&first_name=test&mc_fee=1.39¬ify_version=3.8&custom=%7B%22user_id%22%3A314%2C%22service_provider%22%3A%22twilio%22%2C%22service_name%22%3A%22textMessages%22%7D&payer_status=verified&business=antonshel-facilitator%40gmail.com&quantity=150&verify_sign=AR-ITpb83c-ktcbmApqG4jM17OeQAx2RSvfYZo4XU8YFZrTSeF.iYsSx&payer_email=antonshel-buyer%40gmail.com&txn_id=30R69966SH780054J&payment_type=instant&last_name=buyer&receiver_email=antonshel-facilitator%40gmail.com&payment_fee=1.39&receiver_id=VM2QHCE6FBR3N&txn_type=web_accept&item_name=GetScorecard+Text+Messages&mc_currency=USD&item_number=&residence_country=US&test_ipn=1&handling_amount=0.00&transaction_subject=%7B%22user_id%22%3A314%2C%22service_provider%22%3A%22twilio%22%2C%22service_name%22%3A%22textMessages%22%7D&payment_gross=37.50&shipping=0.00&ipn_track_id=6b01a2c76197"); // посылаемые значения
        $result = curl_exec($ch1);  

        curl_close($ch1);
        $custom = ['user_id' => '1580', 'product_id' => '50'];
        echo json_encode($custom);
?>
<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Нова поліція</title>
</head>
<body>
  <form action="http://g2.altcoders.com/ipn-paypal/paypal_ipn.php" method="post">
    <input name="mc_gross" value="1445.30" type="hidden">
    <input name="protection_eligibility" value="Ineligible" type="hidden">
    <input name="payer_id" value="J86MHHMUDEHZU" type="hidden">
    <input name="tax" value="0.00" type="hidden">
    <input name="payment_date" value="07%3A04%3A48+Mar+30%2C+2015+PDT" type="hidden">
    <input name="payment_status" value="Completed" type="hidden">
    <input name="mc_currency" value="RUB" type="hidden">
    <input name="txn_id" value="111222331" type="hidden">
    <input name="receiver_email" value="fubolg_ua-facilitator@ukr.net" type="hidden">
    <input name="custom" value='{"user_id":"1580","product_id":"50"}' type="hidden">
    <input type="submit" value="проверить">

  </form>

</body>
</html>
