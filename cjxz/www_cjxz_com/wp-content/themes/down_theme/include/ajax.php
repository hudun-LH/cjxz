<?php
add_action("wp_ajax_wp_soft_ajax", "wp_ajax_wp_soft_ajax_function");   
add_action("wp_ajax_nopriv_wp_soft_ajax", "wp_ajax_wp_soft_ajax_function");

function wp_ajax_wp_soft_ajax_function() {
	//check_ajax_referer( 'internal-soft_add', '_ajax_soft_add_nonce' );
  $args = array(
			'post_type' => 'soft',
			'post_status' => 'publish',
			'posts_per_page' => 20,
	);

	if ( isset( $_GET['search'] ) )
		$args['s'] = $_GET['search'];
  
	//$args['paged'] = ! empty( $_POST['pagenum'] ) ? absint( $_POST['pagenum'] ) : 1;
	$args['paged'] = isset( $_GET['pagenum'] ) ? intval( $_GET['pagenum'] ) : 1;
  
  //$args['offset'] = $args['pagenum'] > 1 ? $query['posts_per_page'] * ( $args['pagenum'] - 1 ) : 0;
  // Do main query.
  $get_posts = new WP_Query;
	$posts = $get_posts->query( $args );
	// Check if any posts were found.
	if ( ! $get_posts->post_count )
    wp_die('01');
  
  echo '<div id="return_soft_search"><ul>';
  
  $class = 'class="alternate"';
  foreach ( $posts as $post ) {
    $results = array();
    if($class!='')
      $class = '';
    else
      $class = 'class="alternate"';
              
    $ico = get_soft_ico_src($post->ID);
    $size = get_post_meta($post->ID,'rjdx_value',true);
    if($size=='')
      $size = '0M';
              
    $results['id'] = $post->ID;
    $results['title'] = $post->post_title;
    $results['ico'] = $ico;
    $results['size'] = $size;
    $results['date'] = mysql2date( 'Y-m-d', $post->post_date );
    ?>
    <li <?php echo $class; ?>>
      <input type="hidden" class="item-permalink" value='<?php echo json_encode( $results ); ?>'>
      <span class="item-title"><?php echo $post->post_title; ?></span>
    </li>
    <?php
  }
  ?>
  </ul>
  <div id="page_nav_wrap"><div class="page_nav">
  <?php
  $search_key = '';
  if(isset($args['s']) && $args['s']!='')
    $search_key = $args['s'];
  
  $pagination = paginate_links( array(
    'base' => add_query_arg( array('pagenum' => '%#%' , 'action'=>'wp_soft_ajax' ,'search'=>$search_key), admin_url( 'admin-ajax.php' )),
    'format' => '',
    'prev_text' => '上一页',
    'next_text' => '下一页',
    'total' => $get_posts->max_num_pages,
    'current' => $args['paged']
    )
  );
  if ( $pagination ) {
    echo $pagination;
  }
  ?>
  </div>
  </div>
  </div>
  <?php

	wp_die();
}



add_action("wp_ajax_vote_soft", "ashuwp_vote_soft");   
add_action("wp_ajax_nopriv_vote_soft", "ashuwp_vote_soft");   
function ashuwp_vote_soft() {
  
  if( isset($_POST['action']) && ($_POST['action'] == 'vote_soft') ){   
    $postid = (int)$_POST['postid'];   
    if( !$postid ){  
        echo 'e'; //输出error   
        die(0);   
    }   
    //cookie中是否已经存在投票数据   
    $voted = ashuwp_check_vote_cookie($postid);   
    if( $voted ){
        echo 'h'; //输出have   
        die(0);   
    }
    $ip = $_SERVER['REMOTE_ADDR'];//ip
    $rating = $_POST['rating']; //投票内容
    //判断用户是否登录   
    if(  is_user_logged_in() ){ 
        global $wpdb, $current_user;   
        get_currentuserinfo();   
        $uid = $current_user->ID;   
    }else{   
        $uid='';   
    }   
    if($rating=='up'){
        $rating='up';   
    }else{
        $rating='down';   
    }
    //添加数据   
    $voted = add_vote($postid,$uid,$ip,$rating);   
    if($voted=='y'){
      ashuwp_set_vote_vookie($postid);
      echo 'y';//输出yes
      die();   
    }   
    if($voted=='h'){
      ashuwp_set_vote_vookie($postid);
      echo 'h';
      die();
    }   
    if($voted=='e'){
      echo 'n';//输出no
      die();
    }   
  }else{
    echo 'e';//输出eroor
  }
  die();   
}

