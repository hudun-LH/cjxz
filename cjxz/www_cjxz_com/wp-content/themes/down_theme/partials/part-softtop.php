      <div id="boutique">
        <div class="corner heji">合集</div>
        <div class="heji_lists clearfix">
          <?php
          $args = array(
            'post_type'=>'topic',
            'ignore_sticky_posts' => 1,
            'posts_per_page'=>28,
            'orderby'=>'meta_value_num',
            'meta_query' => array(
              array('key' => 'views')
            )
          );
          query_posts($args);
          if(have_posts()): while(have_posts()): the_post();
          ?>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <?php endwhile; endif; wp_reset_query(); ?>
        </div>
      </div>