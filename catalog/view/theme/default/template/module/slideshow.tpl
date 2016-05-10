<!--<div id="slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
   <div class="slider">
    <ul class="slides">
        <?php foreach ($banners as $banner) { ?>
        <li class="slide">
          <?php if ($banner['link']) { ?>
          
          <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
            <div class="container-wrap">
            <div class="container">
                <h4><?php echo $banner['title']; ?></h4>
                <p><?php echo $banner['link']; ?></p>
            </div>
            </div>
        
          <?php } else { ?>
          <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
          <div class="container-wrap">
            <div class="container">
              <h4><?php echo $banner['title']; ?></h4>
              <p>playbns 2</p>
            </div>
          </div>
          <?php } ?>
        </li>
        <?php } ?>
    </ul>
  </div>
</div>-->
<div id="slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <div class="container-wrap">
    <div class="container">
                <h4><?php echo $banner['title']; ?></h4>
                <p><?php echo $banner['link']; ?></p>
    </div>
    </div>
   
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#slideshow<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	singleItem: true,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: true
});
--></script>