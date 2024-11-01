<?php
	$content = apply_filters( 'the_content', $custom_tab_options['content'] );
	$content = str_replace( ']]>', ']]&gt;', $content );

	echo apply_filters( 'woocommerce_custom_product_tabs_panel_content', $content, $custom_tab_options );
?>