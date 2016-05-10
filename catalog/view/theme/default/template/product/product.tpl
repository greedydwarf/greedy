<?php echo $header; ?>



<div class="container">
  <!--<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>-->
  <div class="row">
    
    <div id="content" class="col-sm-12"><?php echo $content_top; ?>
      <div class="row-product">
        
        <div id="order_id_variable"></div>
        <div class="col-sm-4">
          <?php if(isset($_COOKIE['language']) && $_COOKIE['language'] == 'en'){ ?>
           <div class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
            
            <div id="content-game" class="ui-tabs-panel">
            <form action="/index.php?route=product/unitpay" method="post">
                            
                            
                            <h3><?php echo $heading_title; ?></h3>
                                <input name="cur_game_id" type="hidden" value="1">
                                <input name="currency_name" type="hidden" value="">
                                <input name="currency" id="currency_cookie" type="hidden" value="<?php echo $_COOKIE['currency']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                <input type="hidden" name="order_id" id="order_id" value="" />
                                <input type="hidden" name="phone" id="id-phone" value="<?php if (isset($customer_info['telephone'])){echo $customer_info['telephone'];}?>">
                                <div class="column">
                                  <?php foreach ($options as $option) { ?>
                                  <?php if ($option['type'] == 'select') { ?>
                                  <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <select name="server_id" id="server_select">
                                      <option value="">Select a Server</option>
                                      <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                      <option value="<?php echo $option_value['name']; ?>"  
                                        data-price="<?php if (isset($option_value['server_price'])){echo $option_value['server_price'] * $currency_value; } else { echo $price + @$option_value['price']; } ?>" 
                                        data-measure="<?php if (isset($option_value['jargon'])){echo $option_value['jargon']; } else { echo $tags[0]['tag']; } ?>" 
                                        data-maximum="<?php if (isset($option_value['max_volume'])){echo $option_value['max_volume']; } else { echo $manufacturer; }  ?>" 
                                        data-minimumrage="1" 
                                        data-minimumprice="<?php echo $option_value['quantity'] * $currency_value; ?>" 
                                        data-currency="<?php if (isset($option_value['game_currency'])){echo $option_value['game_currency']; } else { echo $model; }  ?>"
                                        data-amount="<?php if (isset($option_value['amount_unit'])){echo $option_value['amount_unit']; } else { echo $minimum; }  ?>"
                                        value="{{$keys}}"><?php echo $option_value['name']; ?>
                                     
                                      </option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <?php }
                                  } ?>
                                    <div class="input">
                                        Price for 1 <span class="currency_measure green">кк</span> <span id="server-currency"></span>: <span class="green server_price">1</span> <span class="currency"><?php echo $_COOKIE['currency'] ?></span>
                                    </div>
                                    <div id="slider-range-min" class="slider1"></div>
                                    <input type="text" id="amount" readonly="">
                                    <div class="input">
                                        Total volume: <!-- <span id="volume" class="green">0</span> -->
                                        <input id="total_volume" class="input" placeholder="Quantity" name="total_volume" style="width:120px; text-align: right" type="text" value="">
                                        <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" id="input-quantity"/>
                                        <span id="server-currency1"></span><br>
                                        <span class="total_volume_str" style="display:none;">You will receive: <span id='total_volume_str'></span><span id="server-currency2"> </span><span>

                                   </div>
                                   <div class="input">
                                        Total price:    <!-- <span id="total_price" class="green">100</span> --><input name="total_price" id="total_price" class="input" placeholder="Sum" value="" style="width:75px; text-align: right" type="text">
                                        
                                         <span class="currency"><?php echo $_COOKIE['currency'] ?></span> (with discount <span class="red"><span id="total_percent">0</span>%</span>)
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="form-item">
                                        <label for="id-mail"></label>
                                        <input id="id-mail" name="nick-name" class="mail input" placeholder="Your nickname in the game*" type="text">
                                        
                                    </div>
                                    <div class="form-item">
                                        
                                        <input id="id-skype" name="emails" class="skype input" placeholder="Email *" type="email" value="<?php if (isset($customer_info['email'])){echo $customer_info['email'];}?>">
                                        
                                    </div>
                                    <div class="form-item">
                                        <label for="id-message"></label>
                                        <textarea id="id-message" class="input" name="comments" placeholder="Enclose details and wishes " cols="30" rows="10"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="column">
                                    <div id="diagramma" class="diagramma">
                                        <div id="circle_2" class="circlestat red" data-dimension="150" data-text="" data-width="15" data-bordersize="15" data-fontsize="38" data-percent="1" data-oldpercent="0" data-fgcolor="#fa6f57" data-bgcolor="transparent" data-fill="transparent"></div>
                                        <div id="circle_1" class="circlestat blue" data-dimension="200" data-text="" data-width="15" data-bordersize="15" data-fontsize="38" data-percent="<?php if (isset($customer_info['fax'])){echo $customer_info['fax'];}else{echo 0;}?>" data-oldpercent="0" data-fgcolor="#009be0" data-bgcolor="transparent" data-fill="transparent" ></div>
                                
                                        <p class="sale-1"><span id="sale_1_text"><?php if (isset($customer_info['fax'])){echo $customer_info['fax'];
                                      } else {
                                        echo 0;
                                      }?></span>% cumulative discount</p>
                                        <p class="sale-2"><span id="sale_2_text">0</span>% purchase discount  </p>
                                    </div>
                                    <div class="form-item">
                                      
                                      <select id="dtype" name="deliveryType">
                                        <option value="">Select a delivery method *</option>
                                        <option value="Hand in hand">Hand in hand</option>
                                        <option value="Games-mail">Games-mail</option>
                                      </select>
                                    </div>
                                      <select id="ptype" name="paymentType">
                                        <option data-name="webmoney" value="">Select a payment method *</option>
                                        <option data-name="mc" value="mc">Mobile payment</option>
                                        <option data-name="sms" value="sms">SMS-payment</option>
                                        <option data-name="card" value="card">Plastic cards</option>
                                        <option data-name="webmoney" value="webmoney">WebMoney(unitpay)</option>
                                        <option data-name="webmoney" value="webmoney-merchant">WebMoney</option>
                                        <!--<option data-name="yandex" value="yandex-merchant">Yandex money</option>-->
                                        <option data-name="yandex" value="yandex">Yandex money</option>
                                        <option data-name="qiwi" value="qiwi">Qiwi</option>
                                        <option data-name="paypal" value="paypal">PayPal(unitpay)</option>
                                        <option data-name="liqpay" value="paypal-merchant">PayPal</option>
                                        <option data-name="liqpay" value="liqpay">LiqPay</option>
                                        <option data-name="alfaClick" value="alfaClick">Alfa-Click</option>
                                       </select>
                                       
                                     </div>
                                <div style="display: none;" id="current_currency">1</div>
                                <div style="display: none;" id="current_server_price"></div>
                                <div style="display: none;" id="minimum_server_price"></div>
                                <div style="display: none;" id="amount_per_unit"></div>
                                <div style="display: none;" id="currency_value"><?php echo $currency_value; ?></div>
                                
                                <div id="messager">
                              </div>
                                <input type="hidden" name="account" id="account" value="" />
                                <input type="hidden" name="method" id="method" value="" />
                                <input type="hidden" name="unitpayId" id="unitpayId" value="" />
                              <input id="post_form" type="button" value="Go on!">
                              <!--<input id="get_form" type="button" value="get">-->
                              <input id="post_form_button" type="submit" value="">
                        </form>
                        <form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251">  
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="12.08">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="платеж по счету">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="<?php if ($_COOKIE['currency'] === 'USD'){
                                  echo 'Z648900704049';
                                }else {
                                  echo 'R993589570250';
                                } ?>">
                                <input style="display:none; background-color:transparent; z-index:-1;" id="post_form_webmoney"  type="submit" value="">
                
                        </form>

                        <form action="https://money.yandex.ru/eshop.xml" method="post"> 
  
