<div class="wt-admingeneral">
    <div class="wt-faqcnt ">
      <div class="wt-faqtitle"><h4><?php _e('General Setting',EXTRA_WOO_TABS_TEXTDOMAN);?></h4></div>
      <div class="wt-faqcontent">
        <div class="options_group wt-publicfield">
           
            
            <?php 
                woocommerce_wp_checkbox( 
                array( 
                    'id'            => $public_perfix.'tab_enabled', 
                    'label' => __('Enable Custom Tab?', EXTRA_WOO_TABS_TEXTDOMAN), 
                    'description' => __('Enable this option to display the custom tab on the frontend.', EXTRA_WOO_TABS_TEXTDOMAN),
                    'value' =>  $custom_tab_options['public_fields'][$public_perfix.'tab_enabled'], 
                    'cbvalue' => 'yes',
                    )
                );
                
            ?>
    
            <?php
                woocommerce_wp_text_input( 
                    array( 
                        'id'          => $public_perfix.'tab_title', 
                        'label'       => __( 'Custom Tab Title', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'placeholder' => '',
                        'desc_tip'    => 'true',
                        'description' => __( 'Enter your custom tab title.', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value' 	   => @$custom_tab_options['public_fields'][$public_perfix.'tab_title'] 
                    )
                );
            ?>	
            
            <?php
                // Textarea
                woocommerce_wp_textarea_input( 
                    array( 
                        'id'          => $public_perfix.'tab_description', 
                        'label'       => __( 'Text Content', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'placeholder' => __( 'Enter Content', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description' => '',
                        'value' 	   => @$custom_tab_options['public_fields'][$public_perfix.'tab_description']
                    )
                );
            ?>
            
           <?php woocommerce_wp_checkbox( array( 'id' => $public_perfix.'tab_sticky_enabled', 'label' => __('Enable Sticky Button?', EXTRA_WOO_TABS_TEXTDOMAN ), 'description' => __('Enable/Disable Sticky Button.', EXTRA_WOO_TABS_TEXTDOMAN) ) ); ?>
            
            <?php 
                // Select
                woocommerce_wp_select( 
                array( 
                    'id'      => $public_perfix.'tab_sticky_width',
                    'label'   => __( 'Content Width', EXTRA_WOO_TABS_TEXTDOMAN ), 
                    'description'       => __( 'Enter Sticky Content Width.', EXTRA_WOO_TABS_TEXTDOMAN ),
                    'desc_tip'   		 => 'true',
                    'value' => $custom_tab_options['public_fields'][$public_perfix.'tab_sticky_width'],
                    'options' => array(
                        'pw-content-1'   =>  '2:3',
                        'pw-content-2'   =>  '1:2',
                        'pw-content-3' => '1:3',
                        'pw-content-4' => '1:4',
                        'pw-content-full' => __( 'Full', EXTRA_WOO_TABS_TEXTDOMAN ),
                        )
                    )
                );
				$dependency = array(
					'parent_id' => $public_perfix.'tab_sticky_enabled',
					'value'	  => 'true' 	
				);
				dependency($public_perfix.'tab_sticky_width',$dependency);
            ?>
            
            <?php 
                // Number Field
                woocommerce_wp_text_input( 
                    array( 
                        'id'                => $public_perfix.'tab_sticky_height',
                        'label'   => __( 'Content Height (Pixel)', EXTRA_WOO_TABS_TEXTDOMAN ), 
                        'description'       => __( 'Enter Sticky Content Height.', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'type'              => 'number', 
                        'value' => $custom_tab_options['public_fields'][$public_perfix.'tab_sticky_height'],
                        'custom_attributes' => array(
                                'step' 	=> 'any',
                                'min'	=> '0'
                            ) 
                    )
                );
    			$dependency = array(
					'parent_id' => $public_perfix.'tab_sticky_enabled',
					'value'	  => 'true' 	
				);
				dependency($public_perfix.'tab_sticky_height',$dependency);
            ?>
            
            <?php
                // Select
                woocommerce_wp_select( 
                array( 
                    'id'      => $public_perfix.'tab_sticky_position', 
                    'label'   => __( 'Sticky Button Position', EXTRA_WOO_TABS_TEXTDOMAN ),
                    'description'       => __( 'Choose Sticky Position', EXTRA_WOO_TABS_TEXTDOMAN ),
                    'desc_tip'    => 'true', 
                    'value' => $custom_tab_options['public_fields'][$public_perfix.'tab_sticky_position'],
                    'options' => array(
                        'pw-left-stick'   => __( 'Left Side', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'pw-right-stick'   => __( 'Right Side', EXTRA_WOO_TABS_TEXTDOMAN ),
                        )
                    )
                );
				$dependency = array(
					'parent_id' => $public_perfix.'tab_sticky_enabled',
					'value'	  => 'true' 	
				);
				dependency($public_perfix.'tab_sticky_position',$dependency);
            ?>
            <?php
                if($product_tab_use_all=='on')
                {
                    woocommerce_wp_checkbox( 
                    array( 
                        'id'            => $public_perfix.'tab_content_changed', 
                        'label'   => __( 'Content Changed', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'description' => __( 'If You Change Below Content, Please Check This Features', EXTRA_WOO_TABS_TEXTDOMAN ),
                        'value' =>  $custom_tab_options['public_fields'][$public_perfix.'tab_content_changed'], 
                        'cbvalue' => 'yes',
                        )
                    );
                }
            ?>            
        </div>
      </div>
    </div>
</div>