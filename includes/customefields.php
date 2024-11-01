<?php

	
	//include_once 'metaboxes/wpalchemy/MetaBox.php';
	function add_custom_meta_box_product_tab() {  
		add_meta_box(  
			'general_setting', // $id  
			'<i class="fa fa-th-list"></i> '.__('Product Tabs General Setting',EXTRA_WOO_TABS_TEXTDOMAN), // $title   
			'show_custom_product_tab', // $callback  
			'extra_product_tab', // $page  
			'normal', // $context  
			'high');
			
		add_meta_box( 
			'product_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Products :: Display for all Products',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
		
		add_meta_box( 
			'brands_category_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Brands & Category :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
		
		add_meta_box( 
			'editor_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Editor :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_editor_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
		'faq_setting_area', 
		'<i class="fa fa-clipboard"></i> '.__('Editor :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
		'show_product_setting_area',
		'extra_product_tab',
		'normal',
		'high');
		
		add_meta_box( 
			'form_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Shortcodes :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'video_gallery_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Video Gallery :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'photo_gallery_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Photo Gallerty :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'map_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Map :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'inquire_form_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Inquiry Form :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');
			
		add_meta_box( 
			'download_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Download :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');		
		
		add_meta_box( 
			'related_post_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('Related Posts :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');		
			
		add_meta_box( 
			'faq_setting_area', 
			'<i class="fa fa-clipboard"></i> '.__('FAQ :: Display for all Product',EXTRA_WOO_TABS_TEXTDOMAN).'', 
			'show_product_setting_area',
			'extra_product_tab',
			'normal',
			'high');							
				
	}  
	add_action('add_meta_boxes', 'add_custom_meta_box_product_tab');  
	
	$prefix = 'product_';  
	$custom_fields_product_tab = array(  
		array(  
			'label' => '<strong>'.__('Type',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Tab Type',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_type',
			'type'  => 'select',  
			'options' => array (  
				
				'one' => array (

					'label' => __('Brands & Category',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'brands_category'  
				),
				'two' => array (

					'label' => __('Editor',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'editor'  
				),
				'three' => array (  
					'label' => __('Download',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'download'  
				),  
				'four' => array (  
					'label' => __('FAQ',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'faq'  
				),
				'five' => array (  
					'label' => __('Inquiry Form',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'inquire_form'  
				),  
				'six' => array (  
					'label' => __('Map',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'map'  
				),  
				'seven' => array ( 

					'label' => __('Photo Gallery',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'photo_gallery'  
				),
				'eight' => array (  
					'label' => __('Products',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'product'  
				),      
				'nine' => array (  
					'label' => __('Related Posts',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'related_post'  
				),  
				'ten' => array (  
					'label' => __('Shortcodes',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'form'  
				),   
				'eleven' => array (  

					'label' => __('Video Gallery',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'video_gallery'  
				)
			)  
		),
		array(  
			'label' => '<strong>'.__('Order',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Enter Tab Order',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_order',
			'type'  => 'numeric'  
		),
		array(  
			'label' => '<strong>'.__('Tab Status',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Tab Status,',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_enable_all',
			'type'  => 'radio' ,
			'options' => array (  
				'yes' => array (  
					'label' => __('Enable',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'yes',
					'checked'=> 'checked' 
				),  
				'no' => array (  
					'label' => __('Disable',EXTRA_WOO_TABS_TEXTDOMAN),  
					'value' => 'no',
					'checked'=> ''   
				) 
			)   
		),
		array(  
			'label' => '<strong>'.__('Icon',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('Choose Icon for Tab or Sticky Button',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_icon',
			'type'  => 'icon_type'  
		),
		array(  
			'label' => '<strong>'.__('Use For All',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => __('If Checked,You can Enter Content for This Tab here and the Content Will be Displayed in All Products Page',EXTRA_WOO_TABS_TEXTDOMAN),
			'id'    => $prefix.'tab_use_all',
			'type'  => 'checkbox'  
		)
	);	
	

	
	$prefix = 'product_';  
	$fields_editor_setting_area = array(  
		array(  
			'label' => '<strong>'.__('Editor',EXTRA_WOO_TABS_TEXTDOMAN).'</strong>',  
			'desc'  => '',
			'id'    => $prefix.'editor_tab_content',
			'type'  => 'editor'  
		)
	);

	function show_custom_product_tab() {  
		global $custom_fields_product_tab, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($custom_fields_product_tab as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with  
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'text':  
	
								echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
								<br /><span class="description">'.$field['desc'].'</span>	';  
							break; 
							
							case 'radio':  
								foreach ( $field['options'] as $option ) {
									echo '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
											<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
								}  
							break;
							
							case 'select':  
								echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
								foreach ($field['options'] as $option) {  
									echo '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
								}  
								echo '</select><br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;
							
							case 'numeric':  
								echo '
								<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.($meta=='' ? "1":$meta).'" size="30" class="width_170" min="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" value="1" title="Only Digits!" class="input-text qty text" />
	';
								echo '
									<br /><span class="description">'.$field['desc'].'</span>';  
							break;
							
							case 'checkbox':  
								echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( $meta, "on" ,0).'"/> 
									<br /><span class="description">'.__($field['desc'],EXTRA_WOO_TABS_TEXTDOMAN).'</span>';  
							break;  
							
							case 'icon_type':  
								echo '<input type="hidden" id="font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
								echo '<div class="iconpicker" id="benefit_image_icon">';
								include(plugin_dir_path( __FILE__ ) .'../class/font-awesome.php');
								echo '</div>';
							break; 
							
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	
	function show_product_setting_area() {  
		global $post;  
		echo PL_DEMO;
		
	}
	
	
	function show_editor_setting_area() {  
		global $fields_editor_setting_area, $post;  
		// Use nonce for verification  
		echo '<input type="hidden" name="show_custom_meta_box_extra_product_tab_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			// Begin the field table and loop  
			echo '<table class="form-table">';  
			foreach ($fields_editor_setting_area as $field) {  
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true); 
				// begin a table row with 
				echo '<tr> 

						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
							
							case 'editor':
									echo '
										<p><span class="description">'.$field['desc'].'</span></p>
										<p class="form-field product_field_type" >';
										$editor_id =$field['id'];
										wp_editor( $meta, $editor_id );
										echo '</p>';
							break; 
	
						} //end switch  
				echo '</td></tr>';  
			} // end foreach  
			echo '</table>'; // end table  
	}
	

	
	
	function save_custom_meta_product_tab ($post_id) {  
		//die(print_r($_POST));
		global $fields_editor_setting_area,$custom_fields_product_tab;
		// verify nonce
		if(isset($_POST) && !empty($_POST)){
			if (isset($_POST['show_custom_meta_box_extra_product_tab_nonce']) && !wp_verify_nonce($_POST['show_custom_meta_box_extra_product_tab_nonce'], basename(__FILE__)))
				return $post_id;
		// check autosave  
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
				return $post_id;  
			// check permissions  
			if ('page' == $_POST['post_type']) {  
				if (!current_user_can('edit_page', $post_id))  
					return $post_id;  
				} elseif (!current_user_can('edit_post', $post_id)) {  
					return $post_id;  
			}  
			
			$tab_type='product';
			if(isset($_POST) && !empty($_POST)){
				if (isset($_POST['product_tab_type'])){
					$tab_type=esc_attr(($_POST['product_tab_type']));
				}
			}
	
			foreach ($custom_fields_product_tab as $field) { 
				if(!isset($_POST[$field['id']])){
					delete_post_meta($post_id, $field['id']);  
					continue;
				}
				
				$post = get_post($post_id);
				$category = $_POST[$field['id']];  
				wp_set_post_terms( $post_id, $category, $field['id'],false );

				$old = get_post_meta($post_id, $field['id'], true);  
				$new = $_POST[$field['id']];  
				if ($new && $new != $old) {  
					update_post_meta($post_id, $field['id'], $new);  
				} elseif ('' == $new && $old) {  
					delete_post_meta($post_id, $field['id'], $old);  
				}
	
			} // end foreach  
			
			if($tab_type=='editor')
			{
				foreach ($fields_editor_setting_area as $field) { 
					if(!isset($_POST[$field['id']])){
						delete_post_meta($post_id, $field['id']); 
						continue;
					}
					
					$post = get_post($post_id);
					$category = $_POST[$field['id']];  
					wp_set_post_terms( $post_id, $category, $field['id'],false );
					
					$old = get_post_meta($post_id, $field['id'], true);  
					$new = $_POST[$field['id']];  
					if ($new && $new != $old) {  
						update_post_meta($post_id, $field['id'], $new);  
					} elseif ('' == $new && $old) {  
						delete_post_meta($post_id, $field['id'], $old);  
					}
		
				} // end foreach
			}
			
			
			
		}		
	
		
	} 
	 
	add_action('save_post', 'save_custom_meta_product_tab');  
	
	
	
?>