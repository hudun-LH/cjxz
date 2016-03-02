<?php
//去除谷歌字体
function ashuwp_remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}   
add_action('init','ashuwp_remove_open_sans');

/**加载ahuwp框架和其他文件**/
require get_template_directory() . '/include/ashuwp_framework_core.php';
require get_template_directory() . '/include/ashuwp_post_feild.php';
require get_template_directory() . '/include/simple-term-meta.php';
require get_template_directory() . '/include/ashuwp_taxonomy_feild.php';
require get_template_directory() . '/include/ashuwp_options_feild.php';
require get_template_directory() . '/include/import_export.php';
require get_template_directory() . '/include/post_type.php';
require get_template_directory() . '/include/function.php';
require get_template_directory() . '/include/config.php';
require get_template_directory() . '/include/config_phone.php';
require get_template_directory() . '/include/breadcrumbs.php';
require get_template_directory() . '/include/ashuwp_button.php';
require get_template_directory() . '/include/topic_metabox.php';
require get_template_directory() . '/include/ajax.php';
require get_template_directory() . '/include/seo/seo.php';
/**继承3个插件**/
require get_template_directory() . '/plugin/custom-post-type-permalinks/custom-post-type-permalinks.php';
require get_template_directory() . '/plugin/post-type-archive-in-menu/post-type-archive-in-menu.php';
require get_template_directory() . '/plugin/worderbypress/worderbypress.php';

//注册菜单等
function ashuwp_setup() {
  add_editor_style( array( 'css/editor-style.css') );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support('custom-background');
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
  register_nav_menus(
    array(
	  'primary' => '主菜单',
	  'phone' => '手机站主菜单',
	  'footer' => '底部菜单',
    'links'=> '友情链接'
	)
  );
  add_theme_support( 'post-thumbnails',array('post','work','page','soft','topic') );
  set_post_thumbnail_size( 150, 150, true );
  add_image_size('ashu_work',85,85,true);
  // This theme uses its own gallery styles.
  add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'ashuwp_setup' );

//后台按照修改时间排序
function ludou_set_post_order_in_admin( $wp_query ) {
  if ( is_admin() ) {
    $wp_query->set( 'orderby', 'modified' );

    // 此处是将最新修改的文章排在前面
    // 如果要将最新修改的文章排在后面，可将DESC改成ASC
    $wp_query->set( 'order', 'DESC' );
  }
}
add_filter('pre_get_posts', 'ludou_set_post_order_in_admin' );


//后台编辑器按文章类型加载css
function my_theme_add_editor_styles() {
    global $post;

    $my_post_type = 'soft';

    // New post (init hook).
    if ( stristr( $_SERVER['REQUEST_URI'], 'post-new.php' ) !== false
            && ( isset( $_GET['post_type'] ) === true && $my_post_type == $_GET['post_type'] ) ) {
        add_editor_style( get_stylesheet_directory_uri()
            . '/css/editor-style-' . $my_post_type . '.css' );
    }

    // Edit post (pre_get_posts hook).
    if ( stristr( $_SERVER['REQUEST_URI'], 'post.php' ) !== false
            && is_object( $post )
            && $my_post_type == get_post_type( $post->ID ) ) {
        add_editor_style( get_stylesheet_directory_uri()
            . '/css/editor-style-' . $my_post_type . '.css' );
    }
}
add_action( 'init', 'my_theme_add_editor_styles' );
add_action( 'pre_get_posts', 'my_theme_add_editor_styles' );

//remove head info
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);

remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'wptexturize');
function beginner_remove_version() {return '';}
add_filter('the_generator', 'beginner_remove_version');

function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) ) unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//tinymce add bottom
function add_more_buttons($buttons) {
$buttons[] = 'hr';
$buttons[] = 'del';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
$buttons[] = 'wp_page';
$buttons[] = 'anchor';
$buttons[] = 'backcolor';
return $buttons; 
}
add_filter("mce_buttons_3", "add_more_buttons");
function customize_text_sizes($initArray){
   $initArray['theme_advanced_font_sizes'] = "12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px,26px,27px,28px,29px,30px,32px,48px";
   return $initArray;
}
add_filter('tiny_mce_before_init', 'customize_text_sizes');

//加载css和js
function ashuwp_scripts_styles() {
	
	wp_enqueue_style( 'ashuwp-style', get_stylesheet_uri(), array(), '2015-12-12' );
  wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '2015-12-12' );
  wp_enqueue_style( 'fancybox_css', get_template_directory_uri().'/fancybox/fancybox.css', array(), '2015-12-12' );
  
	wp_enqueue_script( 'ashuwp-jquery', get_template_directory_uri() . '/js/jquery-1.11.1.min.js','', '2015-12-12');
	wp_enqueue_script( 'bootstrap-tab', get_template_directory_uri() . '/js/bootstrap-tab.js','', '2015-12-12');
	wp_enqueue_script( 'matchheight', get_template_directory_uri() . '/js/jquery.matchHeight-min.js','', '2015-12-12');
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js','', '2015-12-12');
	wp_enqueue_script( 'fancybox_js', get_template_directory_uri() . '/fancybox/fancybox.js','', '2015-12-12');
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js','', '2015-12-12');
  
  wp_localize_script( 'custom', 'ashuwp', array('ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
  
}
add_action( 'wp_enqueue_scripts', 'ashuwp_scripts_styles' );


/**backend****/
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

//替换gravatar服务器
function duoshuo_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'duoshuo_avatar', 10, 3 );

