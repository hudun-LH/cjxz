<?php
function ashuwp_pagenavi() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  $pagination = array(   
    'base' => @add_query_arg('paged','%#%'),   
    'format' => '',   
    'total' => $wp_query->max_num_pages,   
    'current' => $current,   
    'show_all' => false,   
    'type' => 'plain',   
    'end_size'=>'1',   
    'mid_size'=>'3',   
    'prev_text' => '上一页',
    'next_text' => '下一页'
  );   
  $total_pages = $wp_query->max_num_pages;
  if( $wp_rewrite->using_permalinks() ) 
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');   
  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array('s'=>get_query_var('s'));
	echo '<div class="page_nav">';
    if ( $current !=1 ) {
      echo '<a class="page-numbers" href="'. esc_html(get_pagenum_link(1)).'">首页</a>';
    }
    echo paginate_links($pagination);
    if ( $current < $total_pages ) {
      echo '<a class="page-numbers" href="'. esc_html(get_pagenum_link($total_pages)).'">尾页</a>';
    } 
	echo '</div>';
}

function ashuwp_pagenavi_num() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  $pagination = array(   
    'base' => '%#%',   
    'format' => '',   
    'total' => $wp_query->max_num_pages,   
    'current' => $current,   
    'show_all' => false,   
    'type' => 'plain',   
    'end_size'=>'1',   
    'mid_size'=>'3',   
    'prev_text' => '上一页',
    'next_text' => '下一页'
  );   
  $total_pages = $wp_query->max_num_pages;
  if( $wp_rewrite->using_permalinks() ) 
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');   
  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array('s'=>get_query_var('s'));
	echo '<div class="page_nav">';
    if ( $current !=1 ) {
      echo '<a class="page-numbers" href="'. esc_html(get_pagenum_link(1)).'">首页</a>';
    }
    echo paginate_links($pagination);
    if ( $current < $total_pages ) {
      echo '<a class="page-numbers" href="'. esc_html(get_pagenum_link($total_pages)).'">尾页</a>';
    } 
	echo '</div>';
}

