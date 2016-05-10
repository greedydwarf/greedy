<?php echo $header; ?>
<div class="container">
  <!--<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>-->
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="all-news">
	    <!--<thead>
		  <tr>
			<th></th>
			<th><?php echo $text_title; ?></th>
			<th><?php echo $text_description; ?></th>
			<th><?php echo $text_date; ?></th>
			<th class="text-right"></th>
		  </tr>
		</thead>-->
		<div class="all-news-content">
		<h1><?php echo $heading_title; ?></h1>
		<?php foreach ($all_news as $news) { ?>
		  <div class="news-item">
		   <a href="<?php echo $news['view']; ?>"><span><?php echo $news['title']; ?></span></a><br />
		   <img src="<?php echo $news['image']; ?>" />
		   
		   <!--<div class="news-item-description"><?php echo $news['description']; ?></div>-->
		   <div class="news-item-date">Дата публикации: <?php echo $news['date_added']; ?></div>
		   <!--<td style="vertical-align:middle" class="text-right"><a href="<?php echo $news['view']; ?>"><?php echo $text_view; ?></a></td>-->
		  </div>
		<?php } ?>
		</div>
	  </div>
	  <div class="clear-fix"></div>
	  <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>

	  <?php echo $content_bottom; ?>
	</div>
    <?php echo $column_right; ?>
</div>
</div>
<?php echo $footer; ?> 