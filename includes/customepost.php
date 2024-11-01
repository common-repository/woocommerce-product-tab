<?php
	add_action('init', 'register_extra_product_tab');
	function register_extra_product_tab() {
		$args = array(
			'description' => __('Product Tab',EXTRA_WOO_TABS_TEXTDOMAN),
			'show_ui' => true,
			'menu_position' => 25,
			'exclude_from_search' => true,
			'menu_icon' => 'dashicons-exerpt-view',
			'labels' => array(
				'name'=> __('Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'singular_name' => __('Product Tab',EXTRA_WOO_TABS_TEXTDOMAN),
				'add_new' => __('Add Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'add_new_item' => __('Add Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'edit' => __('Edit Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'edit_item' => __('Edit Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'new-item' => 'New Woo Tabs Pro',
				'view' => __('View Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'view_item' => __('View Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'search_items' => __('Search Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN),
				'not_found' => __('No Woo Tabs Pro Found',EXTRA_WOO_TABS_TEXTDOMAN),
				'not_found_in_trash' => __('No Woo Tabs Pro Found in Trash',EXTRA_WOO_TABS_TEXTDOMAN),
				'parent' => __('Parent Woo Tabs Pro',EXTRA_WOO_TABS_TEXTDOMAN)
			),
			'public' => true,
			//'taxonomies' => array('propertytype'),
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title','editor'),
			'has_archive' => true,
			'show_in_menu' => 'woocommerce' // SHOW IN WOOCOMMERCE MENU
			
		);
	
		register_post_type( 'extra_product_tab' , $args );
	}
	
	
	

	add_filter('manage_extra_product_tab_posts_columns', 'custom_add_property_columns_product_tab');
	function custom_add_property_columns_product_tab($columns) {
		//unset($columns['title']);	
		unset($columns['date']);	
		//$columns['custom_tracking_no']= 'Tracking Number' ;
		$columns['product_tab_type']= __('Type',EXTRA_WOO_TABS_TEXTDOMAN);
		$columns['product_tab_order']= __('Order',EXTRA_WOO_TABS_TEXTDOMAN) ;
		$columns['product_tab_enable']= __('Enable for All',EXTRA_WOO_TABS_TEXTDOMAN);
		$columns['product_tab_use']= __('Use for All' ,EXTRA_WOO_TABS_TEXTDOMAN);
		return $columns;
	}


	add_action('manage_posts_custom_column', 'custom_render_post_columns_product_tab', 10, 2);
	function custom_render_post_columns_product_tab($column_name, $id) {

		switch ($column_name) {
			
			case 'product_tab_type':
				$arr_type = array('brands_category'=>__('Brands & Category',EXTRA_WOO_TABS_TEXTDOMAN),'product'=>__('Products',EXTRA_WOO_TABS_TEXTDOMAN),'editor'=>__('Editor',EXTRA_WOO_TABS_TEXTDOMAN),'video_gallery'=>__('Video Gallery',EXTRA_WOO_TABS_TEXTDOMAN),'photo_gallery'=>__('Photo Gallery',EXTRA_WOO_TABS_TEXTDOMAN),'map'=>__('Map',EXTRA_WOO_TABS_TEXTDOMAN),'form'=>__('Shortcodes',EXTRA_WOO_TABS_TEXTDOMAN),'inquire_form'=>__('Inquiry Form',EXTRA_WOO_TABS_TEXTDOMAN),'download'=>__('Download',EXTRA_WOO_TABS_TEXTDOMAN),'related_post'=>__('Related Posts',EXTRA_WOO_TABS_TEXTDOMAN),'faq'=>__('faq',EXTRA_WOO_TABS_TEXTDOMAN));
				$type = get_post_meta( $id , 'product_tab_type' ,true );
				echo ( isset ( $arr_type [ $type ] ) ? $arr_type [ $type ] : __('No Tab Type',EXTRA_WOO_TABS_TEXTDOMAN) );
			break;	

			case 'product_tab_order':
				echo get_post_meta( $id , 'product_tab_order' ,true );
			break;	
			
			case 'product_tab_enable':
				echo (get_post_meta( $id , 'product_tab_enable_all' ,true )=='yes' ? "<i class='fa fa-check'></i>":"<i class='fa fa-times'></i>");
			break;	
			
			case 'product_tab_use':
				echo (get_post_meta( $id , 'product_tab_use_all' ,true )=='yes' ? "<i class='fa fa-check'></i>":"<i class='fa fa-times'></i>");
			break;

		}
	}
?>