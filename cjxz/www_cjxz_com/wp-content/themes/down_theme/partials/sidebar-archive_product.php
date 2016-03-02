        <div class="left_side">
          <div class="widget categories">
            <?php
            if(is_post_type_archive('soft')){
              $all_terms = get_terms('softs',array( 'parent'=>0, 'hide_empty' => 0 ));
            }else{
              $currentterm = get_queried_object();
              $all_terms = get_terms('softs',array( 'parent'=>$currentterm->term_id,'hide_empty' => 0 ));
              if ( is_wp_error( $terms ) || empty($all_terms)  ){
                $all_terms = get_terms('softs',array( 'parent'=>$currentterm->parent,'hide_empty' => 0 ));
              }
            }
            
            ?>
            <?php  if ( !empty( $all_terms ) && !is_wp_error( $all_terms ) ): ?>
            <ul class="clearfix">
              <?php foreach($all_terms as $term): ?>
              <li><a href="<?php echo get_term_link( $term,'softs' ); ?>"><?php echo $term->name; ?></a></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
          <div class="widget rank">
            <div class="widget_title clearfix">
              <h3>最热软件</h3>
            </div>
            <?php
            $args = array(
              'post_type'=>'soft',
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
        </div>