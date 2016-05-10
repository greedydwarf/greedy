<div id="bottom">
  <div class="container">
    <div class="boxs">
      <?php if ($_SERVER['REQUEST_URI'] == '/index.php?route=common/home' || $_SERVER['REQUEST_URI'] == '/'){ ?>
      <div class="box disqus">
        <h3><?php if ($_COOKIE['language'] == 'en'){ echo 'TESTIMONIALS';
        } else{
          echo 'ОТЗЫВЫ';
        }?></h3>
        <div class="body-disqus">
        <div id="disqus_thread"></div>
            <div id="disqus_thread"></div>
               <div id="disqus_thread"></div>
              <script>
                  /**
                   *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                   *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
                   */
                  /*
                  var disqus_config = function () {
                      this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                      this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                  };
                  */
                  (function() {  // DON'T EDIT BELOW THIS LINE
                      var d = document, s = d.createElement('script');
                      
                      s.src = '//greedydwarfcom.disqus.com/embed.js';
                      
                      s.setAttribute('data-timestamp', +new Date());
                      (d.head || d.body).appendChild(s);
                  })();
              </script>
              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        </div>
      </div>
          
      <?php } ?>
      
      <div class="box news <?php if ($_SERVER['REQUEST_URI'] != '/index.php?route=common/home'){ ?><?php if ($_SERVER['REQUEST_URI'] != '/'){ ?><?php echo 'pages' ?><?php } ?><?php } ?>">	
			  <h3><?php echo $heading_title; ?></h3>
			  <div class="wrap">
			  <?php foreach ($all_news as $news) { ?>
				<div class="last-news-item">
				  <a href="<?php echo $news['view']; ?>"><?php echo $news['title']; ?></a>
				  <!--<span style="float:right;"><?php echo $news['date_added']; ?></span>--><br />
				  <p><?php echo $news['description']; ?><p>
				</div>
				
			  <?php } ?>
			  </div>
			  <div class="pagination">
				<a href="/news"><?php if ($_COOKIE['language'] == 'en'){ echo 'All news';
        } else{
          echo 'Все новости';
        }?> &rarr;</a>	
			  </div>
			
	  </div>
      <div class="box contacts">
        <h3><?php if ($_COOKIE['language'] == 'en'){ echo 'CONTACTS';
        } else{
          echo 'КОНТАКТЫ';
        }?></h3>
        <div class="wrap">
          <img src="image/catalog/images-my/phone.png" alt="">
          <p><span>SKYPE:</span><a href="skype:greedy.dwarf">greedy.dwarf</a> <br>
          <span>ICQ:</span> 553-849-018</p>
          
          <img src="image/catalog/images-my/mail.png" alt="">
          <p class="mail"><span>Email us:</span> info@greedydwarf.com</p>
        <!-- VK Widget -->
          <div id="vk_groups"></div>
          <div id="vk_groups-icon">
          <img src="image/catalog/images-my/vk-icon.png" alt="">
          <p><a href="#"><strong>Группа VK</strong></a></p>
          </div>

           <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "150", color1: 'e7e7e7', color2: '202628', color3: '202628'},                          94357198);
           </script>
        </div>
      </div>
    </div>
  </div>
</div>
