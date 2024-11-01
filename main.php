<?php
/*
Plugin Name: Woocommerce Product Tab Pro
Plugin URI: http://proword.net/Woo_Tabs_Pro/
Description: Create Ultimate Tabs For Product and Then Set Dynamic Content There. These Tabs Display in Product Sinle Page(Append to Other Tabs).
Version: 1.0.1
Author: Proword
Author URI: http://proword.net/
Text Domain: extra_woo_tabs
Domain Path: /languages/
*/

/**
 * Check if WooCommerce is active
 **/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	define ('PL_URL',plugins_url('', __FILE__));
	define( 'EXTRA_WOO_TABS_TEXTDOMAN', 'extra_woo_tabs' );
	define ('PL_NOTACTIVE','<tr>
            <td>
                <p style="color:red">'.__('For use this type of tab you need ',EXTRA_WOO_TABS_TEXTDOMAN).'<a target="_blank" href="http://codecanyon.net/item/woocommerce-brands/8039481?ref=proword">'.__('Woocommerce Brands Plugin',EXTRA_WOO_TABS_TEXTDOMAN).'</a></p>
                <p>'.__('Please Install/Activate Woocommerce Brands Plugin.',EXTRA_WOO_TABS_TEXTDOMAN).'</p>
            </td>
        </tr>');
		
	define ('PL_DEMO','<tr>
            <td>
                <p style="color:red">'.__('To Buy Pro Version Please',EXTRA_WOO_TABS_TEXTDOMAN).' <a target="_blank" href="http://codecanyon.net/item/woocommerce-tabs-pro-extra-tabs-for-product-page/8218941?ref=proword?ref=proword">'.__('Click Here',EXTRA_WOO_TABS_TEXTDOMAN).'</a></p>
				<p style="color:red">
					'.__('Pro Version Feature:',EXTRA_WOO_TABS_TEXTDOMAN).'
					<br />
					<strong>11 different tab types</strong>
					<ol>
						<li><strong>Products : </strong>It is a great idea to offer another products when a customer is visiting a product. Choose products for different use.(Such as: Wear With, Use With, ...)</li>
						<li><strong>Download :</strong> You can add files for download in this type of tab.</li>
						<li><strong>Editor : </strong>In this type You`ll have an editor field which you can enter any content!!</li>
						<li><strong>FAQ : </strong>Include some FAQs for product(s).</li>
						<li><strong>Inquiry Form :</strong> If you need to provide a request form for product, You can choose this type.(Ajax Submit)</li>
						<li><strong>Map :</strong>Display map in tab. We provide three types for displaying map. Embed Map,Location point and Direct Address</li>
						<li><strong>Photo Gallery :</strong> Add unlimited photo for product</li>
						<li><strong>Related Posts :</strong> Another good feature is related post, for example you need to display some news or articles related to a product. </li>
						<li><strong>Short-codes : </strong>If you need to display any short-codes in product tab, you can use this type.</li>
						<li><strong>Video Gallery : </strong>If you have Some videos for product, Add this tab. You can choose displaying type from Grid or Slider.</li>
						<li><strong>Brands &amp; Category :</strong> Display All/Featured same brand Products</li>
					</ol>
				</p>
            </td>
        </tr>');	
	
	require_once('includes/customepost.php');
	require_once('includes/customefields.php');
	
	/**
	 * Localisation
	 **/
	add_action( 'init', 'plugin_inits' );
	function plugin_inits() {
		load_plugin_textdomain( EXTRA_WOO_TABS_TEXTDOMAN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	

	/**
	 * WC_List_Grid class
	 **/
	if (!class_exists('WC_List_Grid')) {
		
		class WC_List_Grid {
			
			var $counter=1;
			var $content_changed=false;
						
			public function __construct() {
				register_activation_hook( __FILE__ , array( $this, 'on_activation' ) );
				register_deactivation_hook( __FILE__ , array(  $this, 'on_deactivation' ) );
				$this->includes();
				// Enqueue Scripts and Styles in FRONT_END
				// Admin
				add_action( 'woocommerce_update_options_products', array( $this, 'save_admin_settings' ) );
				
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links_woo_tabs' ) );
			}
			

			function includes()
			{
				include_once( 'includes/embed.php' );
				include_once( 'class/setting-tabs.php' );
				include_once( 'includes/product_custom_tab.php' );
				include_once( 'includes/functions.php' );
			}

			/**
			 * Custom Tabs for Product Display. Compatible with WooCommerce 2.0+ only!
			 */
			 
			private function to_slug($string){
				return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
			} 
			 

			
			/**
			 * Custom Tab Options
			 */

			static $variable = 'static property';
			static function Variable()
			{
				echo 'Method Variable called';
			}
			


			/**
			 * Process meta
			 * 
			 * Processes the custom tab options when a post is saved
			 */
			 
			
			public function action_links_woo_tabs( $links ) {
				return array_merge( array(
					'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=pw_woocommerce_tabs' ) . '">' . __( 'Settings', 'Woocommerce-Tabs' ) . '</a>',
					'<a href="' . esc_url( apply_filters( 'woocommerce_docs_url', 'http://proword.net/Woo_Tabs_Pro/documentation/', 'woocommerce' ) ) . '">' . __( 'Docs', 'woocommerce-brands' ) . '</a>',
		
				), $links );
			}			
			
			public function on_deactivation(){
				delete_option('woocommerce_tab_light_color');
				delete_option('woocommerce_tab_dark_color');
				delete_option('woocommerce_tab_btn_color');
				delete_option('woocommerce_tab_btn_hover_color');
				delete_option('woocommerce_tab_icon_color');
				delete_option('woocommerce_tab_link_color');
				delete_option('woocommerce_tab_link_hover_color');
				delete_option('woocommerce_tab_hover_color');
				delete_option('woocommerce_tab_description_color');
				delete_option('woocommerce_tab_price_color');
				delete_option('woocommerce_tab_border_color');
				delete_option('woocommerce_tab_featured_color');
				delete_option('woocommerce_tab_featured_bg_color');
				delete_option('woocommerce_tab_default_theme');
				delete_option('woocommerce_tab_animation_type');
				delete_option('woocommerce_tab_eb_left_top');
				delete_option('woocommerce_tab_eb_right_top');
				delete_option('pw_woocommerce_tabs_default_image');
			}			

			public function on_activation() {
				update_option( 'woocommerce_tab_light_color', '#f7f7f7' );
				update_option( 'woocommerce_tab_dark_color' , '#414141' );
				update_option( 'woocommerce_tab_btn_color' , '#a7a7a7' );
				update_option( 'woocommerce_tab_btn_hover_color' , '#309af7' );
				update_option('woocommerce_tab_icon_color' , '#309af7' );
				update_option( 'woocommerce_tab_link_color' , '#bbbbbb' );
				update_option( 'woocommerce_tab_link_hover_color' , '#309af7' );
				update_option( 'woocommerce_tab_hover_color' , '#000000' );
				update_option( 'woocommerce_tab_description_color' , '#a7a7a7' );
				update_option( 'woocommerce_tab_price_color' , '#309af7' );
				update_option( 'woocommerce_tab_border_color' , '#636363' );
				update_option( 'woocommerce_tab_featured_color' , '#ffffff' );
				update_option( 'woocommerce_tab_featured_bg_color' , '#309af7' );
				update_option( 'woocommerce_tab_default_theme' , 'no' );
				update_option( 'woocommerce_tab_animation_type' , 'no_animation' );
				update_option( 'woocommerce_tab_eb_left_top' , '100' );
				update_option( 'woocommerce_tab_eb_right_top' , '100' );				
			}
//			public function on_deactivation() {}
			
		}
		$GLOBALS['WC_List_Grid'] = new WC_List_Grid();
		
		//register_activation_hook(   __FILE__, array( 'WC_List_Grid', 'on_activation' ) );
		//register_deactivation_hook( __FILE__, array( 'WC_List_Grid', 'on_deactivation' ) );
		//register_uninstall_hook(    __FILE__, array( 'WCM_Setup_Demo_Class', 'on_uninstall' ) );
	}
	


}
