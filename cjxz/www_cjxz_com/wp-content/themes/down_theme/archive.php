<?php get_header(); ?>
      <?php wp_bac_breadcrumb(); ?>
      <div class="row clearfix">
        <div class="left_main">
          <div id="news_list">
            <?php while(have_posts()): the_post(); ?>
            <article class="new_item">
              <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              <a href="<?php the_permalink(); ?>" class="img" ><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&w=180&h=120&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/></a>
              <div class="new_info clearfix">
                
                <p><?php echo hunsubstrs( strip_tags($post->post_content),120,true); ?><a href="<?php the_permalink(); ?>" class="read_more">阅读全文</a></p>
                <time><?php the_time('Y-m-d'); ?></time>
              </div>
            </article>
            <?php endwhile; ?>
          </div>
          <?php ashuwp_pagenavi(); ?>
        </div>
        <?php get_template_part('partials/sidebar','archive_post');?>
      </div>
<?php get_footer(); ?>