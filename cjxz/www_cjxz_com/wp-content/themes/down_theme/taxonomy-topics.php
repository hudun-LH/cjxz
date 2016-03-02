<?php get_header(); ?>
      <div class="row clearfix">
      <div id="topic_main">
        <?php wp_bac_breadcrumb(); ?>
        <?php
        $currentterm = get_queried_object();
        $args = array(
          'parent'=> $currentterm->term_id,
          'hide_empty' => 0
        );
        $child_terms = get_terms('topics',$args);
        if ( !empty( $child_terms ) && !is_wp_error( $child_terms ) ):
        foreach($child_terms as $child_term):
        ?>
        <div class="topics_wrap">
          <div class="topics_title clearfix">
            <h3><?php echo $child_term->name; ?></h3>
            <a href="<?php echo get_term_link( $child_term,'topics' ); ?>" class="more">更多专题>></a>
          </div>
          <div class="topics_list clearfix">
            <?php
            $args = array(
              'post_type'=>'topic',
              'tax_query'=>array(
                array(
                  'taxonomy'=>'topics',
                  'field'=>'term_id',
                  'terms'=>$child_term->term_id
                )
              ),
              'posts_per_page'=>6
            );
            query_posts($args);
            if(have_posts()):
            while(have_posts()): the_post(); ?>
            <article class="topic_item">
              <div class="topic_wrap">
              <a href="<?php the_permalink(); ?>">
                <?php
                $topic_ico = get_post_meta($post->ID,'topic_ico',true);
                ?>
                <img src="<?php echo get_template_directory_uri().'/timthumb.php?src='.$topic_ico.'&h=95&w=232&zc=1'; ?>" />
                <h1><?php the_title(); ?></h1>
              </a>
              </div>
            </article>
            <?php
            endwhile;
            endif; wp_reset_query();
            ?>
          </div>
        </div>
        <?php
        endforeach;
        else:
        ?>
        <div class="topics_wrap">
          <div class="topics_title clearfix">
            <h3><?php single_cat_title(); ?></h3>
          </div>
          <div class="topics_list clearfix">
            <?php while(have_posts()): the_post(); ?>
            <article class="topic_item">
              <div class="topic_wrap">
              <a href="<?php the_permalink(); ?>">
                <?php
                $topic_ico = get_post_meta($post->ID,'topic_ico',true);
                ?>
                <img src="<?php echo get_template_directory_uri().'/timthumb.php?src='.$topic_ico.'&h=95&w=232&zc=1'; ?>" />
                <h1><?php the_title(); ?></h1>
              </a>
              </div>
            </article>
            <?php endwhile; ?>
          </div>
        </div>
        <?php ashuwp_pagenavi(); ?>
        <?php endif; ?>
      </div>
      <div id="topic_side">
        <span class="t">专题合集汇总</span>
        <a href="<?php echo get_post_type_archive_link('topic'); ?>">汇总首页</a>
        <?php
        $all_terms = get_terms('topics',array( 'hide_empty' => 0 ));
        $current_term = get_queried_object();
        $noborder = '';
        $next_one = false;
        if ( !empty( $all_terms ) && !is_wp_error( $all_terms ) ):
        foreach($all_terms as $term):
        if($current_term->term_id == $term->term_id){
          $current = 'class="current"';
          $next_one = true;
        }else{
          $current = '';
        }
        ?>
        <a href="<?php echo get_term_link( $term,'topics' ); ?>" <?php echo $current; echo $next_one; ?>><?php echo $term->name; if($current_term->term_id == $term->term_id) echo '<i class="fa fa-caret-right"></i>'; ?></a>
        <?php
        if($next_one){
          $noborder = 'class="noborder"';
          $next_one = false;
        }
        
        endforeach;
        endif;
        ?>
      </div>
      </div>
<?php get_footer(); ?>