<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class pw_woocommerc_WC_List_Grid_WC_Admin_Tabs {

	public $tab; 
	public $options; 
	
	/**
	 * Constructor
	 */
	public function __construct() {

		$this->options = $this->pw_woocommerce_tabs_plugin_options();
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'pw_woocommerce_tabs_add_tab_woocommerce' ) );
		add_filter( 'woocommerce_page_settings', array( $this, 'pw_woocommerce_tabs_add_page_setting_woocommerce' ) );
		add_action( 'woocommerce_update_options_pw_woocommerce_tabs', array( $this, 'pw_woocommerce_tabs_update_options' ) );
		add_action( 'woocommerce_admin_field_upload_tabs', array( $this, 'admin_fields_upload_tabs' ) );
		add_action( 'woocommerce_update_option_upload_tabs', array( $this, 'admin_update_option_tabs' ) );		
		add_action( 'woocommerce_settings_tabs_pw_woocommerce_tabs', array( $this, 'pw_woocommerce_tabs_print_plugin_options' ) );
	}
	
	function pw_woocommerce_tabs_add_tab_woocommerce($tabs){
		$tabs['pw_woocommerce_tabs'] = __('Product Tabs','woocommerce-brands'); // or whatever you fancy
		return $tabs;
	}
	
	
	/**
	 * Update plugin options.
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function pw_woocommerce_tabs_update_options() {
		foreach( $this->options as $option ) {
			woocommerce_update_options( $option );   
		}
	}
	
	/**
	 * Add the select for the Woocommerce tabs page in WooCommerce > Settings > Pages
	 * 
	 * @param array $settings
	 * @return array
	 * @since 1.0.0
	 */
	public function pw_woocommerce_tabs_add_page_setting_woocommerce( $settings ) {
		unset( $settings[count( $settings ) - 1] );
		
		$settings[] = array(
			'name' => __( 'Wishlist Page', EXTRA_WOO_TABS_TEXTDOMAN ),
			'desc' 		=> __( 'Page contents: [pw_woocommerce_tabs]', EXTRA_WOO_TABS_TEXTDOMAN ),
			'id' 		=> 'pw_woocommerce_tabs_page_id',
			'type' 		=> 'single_select_page',
			'std' 		=> '',         // for woocommerce < 2.0
			'default' 	=> '',         // for woocommerce >= 2.0
			'class'		=> 'chosen_select_nostd',
			'css' 		=> 'min-width:300px;',
			'desc_tip'	=>  false,
		);
		
		$settings[] = array( 'type' => 'sectionend', 'id' => 'page_options');
		
		return $settings;
	}

	
	
	
	public function pw_woocommerce_tabs_print_plugin_options() {

		?>
		<div class="subsubsub_section">
			<br class="clear" />
			<?php foreach( $this->options as $id => $tab ) : ?>
			<div class="section" id="pw_woocommerce_tabs_<?php echo $id ?>">
				<?php woocommerce_admin_fields( $this->options[$id] ) ;?>
			</div>
			<?php endforeach;?>
		</div>
		<?php
	}
	
	private function pw_woocommerce_tabs_plugin_options() {
		$options['general_settings'] = array(
			array(	'title' => __( 'Styles and Scripts', EXTRA_WOO_TABS_TEXTDOMAN ), 'type' => 'title', 'id' => 'script_styling_options' ),

			array(
				'title' => __( 'Light Skin Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Light Skin Colour. Default <code>#f7f7f7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_light_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#f7f7f7',
				'autoload'  => false
			),

			array(
				'title' => __( 'Dark Skin Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Dark Skin Colour. Default <code>#414141</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_dark_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#414141',
				'autoload'  => false
			),
			array(
				'title' => __( 'Button Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Button Colour. Default <code>#a7a7a7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_btn_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#a7a7a7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Button Hover Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Button Hover Colour. Default <code>#309af7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_btn_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#309af7',
				'autoload'  => false
			),			
			array(
				'title' => __( 'Icon Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Icon Colour. Default <code>#309af7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_icon_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#309af7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Link Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Link Colour. Default <code>#bbbbbb</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_link_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#bbbbbb',
				'autoload'  => false
			),
			array(
				'title' => __( 'Link Hover Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Link Hover Colour. Default <code>#309af7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_link_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#309af7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Image Hover', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Image Hover. Default <code>#000000</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#000000',
				'autoload'  => false
			),			
			array(
				'title' => __( 'Description Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Description Colour. Default <code>#a7a7a7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_description_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#a7a7a7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Price Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Price Colour. Default <code>#309af7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_price_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#309af7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Border Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Border Colour. Default <code>#636363</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#636363',
				'autoload'  => false
			),
			array(
				'title' => __( 'Featuerd  Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Featuerd  Colour. Default <code>#ffffff</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_featured_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#ffffff',
				'autoload'  => false
			),			
			array(
				'title' => __( 'Featuerd Backgraund Colour', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'The base colour for Featuerd Backgraund Colour. Default <code>#309af7</code>.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_featured_bg_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'default'	=> '#309af7',
				'autoload'  => false
			),
			array(
				'title' => __( 'Use Default Theme To Show Products', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'check this if you want to use your default theme view for products.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_default_theme',
				'default'	=> 'no',
				'type' 		=> 'checkbox',
			),					
			array( 'type' => 'sectionend', 'id' => 'pw_woocommerce_tabs_general_settings' )
		);
		
		$options['tabs_settings'] = array(
			array( 'name' => __( 'Sticky Button', EXTRA_WOO_TABS_TEXTDOMAN ), 'type' => 'title', 'desc' => '', 'id' => 'pw_woocommerce_tabs_image_settings' ),

			array(
				'title' => __( 'Animation', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'Choose animation for product tab element in front-end.', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_animation_type',
				'default'	=> 'no_animation',
				'type' 		=> 'select',
				'class'		=> 'chosen_select',
				'css' 		=> 'min-width: 350px;',
				'desc_tip'	=>  true,
				'options' => array(
					'no_animation'      => __( 'No Animation', EXTRA_WOO_TABS_TEXTDOMAN ),
					'slidedown'      => __( 'slideDown', EXTRA_WOO_TABS_TEXTDOMAN ),
					'slidedp' => __( 'slideUp', EXTRA_WOO_TABS_TEXTDOMAN ),
					'slideleft' => __( 'slideLeft', EXTRA_WOO_TABS_TEXTDOMAN ),
					'slidelight' => __( 'slideRight', EXTRA_WOO_TABS_TEXTDOMAN ),
					'fadein' => __( 'fadeIn', EXTRA_WOO_TABS_TEXTDOMAN ),
				)
			),	

			array(
				'title' => __( 'Top margin for Left side (Pixel)', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc' 		=> __( 'Extra Button Left Top', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_eb_left_top',
				'css' 		=> 'width:50px;',
				'default'	=> '100',
				'type' 		=> 'text',
				'desc_tip'	=>  true,
			),
			array(
				'title' => __( 'Top margin for Right side (Pixel)', 'woocommerce' ),
				'desc' 		=> __( 'Extra Button Right Top', EXTRA_WOO_TABS_TEXTDOMAN ),
				'id' 		=> 'woocommerce_tab_eb_right_top',
				'css' 		=> 'width:50px;',
				'default'	=> '100',
				'type' 		=> 'text',
				'desc_tip'	=>  true,
			),
		
			array(
				'name'      => __( 'Default Image', EXTRA_WOO_TABS_TEXTDOMAN ),
				'desc'      => __( 'Add Default Image', EXTRA_WOO_TABS_TEXTDOMAN), 
				'id'        => 'pw_woocommerce_tabs_default_image',
				'std' 		=> '',         // for woocommerce < 2.0
				'default' 	=> '',         // for woocommerce >= 2.0
				'type'      => 'upload_tabs'
			),
			
			array( 'type' => 'sectionend', 'id' => 'pw_woocommerce_tabs_image_settings' )
		);
		
		return apply_filters( 'pw_woocommerce_tabs_tab_options', $options );
	}

	public function admin_fields_upload_tabs( $value ) {
			$upload_value = ( get_option( $value['id'] ) !== false && get_option( $value['id'] ) !== null ) ? 
								esc_attr( stripslashes( get_option($value['id'] ) ) ) :
								esc_attr( $value['std'] );
								
			?><tr valign="top">
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
				</th>
				<td class="forminp">
					<div class="form-field">
                        <div id="tabs_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo ( $upload_value!='' ? wp_get_attachment_thumb_url( $upload_value ) : woocommerce_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
                        <div style="line-height:60px;">
                            <input type="hidden" id="<?php echo esc_attr( $value['id'] ); ?>" name="<?php echo esc_attr( $value['id'] ); ?>" value="<?php echo $upload_value; ?>" />
                            <button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', EXTRA_WOO_TABS_TEXTDOMAN ); ?></button>
                            <button type="button" class="remove_image_button button"><?php _e( 'Remove image', EXTRA_WOO_TABS_TEXTDOMAN ); ?></button>
                        </div>
                        
                        <div class="clear"></div>
                    </div>	
					<?php echo $value['desc']; ?>
                </td>
			</tr>
			

			
			<script type="text/javascript">
			jQuery(document).ready(function(){
				
				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#pw_woocommerce_tabs_default_image').val() )
					 jQuery('.remove_image_button').hide();
	
				// Uploading files
				var file_frame;
	
				jQuery(document).on( 'click', '.upload_image_button', function( event ){

					event.preventDefault();
	
					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}
					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', EXTRA_WOO_TABS_TEXTDOMAN ); ?>',
						button: {
							text: '<?php _e( 'Use image', EXTRA_WOO_TABS_TEXTDOMAN ); ?>',
						},
						multiple: false
					});
	
					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();
	
						jQuery('#pw_woocommerce_tabs_default_image').val( attachment.id );
						jQuery('#tabs_thumbnail img').attr('src', attachment.url );
						jQuery('.remove_image_button').show();
					});
	
					// Finally, open the modal.
					file_frame.open();
				});
	
				jQuery(document).on( 'click', '.remove_image_button', function( event ){
					jQuery('#tabs_thumbnail img').attr('src', '<?php echo woocommerce_placeholder_img_src(); ?>');
					jQuery('#pw_woocommerce_tabs_default_image').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});
			});
			</script>
			
			<?php
	}
	/**
	* Save the admin field: slider
	*
	* @access public
	* @param mixed $value
	* @return void
	* @since 1.0.0
	*/
	public function admin_update_option_tabs($value) {
		update_option( $value['id'], woocommerce_clean($_POST[$value['id']]) );
	}
	
}
new pw_woocommerc_WC_List_Grid_WC_Admin_Tabs();
?>