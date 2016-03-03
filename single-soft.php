<?php get_header(); ?>
      <?php wp_bac_breadcrumb(); ?>
      <div class="row clearfix">
        <?php
        set_post_views($post->ID);
        while(have_posts()): the_post();
        
        ?>
        <div class="single_soft_title">
          <h1><?php the_title(); ?></h1>
        </div>
        <div class="left_main">
          <div class="row clearfix single_soft_meta">
            <div class="soft_metas">
              <ul class="clearfix">
                <?php
                $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
                if($xxdj_value=='')
                  $xxdj_value = 4;
                $size = get_post_meta($post->ID,'rjdx_value',true);
                if($size=='')
                  $size = '0';
                 $adw = get_post_meta($post->ID,'rjdw_value',true);
                if($adw=='KB'){
                 $dw='KB';
				}elseif($adw=='MB'){
				$dw='MB';
				}else{
				$adw ='';
				}
                $jmyy_value1 = get_post_meta($post->ID,'jmyy_value',true);
                if($jmyy_value1=='cn'){
                  $jmyy_value = '中文';
				}elseif($jmyy_value1=='en'){
					$jmyy_value = '英文';
				}elseif($jmyy_value1=='tw'){
					$jmyy_value = '繁体中文';
				}elseif($jmyy_value1=='other'){
				    $jmyy_value = '多国语言';
				}else{
				$jmyy_value = '中文';
				}
                $sqfs = get_post_meta($post->ID,'sqfs_value',true);

                if($sqfs=='shares'){ 
                  $sqfs_value = '共享版';

				  }elseif($sqfs=='frees'){

				  $sqfs_value = '免费版';
				  
				  }elseif($sqfs=='trys'){
				  $sqfs_value = '试用版';
				  }else{
				  $sqfs_value = '免费版';
				  }

                $soft_site = get_post_meta($post->ID,'soft_site',true);
                $soft_down_count = get_post_meta($post->ID,'views',true);
                
                if($soft_down_count=='')
                  $soft_down_count = 0;

                  $soft_update_time = date('Y-m-d');
                ?>
                <li><span class="key">软件大小：</span><span class="value"><?php echo $size; ?><?php echo $dw; ?></span></li>
                <li><span class="key">软件语言：</span><span class="value"><?php echo $jmyy_value; ?></span></li>
                <li><span class="key">授权方式：</span><span class="value"><?php echo $sqfs_value; ?></span></li>
                <li><span class="key">软件类别：</span><span class="value"><?php the_terms($post->ID,'softs','',',',''); ?></span></li>
                <li><span class="key">更新时间：</span><span class="value"><?php echo $soft_update_time; ?></span></li>
                <li><span class="key">下载次数：</span><span class="value red"><?php echo $soft_down_count.'次'; ?></span></li>
                <?php if($soft_site!=''){ 
				if(strpos($soft_site,'com/')){
				$softsite=substr($soft_site,0,strpos($soft_site,'com/')+4)."...";
				}else{
				$softsite="http://www.cjxz.com/...";
				}?>
                <li class="row"><span class="key">软件官网：</span><span class="value blue"><a target="_blank" rel="nofollow" href="<?php echo $soft_site; ?>"><?php echo $softsite; ?></a></span></li>
                <?php } ?>
              </ul>
              <div class="rate clearfix">
                <div class="post-ratings">
                  <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                  <i class="fa fa-star light"></i>
                  <?php } ?>
                  <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                  <i class="fa fa-star"></i>
                  <?php } ?>
                </div>
                <div class="score">网友评分:<span class="num"><?php echo $xxdj_value; ?></span></div>
              </div>
              <div class="row clearfix">
                <div class="comment_b">
                  <i class="fa fa-commenting-o"></i><a href="#comment_area" rel="nofollow">网友评论</a>
                </div>
                <div class="down_b">
                  <i class="fa fa-download"></i><a href="#down_mark" rel="nofollow">下载地址</a>
                </div>
                <div class="collect_b">
                  <i class="fa fa-heart-o"></i><a href="#" rel="nofollow" id="addcollect">收藏此页</a>
                </div>
              </div>
              <div class="digg clearfix">
                <?php
                $ding_count = get_post_vote($post->ID,'up');
                if(!$ding_count)
                  $ding_count = 1;
                $cai_count = get_post_vote($post->ID,'down');
                if(!$cai_count)
                  $cai_count = 0;
                $ding_percent = round(($ding_count/($ding_count+$cai_count))*100).'%';
                $cai_percent = round(($cai_count/($ding_count+$cai_count))*100).'%';
                //var_dump($cai_count);
                ?>
                <a href="" id="ding" rel="<?php echo 'up_',$post->ID;?>">
                  <div class="digg_ico">
                  <i class="fa fa-thumbs-o-up"></i>
                  </div>
                  <div class="digg_text">非常好我支持</div>
                  <div class="digg_percent">
                    <span class="border">
                      <span class="bg" style="width:<?php echo $ding_percent; ?>"></span>
                    </span>
                    <span class="txt"><?php echo $ding_percent; ?></span>
                  </div>
                </a>
                <a href="" id="cai" rel="<?php echo 'down_',$post->ID;?>">
                  <div class="digg_ico">
                  <i class="fa fa-thumbs-o-down"></i>
                  </div>
                  <div class="digg_text">不好用我反对</div>
                  <div class="digg_percent">
                    <span class="border">
                      <span class="bg" style="width:<?php echo $cai_percent; ?>"></span>
                    </span>
                    <span class="txt"><?php echo $cai_percent; ?></span>
                  </div>
                </a>
              </div>
            </div>
            <div class="relate_down">
              <div class="relate_soft">
                <span class="t">相关软件</span>
                <?php
                global $post;
                $terms = wp_get_post_terms($post->ID,'softs');
                if ($terms) {
                  $args = array(
                    'post_type'=>'soft',
                    'tax_query'=>array(
                      array(
                        'taxonomy'=>'softs',
                        'field'=>'term_id',
                        'operator'=>'IN',
                        'terms'=>array($terms[0]->term_id)
                      )
                    ),
                    'post__not_in' => array( $post->ID ),
                    'showposts' => 5
                  );
                  query_posts($args);
                  if(have_posts()):
                ?>
                <ul>
                  <?php while(have_posts()): the_post(); ?>
                  <li><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),42,true); ?></a><time class="date"><?php the_time('m-d'); ?></time></li>
                  <?php endwhile; ?>
                </ul>
                <?php
                  endif; wp_reset_query(); 
                }
                ?>
              </div>
              <div class="download">
                <a href="<?php echo get_post_meta($post->ID,"xlgs_value",true);?>" target="_blank" rel="nofollow">
                  <div class="ico"><i class="fa fa-download"></i></div>
                  <div class="down_txt">
                    <span class="b">本地下载</span>
                    <span>安全、高速、放心</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="soft_content">
            <?php the_content(); ?>
            <div class="line_title clearfix">
              <h2>下载地址</h2>
            </div>
            <div class="down_src" id="down_mark">
			  <a href="<?php echo get_post_meta($post->ID,"gfgs_value",true);?>" target="_blank" rel="nofollow" class="thunder_down">
                <img src="<?php echo get_template_directory_uri(); ?>/images/gf_down.png" />
              </a>
              <a href="<?php echo get_post_meta($post->ID,"xlgs_value",true);?>" target="_blank" rel="nofollow" class="thunder_down">
                <img src="<?php echo get_template_directory_uri(); ?>/images/thunder_down.png" />
              </a>
              <a href="<?php echo get_post_meta($post->ID,"bdwp_value",true);?>" target="_blank" rel="nofollow" class="baidu_down">
                <img src="<?php echo get_template_directory_uri(); ?>/images/baidu_down.png" />
              </a>
            </div>
          </div>
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
        </div>
        
        <?php endwhile; ?>
        <?php get_template_part('partials/sidebar','single_product'); ?>
      </div>
<?php get_footer(); ?>