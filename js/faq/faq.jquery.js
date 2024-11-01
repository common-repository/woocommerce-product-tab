// JavaScript Document
jQuery(window).load(function(){
	jQuery(".wt-faqcontent").hide();
	jQuery(".wt-adminadvanced").show();
	jQuery(".wt-faqtitle").click(function () {
		
		jQuery(this).next(".wt-faqcontent").slideToggle(500);
		jQuery(this).toggleClass("expanded");
	});
});
