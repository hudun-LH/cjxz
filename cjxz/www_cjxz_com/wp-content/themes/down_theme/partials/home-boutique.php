      <?php global $ashu_option; ?>
      <div id="boutique">
        <div class="corner">精品</div>
        <div class="boutique_first clearfix">
          <dl>
            <?php
            /**获取软件**/
            $args = array(
              'post_type'=>'soft',
              'ignore_sticky_posts' => 1,
              'showposts'=>9,
              'orderby'=>'meta_value_num',
              'meta_query' => array(
                array('key' => 'views')
              )
            );
            $boutique_soft = $ashu_option['home']['boutique_soft'];
            if(!empty($boutique_soft))
              $args['post__in'] =$boutique_soft;
            query_posts($args);
            if(have_posts()): while(have_posts()): the_post();
            ?>
            <dd>
              <a href="<?php the_permalink(); ?>"><img src="<?php echo get_soft_ico_src($post->ID); ?>" /><h5><?php the_title(); ?></h5></a>
            </dd>
            <?php
            endwhile;
            endif;
            wp_reset_query();
            ?>
          </dl>
        </div>
        <?php
        $args_1 = array(
          'hide_empty' => 0,
          'orderby'=>'term_group',
          'number'=>4,
        );
        $boutique_topic = $ashu_option['home']['boutique_topic'];
        if(!empty($boutique_topic)){
          foreach($boutique_topic as $id){
            $id = (int)$id;
            $tem_term = get_term($id,'topics');
            if(!is_wp_error( $tem_term ) )
              $all_terms[] = $tem_term;
          }
        }else{
          $all_terms = get_terms('topics',$args_1);
        }
        
        if( !empty( $all_terms ) && !is_wp_error( $all_terms ) ):
        $gray = '';
        foreach($all_terms as $term):
        if($gray == '')
          $gray = 'gray';
        else
          $gray = '';
        ?>
        <div class="boutique_list clearfix <?php echo $gray; ?>">
          <span class="boutique_title">
            <a href="<?php echo get_term_link( $term,'topics' ); ?>"><?php echo $term->name; ?></a>
          </span>
          <div class="gather">
            <?php
            /**获取专题分类**/
            $args = array(
              'post_type'=>'topic',
              'tax_query'=>array(
                array(
                  'taxonomy'=>'topics',
                  'field'=>'term_id',
                  'terms'=>$term->term_id
                )
              ),
              'posts_per_page'=>11
            );
            query_posts($args);
            if(have_posts()):
            while(have_posts()): the_post(); ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php
            endwhile;
            endif;
            wp_reset_query();
            ?>
          </div>
        </div>
        <?php
        endforeach;
        endif;
        ?>
      </div>