<?php
/**
 * Deprecated functions from past Pronamic Cookies plugin versions. You shouldn't use these
 * functions and look for the alternatives instead. The functions will be removed in a later 
 * version.
 * 
 * @see http://core.trac.wordpress.org/browser/tags/3.5.1/wp-includes/deprecated.php
 */

function pcl_button( $name, $arguments = array() ) {
	_deprecated_function( __FUNCTION__, '0.2', 'pronamic_cookies_button()' );
	
	return pronamic_cookies_button( $name, $arguments );
}

function pcl_modal( $name, $arguments = array() ) {
	_deprecated_function( __FUNCTION__, '0.2', 'pronamic_cookies_modal()' );
	
	return pronamic_cookies_modal( $name, $arguments );
}
