<?php echo $header; ?>

<div class="container">
  <div class="check">
    <div class="check-header">
        <img class="check-logo" src="<?php echo $logo; ?>" />
        <span class="change-check-language <?php if ($language_id == 1){echo 'language-selected';}?>" id="check-language1" data-lamguageid="1" >Ru</span>
        <span class="change-check-language <?php if ($language_id == 2){echo 'language-selected';}?>" data-lamguageid="2"  id="check-language2">En</span>
        <?php foreach ($languages as $language) { ?>   
            <a class="my-orders" id="my-orders<?php echo $language['language_id']; ?>" href="/moi-zakazy" style="<?php if ($language_id == $language['language_id']){echo 'display:block';} else {echo 'display:none';} ?>"><?php echo $text_my_orders[$language['language_id']]; ?></a>
        <?php } ?>  
    </div>
    <?php if (isset($order_id)){ ?>

        <?php foreach ($languages as $language) { ?>    
        <h3 class="order-number" id="order-number-<?php echo $language['language_id']; ?>" style="<?php if ($language_id == $language['language_id']){echo 'display:block';} else {echo 'display:none';} ?>"><?php echo $text_order[$language['language_id']]; ?> №<?php echo $order_id; ?></h3>
        <div class="check-body" id="check-body-<?php echo $language['language_id']; ?>" style="<?php if ($language_id == $language['language_id']){echo 'display:block';} else {echo 'display:none';} ?>">
            
            <h2><?php echo $text_order_info[$language['language_id']]; ?></h2>
            <p class="check-row"><span class="left"><?php echo $text_product[$language['language_id']]; ?></span><span class="right"><?php echo $product_name; ?>(<?php echo $game_currency; ?>)</span></p>
            <p class="check-row"><span class="left"><?php echo $text_quantity[$language['language_id']]; ?></span><span class="right"><?php echo $quantity; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_sum[$language['language_id']]; ?></span><span class="right"><?php echo $total; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_order_status[$language['language_id']]; ?></span><span class="right"><?php echo $order_status[$language['language_id']]['status_name'] ; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_nick_name[$language['language_id']]; ?></span><span class="right"><?php echo $nick_name; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_server[$language['language_id']]; ?></span><span class="right"><?php echo $server_name; ?></span></p>
            <div class="clear-fix"></div>
            <h2><?php echo $text_payment_info[$language['language_id']]; ?></h2>
            <p class="check-row"><span class="left"><?php echo $text_payment_method[$language['language_id']]; ?></span><span class="right"><?php echo $payment_method; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_payment_date[$language['language_id']]; ?></span><span class="right"><?php echo $date_pay; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_sum[$language['language_id']]; ?></span><span class="right"><?php echo $total; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_currency[$language['language_id']]; ?></span><span class="right"><?php echo $currency_code; ?></span></p>
            <p class="check-row"><span class="left"><?php echo $text_payment_num[$language['language_id']]; ?></span><span class="right"><?php echo $payment_num; ?></span></p>
            <div class="clear-fix"></div>
        </div>
        <?php } ?> 
        
       
    <?php } else { ?> 
    <h3 class="order-number"><?php echo $text_order; ?> №<?php echo $text_no_informatuon; ?></h3>
    <div class="check-body">
        <div class="clear-fix"></div>
    </div>
    <?php } ?> 
  </div>
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>
</div>

<?php echo $footer; ?>
<script type="text/javascript">
$('.change-check-language').on('click', function() {
   var language_id = $(this).data('lamguageid');
   if ($(this).hasClass('language-selected')) {
            return true;
   } else{

    $('.change-check-language').each(function() {

       $(this).removeClass('language-selected');

    } );
    $('.my-orders').hide();
    $('.order-number').hide();
    $('.check-body').hide();
    $('#my-orders' + language_id).show();
    $('#order-number-' + language_id).show();
    $('#check-body-' + language_id).show();
    $('#check-language' + language_id).addClass('language-selected');;

   }

  

   

});
</script>