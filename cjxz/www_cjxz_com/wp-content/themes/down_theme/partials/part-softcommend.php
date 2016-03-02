          
              <?php
              $current_term = get_queried_object();
              $child_args = array(
                'hide_empty'=>false,
                'parent'=>$current_term->term_id
              );
              $term_in = array();
              $term_in[] = $current_term->term_id;
              $child_terms = get_terms($child_args);
              if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                foreach( $child_terms as $term ){
                  $term_in[] = $term->term_id;
                }
              }
              $args = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'posts_per_page'=>24,
                'orderby'=>'meta_value_num',
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'operator'=>'IN',
                    'terms'=>$term_in
                  )
                ),
                'meta_query' => array(
                  array('key' => 'views')
                )
              );
              query_posts($args);
              ?>
              <?php if(have_posts()):
              ?>
              <div id="commend">
            <div class="title"><span>本类推荐</span></div>
            <div id="carosel_wrap">
              <?php while(have_posts()): the_post(); ?>
              <div class="item">
                <div class="item_wrap">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo get_soft_ico_src($post->ID); ?>" />
                    <span class="item_title"><?php the_title(); ?></span>
                  </a>
                </div>
              </div>
              <?php endwhile; ?>
              </div>
          </div>
              <?php endif; wp_reset_query(); ?>