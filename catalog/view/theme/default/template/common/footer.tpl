<script type="text/javascript" async>
$('#button-vk-reg').on('click', function() {
  $('.ulogin-button-vkontakte').click();
  
});
$('#button-fb-reg').on('click', function() {
  $('.ulogin-button-facebook').click();
  
});

var pattern_mail = /^([A-z0-9_\.-]+)@([A-z0-9_\.-]+)\.([A-z\.]{2,6})$/; 

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
      
       
    },
    success: function(json) {
      if (json['already_exist']){
        email_register.val(json['already_exist'])
      } else{
        setTimeout(function() {window.location.reload();}, 1000); 
      }
      
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
      
      setTimeout(function() {window.location.reload();}, 1000);
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
<script type="text/javascript">
function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
      offset = cookie.indexOf(search);
      if (offset != -1) {
        offset += search.length;
        end = cookie.indexOf(";", offset)
        if (end == -1) {
          end = cookie.length;
        }
        setStr = unescape(cookie.substring(offset, end));
      }
    }
    return(setStr);
}
var language = getCookie("language");
    if (language == 'en' && $('#control-language').text() == 'Домой') {
      window.location.reload();
    } else if (language == 'ru' && $('#control-language').text() == 'Home'){
      window.location.reload();
    }

</script>

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
            <li><a href="/news"><?php if ($_COOKIE['language'] == 'en'){ echo 'News';
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
      
         <a href="https://www.facebook.com/greedy.dwarf" class="addthis_button_facebook" fb:like:layout="button_count">
         <img src="image/catalog/images-my/fb.png" alt=""></a>
         <a href="https://twitter.com/greedydwarf_com" class="addthis_button_tweet"><img src="image/catalog/images-my/twitter.png" alt=""></a> 
         <a href="https://vk.com/greedydwarf_com" class="addthis_button_vk"><img src="image/catalog/images-my/vk.png" alt=""></a>


<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?2oWruenS6YcGGlvlZWPOoCuVVlQjNA8H";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->         
       
           <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>-->
      
    </div>
  </div>
</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery-ui.js"></script>
<script src="catalog/view/javascript/jquery.formstyler.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.glide.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.circliful.js"></script>
<script type="text/javascript" src="catalog/view/javascript/accounting.js"></script>
<script type="text/javascript" src="catalog/view/javascript/ajax.js"></script>
<script src="catalog/view/javascript/script.js" type="text/javascript"></script>
<script id="dsq-count-scr" src="//greedydwarfcom.disqus.com/count.js" async></script>

<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->

</body></html>
