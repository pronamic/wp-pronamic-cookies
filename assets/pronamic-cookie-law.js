jQuery( function() {
	jQuery('.pronamic_cookie_close_button').click(function(){
		jQuery('#pronamic_cookie_holder').hide();
		document.cookie = escape('pcl_viewed') + "=" + escape(1) + "; path=/";
	});
} );