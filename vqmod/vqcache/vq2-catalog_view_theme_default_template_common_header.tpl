<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>

<script src="catalog/view/javascript/jquery/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/jquery.circliful.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/jquery.formstyler.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/template.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?119"></script>
<script language="JavaScript" type="text/javascript">
            function highlight(){
              var tags=document.getElementsByTagName("li");
              for(i in tags){
                if(tags[i].className=="main-menu"){
                    if(document.location.href==tags[i].firstChild.href){
                        tags[i].className += " active";
                    }
                    if(document.location.href== "http://greedydwarf.com/index.php?route=common/home" ){
                        tags[0].className += " active";
                    }
                }
              }
            }
</script>
<script type="text/javascript">
    $(function(){
    $("#dialog").dialog({
    autoOpen: false
    });
    $("#openD").click(function(){
    $("#dialog").dialog("open");
    });
    });
      $(function(){
      $("#dialog-2").dialog({
      autoOpen: false
      });
      $("#openD-2").click(function(){
      $("#dialog-2").dialog("open");
      });
      });
        $(function(){
      $("#dialog-3").dialog({
      autoOpen: false
      });
      $("#openD-3").click(function(){
      $("#dialog-3").dialog("open");
      });
      });
     
</script>
</head>
<body class="<?php echo $class; ?>" onload="highlight()">
<!--<nav id="top">
  <div class="container">
    
    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
        <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>
        
			<?php if ($logged) { ?>
			<li class="dropdown">
			<?php } else { ?>
			 <li class="dropdown style:display:none"><li id="welcome">
			<?php } ?>
			<a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
            <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
            <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
            <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
        <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
        <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>-->
<?php
                    //$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
                    //$user = json_decode($s, true);
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
?>

<header>
  <div class="container header">
    <?php echo $currency; ?>
    <?php echo $language; ?>
    <div class="clear-fix"></div>
    <?php if ($logo) { ?>
    <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>"/></a>
    <?php } else { ?>
    <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
    <?php } ?>
    <nav id="nav" class="menu-top">
      <a href="javascript:void(0)" class="open_nav"><span>Menu</span></a>
      <div class="drop">
        <ul>                                     
          <li class="main-menu"><a href="http://greedydwarf.com"><?php if ($_COOKIE['language'] == 'en'){ echo 'Home';
        } else{
          echo 'Домой';
        }?></a></li>
          <?php
          $i = 0;
          for($i = 0; $i < count($categories); $i++){
            if ($i === 1 ){
          ?>
            <li class="main-menu"><a href="http://greedydwarf.com/index.php?route=information/news/"><?php if ($_COOKIE['language'] == 'en'){ echo 'News';
        } else{
          echo 'Новости';
        }?></a></li>
            <li class="main-menu"><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
          <?php   }
           else{
          ?>
              <li class="main-menu"><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
          <?php  }
          }
          ?>
          
          <!--<li class="main-menu"><a href="http://greedydwarf.com/index.php?route=information/news/">Новости</a></li>
          <?php foreach ($categories as $category) { ?>
          <li class="main-menu"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
          <?php } ?>-->
        </ul>
        
      </div>
    </nav>

  </div>
  
</header>
  
<!--<?php if ($categories) { ?>
<div class="container">
  <nav id="menu" class="navbar">
    <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
        <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
          <div class="dropdown-menu">
            <div class="dropdown-inner">
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
              <ul class="list-unstyled">
                <?php foreach ($children as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
            <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
        </li>
        <?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>
<?php } ?>-->