<!-- Обязательные поля --> 
                              <input name="shopId" value="F97D1D6F092F9F7015DB5459A5AFF28643B4683603764318E629EBE9EDECC108" type="hidden"/> 
                              <input name="scid" value="Q4JfMeq7YmWdjS9+G4xfn+/a" type="hidden"/> 
                              <input name="sum" value="100.50" type="hidden"> 
                              <input name="customerNumber" value="1068" type="hidden"/> 
                                

                                
                              <input id='post_form_yandex' type="submit" style="display:none;" value="Заплатить"/> 
                        </form>
                          <form action="/paypalAPI-Express/paypal-api.php" method="post">
                              <input type="hidden" name="cmd" value="_xclick">
                              <input type="hidden" name="business" value="fubolg_ua-facilitator@ukr.net">
                              <input id="paypalItemName" type="hidden" name="item_name" value="Greedy Dwarf">
                              <input id="paypalQuantity" type="hidden" name="quantity" value="1">
                              <input id="paypalAmmount" type="hidden" name="amount" value="">
                              <input type="hidden" name="no_shipping" value="1">
                              
                              <input type="hidden" name="custom" value="">

                              <input type="hidden" name="currency_code" value="USD">
                              
                              <input type="hidden" name="bn" value="PP-BuyNowBF">

                              <button type="submit" style="display:none;" id='post_form_paypal'>
                                  Pay Now        
                              </button>
                          </form>

            </div>
            <div>

          <?php } else{ ?>

          <div class="col-sm-4">
           <div class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
            
            <div id="content-game" class="ui-tabs-panel">
            <form action="/index.php?route=product/unitpay" method="post">
                            
                            
                            <h3><?php echo $heading_title; ?></h3>
                                <input name="cur_game_id" type="hidden" value="1">
                                <input name="currency_name" type="hidden" value="">
                                <input name="currency" id="currency_cookie" type="hidden" value="<?php echo $_COOKIE['currency']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                <input type="hidden" name="order_id" id="order_id" value="" />
                                <input type="hidden" name="phone" id="id-phone" class="email input" value="<?php if (isset($customer_info['telephone'])){echo $customer_info['telephone'];}?>">
                                <div class="column">
                                  <?php foreach ($options as $option) { ?>
                                  <?php if ($option['type'] == 'select') { ?>
                                  <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <select name="server_id" id="server_select">
                                      <option value="">Выберите сервер</option>
                                      <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                      <option value="<?php echo $option_value['name']; ?>"  
                                        data-price="<?php if (isset($option_value['server_price'])){echo $option_value['server_price'] * $currency_value; } else { echo $price + @$option_value['price']; } ?>" 
                                        data-measure="<?php if (isset($option_value['jargon'])){echo $option_value['jargon']; } else { echo $tags[0]['tag']; } ?>" 
                                        data-maximum="<?php if (isset($option_value['max_volume'])){echo $option_value['max_volume']; } else { echo $manufacturer; }  ?>" 
                                        data-minimumrage="1" 
                                        data-minimumprice="<?php echo $option_value['quantity'] * $currency_value; ?>" 
                                        data-currency="<?php if (isset($option_value['game_currency'])){echo $option_value['game_currency']; } else { echo $model; }  ?>"
                                        data-amount="<?php if (isset($option_value['amount_unit'])){echo $option_value['amount_unit']; } else { echo $minimum; }  ?>"
                                        value="{{$keys}}"><?php echo $option_value['name']; ?>
                                     
                                      </option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <?php }
                                  } ?>
                                    <div class="input">
                                        Цена за 1 <span class="currency_measure green">кк</span> <span id="server-currency"></span>: <span class="green server_price">1</span> <span class="currency"><?php echo $_COOKIE['currency'] ?></span>
                                    </div>
                                    <div id="slider-range-min" class="slider1"></div>
                                    <input type="text" id="amount" readonly="">
                                    <div class="input">
                                        Объем покупки: <!-- <span id="volume" class="green">0</span> -->
                                        <input id="total_volume" class="input" placeholder="Количество" name="total_volume" style="width:120px; text-align: right" type="text" value="">
                                        <input type="hidden" name="quantity" value="1" id="input-quantity"/>
                                        <span id="server-currency1"></span><br>
                                        <span class="total_volume_str" style="display:none;">Вы получите: <span id='total_volume_str'></span><span id="server-currency2"> </span><span>
                                   </div>

                                   <div class="input">
                                        Сумма к оплате: <!-- <span id="total_price" class="green">100</span> --><input name="total_price" id="total_price" class="input" placeholder="Сумма" value="" style="width:75px; text-align: right" type="text">
                                        
                                         <span class="currency"><?php echo $_COOKIE['currency'] ?></span> (с учетом скидки <span class="red"><span id="total_percent">0</span>%</span>)
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="form-item">
                                        <label for="id-mail"></label>
                                        <input id="id-mail" name="nick-name" class="mail input" placeholder="Ваш ник в игре *" type="text">
                                        
                                    </div>
                                    <div class="form-item">
                                        
                                        <input id="id-skype" name="emails" class="skype input" placeholder="Eмейл *" type="email" value="<?php if (isset($customer_info['email'])){echo $customer_info['email'];}?>">
                                        
                                    </div>
                                    <div class="form-item">
                                        <label for="id-message"></label>
                                        <textarea id="id-message" class="input" name="comments" placeholder="Приложите подробности и пожелания" cols="30" rows="10"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="column">
                                    <div id="diagramma" class="diagramma">
                                        <div id="circle_2" class="circlestat red" data-dimension="150" data-text="" data-width="15" data-fontsize="38" data-percent="1" data-oldpercent="0" data-fgcolor="#fa6f57" data-bgcolor="transparent" data-fill="transparent"></div>
                                        <div id="circle_1" class="circlestat blue" data-dimension="200" data-text="" data-width="15" data-fontsize="38" data-percent="<?php if (isset($customer_info['sale'])){echo $customer_info['fax'];}else{echo 0;}?>" data-oldpercent="0" data-fgcolor="#009be0" data-bgcolor="transparent" data-fill="transparent" ></div>
                                
                                        <p class="sale-1"><span id="sale_1_text"><?php if (isset($customer_info['fax'])){echo $customer_info['fax'];
                                      } else {
                                        echo 0;
                                      }?></span>% накопительная скидка</p>
                                        <p class="sale-2"><span id="sale_2_text">0</span>% скидка с покупки </p>
                                    </div>
                                    <div class="form-item">
                                      
                                      <select id="dtype" name="deliveryType">
                                        <option value="">Выберите способ доставки *</option>
                                        <option value="Из рук в руки">Из рук в руки</option>
                                        <option value="Игровая почта">Игровая почта</option>
                                      </select>
                                    </div>
                                      <select id="ptype" name="paymentType">
                                        <option data-name="webmoney" value="">Выберите способ оплаты *</option>
                                        <option data-name="mc" value="mc">Мобильный платеж</option>
                                        <option data-name="sms" value="sms">SMS-оплата</option>
                                        <option data-name="card" value="card">Пластиковые карты</option>
                                        <option data-name="webmoney" value="webmoney">WebMoney(unitpay)</option>
                                        <option data-name="webmoney" value="webmoney-merchant">WebMoney</option>
                                        <!--<option data-name="yandex" value="yandex-merchant">Яндекс.Деньги</option>-->
                                        <option data-name="yandex" value="yandex">Яндекс.Деньги</option>
                                        <option data-name="qiwi" value="qiwi">Qiwi</option>
                                        <option data-name="paypal" value="paypal">PayPal(Unitpay)</option>
                                        <option data-name="liqpay" value="paypal-merchant">PayPal</option>
                                        <option data-name="liqpay" value="liqpay">LiqPay</option>
                                        <option data-name="alfaClick" value="alfaClick">Альфа-Клик</option>
                                       </select>
                                       
                                     </div>
                                <div style="display: none;" id="current_currency">1</div>
                                <div style="display: none;" id="current_server_price"></div>
                                <div style="display: none;" id="minimum_server_price"></div>
                                <div style="display: none;" id="amount_per_unit"></div>
                                <div style="display: none;" id="currency_value"><?php echo $currency_value; ?></div>
                                <div id="messager">
                              </div>
                                <input type="hidden" name="account" id="account" value="" />
                                <input type="hidden" name="method" id="method" value="" />
                                <input type="hidden" name="unitpayId" id="unitpayId" value="" />
                              <input id="post_form" type="button" value="Дальше">
                              <!--<input id="get_form" type="button" value="get">-->
                              <input id="post_form_button" type="submit" value="">
                        </form>
                        <form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251">  
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="12.08">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="платеж по счету">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="204">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="<?php if ($_COOKIE['currency'] === 'USD'){
                                  echo 'Z648900704049';
                                }else {
                                  echo 'R993589570250';
                                } ?>">
                                <input style="display:none;" id="post_form_webmoney"  type="submit" value="">
                
                        </form>
                        <form action="https://money.yandex.ru/eshop.xml" method="post"> 
  
