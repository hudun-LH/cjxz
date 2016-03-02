<?php get_header(); ?>
      <?php wp_bac_breadcrumb(); ?>
      <div class="row clearfix">
        <div class="left_main">
          <?php while(have_posts()): the_post(); set_post_views($post->ID); ?>
          <article class="single_page">
            <h1 class="single_title"><?php the_title(); ?></h1>
            <div class="post_meta">
              <time class="date"><?php the_time('Y-m-d g:i'); ?></time>
              <span class="views"><?php echo custom_the_views($post->ID).'人浏览';?></span>
            </div>
            <div class="entry">
              <?php the_content(); ?>
            </div>
          </article>
          <div class="relate_post">
            <div class="line_title clearfix">
              <h5>相关资讯</h5>
            </div>
            <div class="relate_li clearfix">
              <ul>
                <?php
                global $post;
                $cats = wp_get_post_categories($post->ID);
                if ($cats) {
                  $args = array(
                    'category__in' => array( $cats[0] ),
                    'post__not_in' => array( $post->ID ),
                    'showposts' => 10
                  );
                  query_posts($args);
                  if (have_posts()) {
                    while (have_posts()) { the_post(); update_post_caches($posts); ?>
                      <li>&gt;&gt;<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                  <?php }
                  }else {
                    echo '<li>&gt;&gt; 暂无相关文章</li>';
                  }
                  wp_reset_query();
                }else {
                  echo '<li>&gt;&gt;暂无相关文章</li>';
                }
                ?>
              </ul>
            </div>
          </div>
          <div id="comment_area"><div class="line_title clearfix"><h5>网友评论</h5></div><?php comments_template(); ?></div>
          <?php endwhile; ?>
        </div>
        <?php get_template_part('partials/sidebar','post');?>
      </div>
<?php get_footer();  ?>