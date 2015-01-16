$(function () {
	jQuery('.main-nav-item').each(function(){
		var anchor = jQuery(this).find('a').attr('href');
		jQuery(this).css('cursor','pointer').on('click',function(){
			window.location = anchor;
		});
	})
});