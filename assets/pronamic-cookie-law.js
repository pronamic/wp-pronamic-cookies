jQuery( function() {
	jQuery('.pronamic_cookie_law_close_button').click(function(){
		jQuery('#pronamic_cookie_law_holder').hide();
		document.cookie = escape('pcl_viewed') + "=" + escape(1) + "; path=/";
	});
} );