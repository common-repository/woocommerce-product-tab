<?php
class product_custom_tab {
	
	var $counter=1;
	var $content_changed=false;
	
	public function __construct() 
	{
		//SHOW CUSTOM TAB IN FRONT END
		add_filter( 'woocommerce_product_tabs', array( $this,'woocommerce_product_custom_tab') );
		//CUSTOM TAB
		add_action('woocommerce_product_write_panel_tabs', array( $this,'custom_tab_options_tab'));		
		
		add_action('woocommerce_process_product_meta', array( $this,'process_product_meta_custom_tab'), 10, 2);		
	}
	
	/**
	 * Display Tab
	 * 
	 * Display Custom Tab on Frontend of Website for WooCommerce 2.0
	 */	

	public function custom_tab_options_tab() {
		global $wpdb;
		//$save_post=$post;

		$args = array( 
					'post_type' => 'extra_product_tab',
					'meta_key' => 'product_tab_order',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'product_tab_enable_all',
							'value' => 'yes',
							'compare' => '='
						),
						array(
							'key' => 'product_tab_type',
							'value' => 'editor',
							'compare' => '='
						)
					)
				);
		
		global $post;  
		$save_post = $post;
				
				
				
		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_icon=get_post_meta(get_the_ID(),'product_tab_icon', true);
			$perfix_tab=$product_type.'_'.get_the_ID();
			?>
				<li class="my-tabs <?php echo $perfix_tab;?>_tab"><a href="#<?php echo $perfix_tab;?>_tab"><i class="fa <?php echo $product_icon;?>"></i> <?php the_title(); ?></a></li>
			<?php
		endwhile;
		$post = $save_post;
		wp_reset_postdata();
		add_action('woocommerce_product_write_panels', array( $this,'product_tab_options') );
	?>

	<?php
	}
			
	public function product_tab_options($product_type) {
		global $wpdb;
		//$save_post = $post;
		
		$args = array( 
					'post_type' => 'extra_product_tab',
					'meta_key' => 'product_tab_order',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'product_tab_enable_all',
							'value' => 'yes',
							'compare' => '='
						),
						array(
							'key' => 'product_tab_type',
							'value' => 'editor',
							'compare' => '='
						)
					)
				);
				
		global $post;  
		$save_post = $post;
		$post_id=(isset($_GET['post']) ? $_GET['post']:"");		
		$loop = new WP_Query( $args );
		//echo $loop->request;
		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
			$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
			$perfix='product_'.$product_type.'_';
			$perfix_tab=$product_type.'_'.get_the_ID();
			
			$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
			$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
			
			$enable='yes';
			if($product_tab_use_all!="on" && $tab_enable_in_product=='yes')
			{
				$enable='yes';
			}else if($product_tab_use_all!="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
			{
				$enable='no';
			}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='yes' || $tab_enable_in_product!='no'))
			{
				$enable='yes';
			}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
			{
				$enable='no';
			}
			
			
			$public_field_array=array(
				$public_perfix.'tab_enabled' => $enable,
				$public_perfix.'tab_title' => ($tab_enable_in_product!='' ? get_post_meta ( $post_id, $public_perfix.'tab_title', true ):get_the_title() ),
				$public_perfix.'tab_description' => ($tab_enable_in_product!='' ? get_post_meta ( $post_id, $public_perfix.'tab_description', true ) : get_the_content() ),
				$public_perfix.'tab_sticky_enabled' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_enabled', true ),
				$public_perfix.'tab_sticky_width' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_width', true ),
				$public_perfix.'tab_sticky_height' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_height', true ),
				$public_perfix.'tab_sticky_position' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_position', true ),
				$public_perfix.'tab_content_changed' => get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true ),
			);
			include("admin-ui/editor_tab.php");
			

		endwhile;
		$post = $save_post;
		wp_reset_postdata();
	}
			
	public function update_public_fields($public_perfix,$post_id)
	{
		
		$this->update_public_meta( $post_id, $public_perfix.'tab_enabled', ( isset ( $_POST[$public_perfix.'tab_enabled'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_enabled'] ) : 'no' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_title', ( isset ( $_POST[$public_perfix.'tab_title'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_title'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_description', ( isset ( $_POST[$public_perfix.'tab_description'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_description'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_enabled', ( isset ( $_POST[$public_perfix.'tab_sticky_enabled'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_enabled'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_width', ( isset ( $_POST[$public_perfix.'tab_sticky_width'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_width'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_height', ( isset ( $_POST[$public_perfix.'tab_sticky_height'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_height'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_sticky_position', ( isset ( $_POST[$public_perfix.'tab_sticky_position'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_sticky_position'] ) : '' );
		$this->update_public_meta( $post_id, $public_perfix.'tab_content_changed', ( isset ( $_POST[$public_perfix.'tab_content_changed'] ) ) ? esc_attr ( $_POST[$public_perfix.'tab_content_changed'] ) : '' );
		
		if($this->content_changed)
		{
			$this->update_public_meta( $post_id, $public_perfix.'tab_content_changed', "yes" );
			$this->content_changed=false;
		}
	
	}
	
	public function update_public_meta ( $id, $field, $value )
	{
		$old = get_post_meta($id, $field, true);  
		$new = $value;  
		if ($new && $new != $old) {  
			update_post_meta($id, $field, $new);
		} elseif ('' == $new && $old) {  
			delete_post_meta($id, $field, $old);  
		}
	}
	 
	public function update_meta ( $id, $field, $value )
	{
		$old = get_post_meta($id, $field, true);  
		$new = $value;  
		if ($new && $new != $old) {  
			update_post_meta($id, $field, $new);
			$this->content_changed=true;
		} elseif ('' == $new && $old) {  
			delete_post_meta($id, $field, $old);  
			$this->content_changed=true;
		}
	}
	 
	public function process_product_meta_custom_tab( $post_id ) {
		
		global $wpdb;
		//$save_post=$post;

		$args = array( 
					'post_type' => 'extra_product_tab',
					'meta_key' => 'product_tab_order',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'product_tab_enable_all',
							'value' => 'yes',
							'compare' => '='
						),
						array(
							'key' => 'product_tab_type',
							'value' => 'editor',
							'compare' => '='
						)
					)
				);
		global $post;  
		$save_post = $post;		
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
			$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
			$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
			$perfix='product_'.$product_type.'_';
		
			
			
			$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
			$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
			$this->update_meta( $post_id, $public_perfix.'tab_content', ( isset ( $_POST[$public_perfix.'tab_content'] ) ) ?  ( $_POST[$public_perfix.'tab_content'] ) : '' );
			
			$this->update_public_fields($public_perfix,$post_id);

		endwhile;
		$post = $save_post;
		wp_reset_postdata();
	}

	public function woocommerce_product_custom_tab( $tabs ) {
				global $post, $product,$wpdb;
				$post_id=$post->ID;
				$save_post = $post;
								
				$args = array( 
							'post_type' => 'extra_product_tab',
							'meta_key' => 'product_tab_order',
  							'orderby' => 'meta_value_num',
  							'order' => 'ASC',
							'meta_query' => array(
								array(
									'relation' => 'AND',
									array(
										'key' => 'product_tab_enable_all',
										'value' => 'yes',
										'compare' => '='
									),
									array(
										'key' => 'product_tab_type',
										'value' => 'editor',
										'compare' => '='
									)
								)
							)
						);
				$loop = new WP_Query( $args );
				//echo $loop->request;
				global $extra_number ;

				$extra_left_top = get_option('woocommerce_tab_eb_left_top');
				$extra_right_top = get_option('woocommerce_tab_eb_right_top');
				while ( $loop->have_posts() ) : $loop->the_post();

					$product_type=get_post_meta(get_the_ID(),'product_tab_type', true);
					$product_tab_use_all=get_post_meta(get_the_ID(),'product_tab_use_all', true);
					$product_tab_order=get_post_meta(get_the_ID(),'product_tab_order', true);
					$product_icon=get_post_meta(get_the_ID(),'product_tab_icon', true);
					$public_perfix='product_'.$product_type.'_'.get_the_ID().'_';
					$perfix='product_'.$product_type.'_';
					
					$tab_enable_in_product=get_post_meta ( $post_id, $public_perfix.'tab_enabled', true );
					$tab_content_changed=get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true );
					
					$enable='yes';
					if($product_tab_use_all!="on" && $tab_enable_in_product=='yes')
					{
						$enable='yes';
					}else if($product_tab_use_all!="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
					{
						$enable='no';
					}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='yes' || $tab_enable_in_product!='no'))
					{
						$enable='yes';
					}else if($product_tab_use_all=="on" && ($tab_enable_in_product=='no' || $tab_enable_in_product!='yes'))
					{
						$enable='no';
					}
					
					
					
					$public_field_array=array(
						$public_perfix.'tab_enabled' => $enable,
						$public_perfix.'tab_title' => ( $tab_enable_in_product!='' ?  get_post_meta($post_id, $public_perfix.'tab_title', true) : get_the_title() ),
						$public_perfix.'tab_description' => ( $tab_enable_in_product!='' ?  get_post_meta($post_id, $public_perfix.'tab_description', true) : get_the_content() ),
						$public_perfix.'tab_icon' => $product_icon,
						$public_perfix.'tab_sticky_enabled' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_enabled', true ),
						$public_perfix.'tab_sticky_width' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_width', true ),
						$public_perfix.'tab_sticky_height' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_height', true ),
						$public_perfix.'tab_sticky_position' => get_post_meta ( $post_id, $public_perfix.'tab_sticky_position', true ),
						$public_perfix.'tab_content_changed' => get_post_meta ( $post_id, $public_perfix.'tab_content_changed', true )
					);

					$front_end_tab_options = array(
						'public_fields'	 => $public_field_array
					);
					
					if (!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_enabled'] != 'no' ){
						if(!empty($front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled']) && $front_end_tab_options['public_fields'][$public_perfix.'tab_sticky_enabled'] == 'yes')
						{
							$custom_tab_options = array(
								'title'    => $front_end_tab_options['public_fields'][$public_perfix.'tab_title'],
								'icon'    => '<i class="fa '.$product_icon.'"></i>',
								'priority' => $product_tab_order,
								'callback' => 'template-editor.php',
								'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
								'public_fields'	 => $public_field_array,
							);
							include('frontend-ui/sticky.php');
						}
						else{
							$description=$front_end_tab_options['public_fields'][$public_perfix.'tab_description'];
							$title='<i class="fa '.$product_icon.'"></i> '.$front_end_tab_options['public_fields'][$public_perfix.'tab_title'].($description!='' ? ' <span rel="tipsyn" title="'.$description.'" class="wt-tab-desc"><i class="fa fa-question-circle"></i></span>' : '' );

							$tabs[$public_perfix.'tab'] = array(
								'title'    => $title,
								'priority' => $product_tab_order,
								'callback' => array( $this, 'custom_product_tabs_panel_content' ),
								'content'  => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ? get_post_meta( $post_id, $public_perfix.'tab_content', true ) : get_post_meta( get_the_ID(), $perfix.'tab_content', true ) ),
								'public_fields'	 => $public_field_array,
							);
						}
					}

				endwhile;
				$post = $save_post;
				wp_reset_postdata();
				
				return $tabs;
			}
	/**
	 * Render the custom product tab panel content for the callback 'custom_product_tabs_panel_content'
	 */
	function custom_product_tabs_panel_content( $key, $custom_tab_options ) {

		// allow shortcodes to function
		$content = apply_filters( 'the_content', $custom_tab_options['content'] );
		$content = str_replace( ']]>', ']]&gt;', $content );

		echo apply_filters( 'woocommerce_custom_product_tabs_panel_content', $content, $custom_tab_options );
		
		//echo 'here';
		
	}
	
			

}
new product_custom_tab();
?>