function get_post_img( $id = null ) {
	if( $id ){
		$post = get_post($id);
		$post_id = $id;
	}else{
		global $post;
		$post_id = $post->ID;
	}
	
	if(get_post_meta($post_id,'_post_pic',true)&&(get_post_meta($post_id,'_post_pic',true)!='')){
		return get_post_meta($post_id,'_post_pic',true);
	}else{
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	
		if( !empty( $matches[1][0] ) ){
			return $matches[1][0];
		}else{
			return '';
		}
	}
}
if ( !function_exists('mb_strlen') ) {
	function mb_strlen ($text, $encode) {
		if ($encode=='UTF-8') {
			return preg_match_all('%(?:
					  [\x09\x0A\x0D\x20-\x7E]           # ASCII
					| [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
					|  \xE0[\xA0-\xBF][\x80-\xBF]       # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					|  \xED[\x80-\x9F][\x80-\xBF]       # excluding surrogates
					|  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
					|  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
					)%xs',$text,$out);
		}else{
			return strlen($text);
		}
	}
}
if (!function_exists('mb_substr')) {
    function mb_substr($str, $start, $len = '', $encoding="UTF-8"){
        $limit = strlen($str);
        for ($s = 0; $start > 0;--$start) {// found the real start
            if ($s >= $limit)
                break;
            if ($str[$s] <= "\x7F")
                ++$s;
            else {
                ++$s; // skip length
                while ($str[$s] >= "\x80" && $str[$s] <= "\xBF")
                    ++$s;
            }
        }
       if ($len == '')
            return substr($str, $s);
        else
            for ($e = $s; $len > 0; --$len) {//found the real end
                if ($e >= $limit)
                    break;
                if ($str[$e] <= "\x7F")
                    ++$e;
                else {
                    ++$e;//skip length
                    while ($str[$e] >= "\x80" && $str[$e] <= "\xBF" && $e < $limit)
                        ++$e;
                }
            }
        return substr($str, $s, $e - $s);
    }
}

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
function hunsubstrs($str,$limit_length,$type=false) {    
    $return_str   = "";
    $total_length = 0;
    $len = mb_strlen($str,'utf8');
    for ($i = 0; $i < $len; $i++) {
        $curr_char   = mb_substr($str,$i,1,'utf8');
        $curr_length = ord($curr_char) > 127 ? 2 : 1;
        if ($i != $len -1) {
            $next_length = ord(mb_substr($str,$i+1,1,'utf8')) > 127 ? 2 : 1;
        } else {
            $next_length = 0;
        }
        if ( $total_length + $curr_length + $next_length > $limit_length ) {
            if($type){
				$return_str .= $curr_char;
                return "{$return_str}...";
            }else{
				$return_str .= $curr_char;
                return "{$return_str}";
            }
        } else {
            $return_str .= $curr_char;
            $total_length += $curr_length;
        }
    }
    return $return_str;
}

function add_nofollow_to_comments_popup_link(){
	return 'rel="nofollow" target="_blank"';
}
add_filter('comments_popup_link_attributes', 'add_nofollow_to_comments_popup_link');

add_filter('get_comment_author_link','my_target_to_comments_athor_link');
function my_target_to_comments_athor_link( $link ){
	return str_replace( '\'>','\' target=\'_blank\'>', $link );
}
add_filter('comment_reply_link', 'add_nofollow_to_replay_link');
function add_nofollow_to_replay_link( $link ){
	return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}

function pa_category_top_parent_id ($catid ,$top_level=0) {

	while ($catid!=$top_level) {
		$cat = get_category($catid); // get the object for the catid
		$catid = $cat->parent; // assign parent ID (if exists) to $catid
		// the while loop will continue whilst there is a $catid
		// when there is no longer a parent $catid will be NULL so we can assign our $catParent
		$catParent = $cat->cat_ID;
	}
	return $catParent;
}

function get_top_parent_page_id($page_id) {
 
    $ancestors=get_post_ancestors($page_id);
 
    // Check if page is a child page (any level)
    if ($ancestors) {
 
        //  Grab the ID of top-level page from the tree
        return end($ancestors);
 
    } else {
 
        // Page is the top level, so use  it's own id
        return $page_id;
 
    }
 
}
/**  
*参数$title 字符串 页面标题  
*参数$slug  字符串 页面别名  
*参数$page_template 字符串  模板名  
*无返回值  
**/  
function ashu_add_page($title,$slug,$page_template=''){   
    $allPages = get_pages();//获取所有页面   
    $exists = false;   
    foreach( $allPages as $page ){   
        //通过页面别名来判断页面是否已经存在   
        if( strtolower( $page->post_name ) == strtolower( $slug ) ){   
            $exists = true;   
        }   
    }   
    if( $exists == false ) {   
        $new_page_id = wp_insert_post(   
            array(   
                'post_title' => $title,   
                'post_type'     => 'page',   
                'post_name'  => $slug,   
                'comment_status' => 'closed',   
                'ping_status' => 'closed',   
                'post_content' => '',   
                'post_status' => 'publish',   
                'post_author' => 1,   
                'menu_order' => 0   
            )   
        );   
        //如果插入成功 且设置了模板   
        if($new_page_id && $page_template!=''){   
            //保存页面模板信息   
            update_post_meta($new_page_id, '_wp_page_template',  $page_template);   
        }   
    }   
} 
function post_thumbnail( $width = 100,$height = 80 ){ 
    global $post; 
    if( has_post_thumbnail() ){ //有缩略图，则显示缩略图 
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); 
        $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$timthumb_src[0].'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />'; 
        echo $post_timthumb; 
    }else{
	    $timthumb_src = get_post_meta($post->ID,'post_thumb',true);
		if($timthumb_src==''){
		  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		  if( !empty( $matches[1][0] ) ){
		    $matches[1][0] = $matches[1][0];
			$post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$matches[1][0].'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		  }else{
		    $noimg = get_template_directory_uri().'/images/noimg.jpg';
		    $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$noimg.'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		  }
		}else{
		  $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$timthumb_src.'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		}
		echo $post_timthumb; 
	}
}

function get_soft_ico_src($post_id, $width = 150,$height = 150){
  if(!$post_id)
    return get_template_directory_uri().'/ico_default.png';
  
  $post = get_post($post_id);
  $ico = get_post_meta($post_id,'rjtb_value',true);
  if($ico!=''){
    return $ico;
  }elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    return get_template_directory_uri().'/timthumb.php?src='.$post_thumbnail_src.'&h='.$height.'&w='.$width.'&zc=1';
	}else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if(!empty($matches[1][0])){
			$post_thumbnail_src = $matches[1][0];   //获取该图片 src
		}else{	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 5);
			$post_thumbnail_src = get_template_directory_uri().'/images/ico_default.png';
		}
    return get_template_directory_uri().'/timthumb.php?src='.$post_thumbnail_src.'&h='.$height.'&w='.$width.'&zc=1';
	}
}

//输出缩略图地址
function post_thumbnail_src(){
	global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
	} else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if(!empty($matches[1][0])){
			$post_thumbnail_src = $matches[1][0];   //获取该图片 src
		}else{	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 5);
			$post_thumbnail_src = get_template_directory_uri().'/images/random/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//$post_thumbnail_src = get_template_directory_uri().'/images/default_thumb.jpg';
		}
	};
	echo $post_thumbnail_src;
}

