        <div class="right_side">
          <div class="widget rank">
            <div class="widget_title clearfix">
              <h3>最热资讯</h3>
            </div>
            <?php
            $args = array(
              'post_type'=>'post',
              'ignore_sticky_posts' => 1,
              'posts_per_page'=>8,
              'orderby'=>'meta_value_num',
              'meta_query' => array(
                array('key' => 'views')
              )
            );
            query_posts($args);
            ?>
            <?php if(have_posts()): $i=0; ?>
            <ul>
              <?php while(have_posts()): the_post();$i++; ?>
              <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; wp_reset_query(); ?>
          </div>
          <div class="widget rank">
            <div class="widget_title clearfix">
              <h3>最新资讯</h3>
            </div>
            <?php
            $args = array(
              'post_type'=>'post',
              'ignore_sticky_posts' => 1,
              'posts_per_page'=>8,
            );
            query_posts($args);
            ?>
            <?php if(have_posts()): $i=0; ?>
            <ul>
              <?php while(have_posts()): the_post();$i++; ?>
              <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; wp_reset_query(); ?>
          </div>
        </div>