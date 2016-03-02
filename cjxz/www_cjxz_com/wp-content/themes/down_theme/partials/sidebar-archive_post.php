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
          <div class="widget tab_rank">
            <div class="widget_title clearfix">
              <ul class="nav nav-tabs clearfix">
                <li class="active"><a href="#side_tab_1" data-toggle="tab">下载周排行</a></li>
                <li><a href="#side_tab_2" data-toggle="tab">下载总排行</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div id="side_tab_1" class="tab-pane active" role="tabpanel">
                <ul>
                <?php
                $week = date('W');
                $year = date('Y');
                $args = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'posts_per_page'=>8,
                  'year'=>$year,
                  'w'=>$week,
                  'orderby'=>'meta_value_num',
                  'meta_query' => array(
                    array('key' => 'views')
                  )
                );
                query_posts($args);
                $loog_1 = array();
                ?>
                <?php if(have_posts()): $i=0; $hot_count = count($posts);  ?>
                
                  <?php while(have_posts()): the_post();$i++; $loog_1[]=$post->ID; ?>
                  <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile; ?>
                
                <?php endif; wp_reset_query(); ?>
                <?php
                if($i<8){
                  $per_page = 8-$i;
                  $args2 = array(
                    'post_type'=>'soft',
                    'post__not_in'=>$loog_1,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'=>$per_page,
                  );
                  query_posts($args2);
                
                ?>
                
                <?php if(have_posts()): ?>
                
                  <?php while(have_posts()): the_post();$i++; ?>
                  <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile; ?>
                
                <?php endif; wp_reset_query(); } ?>
                </ul>
              </div>
              <div id="side_tab_2" class="tab-pane" role="tabpanel">
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
          </div>
          <div class="widget img_list">
            <div class="widget_title clearfix">
              <h3>装机必备软件</h3>
            </div>
            <div class="img_list_wrap">
              <?php
              $necessary = get_term_by('slug','necessary','softs');
              $all_necessary = get_terms('softs',array( 'parent'=>$necessary->term_id,'hide_empty' => 0 ));
              if ( !empty( $all_necessary ) && !is_wp_error( $all_necessary ) ):
              foreach($all_necessary as $term):
              ?>
              <div class="li_wrap">
                <div class="li_title">
                  <a href="<?php echo get_term_link($term,'softs'); ?>"><?php echo $term->name; ?></a>
                </div>
                <ul class="clearfix">
                  <?php
                  $args = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'showposts'=>3,
                  'tax_query'=>array(
                    array(
                      'taxonomy'=>'softs',
                      'field'=>'term_id',
                      'terms'=>$term->term_id
                    )
                  ),
                  'orderby'=>'meta_value_num',
                  'meta_query' => array(
                    array('key' => 'views')
                  )
                );
                query_posts($args);
                if(have_posts()): while( have_posts()): the_post();
                ?>
                  <li><a href="<?php the_permalink(); ?>">
                    <img src="<?php echo get_soft_ico_src($post->ID); ?>" />
                    <span><?php the_title(); ?></span>
                  </a></li>
                <?php endwhile; endif; wp_reset_query(); ?>
                </ul>
              </div>
              <?php
              endforeach;
              endif;
              ?>
            </div>
          </div>
        </div>