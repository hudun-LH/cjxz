<?php get_header(); ?>
      <?php wp_bac_breadcrumb(); ?>
      <?php get_template_part('partials/sidebar','part-softtop'); ?>
      <div class="row clearfix">
        <div class="right_main">
          <?php //get_template_part('partials/part','softcommend'); ?>
          <div id="soft_list">
            <div class="cat_title">
              <?php
              $softs_counts = wp_count_posts('soft');
              ?>
              <h2>所有软件<span>共有<?php echo $softs_counts->publish; ?>款软件</span></h2>
            </div>
            <div class="softs">
              <?php
              while(have_posts()): the_post();

                $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
                if($xxdj_value=='')
                  $xxdj_value = 4;
                $size = get_post_meta($post->ID,'rjdx_value',true);
                if($size=='')
                  $size = '0M';
                $jmyy_value = get_post_meta($post->ID,'jmyy_value',true);
                if($jmyy_value=='')
                  $jmyy_value = '汉语';
                $sqfs_value = get_post_meta($post->ID,'sqfs_value',true);
                if($sqfs_value=='')
                  $sqfs_value = '免费软件';
                $soft_site = get_post_meta($post->ID,'soft_site',true);
                $soft_down_count = get_post_meta($post->ID,'views',true);
                if($soft_down_count=='')
                  $soft_down_count = 0;
                
                $ico = get_soft_ico_src($post->ID);
                ?>
              <div class="soft_item">
                <div class="baseinfo clearfix">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <div class="rate clearfix">
                    <span class="t">星级</span>
                    <div class="post-ratings">
                      <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                      <i class="fa fa-star light"></i>
                      <?php } ?>
                      <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                      <i class="fa fa-star"></i>
                      <?php } ?>
                    </div>
                    <span class="t"><?php echo '评分'.$xxdj_value; ?></span>
                  </div>
                  <?php
                  $terms = get_the_terms( $post->ID, 'softs' );
                  if ( $terms && ! is_wp_error( $terms ) ) :
                  $current_term = current($terms);
                  ?>
                  <a href="<?php echo get_term_link($current_term,'softs'); ?>" class="cat">[<?php echo $current_term->name; ?>]</a>
                  <?php endif; ?>
                </div>
                <div class="soft_info clearfix">
                  <a href="<?php the_permalink(); ?>" class="img">
                    <img src="<?php echo $ico; ?>" />
                  </a>
                  <div class="desc">
                    <p><?php echo hunsubstrs( strip_tags($post->post_content),90,true); ?></p>
                    <p><span>更新时间：<?php the_time('Y-m-d'); ?></span><span>大小：<?php echo $size; ?></span><span class="lic"><?php echo $sqfs_value; ?></span></p>
                  </div><a href="<?php the_permalink(); ?>" class="downbtn">立即下载</a>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
            <?php ashuwp_pagenavi(); ?>
          </div>
        </div>
        <?php get_template_part('partials/sidebar','archive_product'); ?>
      </div>
<?php get_footer(); ?>