function get_item_thumbnail($post_id, $width = 100,$height = 80 ){
    
    $post = get_post($post_id); 
    if( has_post_thumbnail() ){ //有缩略图，则显示缩略图 
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); 
        $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$timthumb_src[0].'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />'; 
        echo $post_timthumb; 
    }else{
	    $timthumb_src = get_post_meta($post->ID,'product_img',true);
		if($timthumb_src==''){
		  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		  if( !empty( $matches[1][0] ) ){
		    $matches[1][0] = $matches[1][0];
			$post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$matches[1][0].'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		  }else{
		    $noimg = get_template_directory_uri().'/images/noimg.jpg';
		    $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$noimg.'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		  }
		}else{
		  $post_timthumb = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$timthumb_src.'&h='.$height.'&w='.$width.'&zc=1" alt="'.$post->post_title.'" class="thumb" />';
		}
		echo $post_timthumb; 
	}
}
function attached_password_required( $post = null ) {
	$post = get_post($post);
  $attached_pass = get_post_meta($post->ID,'attached_pass',true);
	if ( empty( $attached_pass ) )
		return false;

	if ( ! isset( $_COOKIE['wp-attachedpass_' . COOKIEHASH] ) )
		return true;

	require_once ABSPATH . WPINC . '/class-phpass.php';
	$hasher = new PasswordHash( 8, true );

	$hash = wp_unslash( $_COOKIE[ 'wp-attachedpass_' . COOKIEHASH ] );
	if ( 0 !== strpos( $hash, '$P$B' ) )
		return true;

	return ! $hasher->CheckPassword( $attached_pass, $hash );
}

function count_top_level_menu_items($menu_id){
    $count = 0;
    $menu_items = wp_get_nav_menu_items($menu_id);
    foreach($menu_items as $menu_item){
        if($menu_item->menu_item_parent==0){
            $count++;
        }
    }
    return $count;
}
class ashuwp_manu_line extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	  static $top_level_count = array('footer'=>0,'links'=>0);
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		/***add code****/  
        $args->after='';
        if($item->menu_item_parent==0 and $top_level_count[$args->theme_location]!==null){ //Count top level menu items   
            $top_level_count[$args->theme_location]++; //Increment   
        }   
        $location_name = $args->theme_location;   
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $location_name ] ) ) {   
            $main_nav = wp_get_nav_menu_object( $locations[ $location_name ] );   
            if($item->menu_item_parent==0  && $top_level_count[$args->theme_location]!=count_top_level_menu_items($main_nav->term_id)){   
                $args->after= '<span class="menu_line">|</span>';   
            }   
        }   
        /*****add code*****/
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class wp_bootstrap_navwalker extends Walker_Nav_Menu {
  public function end_el( &$output, $item, $depth = 0, $args = array() ) {
     static $top_level_count = array('primary'=>0);
    /***add code****/  
        $end_tag='';   
        if($item->menu_item_parent==0 and $top_level_count[$args->theme_location]!==null){ //Count top level menu items   
            $top_level_count[$args->theme_location]++; //Increment   
        }   
        $location_name = $args->theme_location;   
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $location_name ] ) ) {   
            $main_nav = wp_get_nav_menu_object( $locations[ $location_name ] );   
            if($item->menu_item_parent==0  && $top_level_count[$args->theme_location]!=count_top_level_menu_items($main_nav->term_id)){   
               $end_tag = '<li class="gap"><span class="line"></span></li>';   
            }
        } 
        /*****add code*****/
		$output .= "</li>".$end_tag."\n";
	}
}
class sub_menu_wrapper extends Walker_Nav_Menu{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu'><ul class='sub-ul'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}
/*******menu walker***********/
class Menu_child_Walker extends Walker_Nav_Menu{
  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if( isset($children_elements[$element->$id_field]) ) { 
      $classes = empty( $element->classes ) ? array() : (array) $element->classes;
      $classes[] = 'has-children';
      $element->classes =$classes;
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}
function get_post_by_slug($post_name, $output = OBJECT) {  
  global $wpdb;  
  $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type='post'", $post_name ));  
  if ( $post )  
    return get_post($post, $output);  
  
  return null;  
}
function dev4press_debug_page_request() {   
  global $wp, $template;   
  define("D4P_EOL", "\r\n");   
    
  echo '<!-- Request: ';   
  echo empty($wp->request) ? "None" : esc_html($wp->request); //输出请求   
  echo ' -->'.D4P_EOL;   
  echo '<!-- Matched Rewrite Rule: ';   
  echo empty($wp->matched_rule) ? None : esc_html($wp->matched_rule); //输出翻译   
  echo ' -->'.D4P_EOL;   
  echo '<!-- Matched Rewrite Query: ';   
  echo empty($wp->matched_query) ? "None" : esc_html($wp->matched_query); //输出查询参数   
  echo ' -->'.D4P_EOL;   
  echo '<!-- Loaded Template: ';   
  echo basename($template); //输出模板名称   
  echo ' -->'.D4P_EOL;   
}

class Menu_With_Description extends Walker_Nav_Menu {   
    function start_el(&$output, $item, $depth, $args) {   
        global $wp_query;   
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';   
        $class_names = $value = '';   
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;   
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );   
        $class_names = ' class="' . esc_attr( $class_names ) . '"';   
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';   
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';   
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';   
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';   
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';   
        $item_output = $args->before;   
        $item_output .= '<a'. $attributes .'>';   
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;   
        $item_output .= '<span class="sub">' . $item->description . '</span>';   
        $item_output .= '</a>';   
        $item_output .= $args->after;   
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );   
    }   
}
?>