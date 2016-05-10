<script type="text/javascript" async>
$('#button-vk-reg').on('click', function() {
  $('.ulogin-button-vkontakte').click();
  setTimeout(function() {window.location.reload();}, 2000);
});
$('#button-fb-reg').on('click', function() {
  $('.ulogin-button-facebook').click();
  setTimeout(function() {window.location.reload();}, 2000);
});


var pattern_mail = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i; 

  var checkPattern = function(target,pattern){
      if(target.val() != ''){
        if(target.val().search(pattern) == 0){
          target.removeClass('error');
          return true;
        }else{
          target.addClass('error');
          target.val('Неверный формат данных');
           return false;
        }
      }else{
          target.addClass('error');
          target.attr('placeholder', 'Поле не должно быть пустым!');
          return false;
      }
    };
var checkPatternNotNess = function(target,pattern){
      if(target.val() != ''){
        if(target.val().search(pattern) == 0){
          target.removeClass('error');
          return true;
        }else{
          target.addClass('error');
          target.val('Неверный формат данных');
           return false;
        }
      }else{
          return true;
      }
    };
  function removeEroor(target){
      target.focus(function() {
       target.removeClass('error');
       target.attr('placeholder', '');
      });
  }
//--></script>

<script type="text/javascript" async>
  var email_register = $('input[name="login-register"]');
  var pass_register = $('input[name="pass-register"]');
  
$('#post_track_form').on('click', function() {
  
 
  $.ajax({
    url: 'index.php?route=information/information/checkOrderStatus',
    type: 'post',
    data: $('input[name="track_order"],input[name="language_id"]'),
    dataType: 'json',
    beforeSend: function() {      
    },
    complete: function() {
      
    },
    success: function(json) {
      if (json['status_name']) {
        $('#track_order_info').html(json['status_name']);
      }
    },
    error: function() {
      $('#track_order_info').html("no information");
    }
  });

});
//--></script>


<script type="text/javascript" async>
  var email_register = $('input[name="login-register"]');
  var pass_register = $('input[name="pass-register"]');
  
