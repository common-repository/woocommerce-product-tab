jQuery(document).ready(function($) {
	jQuery('.iconpicker i').click(function(){
		var val=(jQuery(this).attr('class').split(' ')[0]!='fa-none' ? jQuery(this).attr('class').split(' ')[0]:"");
		jQuery('#font_icon').val(val);
		jQuery(this).siblings( '.active' ).removeClass( 'active' );
		jQuery(this).addClass('active');
	});
	
	
	//ADD TAB PAGE	
	jQuery('#product_tab_type').change(function(){
		jQuery('#product_tab_type > option').each(function() {
			var type=jQuery(this).val();
			jQuery('#'+type+'_setting_area').hide();
		});
		jQuery('#product_tab_use_all').attr('checked', false);
		var type=jQuery(this).val();
	});
	
	jQuery('#product_tab_type > option').each(function() {
		var type=jQuery(this).val();
		jQuery('#'+type+'_setting_area').hide();
	});
	
	jQuery('#product_tab_use_all').click(function(){
		var type=jQuery('#product_tab_type').val();
		if(jQuery(this).is(":checked"))
		{
			jQuery('#'+type+'_setting_area').show();
		}else {
			jQuery('#'+type+'_setting_area').hide();
		}
	});
	
	if(jQuery('#product_tab_use_all').is(":checked"))
	{
		var type=jQuery('#product_tab_type').val();
		jQuery('#'+type+'_setting_area').show();
	}
	//END TAB PAGE SCRIPS
	
	
	

});