add_action( 'save_post', 'save_topic_meta' ,20,1);
function save_topic_meta($post_id){

  global $post;
  $old_softs = get_post_meta($post_id,'topic_softs',true);
  $topic_softs = '';

  if( isset($_POST['topic_softs']) ){
    $topic_softs =  $_POST['topic_softs'];
    
    if( !$old_softs && $topic_softs )
      add_post_meta($post_id , 'topic_softs', $topic_softs, true);
    elseif($topic_softs != $old_softs)
      update_post_meta($post_id , 'topic_softs', $topic_softs);
    elseif($topic_softs == "")
      delete_post_meta($post_id , 'topic_softs', $topic_softs);
  }
  
  if($old_softs &&$topic_softs==''){
    delete_post_meta($post_id , 'topic_softs');
  }
}

//统计
 function custom_the_views($post_id, $echo=true, $views='') {
    $count_key = 'views';  
    $count = get_post_meta($post_id, $count_key, true);  
    if ($count == '') {  
        delete_post_meta($post_id, $count_key);  
        add_post_meta($post_id, $count_key, '0');  
        $count = '0';
    }  
    if ($echo)  
        echo number_format_i18n($count) . $views;  
    else  
        return number_format_i18n($count) . $views;  
}  
function set_post_views($postID) { 
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    global $wpdb;
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $num = $count+1;
        //update wp_postmeta set meta_value=meta_value+1 where post_id=541 and meta_key='views'
        $u = "update ".$wpdb->prefix."postmeta set meta_value=meta_value+1 where post_id=$postID and meta_key='views'";   
        $wpdb->query($u);
        //update_post_meta($postID, $count_key, $count);
    }

}  
//add_action('get_header', 'set_post_views');


function ashu_load_theme() {   
    global $pagenow;   
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )   
        ashu_vote_install(); //激活主题的时候执行函数   
}   
add_action( 'load-themes.php', 'ashu_load_theme' );   
function ashu_vote_install(){   
    global $wpdb;   
    //创建 _post_vote表   
    $table_name = $wpdb->prefix . 'post_vote';   
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) :   
    $sql = " CREATE TABLE `".$wpdb->prefix."post_vote` (
      `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,  
      `user` INT NOT NULL ,  
      `post` INT NOT NULL ,  
      `rating` varchar(10),  
      `ip` varchar(40)  
     ) ENGINE = MYISAM DEFAULT CHARSET=utf8;";   
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');   
        dbDelta($sql);   
    endif;   
}
function add_vote($post_id,$user_id='',$ip='',$rating='up'){   
    global $wpdb;   
    $user_id = (int)$user_id;   
    $post_id = (int)$post_id;   
    if(($user_id=='')&&($ip=='')){   
        return "e"; //返回error   
    }   
    //检查用户对某一文章是否已经投票票了   
    if($user_id!=''){ 
        $check= "select * from ".$wpdb->prefix."post_vote where post='$post_id' and user='$user_id'";   
    }else{   
        if($ip!=''){   
            $check= "select * from ".$wpdb->prefix."post_vote where post='$post_id' and ip='$ip'";   
        }   
    }   
    $coo = $wpdb->get_results($check);   
    //投票内容只能是up或者down   
    if($rating=='up'){   
        $rating='up';   
    }else{   
        $rating='down';   
    }   
    //如果不存在数据   
    if(!count($coo) > 0){ 
        //插入数据 sql   
        $s = "insert into ".$wpdb->prefix."post_vote (user,post,rating,ip) values('$user_id','$post_id','$rating','$ip')";   
        $wpdb->query($s);   
        return "y"; //返回yes   
    }else{   
        return "h"; //返回have   
    }   
    return "e";//返回error   
}
/*   
*获取文章投票数据   
*$post_id 文章ID   
*$vote 投票内容   
*/   
function get_post_vote($post_id,$vote='up'){   
    global $wpdb;   
    $post_id = (int)$post_id;   
    if($vote == 'up'){   
        $vote='up';   
    }else{   
        $vote='down';   
    }   
    //查询数据sql   
    $sql = "select count(*) from ".$wpdb->prefix."post_vote where post='$post_id' and rating='$vote'";   
    $coo = $wpdb->get_var($sql);   
    if($coo)   
    return $coo; //返回数据   
    else   
    return 0;   
}

function custom_posts_per_page($query){
  global $ashu_option;
	
	if ( is_search() && $query->is_main_query() ){
		$query->set( 'post_type', array( 'post','soft','topic') );
  }
  if(is_tax('topics')){
    $query->set( 'posts_per_page', 12 );
  }
	return $query;
}
add_action('pre_get_posts','custom_posts_per_page');

add_filter('the_content', 'ashuwp_fancybox');
function ashuwp_fancybox ($content) { global $post;
  $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";
  $replacement = '<a$1href=$2$3.$4$5 rel="box" class="fancybox"$6>$7</a>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}


function __search_by_title_only( $search, &$wp_query ) {
	global $wpdb;
 
	if ( empty( $search ) )
        return $search; // skip processing - no search term in query
 
    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';
 
    $search = 
    $searchand = '';
 
    foreach ( (array) $q['search_terms'] as $term ) {
    	$term = esc_sql( like_escape( $term ) );
    	$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
    	$searchand = ' AND ';
    }
 
    if ( ! empty( $search ) ) {
    	$search = " AND ({$search}) ";
    	if ( ! is_user_logged_in() )
    		$search .= " AND ($wpdb->posts.post_password = '') ";
    }
 
    return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

?>