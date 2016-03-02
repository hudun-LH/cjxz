<?php
class rc_wobp_taxonomies_order_class {

	/**
	 * Constructor
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function __construct() {
		global $pagenow;
		
		// Edit Posts, Pages, and CPTs
		if( $pagenow == 'edit.php') {
			add_action( 'init', array( &$this,'rc_wobp_load_scripts') );
					
		// Categories, Taxonomies
		} elseif( $pagenow == 'edit-tags.php') {
			add_action( 'init', array( &$this,'rc_wobp_load_scripts_taxonomies') );		
			 
		} // end if
		include(get_template_directory(). '/plugin/worderbypress/includes/process-ajax.php');
		
		add_filter( 'pre_get_posts', array( &$this,'rc_wobp_reorder_list') );
		add_filter( 'get_terms_orderby', array( &$this,'rc_wobp_reorder_taxonomies_list'), 10, 2 );
		
	}
	
	/**
	 * Allows to reorder posts, pages and custom post types with drag n drop
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_wobp_load_scripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('rc_wobp-update-order', get_template_directory_uri() . '/plugin/worderbypress/includes/js/update-order.js');
		wp_enqueue_style('rc_wobp-admin-styles', get_template_directory_uri() . '/plugin/worderbypress/includes/css/admin.css');
	}
	
	/**
	 * Allows to reorder taxonomies, tags and categories with drag n drop
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_wobp_load_scripts_taxonomies() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('rc_wobp-update-order', get_template_directory_uri() . '/plugin/worderbypress/includes/js/update-order-taxonomies.js');
		wp_enqueue_style('rc_wobp-admin-styles', get_template_directory_uri() . '/plugin/worderbypress/includes/css/admin.css');
	}

	/**
	 * Reorder elements in default list by menu_order instead of date or ID
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_wobp_reorder_list( $wp_query ) {
	
		global $wp_query;
	
		if( $wp_query->is_main_query() ) {
			$wp_query->set('orderby', array('menu_order'=>'ASC','date'=>'DESC'));
			//$wp_query->set('order', array('ASC','DESC'));
		}
		
		return $wp_query;
	}
	
	/**
	 * Reorder elements in default list by menu_order instead of name by default
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_wobp_reorder_taxonomies_list($orderby, $args) {
	
		$orderby = "t.term_group";
		
		return $orderby;

	}
		
}


// instantiate plugin's class
$GLOBALS['rc_wobp_taxonomies_order'] = new rc_wobp_taxonomies_order_class();