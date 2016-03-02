<?php get_header(); ?>
      <?php wp_bac_breadcrumb(); ?>
      <?php while(have_posts()): the_post(); set_post_views($post->ID); ?>
      <?php
      $softs = get_post_meta($post->ID,'topic_softs',true);
      if( is_array($softs) && !empty($softs) ){
        $soft_count = count($softs);
      }else{
        $soft_count = 0;
      }
      ?>
      <div id="topic_top" class="clearfix">
        <?php
        $topic_ico = get_post_meta($post->ID,'topic_ico',true);
        ?>
        <div class="topic_img"><img src="<?php echo $topic_ico; ?>" /></div>
        <div class="topic_info">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
          <div class="topic_count"><i class="fa fa-list-ul"></i><?php echo $soft_count; ?>个应用</div>
          <div id="bdshare"><p class="sinaGFoot-share bdsharebuttonbox" data-tag="share_1">
          <a data-cmd="qzone" class="a1" href="javascript:void 0" title="分享至QQ空间" rel="nofollow"></a>
          <a data-cmd="tsina" class="a2" href="javascript:void 0"  title="分享到新浪微博" rel="nofollow"></a>
          <a data-cmd="renren" class="a3" href="javascript:void 0" title="分享到校内人人网" rel="nofollow"></a>
          <a data-cmd="tieba" class="a4" href="javascript:void 0" title="分享到贴吧" rel="nofollow"></a>
          <a data-cmd="sqq" class="a5" href="javascript:void 0" title="分享给QQ好友" rel="nofollow"></a>
          <a href="#" onclick="return false;" class="popup_weixin a6" title="分享到微信朋友圈" data-cmd="weixin" rel="nofollow"></a>
          </p>
          <script>
          with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
          </script>
          </div>
        </div>
      </div>
      <div class="topic_content">
        <div class="line_title clearfix">
          <h2>合集列表</h2>
        </div>
        <div class="topic_lists">
          <ul class="clearfix">
            <?php
            $k=0;
            if($softs){ foreach ( $softs as $id=>$desc ) {
              $k++;
              $soft = get_post($id);
              if($desc==''){
                $desc = hunsubstrs( strip_tags($soft->post_content),70,true);
              }
              $ico = get_soft_ico_src($id);
              $size = get_post_meta($id,'rjdx_value',true);
              $xxdj_value = (int)get_post_meta($id,'xxdj_value',true);
              if(!$xxdj_value)
                $xxdj_value = 4;
              
              if($size=='')
                $size = '0M';
              $rank_class = '';
              switch ($k){
                case 1:
                  $rank_class = 'class="rank1"';
                  break;
                case 2:
                  $rank_class = 'class="rank2"';
                  break;
                case 3:
                  $rank_class = 'class="rank3"';
                  break;
                default:
                  $rank_class = '';
                  break;
              }
            ?>
            <li <?php echo $rank_class; ?>>
              <div class="topic_wrap">
                <a href="<?php echo get_permalink($id); ?>" class="img">
                <img src="<?php echo $ico; ?>" alt="<?php echo $soft->post_title; ?>">
                </a>
                <a class="t" href="<?php echo get_permalink($id); ?>"><?php echo $soft->post_title; ?></a>
                <span class="size"><?php echo mysql2date( 'Y-m-d', $soft->post_date ); ?>  /  <?php echo $size; ?></span>
                <div class="post-ratings">
                  <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                  <i class="fa fa-star light"></i>
                  <?php } ?>
                  <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                  <i class="fa fa-star"></i>
                  <?php } ?>
                </div>
                <a class="down" href="<?php echo get_permalink($id); ?>" target="_blank">下载</a>
                <p><span>推荐理由:</span><?php echo $desc; ?></p>
                <?php if(in_array($k,array(1,2,3))){ ?>
                <div class="icon"></div>
                <?php } ?>
              </div>
            </li>
            <?php } } ?>
          </ul>
        </div>
      </div>
      <div class="relate_topic">
        <div class="line_title clearfix">
          <h2>合集推荐</h2>
        </div>
        <div id="topic_carosel">
          <?php
          global $post;
          $terms = wp_get_post_terms( $post->ID, 'topics' );
          if ($terms) {
            $args = array(
              'post_type' => 'topic',
              'tax_query'=>array(
                array(
                  'taxonomy'=>'topics',
                  'field'=>'term_id',
                  'operator'=>'IN',
                  'terms'=>array($terms[0]->term_id)
                )
              ),
              'post__not_in' => array( $post->ID ),
              'showposts' => 10
            );
            query_posts($args);
            if (have_posts()): while (have_posts()): the_post(); update_post_caches($posts);
            $topic_ico = get_post_meta($post->ID,'topic_ico',true);
            if($topic_ico!=''){
          ?>
          <div class="item">
            <div class="item_wrap">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/timthumb.php?src='.$topic_ico.'&h=95&w=232&zc=1'; ?>" />
                <span class="item_title"><?php the_title(); ?></span>
              </a>
            </div>
          </div>
          <?php
            }
            endwhile; endif; wp_reset_query();
          }
          ?>
        </div>
      </div>
      <?php endwhile; ?>
<?php get_footer(); ?>