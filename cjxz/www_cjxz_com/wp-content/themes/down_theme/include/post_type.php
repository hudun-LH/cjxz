<?php
add_action('init', 'ashu_post_type');
function ashu_post_type() {
  register_post_type( 'slider',
		array(
			'labels' => array(
				'name' => '手机站幻灯片',
				'singular_name' => '幻灯片',
				'add_new' => 'Add',
				'add_new_item' => 'Add',
				'edit_item' => 'Edit',
				'new_item' => 'New'
			),
		'public' => true,
    'show_ui' => true,
    'show_in_menu'  => 'options-general.php',
		'has_archive' => false,
		'exclude_from_search' => true,
		'menu_position' => 6,
		'supports' => array( 'title','thumbnail'),
		)
	);
  /**soft**/
	register_post_type( 'soft',
		array(
			'labels' => array(
				'name' => '软件',
				'singular_name' => '软件',
				'add_new' => '添加',
				'add_new_item' => '添加',
				'edit_item' => '编辑',
				'new_item' => '新的',
      ),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug'=>'softs'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 7,
    'taxonomies'=> array('post_tag'),
		'supports' => array('title','editor','thumbnail','comments'),
		'map_meta_cap' => true
		)
	);
  $labels = array(
		'name' => '软件分类',
		'singular_name' => '软件分类',
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => '编辑',
		'add_new_item' => '添加',
		'new_item_name' => '软件分类',
		'menu_name' => '软件分类',
	);
	register_taxonomy(
		'softs',
		array('soft'),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true
		)
	);
  
  /**topic**/
  register_post_type( 'topic',
		array(
			'labels' => array(
				'name' => '专题',
				'singular_name' => '专题',
				'add_new' => '添加',
				'add_new_item' => '添加',
				'edit_item' => '编辑',
				'new_item' => '新的',
      ),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug'=>'topics'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 8,
    'taxonomies'=> array('post_tag'),
		'supports' => array('title','editor','thumbnail','custom-fields'),
		'map_meta_cap' => true
		)
	);
  
  $labels = array(
		'name' => '专题分类',
		'singular_name' => '专题分类',
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => '编辑',
		'add_new_item' => '添加',
		'new_item_name' => '专题分类',
		'menu_name' => '专题分类',
	);
	register_taxonomy(
		'topics',
		array('topic'),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true
		)
	);
}

/***soft colum***/
function soft_custom_columns( $columns ) {
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => '标题',
    'ico' => '图标',
    'softs' => '类别',
    'date' => '日期',
    'ssid' => 'ID'
  );
  return $columns;
}
add_filter( 'manage_edit-soft_columns', 'soft_custom_columns' );

function soft_manage_custom_columns( $column, $post_id ) {
  global $post;
  switch( $column ) {
    //case 'ssid':
      //echo $post->ID;
    //break;
    case 'ico':
      $ico = get_soft_ico_src($post->ID,30,30);
      if($ico){
        echo '<img src="'.$ico.'" alt="" />';
      }else{
        echo '缺少图标，请补充';
      }
    break;
    case "softs":
	  $terms = get_the_terms( $post->ID, 'softs' );
	  if ( $terms && ! is_wp_error( $terms ) ) :
	    $draught_links = array();
      foreach ( $terms as $term ) {
        $draught_links[] = $term->name;
      }
      $on_draught = join( ", ", $draught_links );
	    echo $on_draught;
	  endif;
    break;
    default :
    break;
  }
}
add_action( 'manage_soft_posts_custom_column', 'soft_manage_custom_columns', 10, 2 );

/***topic colum***/
function topic_custom_columns( $columns ) {
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => '标题',
    'topics' => '类别',
    'date' => '日期',
    'ssid' => 'ID'
  );
  return $columns;
}
add_filter( 'manage_edit-topic_columns', 'topic_custom_columns' );

function topic_manage_custom_columns( $column, $post_id ) {
  global $post;
  switch( $column ) {
    case 'ssid':
      echo $post->ID;
    break;
    case "topics":
	  $terms = get_the_terms( $post->ID, 'topics' );
	  if ( $terms && ! is_wp_error( $terms ) ) :
	    $draught_links = array();
		foreach ( $terms as $term ) {
		  $draught_links[] = $term->name;
		}
		$on_draught = join( ", ", $draught_links );
	    echo $on_draught;
	  endif;
    break;
    default :
    break;
  }
}
add_action( 'manage_topic_posts_custom_column', 'topic_manage_custom_columns', 10, 2 );


//文章ID
function ssid_column($cols) {
	$cols['ssid'] = 'ID';
	return $cols;
}
function ssid_value($column_name, $id) {
	if ($column_name == 'ssid')
		echo $id;
}
function ssid_return_value($value, $column_name, $id) {
	if ($column_name == 'ssid')
		$value = $id;
	return $value;
} 
function ssid_css() {
?>
<style type="text/css">
	#ssid { width: 50px; } /* Simply Show IDs */
</style>
<?php	
}
function ssid_add() {
	add_action('admin_head', 'ssid_css');
	add_filter('manage_posts_columns', 'ssid_column');
	add_action('manage_posts_custom_column', 'ssid_value', 10, 2);
	add_filter('manage_pages_columns', 'ssid_column');
	add_action('manage_pages_custom_column', 'ssid_value', 10, 2);
	add_filter('manage_media_columns', 'ssid_column');
	add_action('manage_media_custom_column', 'ssid_value', 10, 2);
	add_filter('manage_link-manager_columns', 'ssid_column');
	add_action('manage_link_custom_column', 'ssid_value', 10, 2);
	add_action('manage_edit-link-categories_columns', 'ssid_column');
	add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);
	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'ssid_column');			
		add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
	}
	add_action('manage_users_columns', 'ssid_column');
	add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);
	add_action('manage_edit-comments_columns', 'ssid_column');
	add_action('manage_comments_custom_column', 'ssid_value', 10, 2);
}
add_action('admin_init', 'ssid_add');
?>