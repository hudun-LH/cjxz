<?php get_header(); ?>
<?php global $ashu_option; ?>
    <div id="home_slider">
      <?php
          $args = array(
            'post_type'=>'slider',
            'orderby'=>'menu_order',
            'order'=>'ASC',
            'showposts'=>5
          );
          query_posts($args);
          if(have_posts()):
          while(have_posts()): the_post();
          $bg = get_post_meta($post->ID,'slider_bg',true);
          $link = get_post_meta($post->ID,'slider_link',true);
          if($bg!=''){
        ?>
        <div><div class="image">
          <?php if($link!='') echo '<a href="'.$link.'">'; ?>
          <img src="<?php echo $bg; ?>"/>
          <?php if($link!='') echo '</a>'; ?>
        </div></div>
      <?php } endwhile; endif; wp_reset_query(); ?>
    </div>
    <div id="home_title">
      <div class="col_wrap clearfix">
        <div class="col">
          <div id="zhuanti" class="item">
            <?php
            $jxzt = '#';
            if(isset($ashu_option['phone']['jxzt']) && $ashu_option['phone']['jxzt']!='')
              $jxzt = $ashu_option['phone']['jxzt'];
            ?>
            <a href="<?php echo $jxzt; ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/home_zhuanti.png" />
              <h2>精选专题</h2>
            </a>
          </div>
        </div>
        <div class="col">
          <div id="bibei" class="item">
            <?php
            $zjbb = '#';
            if(isset($ashu_option['phone']['zjbb']) && $ashu_option['phone']['zjbb']!='')
              $zjbb = $ashu_option['phone']['zjbb'];
            ?>
            <a href="<?php echo $zjbb; ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/home_bibei.png" />
              <h2>装机必备</h2>
            </a>
          </div>
        </div>
        <div class="col">
          <div id="biwan" class="item">
            <?php
            $bwyx = '#';
            if(isset($ashu_option['phone']['bwyx']) && $ashu_option['phone']['bwyx']!='')
              $bwyx = $ashu_option['phone']['bwyx'];
            ?>
            <a href="<?php echo $bwyx; ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/home_biwan.png" />
              <h2>必玩游戏</h2>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="home_block">
      <div class="block_title clearfix">
        <h2>软件推荐</h2>
        <ul class="nav nav-tabs clearfix">
          <li class="active"><a href="#tab11" data-toggle="tab">推荐</a></li>
          <li><a href="#tab12" data-toggle="tab">最新</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div id="tab11" class="tab-pane active" role="tabpanel">
          <div class="home_softs clearfix">
            <?php
            $args1 = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>12,
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'terms'=>phone_soft_term
                  )
                ),
                'orderby'=>'meta_value_num',
                'meta_query' => array(
                  array('key' => 'views')
                )
            );
            query_posts($args1);
            while(have_posts()): the_post();
            $ico = get_soft_ico_src($post->ID);
            $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
            if($xxdj_value=='')
              $xxdj_value = 4;
            $size = get_post_meta($post->ID,'rjdx_value',true);
            if($size=='')
              $size = '0';
            $adw = get_post_meta($post->ID,'rjdw_value',true);
            if($adw=='KB'){
            $dw='KB';
		    }elseif($adw=='MB'){
		    $dw='MB';
		    }else{
	        $dw ='';
	        }
            ?>
            <div class="soft_item">
              <a href="<?php the_permalink(); ?>">
                <div class="item_img">
                  <img src="<?php echo $ico; ?>" />
                </div>
                <div class="caption">
                  <h3><?php the_title(); ?></h3>
                  <div class="post-ratings">
                    <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                    <i class="fa fa-star light"></i>
                    <?php } ?>
                    <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                    <i class="fa fa-star"></i>
                    <?php } ?>
                  </div>
                  <div class="size">
                    <span><?php echo $size.$dw; ?></span>
                  </div>
                </div>
              </a>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
          </div>
        </div>
        <div id="tab12" class="tab-pane" role="tabpanel">
          <div class="home_softs clearfix">
            <?php
            $args2 = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>12,
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'terms'=>phone_soft_term
                  )
                )
            );
            query_posts($args2);
            while(have_posts()): the_post();
            $ico = get_soft_ico_src($post->ID);
            $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
            if($xxdj_value=='')
              $xxdj_value = 4;
            $size = get_post_meta($post->ID,'rjdx_value',true);
            if($size=='')
              $size = '0';
            $adw = get_post_meta($post->ID,'rjdw_value',true);
            if($adw=='KB'){
            $dw='KB';
		    }elseif($adw=='MB'){
		    $dw='MB';
		    }else{
	        $dw ='';
	        }
            ?>
            <div class="soft_item">
              <a href="<?php the_permalink(); ?>">
                <div class="item_img">
                  <img src="<?php echo $ico; ?>" />
                </div>
                <div class="caption">
                  <h3><?php the_title(); ?></h3>
                  <div class="post-ratings">
                    <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                    <i class="fa fa-star light"></i>
                    <?php } ?>
                    <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                    <i class="fa fa-star"></i>
                    <?php } ?>
                  </div>
                  <div class="size">
                    <span><?php echo $size.$dw; ?></span>
                  </div>
                </div>
              </a>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="home_block">
      <div class="block_title clearfix">
        <h2>游戏推荐</h2>
        <ul class="nav nav-tabs clearfix">
          <li class="active"><a href="#tab21" data-toggle="tab">推荐</a></li>
          <li><a href="#tab22" data-toggle="tab">最新</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div id="tab21" class="tab-pane active" role="tabpanel">
          <div class="home_softs clearfix">
            <?php
            $args3 = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>12,
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'terms'=>phone_game_term
                  )
                ),
                'orderby'=>'meta_value_num',
                'meta_query' => array(
                  array('key' => 'views')
                )
            );
            query_posts($args3);
            while(have_posts()): the_post();
            $ico = get_soft_ico_src($post->ID);
            $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
            if($xxdj_value=='')
              $xxdj_value = 4;
            $size = get_post_meta($post->ID,'rjdx_value',true);
            if($size=='')
              $size = '0';
            $adw = get_post_meta($post->ID,'rjdw_value',true);
            if($adw=='KB'){
            $dw='KB';
		    }elseif($adw=='MB'){
		    $dw='MB';
		    }else{
	        $dw ='';
	        }
            ?>
            <div class="soft_item">
              <a href="<?php the_permalink(); ?>">
                <div class="item_img">
                  <img src="<?php echo $ico; ?>" />
                </div>
                <div class="caption">
                  <h3><?php the_title(); ?></h3>
                  <div class="post-ratings">
                    <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                    <i class="fa fa-star light"></i>
                    <?php } ?>
                    <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                    <i class="fa fa-star"></i>
                    <?php } ?>
                  </div>
                  <div class="size">
                    <span><?php echo $size.$dw; ?></span>
                  </div>
                </div>
              </a>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
          </div>
        </div>
        <div id="tab22" class="tab-pane" role="tabpanel">
          <div class="home_softs clearfix">
            <?php
            $args4 = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>12,
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'terms'=>phone_game_term
                  )
                )
            );
            query_posts($args4);
            while(have_posts()): the_post();
            $ico = get_soft_ico_src($post->ID);
            $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
            if($xxdj_value=='')
              $xxdj_value = 4;
            $size = get_post_meta($post->ID,'rjdx_value',true);
            if($size=='')
              $size = '0';
            $adw = get_post_meta($post->ID,'rjdw_value',true);
            if($adw=='KB'){
            $dw='KB';
		    }elseif($adw=='MB'){
		    $dw='MB';
		    }else{
	        $dw ='';
	        }
            ?>
            <div class="soft_item">
              <a href="<?php the_permalink(); ?>">
                <div class="item_img">
                  <img src="<?php echo $ico; ?>" />
                </div>
                <div class="caption">
                  <h3><?php the_title(); ?></h3>
                  <div class="post-ratings">
                    <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                    <i class="fa fa-star light"></i>
                    <?php } ?>
                    <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                    <i class="fa fa-star"></i>
                    <?php } ?>
                  </div>
                  <div class="size">
                    <span><?php echo $size.$dw; ?></span>
                  </div>
                </div>
              </a>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="home_block">
      <div class="block_title clearfix">
        <h2>精选专题</h2>
      </div>
      <div class="home_zhuanti">
        <div class="home_topics clearfix">
          <?php
          $phone_topic_recommend = $ashu_option['phone']['phone_topic_recommend'];
          $args5 = array(
            'post_type'=>'topic',
            'ignore_sticky_posts' => 1,
            'showposts'=>4,
          );
          if(!empty($phone_topic_recommend))
            $args5['post__in'] = $phone_topic_recommend;
          query_posts($args5);
          while(have_posts()): the_post();
          ?>
          <div class="topic_item">
            <?php
            $topic_ico = get_post_meta($post->ID,'topic_ico',true);
            ?>
            <a href="<?php the_permalink(); ?>" >
            <img src="<?php echo get_template_directory_uri().'/timthumb.php?src='.$topic_ico.'&h=95&w=232&zc=1'; ?>" />
            </a>
          </div>
          <?php
          endwhile;
          wp_reset_query();
          ?>
        </div>
      </div>
    </div>
    <?php
    if(0){
    ?>
    <div class="home_block">
      <div class="block_title clearfix">
        <h2>手机壁纸</h2>
        <ul class="nav nav-tabs clearfix">
          <li class="active"><a href="#tab31" data-toggle="tab">美女</a></li>
          <li><a href="#tab32" data-toggle="tab">风景</a></li>
          <li><a href="#tab33" data-toggle="tab">漫画</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div id="tab31" class="tab-pane active" role="tabpanel">
          <div class="home_wallpapers clearfix">
            <?php for($i=0;$i<3;$i++){ ?>
            <div class="wallpaper">
              <a href="" ><img src="<?php echo get_template_directory_uri(); ?>/images/wallpaper.png" /></a>
            </div>
            <?php } ?>
          </div>
        </div>
        <div id="tab33" class="tab-pane" role="tabpanel">
          <div class="home_wallpapers clearfix">
            <?php for($i=0;$i<3;$i++){ ?>
            <div class="wallpaper">
              <a href="" ><img src="<?php echo get_template_directory_uri(); ?>/images/wallpaper.png" /></a>
            </div>
            <?php } ?>
          </div>
        </div>
        <div id="tab33" class="tab-pane" role="tabpanel">
          <div class="home_wallpapers clearfix">
            <?php for($i=0;$i<3;$i++){ ?>
            <div class="wallpaper">
              <a href="" ><img src="<?php echo get_template_directory_uri(); ?>/images/wallpaper.png" /></a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="home_block">
      <div class="block_title clearfix">
        <h2>软件资讯</h2>
      </div>
      <div class="home_news">
        <?php
        $args_news = array(
          'post_type'=>'post',
          'showposts'=>8
        );
        query_posts($args_news);
        if(have_posts()):
        $j=0;
        ?>
        <div class="images clearfix">
          <?php while(have_posts()): the_post(); $j++; ?>
          <div class="img_item">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&w=180&h=120&zc=1" alt="<?php the_title(); ?>" />
              <h3><?php the_title(); ?></h3>
            </a>
          </div>
          <?php
          if($j==2)
            break;
          endwhile; ?>
        </div>
        <ul>
          <?php while(have_posts()): the_post(); ?>
          <li><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),28,true); ?><?php //the_title(); ?></a>
          <span class="date"><?php the_time('Y-m-d'); ?></span>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php
        endif;
        wp_reset_query();
        ?>
      </div>
    </div>
    <?php
    if(isset($ashu_option['phone']['phone_hot_key']) && $ashu_option['phone']['phone_hot_key']!=''){
    $hot_keystr = $ashu_option['phone']['phone_hot_key'];
    $hot_key = explode(',',$hot_keystr);
    ?>
    <div class="home_block hot_search">
      <div class="block_title clearfix">
        <h2>热门搜索</h2>
      </div>
      <div class="search_keys clearfix">
        <?php
        foreach($hot_key as $key):
        ?>
        <a href="<?php echo home_url().'/?s='.$key; ?>"><?php echo $key; ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php } ?>
    <?php if(0){ ?>
    <div class="home_block links">
      <div class="block_title clearfix">
        <h2>友情链接</h2>
      </div>
      <div class="links">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          $args6 = array(
            'echo'=>false,
            'container' => false,
            'items_wrap' => '%3$s',
            'sort_column' => 'menu_order',
            'menu_id'=>'main_nav',
            'depth'=>1,
            'menu_class'=>'nav_c',
            'theme_location' => 'links',
            'walker' => new ashuwp_manu_line()
          );
          $footer_na = wp_nav_menu($args6);
          echo strip_tags($footer_na ,'<span><a>');
        }
        ?>
      </div>
    </div>
    <?php } ?>
    <div id="footer_line"><!--empty--></div>
<?php get_footer(); ?>