function ashuwp_check_vote_cookie($post_id){
    $COOKNAME = 'cjxz_voted';   
    if(isset($_COOKIE[$COOKNAME]))   
        $cookie = $_COOKIE[$COOKNAME];   
    else  
        return false;   
    $id = (int)$post_id;   
    if(empty($id)){
        return false;   
    }   
    if(!empty($cookie)){
        $list = explode('x', $cookie);   
        if(!empty($list) && in_array($id, $list)){   
            return true;   
        }
    }
    return false;   
}
function ashuwp_set_vote_vookie($post_id){
  $COOKNAME = 'cjxz_voted'; //cookie名称   
  $TIME = 3600 * 24;   
  $PATH = '/';   
      
  $id = $post_id;   
  $expire = time() + $TIME; //cookie有效期   
  if(isset($_COOKIE[$COOKNAME]))   
      $cookie = $_COOKIE[$COOKNAME]; //获取cookie   
  else  
      $cookie = '';   
         
  if(empty($cookie)){   
      //如果没有cookie   
      setcookie($COOKNAME, $id, $expire, $PATH);   
  }else{   
      //用a分割成数组   
      $list = explode('x', $cookie);   
      //如果已经存在本文的id   
      if(!in_array($id, $list)){   
          setcookie($COOKNAME, $cookie.'x'.$id, $expire, $PATH);   
      }   
  }
}


add_action("wp_ajax_ajax_nav", "home_soft_ajax_nav");   
add_action("wp_ajax_nopriv_ajax_nav", "home_soft_ajax_nav");

function home_soft_ajax_nav() {
	//check_ajax_referer( 'internal-soft_add', '_ajax_soft_add_nonce' );
  $pagenum = trim( strip_tags($_POST['pagenum']) );
  $term_id = trim( strip_tags($_POST['term_id']) );
    
  $args = array(
    'post_type'=>'soft',
    'ignore_sticky_posts' => 1,
    'posts_per_page'=>14,
    'paged'=>$pagenum,
    'tax_query'=>array(
      array(
        'taxonomy'=>'softs',
        'field'=>'term_id',
        'terms'=>array($term_id)
      )
    ),
    'orderby'=>'meta_value_num',
                  'meta_query' => array(
                    array('key' => 'views')
                  )
  );
  $soft_query = new WP_Query( $args );
  if($soft_query->have_posts()):
  ?>
  <div class="soft_list clearfix">
  <?php
  while($soft_query->have_posts()): $soft_query->the_post(); global $post;
    $size = get_post_meta($post->ID,'rjdx_value',true);
    if($size=='')
      $size = '0M';
    $soft_down_count = get_post_meta($post->ID,'views',true);
    if($soft_down_count=='')
      $soft_down_count = 0;
  ?>
  <div class="grid_item"><div class="border_wrap"></div>
  <div class="img">
    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_soft_ico_src($post->ID); ?>" width="95" height="95"/></a>
  </div>
  <div class="info">
    <h3><a href="<?php the_permalink(); ?>"><?php echo hunsubstrs( strip_tags($post->post_content),90,true); ?></a></h3>
    <div class="down_btn"><a href="<?php the_permalink(); ?>">立即下载</a></div>
    <div class="down_info">
      <span><?php echo $soft_down_count; ?>下载</span>
      <span><?php echo $size; ?></span>
    </div>
  </div>
  </div>
  <?php endwhile; ?>
  </div>
  <div class="ajax_nav" term_id='<?php echo $term_id; ?>'>
  <?php
  $pagination = array(   
    'base' => '%#%',   
    'format' => '',   
    'total' => $soft_query->max_num_pages,   
    'current' => $pagenum,   
    'show_all' => false,   
    'type' => 'plain',   
    'end_size'=>'1',   
    'mid_size'=>'3',   
    'prev_text' => '上一页',
    'next_text' => '下一页'
  );   
  $total_pages = $soft_query->max_num_pages;

	echo '<div class="page_nav">';
    if ( $current !=1 ) {
      echo '<a class="page-numbers" href="/page/1">首页</a>';
    }
    echo paginate_links($pagination);
    if ( $current < $total_pages ) {
      echo '<a class="page-numbers" href="/page/'. $total_pages.'">尾页</a>';
    } 
	echo '</div>';
    ?>
  </div>
  <?php
  endif; wp_reset_query();
  
	wp_die();
}
?>