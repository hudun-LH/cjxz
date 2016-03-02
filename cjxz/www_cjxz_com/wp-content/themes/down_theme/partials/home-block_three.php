      <?php global $ashu_option; ?>
      <div id="block_three">
        <?php
        $cats = $ashu_option['home']['block_3'];
        if(!empty($cats)){
                foreach($cats as $id){
                  $tem_term = get_term($id,'softs');
                  if(!is_wp_error( $tem_term ) )
                    $six_terms[] = $tem_term;
                }
              }else{
                $six_terms = get_terms('softs',array( 'parent'=>0,'number'=>6 ));
              }
        
        ?>
        <ul id="recommend_tab" class="nav nav-tabs clearfix">
          <?php
          $i=0;
          foreach($six_terms as $term): $i++;
            if($i==1)
              $active = 'class="active"';
            else
              $active = '';
          ?>
          <li <?php echo $active; ?>><a href="<?php echo '#tab'.$term->term_id; ?>" data-toggle="tab"><?php echo $term->name; ?></a></li>
          <?php if($i==6) break; endforeach; ?>
        </ul>
        <div id="tab_container" class="tab-content">
          <?php
          $j=0;
          foreach($six_terms as $term): $j++;
          if($j==1)
              $active = 'active';
            else
              $active = '';
          ?>
          <div id="<?php echo 'tab'.$term->term_id; ?>" class="tab-pane <?php echo $active; ?>" role="tabpanel">
            <div class="soft_list clearfix">
              <?php
              $args = array(
                'post_type'=>'soft',
                'ignore_sticky_posts' => 1,
                'showposts'=>14,
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
              if(have_posts()): while(have_posts()): the_post();
              $size = get_post_meta($post->ID,'rjdx_value',true);
                if($size=='')
                  $size = '0M';
              $soft_down_count = get_post_meta($post->ID,'views',true);
                if($soft_down_count=='')
                  $soft_down_count = 0;
              ?>
              <div class="grid_item"><div class="border_wrap"></div>
                <div class="img">
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo get_soft_ico_src($post->ID); ?>" /></a>
                </div>
                <div class="info">
                  <h3><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),90,true); ?></a></h3>
                  <div class="down_btn">
                    <a href="<?php the_permalink(); ?>">立即下载</a>
                  </div>
                  <div class="down_info">
                    <span><?php echo $soft_down_count; ?>下载</span>
                    <span><?php echo $size; ?></span>
                  </div>
                </div>
              </div>
              <?php endwhile; endif; ?>
            </div>
            <div class="ajax_nav" term_id='<?php echo $term->term_id; ?>'>
              <?php ashuwp_pagenavi_num(); ?>
            </div>
            <?php wp_reset_query(); ?>
          </div>
          <?php endforeach; ?>
         </div>
      </div>