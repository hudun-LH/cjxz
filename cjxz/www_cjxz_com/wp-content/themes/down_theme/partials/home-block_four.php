      <?php global $ashu_option; ?>
      <div id="block_four" class="row clearfix">
        <div id="four_left">
          <div class="t_title clearfix">
            <h3>常用软件</h3>
          </div>
          <div class="content">
            <?php
            $cats = $ashu_option['home']['block_4'];
              $cats_array = array(
                'parent'=>0,
                'number'=>15
              );
              if(!empty($cats)){
                foreach($cats as $id){
                  $id = (int)$id;
                  $tem_term = get_term($id,'softs');
                  if(!is_wp_error( $tem_term ) )
                    $s_terms[] = $tem_term;
                }
              }else{
                $s_terms = get_terms('softs',$cats_array);
              }
            
            foreach($s_terms as $term):
            ?>
            <dl>
              <dt><a href="<?php echo get_term_link($term,'softs'); ?>" id="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></dt>
              <?php
              $args = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>4,
                'tax_query'=>array(
                  array(
                    'taxonomy'=>'softs',
                    'field'=>'term_id',
                    'terms'=>$term->term_id
                  )
                ),
              );
              query_posts($args);
              if(have_posts()): while(have_posts()): the_post(); 
              ?>
              <dd><img src="<?php echo get_soft_ico_src($post->ID); ?>" /><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
              <?php endwhile; endif; wp_reset_query(); ?>
            </dl>
            <?php
            endforeach;
            ?>
          </div>
        </div>
        <div id="four_right">
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
                $args1 = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'posts_per_page'=>10,
                  'year'=>$year,
                  'w'=>$week,
                  'orderby'=>'meta_value_num',
                  'meta_query' => array(
                    array('key' => 'views')
                  )
                );
                query_posts($args1);
                $loog_1 = array();
                ?>
                <?php if(have_posts()): $i=0; $hot_count = count($posts);  ?>
                
                  <?php while(have_posts()): the_post();$i++; $loog_1[]=$post->ID; ?>
                  <li><span class="num num-<?php echo $i; ?>"><?php echo $i; ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile; ?>
                
                <?php endif; wp_reset_query(); ?>
                <?php
                if($i<10){
                  $per_page = 10-$i;
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
                $args2 = array(
                  'post_type'=>'soft',
                  'ignore_sticky_posts' => 1,
                  'posts_per_page'=>10,
                  'orderby'=>'meta_value_num',
                  'meta_query' => array(
                    array('key' => 'views')
                  )
                );
                query_posts($args2);
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
        </div>
      </div>