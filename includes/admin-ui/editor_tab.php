<?php
	$custom_tab_options = array(
		'public_fields' =>$public_field_array,		
		$public_perfix.'tab_content' => ( ( $product_tab_use_all=='on' && $tab_content_changed=='yes' ) || ( $product_tab_use_all=='' ) ?  get_post_meta($post_id, $public_perfix.'tab_content', true) : get_post_meta(get_the_ID(),$perfix.'tab_content', true ) )
	);
	
	
?>
	<div id="<?php echo $perfix_tab;?>_tab" class="panel woocommerce_options_panel">
		<?php
        	include("public_fields.php");
		?>
        <div class="wt-admingeneral wt-advanced">
            <div class="wt-faqcnt ">
              <div class="wt-faqtitle expanded"><h4><?php _e('Advanced Setting',EXTRA_WOO_TABS_TEXTDOMAN);?></h4></div>
              <div class="wt-faqcontent wt-adminadvanced">
       			 <p class="form-field">
           <div class=" custom_tab_options" style="width:500px;margin-right: 5px;float:right">
                <label for="video_products_url"><?php _e('Editor :', EXTRA_WOO_TABS_TEXTDOMAN); ?></label>             								
                <p class="form-field product_field_type" >
                    <?php
                        $content =  @$custom_tab_options[$public_perfix.'tab_content'];
                        $editor_id = $public_perfix.'tab_content';
                        wp_editor( $content, $editor_id );
                    ?>
                </p>
            </div>
        </p>
        	  </div>
            </div>
         </div>
	</div>
    

    
    
