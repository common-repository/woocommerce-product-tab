<?php

include('actions.php');
add_action( 'admin_head', 'eb_admin_add_scripts' );	

function eb_admin_add_scripts(){

	//FONTAWESOME STYLE
	wp_register_style('font-awesome', PL_URL.'/css/font-awesome.css');
	wp_enqueue_style('font-awesome');
	
	wp_register_style('style_st', PL_URL.'/css/style.css');
	wp_enqueue_style('style_st');
	
	wp_register_style('faq_style', PL_URL.'/css/faq/faq.css');
	wp_enqueue_style('faq_style');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('tiny_mce');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_media ();
	wp_enqueue_script('dc_gt_admin',PL_URL.'/js/admin.js',array( 'jquery' ));
	wp_localize_script( 'dc_gt_admin', 'translate', array(
		'no_file_uploaded' => __( 'No File Uploaded', EXTRA_WOO_TABS_TEXTDOMAN ),
		'file_uploaded' => __( 'File Uploaded', EXTRA_WOO_TABS_TEXTDOMAN ),
	) );
		
	wp_enqueue_script('faq-script',PL_URL.'/js/faq/faq.jquery.js',array( 'jquery' ));	
    	
	//font-awesome select for edit post
	//echo ' <script src="//code.jquery.com/jquery-1.10.2.js">
	global $custom_fields_product_tab, $post;
	$output = '<script type="text/javascript"> jQuery(document).ready(function(jQuery){

		';
		$slider=1;
		foreach ($custom_fields_product_tab as $field) {
			if ($field['type'] == 'icon_type') {
				if(is_object( $post)){
					$value = get_post_meta($post->ID, $field['id'], true);
					if ($value == '') $value ="fa-none";
					$output .= 'jQuery( ".'.$value.'" ).siblings( ".active" ).removeClass( "active" );
					jQuery( ".'.$value.'" ).addClass("active");';
				}
			}
		}
		$output .= '
			
			
			
			
		}); 
	</script>';  
	echo $output;
	
	function dependency($element_id,$args)
	{}
	
}
	

add_action('wp_enqueue_scripts','eb_add_scripts');

