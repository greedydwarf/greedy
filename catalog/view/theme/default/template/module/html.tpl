<div>
  <?php if(isset($customer_id)){?>
	  <?php if($heading_title) { ?>
	  		<div class="personal">
				<div class="close" id="logout-user">Закрыть</div>
				
				<div id="openD-3" class="setting">Настройки</div>
	            <div id="dialog-3" title="<?php if ($_COOKIE['language'] == 'en'){ echo 'DATA'; } else{echo 'ДАННЫЕ';}?>">
					<form name="login-register" method="post" action="">
					<input id="user-name" name="user-name" type="text" placeholder="<?php if ($_COOKIE['language'] == 'en'){ echo 'Specify the name'; } else{echo 'Ваше имя';}?>" value="<?php if (isset($customer_logged_info['firstname'])){echo $customer_logged_info['firstname']; 
						if (isset($customer_logged_info['lastname'])){
						 echo ' ' . $customer_logged_info['lastname'];
						  }
					} ?>"><br>
					<input id="user-phone" name="user-phone" type="phone" placeholder="<?php if ($_COOKIE['language'] == 'en'){ echo 'Phone'; } else{echo 'Телефон';}?> (70000ХХХХХХХ)" value="<?php if (isset($customer_logged_info['telephone'])){
						echo $customer_logged_info['telephone'];
					} ?>"> <br>
					<input id="user-isq" name="user-isq" type="text" placeholder="IСQ" value="<?php if (isset($customer_logged_info['isq'])){
						echo $customer_logged_info['isq'];
					} ?>" > <br>
					<input id="user-skype" name="user-skype" type="text" placeholder="Skype" value="<?php if (isset($customer_logged_info['skype'])){
						echo $customer_logged_info['skype'];
					} ?>"> <br>
					<input id="user-email" name="user-email" type="email" placeholder="Email" value="<?php if (isset($customer_logged_info['email'])){
						echo $customer_logged_info['email'];
					} ?>"> <br>
					<input id="user-new-pass" name="user-new-pass" type="password" placeholder="<?php if ($_COOKIE['language'] == 'en'){ echo 'New password'; } else{echo 'Новый пароль';}?>"> <br>
					<input id="post_form_update" type="button" value="<?php if ($_COOKIE['language'] == 'en'){ echo 'Save'; } else{echo 'Сохранить';}?>">
					<input type="hidden" name="close" value="close">
					</form>
				</div>
				
				<div class="column">
					<p class="mail"><?php echo $customer_logged_info['email']; ?></p>
				</div>
				<div class="column">
					<div class="diagramma-personal">
						<div class="circlestat" data-dimension="146" data-text="<?php if (isset($customer_logged_info['fax'])){
						echo $customer_logged_info['fax'];
					} ?>%" data-width="10" data-fontsize="38" data-percent="<?php if (isset($customer_logged_info['fax'])){
						echo $customer_logged_info['fax'];
					} ?>" data-oldpercent="0" data-fgcolor="#009be0" data-bgcolor="#fff" data-fill="#fff" ></div>
					</div>
				</div>
				<div class="column info">
					<?php if ($_COOKIE['language'] == 'en'){?>
					<p>Registered: <?php echo $customer_logged_info['date_added']; ?></p>
					<p>Total Purchases(RUB):
										<?php if($customer_total_buy != 0){
											$total = 0;
											foreach ($customer_total_buy as $totals) {
												$total += $totals['total'];
											}
											echo $total;
										} else {
											echo 0;
										} ?> ₽</p>
					<p>Total Purchases(USD):
										<?php if($customer_total_buy_usd != 0){
											$total_usd = 0;
											foreach ($customer_total_buy_usd as $totals_usd) {
												$total_usd += $totals_usd['total_usd'];
											}
											echo $total_usd;
										} else {
											echo 0;
										} ?> $</p>
					<p>Processed applications: <?php
						echo $num_pocessed_orders;
					 ?></p>
					<p>Status: experienced</p>
					<?php  } else{ ?>
					<p>Зарегистрирован: <?php echo $customer_logged_info['date_added']; ?></p>
					<p>Всего куплено(RUB): на 
										<?php if($customer_total_buy != 0){
											$total = 0;
											foreach ($customer_total_buy as $totals) {
												$total += $totals['total'];
											}
											echo $total;
										} else {
											echo 0;
										} ?> рублей</p>
					<p>Всего куплено(USD): на
										<?php if($customer_total_buy_usd != 0){
											$total_usd = 0;
											foreach ($customer_total_buy_usd as $totals_usd) {
												$total_usd += $totals_usd['total_usd'];
											}
											echo $total_usd;
										} else {
											echo 0;
										} ?> $</p>
					<p>Обработано заявок: <?php
						echo $num_pocessed_orders;
					 ?></p>
					<p>Статус: опытный</p>
					<?php } ?>
				</div>
			</div>
	    
	  <?php }else {?> 
	  <?php echo $html;?>
      <?php }?>
  <?php } else {?> 
	  <?php echo $html;?>
  <?php } ?>
</div>
