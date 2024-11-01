// JavaScript Document
jQuery(document).ready(function() {
  jQuery.fn.visible = function(partial) {
      var $t            = jQuery(this),
          $w            = jQuery(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };

	 var win = jQuery(window);
	 
	 var allMods = jQuery(".animate");
	 var j=1;
	 allMods.each(function(i, el) {
	   var el = jQuery(el);
	   //if (el.visible(true)) {
	  //setTimeout(function(){     
		  if (el.hasClass('slidedown-animation'))    
		   el.removeClass("animate").addClass('slideDown animation-triggered');
		  
		  if (el.hasClass('slideup-animation'))    
		   el.removeClass("animate").addClass('slideUp animation-triggered');
		  
		  if (el.hasClass('slideleft-animation'))    
		   el.removeClass("animate").addClass('slideLeft animation-triggered');
		  
		  if (el.hasClass('slideright-animation'))    
		   el.removeClass("animate").addClass('slideRight');
		   
		  if (el.hasClass('expandup-animation'))    
		   el.removeClass("animate").addClass('expandUp animation-triggered');
		  
		  if (el.hasClass('expandopen-animation'))    
		   el.removeClass("animate").addClass('expandOpen animation-triggered');
		  
		  if (el.hasClass('fadein-animation'))    
		   el.removeClass("animate").addClass('fadeIn animation-triggered');
		  
		  if (el.hasClass('stretchright-animation'))    
		   el.removeClass("animate").addClass('stretchRight animation-triggered');
		//  },(i*1000));  
	   j++;  
	   //} 
 });

 win.scroll(function(event) {
  var j=1;
   var allMods = jQuery(".animate");
   allMods.each(function(i, el) {
  var el = jQuery(el);
  if (el.visible(true)) {
   setTimeout(function(){
    if (el.hasClass('slidedown-animation'))    
     el.removeClass("animate").addClass('slideDown animation-triggered');
    
    if (el.hasClass('slideup-animation'))    
     el.removeClass("animate").addClass('slideUp animation-triggered');
    
    if (el.removeClass("animate").hasClass('slideleft-animation'))    
     el.removeClass("animate").addClass('slideLeft animation-triggered');
    
    if (el.hasClass('slideright-animation'))    
     el.removeClass("animate").addClass('slideRight');
     
    if (el.hasClass('expandup-animation'))    
     el.removeClass("animate").addClass('expandUp animation-triggered');
    
    if (el.hasClass('expandopen-animation'))    
     el.removeClass("animate").addClass('expandOpen animation-triggered');
    
    if (el.hasClass('fadein-animation'))    
     el.removeClass("animate").addClass('fadeIn animation-triggered');
    
    if (el.hasClass('stretchright-animation'))    
     el.removeClass("animate").addClass('stretchRight animation-triggered');
   },(j*70));
   j++;
  }
  
   });
   
 });
});
