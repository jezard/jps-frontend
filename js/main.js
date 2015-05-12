$(function () {
	jQuery('.main-nav-item').not('#demo').each(function(){
		var anchor = jQuery(this).find('a').attr('href');
		jQuery(this).css('cursor','pointer').on('click',function(){
			if(jQuery(this).attr('id') == 'signout'){
				gapi.auth.signOut();
			}
			window.location = anchor;

		});
	})
});


