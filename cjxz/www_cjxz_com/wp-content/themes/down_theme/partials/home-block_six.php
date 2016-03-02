      <?php global $ashu_option; ?>
      <div id="block_six">
        <div class="block_title clearfix">
          <div class="corner"><i class="fa fa-refresh"></i></div>
          <h3>分类更新</h3>
          <ul id="cats_tab" class="nav nav-tabs clearfix">
            <?php
              $cats = $ashu_option['home']['cat_new1'];
              $cats_array = array(
                'parent'=>0,
                'number'=>7
              );
              if(!empty($cats)){
                foreach($cats as $id){
                  $tem_term = get_term($id,'softs');
                  if(!is_wp_error( $tem_term ) )
                    $s_terms[] = $tem_term;
                }
              }else{
                $s_terms = get_terms('softs',$cats_array);
              }
            ?>
            <li class="active"><a href="#cat_1" data-toggle="tab">全部分类</a></li>
            <?php foreach($s_terms as $term): ?>
            <li><a href="<?php echo '#cat_'.$term->term_id; ?>" data-toggle="tab"><?php echo $term->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div id="cats_container" class="tab-content">
          <div id="cat_1" class="tab-pane active" role="tabpanel">
            <div class="more_link"><a href="<?php echo get_post_type_archive_link('soft'); ?>">更多 >></a></div>
            <div class="cont clearfix">
              <?php
                $args = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'showposts'=>20,
                );
                query_posts($args);
              $j=0;
              if(have_posts()):
              ?>
              <ul>
                <?php
                while(have_posts()): the_post(); $j++;
                ?>
                <li><time class="time"><?php the_time('d'); ?>日</time><span>
                <?php
                $terms = get_the_terms( $post->ID, 'softs' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                $current_term = current($terms);
                ?>
                <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat">[<?php echo $current_term->name; ?>]</a>
                <?php endif; ?>
                </span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),24,true); ?></a></li>
                <?php
                if($j==10) break;
                endwhile;
                ?>
              </ul>
              <ul>
                <?php
                while(have_posts()): the_post(); $j++;
                ?>
                <li><time class="time"><?php the_time('d'); ?>日</time><span>
                <?php
                $terms = get_the_terms( $post->ID, 'softs' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                $current_term = current($terms);
                ?>
                <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat">[<?php echo $current_term->name; ?>]</a>
                <?php endif; ?>
                </span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),24,true); ?></a></li>
                <?php
                if($j==10) break;
                endwhile;
                ?>
              </ul>
              <?php endif; wp_reset_query(); ?>
              <div class="rank">
                <div class="cat_title clearfix">
                  <h3>最热软件</h3>
                </div>
                <ul>
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
                  
                    <?php while(have_posts()): the_post();$i++; ?>
                    <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),36,true); ?></a></li>
                    <?php endwhile; ?>
                  
                  <?php endif; wp_reset_query(); ?>
                </ul>
              </div>
            </div>
          </div>
          <?php foreach($s_terms as $term): ?>
          <div id="<?php echo 'cat_'.$term->term_id; ?>" class="tab-pane" role="tabpanel">
            <div class="more_link"><a href="<?php echo get_term_link($term,'softs'); ?>">更多 >></a></div>
            <div class="cont clearfix">
              <?php
                $args = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'showposts'=>20,
                  'tax_query'=>array(
                    array(
                      'taxonomy'=>'softs',
                      'field'=>'term_id',
                      'terms'=>$term->term_id
                    )
                  ),
                );
                query_posts($args);
              $j=0;
              if(have_posts()):
              ?>
              <ul>
                <?php
                while(have_posts()): the_post(); $j++;
                ?>
                <li><time class="time"><?php the_time('d'); ?>日</time><span>
                <?php
                $terms = get_the_terms( $post->ID, 'softs' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                $current_term = current($terms);
                ?>
                <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat">[<?php echo $current_term->name; ?>]</a>
                <?php endif; ?>
                </span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),24,true); ?></a></li>
                <?php
                if($j==10) break;
                endwhile;
                ?>
              </ul>
              <ul>
                <?php
                while(have_posts()): the_post(); $j++;
                ?>
                <li><time class="time"><?php the_time('d'); ?>日</time><span>
                <?php
                $terms = get_the_terms( $post->ID, 'softs' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                $current_term = current($terms);
                ?>
                <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat">[<?php echo $current_term->name; ?>]</a>
                <?php endif; ?>
                </span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),24,true); ?></a></li>
                <?php
                if($j==10) break;
                endwhile;
                ?>
              </ul>
              <?php endif; wp_reset_query(); ?>
              <div class="rank">
                <div class="cat_title clearfix">
                  <h3>最热软件</h3>
                </div>
                <ul>
                  <?php
                  $args = array(
                    'post_type'=>'soft',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'=>8,
                    'orderby'=>'meta_value_num',
                    'tax_query'=>array(
                      array(
                        'taxonomy'=>'softs',
                        'field'=>'term_id',
                        'operator'=>'IN',
                        'terms'=>array($term->term_id)
                      )
                    ),
                    'meta_query' => array(
                      array('key' => 'views')
                    )
                  );
                  query_posts($args);
                  ?>
                  <?php if(have_posts()): $i=0; ?>
                  
                    <?php while(have_posts()): the_post();$i++; ?>
                    <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),36,true); ?></a></li>
                    <?php endwhile; ?>
                  
                  <?php endif; wp_reset_query(); ?>
                </ul>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>