$('#post_form_register').on('click', function() {
  
 checkPattern(email_register,pattern_mail);
if(checkPattern(email_register,pattern_mail)){
   
  $.ajax({
    url: 'index.php?route=account/register/addNewCustomerFast',
    type: 'post',
    data: $('input[name="login-register"], input[name="pass-register"]'),
    dataType: 'json',
    beforeSend: function() {      
    },
    complete: function() {
      
      setTimeout(function() {window.location.reload();}, 2000);  
    },
    success: function(json) {
      
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });
}
});
//--></script>
<script type="text/javascript" async>
var email_login = $('input[name="login-login"]');
var pass_login = $('input[name="pass-login"]');

$('#post_form_login').on('click', function() {
 
 checkPattern(email_login,pattern_mail);
if(checkPattern(email_login,pattern_mail)){
   
  $.ajax({
    url: 'index.php?route=account/login/loginCustomerFast',
    type: 'post',
    data: $('input[name="login-login"], input[name="pass-login"]'),
    dataType: 'json',
    beforeSend: function() {
     
    },
    complete: function() {
      
      setTimeout(function() {window.location.reload();}, 2000); 
    },
    success: function(json) {
     
              
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });
  }
});
//--></script>
<script type="text/javascript" async>
$('#logout-user').on('click', function() {
  
   
  $.ajax({
    url: 'index.php?route=account/login/logoutCustomerFast',
    type: 'post',
    data: $('input[name="close"]'),
    dataType: 'json',
    beforeSend: function() {
      
    },
    complete: function() {
      
      setTimeout(function() {window.location.reload();}, 2000);
    },
    success: function(json) {
        
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });
});
//--></script>
<script type="text/javascript" async>
var user_email = $('#user-email');
var user_isq = $('#user-isq');
var user_phone = $('#user-phone');



var pattern_isq = /^[0-9]{9}$/;
var pattern_phone = /^[0-9]{12}$/;

removeEroor(user_email);
removeEroor(user_isq);
removeEroor(user_phone);



$('#post_form_update').on('click', function() {

  checkPattern(user_email,pattern_mail);
  checkPatternNotNess(user_isq,pattern_isq);
  checkPatternNotNess(user_phone,pattern_phone); 
  if (checkPattern(user_email,pattern_mail) && checkPatternNotNess(user_isq,pattern_isq) && checkPatternNotNess(user_phone,pattern_phone)){
  $.ajax({
    url: 'index.php?route=account/login/updateCustomerFast',
    type: 'post',
    data: $('input[name="user-name"],input[name="user-phone"],input[name="user-isq"],input[name="user-skype"],input[name="user-email"],input[name="user-new-pass"]'),
    dataType: 'json',
    beforeSend: function() {
      
    },
    complete: function() {
     
      setTimeout(function() {window.location.reload();}, 1000);
    },
    success: function(json) {
      
         
    },
    error: function() {
      alert("Данные небыли отправлены");
    }
  });
 }
});
//--></script>
<footer id="footer">
  <div class="container">
    <?php if ($informations) { ?>
    <nav class="menu-bottom">
      <ul>                                     
          <li><a href="http://greedydwarf.com"><?php if ($_COOKIE['language'] == 'en'){ echo 'Home';
        } else{
          echo 'Домой';
        }?></a></li>
          <?php
          $i = 0;
          for($i = 0; $i < count($informations); $i++){
            if ($i === 1 ){
          ?>
            <li><a href="http://greedydwarf.com/index.php?route=information/news/"><?php if ($_COOKIE['language'] == 'en'){ echo 'News';
        } else{
          echo 'Новости';
        }?></a></li>
            <li><a href="<?php echo $informations[$i]['href']; ?>"><?php echo $informations[$i]['title']; ?></a></li>
          <?php   }
           else{
          ?>
              <li><a href="<?php echo $informations[$i]['href']; ?>"><?php echo $informations[$i]['title']; ?></a></li>
          <?php  }
          }
          ?>
      </ul>  
          <!--<li class="main-menu"><a href="http://greedydwarf.com/index.php?route=information/news/">Новости</a></li>
          <?php foreach ($categories as $category) { ?>
          <li class="main-menu"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
          <?php } ?>
        
        <ul>
          <li><a href="http://greedydwarf.com">Домой</a></li>
          <li><a href="http://greedydwarf.com/index.php?route=information/news">Новости</a></li>
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>-->
    </nav>
    <?php } ?>
    <div class="sociale">
      
         <a class="addthis_button_facebook" fb:like:layout="button_count">
         <img src="image/catalog/images-my/fb.png" alt=""></a>
         <a class="addthis_button_tweet"><img src="image/catalog/images-my/twitter.png" alt=""></a> 
         <a class="addthis_button_vk"><img src="image/catalog/images-my/vk.png" alt=""></a>
         
       
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
      
    </div>
  </div>
</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery-ui.js"></script>
<script src="catalog/view/javascript/jquery.formstyler.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.glide.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.circliful.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/ajax.js"></script>
<script src="catalog/view/javascript/script.js" type="text/javascript"></script>
<script id="dsq-count-scr" src="//greedydwarfcom.disqus.com/count.js" async></script>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->


			<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
	
			<?php 
if ($hideadl==0) {
$_SESSION['advurl']="http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

echo $customcss;


			}	?>
<?php if ($hideadl==1) { ?>

<?php $zone_id=0; if ((isset($_SESSION['fieldrequired'])) && (count($_SESSION['fieldrequired'])>=1)) { ?>





<link href="catalog/view/javascript/jquery/fancybox/bootstrap-combined.min.css" rel="stylesheet">

<script src="catalog/view/javascript/jquery/fancybox/bootstrafp.min.js"></script>
<div id="thanks"><a id="subscribepopup" href="#form-content"  style="display:none"></a></div>
	<!-- model content -->	
	
	<div id="form-contentb" class="modal fade in" data-keyboard="false" data-backdrop="static" style="bottom: auto !important; display: none; ">
	        <div class="modal-header">
	              
	              <b><?php echo $popupheading; ?></b>
	              
	        </div>
		<div>
		<form id="address_field" class="contact">
			
			<fieldset>
			<div id="thanks2"></div>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
					 <?php foreach ($_SESSION['fieldrequired'] as $field) { ?>
					  <?php if ($field=='firstname') { ?>
				<li class="nav-header">*<?php echo $entry_firstname; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
                
                 <?php if ($field=='lastname') { ?>
				<li class="nav-header">*<?php echo $entry_lastname; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
				
					  <?php if ($field=='fax') { ?>
				<li class="nav-header"><?php echo $entry_fax; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
				
						  <?php if ($field=='telephone') { ?>
				<li class="nav-header">*<?php echo $entry_telephone; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
				
						  <?php if ($field=='company') { ?>
				<li class="nav-header"><?php echo $entry_company; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
				
				
				
				
				
						  <?php if ($field=='postcode') { ?>
				<li class="nav-header"><?php echo $entry_postcode; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				
				<?php if ($error_postcode) { ?>
            <span id="postcode-required" class="error"><?php echo $error_postcode; ?></span>
            <?php } ?>
			<?php } ?>
				
						  <?php if ($field=='city') { ?>
				<li class="nav-header">*<?php echo $entry_city; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
					 
					  <?php if ($field=='address_1') { ?>
				<li class="nav-header">*<?php echo $entry_address_1; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
				
				 <?php if ($field=='address_2') { ?>
				 
				<li class="nav-header"><?php echo $entry_address_2; ?></li>
				<li><input class="input-xlarge" value="" type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>"></li>
				<?php } ?>
					 
					 <?php if ($field=='country_id') { ?>
					 <?php $usecountry='1'; ?>
					 <li class="nav-header">*<?php echo $entry_country; ?></li>
					 <li>
					 <select name="country_id" id="country_id" >
              <option value=""><?php echo $text_select; ?></option>
              <?php foreach ($countries as $country) { ?>
             
              <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
              <?php } ?>
             
            </select>
            <?php if ($error_country) { ?>
            <span id ="country-required"  class="error"><?php echo $error_country; ?></span>
            <?php } ?>					
					 </li>
					  <?php } ?>  <?php if ($field=='zone_id') { ?>
					 
					 
					 <li class="nav-header">*<?php echo $entry_zone; ?></li>
					 <li>
					<select name="zone_id" id="zone_id">
            </select>
            <?php if ($error_zone) { ?>
            <span id ="zone-required" class="error"><?php echo $error_zone; ?></span>
            <?php } ?>
					 </li>
					 <?php } ?> 
					
				
				
				<?php } ?>
				 

				</ul> 
		        </div>
			</fieldset>
			</form>
		</div>
	     <div class="modal-footer">
	         <button class="btn btn-success" id="submit">submit</button>
	        
  		</div>
	</div>

    <script>
 $(function() {
//twitter bootstrap script
	$("button#submit").click(function(){
	        $.ajax({
    		type: "POST",
		url: "index.php?route=module/advancedlogin/address",
		data: $("#address_field").serialize(),
	
        	success: function(msg){
			  $('#thanks2').before('<div class="alert ' + msg.type + '">' + msg.message + '</div>');
 	                
 		       	$("."+msg.type).delay(5000).slideUp(400, function(){if($(this).hasClass('alert-success')){ $("#form-contentb").hide();	}});
 		        },
		error: function(){
			alert("failure");
			}
      		});
	});
});
</script>
<script type="text/javascript">jQuery(document).ready(function() {

    setTimeout( function() {$("#subscribepopup").trigger('click'); $( "#form-contentb" ).show(); },0);
	
   }
   );  
   </script>
   	<?php if ($usecountry=='1') { ?>
   <script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},		
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			
			} else {
				$('#postcode-required').hide();
			
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone']) {
			$('#country-required').show();
			
			$('#zone-required').show();
			
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
					
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
						$('#zone-required').hide();
						
	    			}
					
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
					
					
						
				}
			} else {
			
				$('#zone-required').show();
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
		
			$('select[name=\'zone_id\']').html(html);
			
		
			$('#country-required').hide();
			$('#zone-required').hide();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
  <?php } ?> 
   <?php } ?>
      <?php } ?>
			
			
</body></html>
