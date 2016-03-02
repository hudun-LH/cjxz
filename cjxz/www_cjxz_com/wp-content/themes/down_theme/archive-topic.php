<?php get_header(); ?>
      <div class="row clearfix">
      <div id="topic_main">
        <?php wp_bac_breadcrumb(); ?>
        <?php
        $all_terms = get_terms('topics',array( 'hide_empty' => 0 ));
        if ( !empty( $all_terms ) && !is_wp_error( $all_terms ) ):
        foreach($all_terms as $term):
        ?>
        <div class="topics_wrap">
          <div class="topics_title clearfix">
            <h3><?php echo $term->name; ?></h3>
            <a href="<?php echo get_term_link( $term,'topics' ); ?>" class="more">更多专题>></a>
          </div>
          <div class="topics_list clearfix">
            <?php
            $args = array(
              'post_type'=>'topic',
              'tax_query'=>array(
                array(
                  'taxonomy'=>'topics',
                  'field'=>'term_id',
                  'terms'=>$term->term_id
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
        endif;
        ?>
      </div>
      <div id="topic_side">
        <span class="t">专题合集汇总</span>
        <a href="<?php echo get_post_type_archive_link('topic'); ?>" class="current">汇总首页<i class="fa fa-caret-right"></i></a>
        <?php
        if ( !empty( $all_terms ) && !is_wp_error( $all_terms ) ):
        foreach($all_terms as $term):
        ?>
        <a href="<?php echo get_term_link( $term,'topics' ); ?>"><?php echo $term->name; ?></a>
        <?php
        
        endforeach;
        endif;
        ?>
      </div>
      </div>
<?php get_footer(); ?>