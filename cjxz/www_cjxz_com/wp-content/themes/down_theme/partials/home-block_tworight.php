          <?php
          //第一块图片开始
          ?>
          <div class="box imgbox">
            <a href="">
              <img src="<?php echo get_template_directory_uri(); ?>/ico/dd_ad.png" />
            </a>
          </div>
          <?php
          //第一块图片结束
          ?>
          <?php
          //软件资讯开始
          ?>
          <div class="box new_list">
            <?php
            $new_term = get_term_by('slug','news','category');
            ?>
            <a href="<?php echo get_term_link($new_term,'category'); ?>" class="t"><?php echo $new_term->name; ?></a>
            <?php
            $args_news = array(
              'post_type'=>'post',
              'showposts'=>5,
              'orderby'=>'meta_value_num',
              'meta_query' => array(
                array('key' => 'views')
              )
            );
            query_posts($args_news);
            if(have_posts()):
            ?>
            <ul>
              <?php while(have_posts()): the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>
          </div>
          <?php
          //软件资讯结束
          ?>
          <?php
          //最近更新开始
          ?>
          <div class="box topic_list">
            <span class="t">最近更新</span>
            <?php //图片1 ?>
            <a href="" class="img">
              <img src="<?php echo get_template_directory_uri(); ?>/ico/win10.jpg" />
            </a>
            <?php //图片2 ?>
            <a href="" class="img">
              <img src="<?php echo get_template_directory_uri(); ?>/ico/yingjian.jpg" />
            </a>
            <?php
            $args_news = array(
              'post_type'=>'post',
              'showposts'=>6
            );
            query_posts($args_news);
            if(have_posts()):
            ?>
            <ul class="clearfix">
              <?php while(have_posts()): the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; wp_reset_query(); ?>
          </div>
          <?php
          //最近更新结束
          ?>