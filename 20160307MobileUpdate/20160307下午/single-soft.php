<?php get_header(); ?>
    <div id="single">
      <?php
      while(have_posts()): the_post(); set_post_views($post->ID);
      ?>
      <div id="bread">
        <?php
        $top_term = get_term(phone_soft_term,'softs');
        ?>
        <a href="<?php echo get_term_link($top_term,'softs'); ?>">下载中心</a>
        <span class="sep">>></span>
        <span class="text"><?php the_title(); ?></span>
      </div>
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
	    $dw ='';
	}
      
      $ico = get_soft_ico_src($post->ID);
      
      $soft_down_count = get_post_meta($post->ID,'views',true);
                
                if($soft_down_count=='')
                  $soft_down_count = 0;
      ?>
      <div id="soft_info" class="clearfix">
        <div id="soft_ico">
          <img src="<?php echo $ico; ?>" />
        </div>
        <!--<h1><?php the_title(); ?></h1>-->
		<div class="single_soft_title">
        <h1><span><?php $tvalue=get_post_meta($post->ID,"xlgs_value",true); 
		  if(strpos($tvalue,'apk')){
				echo "<img src='".get_template_directory_uri()."/images/01.png'/>手机版";
				}elseif(strpos($tvalue,'exe')){
				echo "<img src='".get_template_directory_uri()."/images/02.png'/>电脑版";
				}else{
                echo "<img src='".get_template_directory_uri()."/images/01.png'/>手机版";
				}
		  
		  ?></span>   <?php the_title(); ?></h1>
        </div>
        <div class="soft_meta">
          <div class="two_meta clearfix">
            <?php
            $terms = get_the_terms( $post->ID, 'softs' );
            if ( $terms && ! is_wp_error( $terms ) ) :
            $parent_f = current($terms);
            ?>
            <span class="cat"><?php echo $parent_f->name; ?></span>
            <?php
            endif;
            ?>
            <div class="post-ratings">
              <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
              <i class="fa fa-star light"></i>
              <?php } ?>
              <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
              <i class="fa fa-star"></i>
              <?php } ?>
            </div>
          </div>
          <span class="meta">大小：<?php echo $size.$dw; ?></span>
          <span class="meta">下载：<?php echo $soft_down_count.'次';?></span>
        </div>
        <div class="down">
          <a target="_blank" href="<?php echo get_post_meta($post->ID,"xlgs_value",true);?>">下载APK安装包</a>
        </div>
      </div>
      <div class="soft_content">
      <?php
      //the_content();
      
      $a = strrpos($post->post_content,'软件界面');
      $b = substr($post->post_content,0,$a);
      $c = substr($post->post_content,$a);
      echo $b.'软件界面</h2></div>';
      $weizhi = strstr($c,'软件界面');
      $img_strs = preg_match_all('/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/', $weizhi, $matches);
      if(isset($matches[1])&&!empty($matches[1])){
      //if(0){
      ?>
      <div id="image_wape" class="owl-carousel">
        <?php foreach( $matches[1] as $src ){ ?>
        <div class="item"><img src="<?php echo $src; ?>" /></div>
        <?php } ?>
      </div>
      <?php
      }
      ?>
      </div>
      <?php
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
          'showposts' => 4
        );
        query_posts($args);
        if(have_posts()):
                
      ?>
      <div id="relate">
        <h5>猜猜你还喜欢</h5>
        <div class="relate_softs clearfix">
          <?php
          while(have_posts()): the_post();
          $ico = get_soft_ico_src($post->ID);
          $xxdj_value = get_post_meta($post->ID,'xxdj_value',true);
          if($xxdj_value=='')
            $xxdj_value = 4;
          ?>
          <div class="relate_item">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo $ico; ?>" />
              <h3><?php the_title(); ?></h3>
              <div class="post-ratings">
                <?php for($i=1;$i<=$xxdj_value;$i++){ ?>
                <i class="fa fa-star light"></i>
                <?php } ?>
                <?php for($j=1;$j<=(5 - $xxdj_value);$j++){ ?>
                <i class="fa fa-star"></i>
                <?php } ?>
              </div>
            </a>
          </div>
          <?php
          endwhile;
          ?>
        </div>
      </div>
      <?php
      endif;
      wp_reset_query();
      } ?>
      <div id="relate_post">
        <h5>热门资讯</h5>
        <div class="relate_li clearfix">
          <ul>
            <?php
            
              $args_news = array(
                'post_type'=>'post',
                'showposts'=>5,
                'orderby'=>'meta_value_num',
                'meta_query' => array(
                  array('key' => 'views')
                )
              );
              query_posts($args_news);
              if (have_posts()) {
                while (have_posts()) { the_post(); update_post_caches($posts); ?>
                  <li><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_title),28,true); ?><?php //the_title(); ?></a>
                  <span class="date"><?php the_time('Y-m-d'); ?></span>
                  </li>
              <?php }
              }else {
                echo '<li>&gt;&gt; 暂无相关资讯</li>';
              }
              wp_reset_query();
            
            ?>
          </ul>
        </div>
      </div>
      <div id="comment_area">
        <h5>点评</h5>
        <?php comments_template(); ?>
      </div>
      <?php endwhile; ?>
    </div>
<?php get_footer(); ?>