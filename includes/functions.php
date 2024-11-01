<?php

if (!function_exists('excerpt')){
	function excerpt($excerpt,$limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}}

if (!function_exists('dp_add_to_carta')){
	function dp_add_to_carta() {
	global $product;

	if (!$product->is_in_stock()) :

		//return '<a href="' . apply_filters('out_of_stock_add_to_cart_url', get_permalink($product->id)) . '" class="dp-button">' . apply_filters('out_of_stock_add_to_cart_text', __('Read More', DP_TEXTDOMAN)) . '</a>';

	else :
		$link = array(
			'url' => '',
			'label' => '',
			'class' => ''
		);

		$handler = apply_filters('woocommerce_add_to_cart_handler', $product->product_type, $product);

		switch ($handler) {
			case "variable" :
				$link['url'] = apply_filters('variable_add_to_cart_url', get_permalink($product->id));
				$link['label'] = apply_filters('variable_add_to_cart_text wt-addtocart', __('Select options', EXTRA_WOO_TABS_TEXTDOMAN));
				break;
			case "grouped" :
				$link['url'] = apply_filters('grouped_add_to_cart_url', get_permalink($product->id));
				$link['label'] = apply_filters('grouped_add_to_cart_text', __('View options', EXTRA_WOO_TABS_TEXTDOMAN));
				break;
			case "external" :
				$link['url'] = apply_filters('external_add_to_cart_url', get_permalink($product->id));
				$link['label'] = $product->get_button_text();
				break;
			default :
				if ($product->is_purchasable()) {
					$link['url'] = apply_filters('add_to_cart_url', esc_url($product->add_to_cart_url()));
					$link['label'] = apply_filters('add_to_cart_text', __('Add to cart', EXTRA_WOO_TABS_TEXTDOMAN));
					$link['class'] = apply_filters('add_to_cart_class', 'add_to_cart_button wt-addtocart');
				} else {
					$link['url'] = apply_filters('not_purchasable_url', get_permalink($product->id));
					$link['label'] = apply_filters('not_purchasable_text', __('Read More', EXTRA_WOO_TABS_TEXTDOMAN));
					$link['class'] = apply_filters('add_to_cart_class', 'add_to_cart_button wt-postlink');
				}
				break;
		}

		return apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s  product_type_%s">%s</a>', esc_url($link['url']), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr($link['class']), esc_attr($product->product_type), esc_html($link['label'])), $product, $link);

	endif;
	}}
	
if (!function_exists('dp_get_imagea')){
	function dp_get_imagea($dpanimatehover) {
    global $product;
    if (has_post_thumbnail()) {
        $result='<div class="he-wrap tpl1">';
        if($dpanimatehover!='disable'){
            $attachment_ids = $product->get_gallery_attachment_ids();
            if ($attachment_ids) {
                $result.='<div class="he-view">';
                foreach ($attachment_ids as $attachment_id) {
                    $result.='<div class="dp-img-wrapper">'; //img-hided
                    $result.= wp_get_attachment_image($attachment_id, 'display_product_thumbnail', 0, array('class' => "a0", 'data-animate' => $dpanimatehover));
                    $result.='</div>';
                    break;
                }
                $result.='</div>';
            }
        }
        $result.='<div class="dp-img-wrapper">';
        $result.=get_the_post_thumbnail($product->post->ID, 'display_product_thumbnail');
        $result.='</div>';
        $result.='</div>';
    }else {
        $result=woocommerce_placeholder_img();
    }
    return $result;
	}}
	
if (!function_exists('dp_get_sale_flasha')){
	function dp_get_sale_flasha() {
		global $post , $product;
		if ($product->is_on_sale()):
			return apply_filters('woocommerce_sale_flash', '<span class="wt-onsale">' . __('Sale!',EXTRA_WOO_TABS_TEXTDOMAN) . '</span>', $post, $product);
		endif;
	}}	

?>