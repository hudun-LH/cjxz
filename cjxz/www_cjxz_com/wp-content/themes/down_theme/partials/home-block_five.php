      <?php global $ashu_option; ?>
      <div id="block_five">
        <div class="block_title clearfix">
          <div class="corner"><i class="fa fa-map-marker"></i></div>
          <h3>内容导航</h3>
        </div>
        <div class="content">
          <div class="cat">
            <h3>应用导航</h3>
            <div class="cat_li clearfix">
              <?php
              $cats = $ashu_option['home']['daohang_1'];
              $cats_array = array(
                'parent'=>0,
                'number'=>10
              );
              if(!empty($cats)){
                foreach($cats as $id){
                  $tem_term = get_term($id,'softs');
                  if ( ! empty( $tem_term ) && ! is_wp_error( $tem_term ) )
                    $s_terms[] = $tem_term;
                }
              }else{
                $s_terms = get_terms('softs',$cats_array);
              }
              foreach($s_terms as $term):
              ?>
              <a href="<?php echo get_term_link($term,'softs'); ?>"><?php echo $term->name; ?></a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="cat">
            <h3>软件合集</h3>
            <div class="cat_li clearfix">
              <?php
              $cats2 = $ashu_option['home']['daohang_2'];
              $cats2_array = array(
                'parent'=>0,
                'number'=>10
              );
              if(!empty($cats2)){
                foreach($cats2 as $id){
                  $tem2_term = get_term($id,'topics');
                  if ( ! empty( $tem2_term ) && ! is_wp_error( $tem2_term ) )
                    $s2_terms[] = $tem2_term;
                }
              }else{
                $s2_terms = get_terms('topics',$cats2_array);
              }
              foreach($s2_terms as $term): if(!is_wp_error( $term ) ){
                
              ?>
              <a href="<?php echo get_term_link($term,'topics'); ?>"><?php echo $term->name; ?></a>
              <?php } endforeach; ?>
            </div>
          </div>
          <div class="cat">
            <h3>精选专区</h3>
            <div class="cat_li clearfix">
              <?php
              $cats3 = $ashu_option['home']['daohang_3'];
              $args_5 = array(
                'post_type'=>'topic',
                'ignore_sticky_posts' => 1,
                'showposts'=>10,
              );
              if(!empty($cats3))
                $args_5['post__in'] = $cats3;
              
              query_posts($args_5);
              if(have_posts()): while(have_posts()): the_post();
            
              ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              <?php
              endwhile;
              endif;
              wp_reset_query(); ?>
            </div>
          </div>
        </div>
      </div>