<!-- Обязательные поля --> 
                              <input name="shopId" value="40704" type="hidden"/> 
                              <input name="scid" value="25956" type="hidden"/> 
                              <input name="sum" value="100.50" type="hidden"> 
                              <input name="customerNumber" value="abc000" type="hidden"/> 
                                

                                
                              <input id='post_form_yandex' type="submit" style="display:none;" value="Заплатить"/> 
                        </form>
                        <form action="/paypalAPI-Express/paypal-api.php" method="post">
                              <input type="hidden" name="cmd" value="_xclick">
                              <input type="hidden" name="business" value="fubolg_ua-facilitator@ukr.net">
                              <input id="paypalItemName" type="hidden" name="item_name" value="Greedy Dwarf">
                              <input id="paypalQuantity" type="hidden" name="quantity" value="1">
                              <input id="paypalAmmount" type="hidden" name="amount" value="">
                              <input type="hidden" name="no_shipping" value="1">
                              
                              <input type="hidden" name="custom" value="">

                              <input type="hidden" name="currency_code" value="RUB">
                              
                              <input type="hidden" name="bn" value="PP-BuyNowBF">
                              <input type="hidden" name="lc" value="RU">
                              <button type="submit" style="display:none;" id='post_form_paypal'>
                                  Pay Now        
                              </button>
                        </form>


            </div>
            <div>
              <?php } ?>

            <?php if ($products) { ?>
              <h3><?php echo $text_related; ?></h3> 
              <div class="row">
                
                <?php foreach ($products as $product) { ?>
                <div class="related-box">
                  <div class="related-item">
                    <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                    </div>

                  </div>
                </div>
              <?php } ?>
              </div>
            <?php } ?>
            <?php if ($column_right) { ?>
            <?php echo $column_right; ?>
            <?php } ?>

              <div class="text">
                <p>
                 <?php echo $description; ?>
                </p>
              </div>
            </div>
           
          </div>
          
      <?php echo $content_bottom; ?></div>
    </div>
