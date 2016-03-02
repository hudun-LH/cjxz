      <?php global $ashu_option; ?>
      <div id="block_two" class="row clearfix">
        <div id="left_col">
          <div class="t"><span>精选推荐</span></div>
          <div class="col_wrap">
          <?php
          for($i=1;$i<=4;$i++){
            $args_2['post__in'] = '';
            $oj = $ashu_option['home']['block_2_'.$i];
            $args_2 = array(
              'post_type'=>'soft',
              'ignore_sticky_posts' => 1,
              'showposts'=>5
            );
            if(!empty($oj))
              $args_2['post__in'] = $oj;
            query_posts($args_2);
          ?>
          <?php if(have_posts()): ?>
          <ul>
            <?php
            while(have_posts()): the_post();
            ?>
            <li>
              <img src="<?php echo get_soft_ico_src($post->ID); ?>" />
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; wp_reset_query(); ?>
          <?php } ?>
          </div>
        </div>
        <div id="center_col">
          <div class="title clearfix">
            <span class="fl">最近更新</span>
            <?php
            $softs_counts = wp_count_posts('soft');
            $todayposts=get_posts('numberposts=-1&year=' .$today["year"] .'&monthnum=' .$today["mon"] .'&day=' .$today["mday"] );
            ?>
            <span class="fr">共收录软件：<em><?php echo $softs_counts->publish; ?></em>今天更新：<em><?php echo count($todayposts); ?></em><a href="<?php echo get_post_type_archive_link('soft'); ?>" target="_blank">更多&gt;&gt;</a></span>
          </div>
          <div class="content">
            <div class="top">
              <?php
              query_posts(array('showposts'=>4));
              if(have_posts()):
              while(have_posts()): the_post();
              ?>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php break; endwhile; ?>
              <div class="newest">
                <?php while(have_posts()): the_post(); ?>
                <span>[<a href="<?php the_permalink(); ?>"><?php echo hunsubstrs(strip_tags($post->post_title),18,true); ?></a>]</span>
                <?php endwhile; ?>
              </div>
              <?php endif; ?>
            </div>
            <div id="new_tab" class="clearfix">
              <?php
              $cats_25 = $ashu_option['home']['block_2_5'];
              $cats_array = array(
                'parent'=>0,
                'number'=>6
              );
              if(!empty($cats_25)){
                foreach($cats_25 as $id){
                  $id = (int)$id;
                  $tem_term = get_term($id,'softs');
                  if(!is_wp_error( $tem_term ) )
                    $top_terms[] = $tem_term;
                }
              }else{
                $top_terms = get_terms('softs',$cats_array);
              }
              
              $k=0;
              ?>
              <div class="controls">
                <?php
                foreach($top_terms as $term): $k++;
                if($k==1)
                  $active = 'class="active"';
                else
                  $active = '';
                ?>
                <a href="<?php echo get_term_link($term,'softs'); ?>" <?php echo $active; ?>><?php echo $term->name; ?></a>
                <?php endforeach; ?>
              </div>
              <div class="tab_show">
                <?php
                $i=0;
                foreach($top_terms as $term): $i++;
                
                ?>
                <?php
                $args_3 = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'showposts'=>12,
                  'tax_query'=>array(
                    array(
                      'taxonomy'=>'softs',
                      'field'=>'term_id',
                      'terms'=>$term->term_id
                    )
                  )
                );
                query_posts($args_3);
                if(have_posts()):
                $j=0;
                if($i==1)
                  $active = 'active';
                else
                  $active = '';
                ?>
                <div class="item_pane <?php echo $active; ?>">
                  <div class="group">
                    <?php while(have_posts()): the_post(); $j++;
                     $soft_down_count = get_post_meta($post->ID,'views',true);
                
                      if($soft_down_count=='')
                        $soft_down_count = 0;
                    ?>
                    <div class="item">
                      <img src="<?php echo get_soft_ico_src($post->ID); ?>" />
                      <a href="<?php the_permalink(); ?>"><?php echo hunsubstrs(strip_tags($post->post_title),32,true); ?></a>
                      <?php
                      $terms = get_the_terms( $post->ID, 'softs' );
                      if ( $terms && ! is_wp_error( $terms ) ) :
                      $current_term = current($terms);
                      ?>
                      <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat"><?php echo $current_term->name; ?></a>
                      <?php endif; ?>
                      <div class="views"><?php echo $soft_down_count.'次下载'; ?></div>
                    </div>
                    <?php if($j==6) break; endwhile; ?>
                  </div>
                  <div class="group">
                    <?php while(have_posts()): the_post();
                    $soft_down_count = get_post_meta($post->ID,'views',true);
                
                      if($soft_down_count=='')
                        $soft_down_count = 0;
                    ?>
                    <div class="item">
                      <img src="<?php echo get_soft_ico_src($post->ID); ?>" />
                      <a href="<?php the_permalink(); ?>"><?php echo hunsubstrs(strip_tags($post->post_title),32,true); ?></a>
                      <?php
                      $terms = get_the_terms( $post->ID, 'softs' );
                      if ( $terms && ! is_wp_error( $terms ) ) :
                      $current_term = current($terms);
                      ?>
                      <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat"><?php echo $current_term->name; ?></a>
                      <?php endif; ?>
                      <div class="views"><?php echo $soft_down_count.'次下载'; ?></div>
                    </div>
                    <?php endwhile; ?>
                  </div>
                </div>
                <?php endif; wp_reset_query(); ?>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
        <div id="right_col">
          <?php get_template_part('partials/home','block_tworight'); ?>
        </div>
      </div>