//enqueue script to the front end -> wp_enqueue_scripts
function eb_add_scripts(){
	
	wp_register_style('front_end_style', PL_URL.'/css/front-style.css');
	wp_enqueue_style('front_end_style');

	wp_register_style('font-awesome', PL_URL.'/css/font-awesome.css');
	wp_enqueue_style('font-awesome');
	
	/*******************************MY CSS**********/
	////////////////////////////////////////////////
	
	wp_enqueue_style('slider-style', PL_URL.'/css/slick-slider/slick.css', array() , null);

	wp_enqueue_style( 'grid-style', PL_URL.'/css/grid/grid.css', array() , null );
	
	wp_enqueue_style( 'effect-style', PL_URL.'/css/effects.css', array() , null );
	
	wp_enqueue_style('lightbox-style', PL_URL.'/css/lightbox/lightbox.css', array() , null);
	
	wp_enqueue_style('faq-style', PL_URL.'/css/faq/faq.css', array() , null);
	
	wp_enqueue_style('map-style', PL_URL.'/css/map/map.css', array() , null);
	
	wp_enqueue_style('video-style', PL_URL.'/css/video/video-js.css', array() , null);
	
	wp_enqueue_style('tooltip-style', PL_URL.'/css/tooltip/tipsy.css', array() , null);
	
	wp_enqueue_style('extra-button-style', PL_URL.'/css/extra-button/extra-style.css', array() , null);
	
	wp_enqueue_style('scroller-style', PL_URL.'/css/scroll/tinyscroller.css', array() , null);
	if (get_option('woocommerce_tab_animation_type')!='no_animation'){
		wp_enqueue_style('animation-style', PL_URL.'/css/animation/animation.css', array() , null);
	}
	
	
	/*******************************MY JS**********/
	////////////////////////////////////////////////
	

	wp_enqueue_script( 'slider-script', PL_URL.'/js/slick-slider/slick.js', array( 'jquery' ));
	
	wp_enqueue_script( 'lightbox-script', PL_URL.'/js/lightbox/lightbox-2.6.min.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'scripts-script', PL_URL.'/js/scripts.js', array( 'jquery' ) );
	wp_enqueue_script( 'video-script', PL_URL.'/js/video/video.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'tooltip-script', PL_URL.'/js/tooltip/jquery.tipsy.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'extra-button-script', PL_URL.'/js/extra-button/extra-button.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'scroller-script', PL_URL.'/js/scroll/tinyscroller.js', array( 'jquery' ) , true );
	
	wp_enqueue_script( 'map', 'https://maps.googleapis.com/maps/api/js', array( 'jquery' ),true );
	
	
	wp_enqueue_script( 'faq-script', PL_URL.'/js/faq/faq.jquery.js', array( 'jquery' ) );
	if (get_option('woocommerce_tab_animation_type')!='no_animation'){
		wp_enqueue_script( 'animation-script', PL_URL.'/js/animation/animation.js', array( 'jquery' ) );
	}
}

function dynamic_style() {
	$light_skin_color = get_option( 'woocommerce_tab_light_color' ); //E.g. #FF0000
	$dark_skin_color = get_option( 'woocommerce_tab_dark_color' ); //E.g. #FF0000
	$btn_color = get_option( 'woocommerce_tab_btn_color' ); //E.g. #FF0000
	$btn_hover_color = get_option( 'woocommerce_tab_btn_hover_color' ); //E.g. #FF0000
	$icon_color = get_option( 'woocommerce_tab_icon_color' ); //E.g. #FF0000
	$link_color = get_option( 'woocommerce_tab_link_color' ); //E.g. #FF0000
	$link_hover_color = get_option( 'woocommerce_tab_link_hover_color' ); //E.g. #FF0000
	$hover_color = get_option( 'woocommerce_tab_hover_color' ); //E.g. #FF0000
	$description_color = get_option( 'woocommerce_tab_description_color' ); //E.g. #FF0000
	$price_color = get_option( 'woocommerce_tab_price_color' ); //E.g. #FF0000
	$border_color = get_option( 'woocommerce_tab_border_color' ); //E.g. #FF0000
	$featured_color = get_option( 'woocommerce_tab_featured_color' ); //E.g. #FF0000
	$featured_bg_color = get_option( 'woocommerce_tab_featured_bg_color' ); //E.g. #FF0000
	?>
<style type = "text/css">
  .wt-carskin-light1 .wt-detailcnt,.wt-carskin-light2 .wt-detailcnt{
    background: <?php echo $light_skin_color; ?>;
  }
  .wt-carskin-dark1 .wt-detailcnt , .wt-carskin-dark2 .wt-detailcnt{
    background: <?php echo $dark_skin_color; ?>;
  }
  .wt-downlink a{ color:<?php echo $btn_color ?>!important;border-color:<?php echo $btn_color; ?>!important}
   .wt-downlink a:hover{ color:<?php echo $btn_hover_color; ?>!important;border-color:<?php echo $btn_hover_color; ?>!important}
  .wt-itemcnt .wt-overally.fadein-eff{ background-color:<?php echo $hover_color; ?>;  }
  .wt-link-icon , .wt-zoom-icon{ color:<?php echo $icon_color; ?>!important; }
  .wt-title a{ color:<?php echo $link_color; ?>!important; }
   .wt-title a:hover{ color:<?php echo $link_hover_color; ?>!important; }
  
  .wt-text{ color:<?php echo $description_color; ?> }
  .wt-detailcnt .wt-price-vis ins{ color:<?php echo $price_color; ?>  }
  .wt-carskin-dark2 .wt-detailcnt .wt-title, .wt-carskin-dark2 .wt-detailcnt .wt-text, .wt-carskin-dark2 .wt-detailcnt .wt-price-vis{  border-color:<?php echo $border_color; ?>!important; }
  .wt-notify , .wt-onsale{ background:<?php echo $featured_bg_color; ?>; color:<?php echo $featured_color; ?>;  }
 </style>
	<?php
}
add_action( 'wp_head', 'dynamic_style' );


add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
function load_custom_wp_admin_style() {
	
	wp_register_style( 'chosen_css_1', PL_URL.'/css/chosen/chosen.css', false, '1.0.0' );
	wp_enqueue_style( 'chosen_css_1' );
	
	wp_register_script( 'chosen_js1', PL_URL.'/js/chosen/chosen.jquery.js' , false, '1.0.0' );
	wp_enqueue_script( 'chosen_js1' );
	
	wp_register_script( 'chosen_js', PL_URL.'/js/chosen/chosen.ajaxaddition.jquery.js', false, '1.0.0' );
	wp_enqueue_script( 'chosen_js' );

}


?>