<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

// Delete options
delete_option( 'pronamic_cookie_location' );
delete_option( 'pronamic_cookie_text' );
delete_option( 'pronamic_cookie_link' );
