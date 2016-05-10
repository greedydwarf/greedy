<?php echo $header; ?>
<div id="blog-content" id="blog">

  <?php if(count($breadcrumbs)) : ?>
  <div id="blog-breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <!-- #blog-breadcrumb -->

  <!-- Blog Success Alert Start -->
  <?php if(isset($success) && $success): ?>
      <div id="blog-alert">
        <div class="container">
        <div class="row">
        <div class="col-sm-12">
              <?php if ($success) { ?>
              <div class="alert alert-succes"><?php echo $success; ?></div>
              <?php } ?>
        </div>
        </div>
        </div>
      </div>
  <?php endif; ?>
  <!-- BLog Success Alert End -->

  <!-- Blog Error Warning Start-->
  <?php if(isset($error_warning) && $error_warning): ?>
      <div id="blog-warning">
        <div class="container">
        <div class="row">
        <div class="col-sm-12">
              <?php if ($error_warning) { ?>
              <div class="error_warning alert alert-succes"><?php echo $error_warning; ?></div>
              <?php } ?>
        </div>
        </div>
      </div>
      </div>
  <?php endif; ?>
  <!-- Blog Error Warning End -->

  <!-- Content Top Start -->
  <div class="module-wrapper">
      <div class="container">
          <?php echo $content_top; ?>
      </div>
  </div>
  <!-- Content Top End -->

  <div id="blog-maincontent">
  <div class="container">
  <div class="row">

        <?php echo $column_left; ?>

        <?php 
          if($column_left AND $column_right) {
            $layout = 'col-sm-6';
          } else if ($column_left || $column_right ) {
            $layout = 'col-sm-9';
          } else {
            $layout = 'col-sm-12';
          }
        ?>
        <div class="<?php echo $layout; ?>">
        <div class="content">
        <div class="row">
        <div class="col-sm-12">
              <?php if($post) : ?>
              
              <?php if($related_products): ?>
                <div class="row">
                <div class="col-sm-9">
              <?php endif; ?>

              <ul class="post-list">
                <li class="post post-single">

                    <?php $time = strtotime($post['date_added']); ?>
                    <div class="datetime">
                      <span class="date"><?php echo date('d',$time); ?>, <?php echo month_name(date('m',$time)); ?>, <?php echo date('Y',$time); ?></span>
                      <span class="time"><?php echo date('h',$time); ?>:<?php echo date('i',$time); ?>:<?php echo date('s',$time); ?></span>
                    </div>
                    <!-- .datetime -->

                    <div class="post-heading">
                      <h2 class="post-title"><span class="fa fa-pencil"></span>&nbsp;&nbsp;<?php echo ucfirst($post['title']); ?></h2>
                    </div>

                    <div class="post-content">
                      <div class="post-meta">
                        <span><?php echo $text_author; ?><?php echo author($post['post_author'],'username'); ?></span>
                        <span><?php echo $text_comment; ?><?php echo $post['comment_count']; ?></span>
                        <span><?php echo sprintf($text_view,$post['view']); ?></span>
                      </div>

                      <div class="content content-single">
                        <div>

                          <?php echo html_entity_decode($post['content']); ?>

                          <div class="clearfix"></div>

                          <?php if($post['images']) : ?>
                            <div class="gallery">
                              <h2><?php echo $text_gallery_title; ?></h2>
                              <ul class="list-unstyled imagepopups">
                                <?php foreach ($post['images'] as $image) : ?>
                                  <li>
                                    <a href="<?php echo $image['url']; ?>" title="">
                                      <img src="<?php echo $image['image']; ?>" alt="">
                                    </a>
                                  </li>
                                <?php endforeach; ?>
                              </ul>
                            </div>
                          <?php endif; ?>

                        </div>
                      </div>
                      <!-- .content -->
                  </div>
                  <div class="clearfix"></div>
                  <!-- .post-content -->

                   <div class="post-footer">
                      <div class="footer-meta">
                        <div class="post-tags pull-left">
                          <strong><?php echo $text_tag; ?>&nbsp;</strong>
                          <?php $tags = explode(',', $post['tag']);?>
                          <?php for ($i=0; $i < count($tags); $i++) : ?>
                            <a href="<?php echo HTTP_SERVER; ?>index.php?route=blog/tag&amp;tag=<?php echo urldecode($tags[$i]); ?>"><?php echo ucfirst($tags[$i]); ?></a>
                          <?php endfor; ?>
                        </div>
                        <div class="addthis_native_toolbox social-bar pull-right"></div>
                      </div>
                    </div>


                </li>
                <!-- .post -->
              </ul>
              <!-- .post-list -->

              <?php if($related_products): ?>
              </div>
              <!-- col -->
                <div class="col-sm-3">
                  <div class="big-title">
                    <h2 class="title"><?php echo $title_related_product; ?></h2>
                  </div>
                  <?php foreach ($related_products as $product) : ?>
                    <div class="related-product">
                      <div class="product-thumbanil">
                        <img src="<?php echo $product['product_thumb']; ?>" alt="">
                      </div>
                      <div class="product-info">
                        <h2 class="product-title"><a href="<?php echo HTTP_SERVER; ?>index.php?route=product/product&amp;product_id=<?php echo $product['product_id']; ?>" ttile=""><?php echo $product['name']; ?></a></h2>
                        <p><?php echo words_limit(html_entity_decode($product['description']), 20, '...'); ?></p>
                        <b>Price: </b><span class="product-price"><?php echo $product['price']; ?></span>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php endif; ?>

              <?php else: ?>
                <div class="alert alert-danger">
                  <?php echo $not_found; ?>
                </div>
              <?php endif; ?>

            <div class="panel panel-default related-post">
              <div class="panel-heading">
                <h2 class="panel-title"><?php echo $text_related; ?></h2>
              </div>
              <div class="panel-body content">
                  <?php if($related_posts) : ?> 
                  <ul class="list-unstyled related-posts">
                    <?php 
                    $inc = 0;
                    foreach ($related_posts as $related_post) : ?>
                        <li class="post-list">
                          <a href="<?php echo HTTP_SERVER; ?>index.php?route=blog/single&amp;pid=<?php echo $post['ID']; ?>">
                            <img class="thumbnail" src="<?php echo $related_post['post_thumbnail']; ?>" alt="">
                            <h2 class="post-title"><?php echo ucfirst($related_post['title']); ?></h2>
                            <div class="post-meta">
                              <strong><?php echo $text_author; ?></strong><span><?php echo author($related_post['post_author'],'username'); ?></span>
                              &nbsp;|&nbsp;<strong><?php echo $text_publish; ?></strong><span><?php echo $post['date_added']; ?></span>
                            </div>
                            <p><?php echo words_limit(html_entity_decode($related_post['content']),$config['word_limit_in_related_post'],'...'); ?></p>
                          </a>
                        </li>
                    <?php 
                    $inc++;
                    endforeach; ?>
                  </ul>
                  <?php else: ?>
                    <div class="alert alert-warning"><?php echo $not_found; ?></div>
                  <?php endif; ?>
              </div>
            </div>
            <!-- .Related Post -->

        </div>
        <!-- col-sm-12 -->
        </div>
        <!-- .row -->
        </div>
        <!-- #content -->
        </div>

        <?php echo $column_right; ?>

    </div>
    <!-- .row -->
    </div>
    <!-- .container -->
    </div>
    <!-- #blog-maincontent -->

    <div class="module-wrapper">
        <div class="container">
            <?php echo $content_bottom; ?>
        </div>
    </div>

<script type="text/javascript"><!--
$(document).ready(function() {
  $('.imagepopups').magnificPopup({
    type:'image',
    delegate: 'a',
    gallery: {
      enabled:true
    }
  });
});
//--></script> 

<?php echo $footer; ?>