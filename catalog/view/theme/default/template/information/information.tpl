<?php echo $header; ?>
<div class="container">
  <!--<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>-->
  <div class="information-wrap">
    <div class="row"><?php echo $column_left; ?>
      <?php if ($column_left && $column_right) { ?>
      <?php $class = 'col-sm-6'; ?>
      <?php } elseif ($column_left || $column_right) { ?>
      <?php $class = 'col-sm-9'; ?>
      <?php } else { ?>
      <?php $class = 'col-sm-12'; ?>
      <?php } ?>
      <?php echo $content_top; ?>
      <div id="content" class="<?php echo $class; ?>">

        <h1><?php echo $heading_title; ?></h1>
            <?php if($heading_title === 'Мои заказы'){ ?>
              <form action="" method="post">
                <input type="text" id="track_order" name="track_order">
                <input type="hidden" id="language_id" name="language_id" value="1">
                <input id="post_track_form" type="button" value="Отследить">
              </form>
              <p id="track_order_info"></p>
              <?php if (isset($_COOKIE['customer_id'])){ ?>
              
              <table class="status-order">
                <caption>ожидает доставки</caption>
                <thead>
                  <tr>
                    <td>№ заказа</td>
                    <td>Платеж №</td>
                    <td>Игра(товар)</td>
                    <td>Ник персонажа</td>
                    <td>Сервер</td>
                    <td>Игровая валюта</td>
                    <td>Количество</td>
                    <td>Оплачено(RUB)</td>
                    <td>Оплачено(USD)</td>
                    <td>Способ доставки</td>
                    <td>Чек</td>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($paid_order_info)){ ?>    
                      <?php  foreach ($paid_order_info as $order_info) { ?>
                      <tr>
                          <td><?php echo $order_info['order_id']; ?></td>
                          <td><?php echo $order_info['paymentID']; ?></td>
                          <td><?php echo $order_info['name']; ?></td>
                          <td><?php echo $order_info['nickname']; ?></td>
                          <td><?php echo $order_info['server']; ?></td>
                          <td><?php echo $order_info['model']; ?></td>
                          <td><?php echo $order_info['quantity']; ?></td>
                          <td><?php echo number_format($order_info['total'], 2, ',', ' '); ?></td>
                          <td><?php echo number_format($order_info['total_usd'], 2, ',', ' ') ?></td>
                          <td><?php echo $order_info['delivery'] ?></td>
                          <td><a href="/check?order_id=<?php echo $order_info['order_id']; ?>">Посмотреть</a></td>
                      </tr>
                      <?php } ?>
                    <?php } ?> 
                </tbody>
              

              </table>
              <table class="status-order">
                <caption>Завершенные сделки</caption>
                <thead>
                  <tr>
                    <td>№ заказа</td>
                    <td>Платеж №</td>
                    <td>Игра(товар)</td>
                    <td>Ник персонажа</td>
                    <td>Сервер</td>
                    <td>Игровая валюта</td>
                    <td>Количество</td>
                    <td>Оплачено(RUB)</td>
                    <td>Оплачено(USD)</td>
                    <td>Способ доставки</td>
                    <td>Чек</td>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($treated_order_info)){ ?>    
                      <?php  foreach ($treated_order_info as $order_info) { ?>
                      <tr>
                          <td><?php echo $order_info['order_id']; ?></td>
                          <td><?php echo $order_info['paymentID']; ?></td>
                          <td><?php echo $order_info['name']; ?></td>
                          <td><?php echo $order_info['nickname']; ?></td>
                          <td><?php echo $order_info['server']; ?></td>
                          <td><?php echo $order_info['model']; ?></td>
                          <td><?php echo $order_info['quantity']; ?></td>
                          <td><?php echo number_format($order_info['total'], 2, ',', ' '); ?></td>
                          <td><?php echo number_format($order_info['total_usd'], 2, ',', ' ') ?></td>
                          <td><?php echo $order_info['delivery'] ?></td>
                          <td><a href="/check?order_id=<?php echo $order_info['order_id']; ?>">Посмотреть</a></td>
                      </tr>
                      <?php } ?>
                    <?php } ?>
                </tbody>
              

              </table>
             
              <?php  }  ?>
            <?php } ?>
            <?php if($heading_title === 'My orders'){ ?>
              <form action="" method="post">
                <input type="text" id="track_order" name="track_order">
                <input type="hidden" id="language_id" name="language_id" value="2">
                <input id="post_track_form" type="button" value="Track">
              </form>
              <p id="track_order_info"></p>
              <?php if (isset($_COOKIE['customer_id'])){ ?>
              
              <table class="status-order">
                <caption>awaiting delivery</caption>
                <thead>
                  <tr>
                    <td>order №</td>
                    <td>Payment №</td>
                    <td>Game(product)</td>
                    <td>Nick-name</td>
                    <td>Server</td>
                    <td>Game currency</td>
                    <td>Quantity</td>
                    <td>Paid(RUB)</td>
                    <td>Paid(USD)</td>
                    <td>Delivery method</td>
                    <td>Check</td>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($paid_order_info)){ ?>    
                      <?php  foreach ($paid_order_info as $order_info) { ?>
                      <tr>
                          <td><?php echo $order_info['order_id']; ?></td>
                          <td><?php echo $order_info['paymentID']; ?></td>
                          <td><?php echo $order_info['name']; ?></td>
                          <td><?php echo $order_info['nickname']; ?></td>
                          <td><?php echo $order_info['server']; ?></td>
                          <td><?php echo $order_info['model']; ?></td>
                          <td><?php echo $order_info['quantity']; ?></td>
                          <td><?php echo number_format($order_info['total'], 2, ',', ' '); ?></td>
                          <td><?php echo number_format($order_info['total_usd'], 2, ',', ' ') ?></td>
                          <td><?php echo $order_info['delivery'] ?></td>
                          <td><a href="/check?order_id=<?php echo $order_info['order_id']; ?>">See</a></td>
                      </tr>
                      <?php } ?>
                    <?php } ?> 
                </tbody>
              

              </table>
              <table class="status-order">
                <caption>Completed deals</caption>
                <thead>
                  <tr>
                    <td>order №</td>
                    <td>Payment №</td>
                    <td>Game(product)</td>
                    <td>Nick-name</td>
                    <td>Server</td>
                    <td>Game currency</td>
                    <td>Quantity</td>
                    <td>Paid(RUB)</td>
                    <td>Paid(USD)</td>
                    <td>Delivery method</td>
                    <td>Check</td>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($treated_order_info)){ ?>    
                      <?php  foreach ($treated_order_info as $order_info) { ?>
                      <tr>
                          <td><?php echo $order_info['order_id']; ?></td>
                          <td><?php echo $order_info['paymentID']; ?></td>
                          <td><?php echo $order_info['name']; ?></td>
                          <td><?php echo $order_info['nickname']; ?></td>
                          <td><?php echo $order_info['server']; ?></td>
                          <td><?php echo $order_info['model']; ?></td>
                          <td><?php echo $order_info['quantity']; ?></td>
                          <td><?php echo number_format($order_info['total'], 2, ',', ' '); ?></td>
                          <td><?php echo number_format($order_info['total_usd'], 2, ',', ' ') ?></td>
                          <td><?php echo $order_info['delivery'] ?></td>
                          <td><a href="/check?order_id=<?php echo $order_info['order_id']; ?>">See</a></td>
                      </tr>
                      <?php } ?>
                    <?php } ?>
                </tbody>
              

              </table>
             
              <?php  }  ?>
            <?php } ?>
        <?php  ?>
        <?php  ?>
        <?php echo $description; ?>
      </div>
      <?php echo $column_right; ?>
    </div>
  </div>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>