</div> 
<script type="text/javascript">
  var calc_english = $('#content-game').html();

                            
 window.onhashchange = $('#content-game').html(calc_english);
</script>
<script type="text/javascript">

$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
</script>
<script type="text/javascript">


var mail = $('#id-skype');
var nickname = $('#id-mail');
var total_volume = $('#total_volume');
var total_price = $('#total_price');
var ptype = $('#ptype');
var dtype = $('#dtype');
var server = $('#server_select');
var currency = $('#currency_cookie').val();


var pattern_mail = /^([A-z0-9_\.-]+)@([A-z0-9_\.-]+)\.([A-z\.]{2,6})$/;
var pattern_total = /^[0-9,]{1,100}$/;
var pattern_price = /^[0-9]+\.[0-9]{1,4}$/;




  function removeEroor(target){
      target.focus(function() {
       target.removeClass('error');
       target.attr('placeholder', '');
      });
  }

  
  
//убираем класс error при фокусе
removeEroor(mail);
removeEroor(nickname);
removeEroor(total_volume);
removeEroor(total_price);
removeEroor(ptype);

var checkInput = function(target){
      if(target.val() != ''){
          target.removeClass('error');
          return true;
      }else{
          target.addClass('error');
          if (language == 'en'){
            target.attr('placeholder', 'The field can not be empty!');
          } else{
            target.attr('placeholder', 'Поле не должно быть пустым!');
          }
          
          return false;
      }
};
var checkSelect = function(target,message){
      if(target.val() != ''){
          
          return true;
      }else{
          
          alert(message);
          return false;
      }
};
var checkPattern = function(target,pattern){
      if(target.val() != ''){
        if(target.val().search(pattern) == 0){
          target.removeClass('error');
          return true;
        }else{
          target.addClass('error');
          if (language == 'en'){
            target.val('Invalid data format');
          } else{
            target.val('Неверный формат данных');
          }
          
           return false;
        }
      }else{
          target.addClass('error');

          if (language == 'en'){
            target.attr('placeholder', 'The field can not be empty!');
          } else{
            target.attr('placeholder', 'Поле не должно быть пустым!');
          }
          
          return false;
      }
};
$('#post_form').on('click', function() {
  
  var order_status_id = 1;
  
  //заоплнение формы вебмани есле выбран

var message_ptype = 'Выберите способ оплаты';
var deliveryMessage = 'Выберите способ доставки';
var serverMessage = 'Сервер не выбран';
if (language == 'en'){
  message_ptype = 'Select a payment method';
  deliveryMessage = 'Select a delivery method';
  serverMessage = 'Select a server';
}


//проверка инпутов
 var check_server = checkSelect(server, serverMessage);
 var check_ptype = checkSelect(ptype, message_ptype);
 var check_dtype = checkSelect(dtype, deliveryMessage);
 var check_nick = checkInput(nickname);
 var check_mail = checkPattern(mail,pattern_mail);
 var check_total = checkPattern(total_volume,pattern_total);
 var check_price = checkPattern(total_price,pattern_price);
 
 
function checkMinimunPrice(minimumprice){
    if (minimumprice > parseFloat(total_price.val())){
      alert('Minimum ' + minimumprice + ' ' + currency + '!');
      return false;
    } else{
      
      return true;
    }
      
  }
 
var minimumserverprice = parseFloat($('#minimum_server_price').text());


  if(check_server && check_ptype && check_dtype && check_mail && check_nick && check_total && check_price && checkMinimunPrice(minimumserverprice)){
 
  $.ajax({
    url: 'index.php?route=product/product/addOrderFromProduct',
    type: 'post',
    /*data: $({server : server, quantity : quantity, total : total, nickname : nickname, email : email, message : message, phone : phone,paynent : paynent, product_id : product_id, order_status_id : order_status_id  }),*/
    data: $('input[name=\'product_id\'], select[name=\'server_id\'], input[name=\'total_volume\'], input[name=\'total_price\'], input[name=\'nick-name\'], input[name=\'currency\'], input[name=\'emails\'], textarea[name=\'comments\'], input[name=\'phone\'], select[name=\'paymentType\'], select[name=\'deliveryType\']'),
    dataType: 'json',
    beforeSend: function() {
     
    },
    complete: function() {
      
    },
    success: function(json) {
      if (json['order_id']) {
        $('#order_id').val(json['order_id']);
      }

      if ($('select[name="paymentType"]').val() == 'webmoney-merchant'){
        $('input[name="LMI_PAYMENT_AMOUNT"]').val($('#total_price').val());
        $('input[name="LMI_PAYMENT_DESC"]').val($('#server_select').val());
        $('input[name="LMI_PAYMENT_NO"]').val($('#order_id').val());
           $('#post_form_webmoney').click();
      } else if ($('select[name="paymentType"]').val() == 'yandex-merchant'){
        $('input[name="sum"]').val($('#total_price').val());
        $('input[name="customerNumber"]').val($('#order_id').val());
           $('#post_form_yandex').click();
      } else if ($('select[name="paymentType"]').val() == 'paypal-merchant'){
        customData = {
            user_id: $('#order_id').val(),
            product_id: <?php echo $product_id; ?>,
        };
        
        
        $('input[name="custom"]').val(JSON.stringify(customData));
        $('input[name="amount"]').val($('#total_price').val());
        
        $('#post_form_paypal').click();
       
      } else {
        $('#post_form_button').click();
      }
      
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });
}
});
//--></script>
<script type="text/javascript">
$('#get_form').on('click', function() {
  var method = 'pay';
  var account = 115;
  var unitpayId = 43214321;

  $('#account').val(account);
  $('#method').val(method);
  $('#unitpayId').val(unitpayId);

  

  
  $.ajax({
    url: 'index.php?route=product/product/updateOrderFromProduct',
    type: 'get',
    data: $('input[name=\'account\'], input[name=\'method\'], input[name=\'unitpayId\']'),
    /*data: $('input[name=\'product_id\'], select[name=\'server_id\'], input[name=\'total_volume\'], input[name=\'total_price\'], input[name=\'nick-name\'], input[name=\'emails\'], textarea[name=\'comments\'], input[name=\'phone\'], select[name=\'paymentType\']'),*/
    dataType: 'json',
    beforeSend: function() {
      alert('otpravliay');
    },
    complete: function() {
      alert('otpravil');
    },
    success: function(json) {
      
            alert("данніе отправлені");    
    
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });

});
//--></script>
<script type="text/javascript">
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript">
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});


</script>
<?php echo $footer; ?>
