<?php
/*
Plugin Name: Pronamic Cookies
Plugin URI: http://pronamic.eu/wp-plugins/cookies/
Description: Handy solutions to the new Cookie Law. Full site blocker or just a bar. You can also block specific sections of a page.

Version: 0.2.6
Requires at least: 3.2

Author: Pronamic
Author URI: http://pronamic.eu/

Text Domain: pronamic-cookies
Domain Path: /lang/

License: GPL

GitHub URI: https://github.com/pronamic/wp-pronamic-cookies
*/

define( 'PRONAMIC_CL_FILE',       __FILE__ );
define( 'PRONAMIC_CL_BASE',       dirname( PRONAMIC_CL_FILE ) );
define( 'PRONAMIC_CL_PLUGIN_DIR', basename( PRONAMIC_CL_BASE ) );


/**
 * Method to load classes for this plugin
 *
 * @param unknown $class | string | The auto passed name of class
 */
function pronamic_cookie_autoload( $class ) {
	$class = strtolower( str_replace( '_' , '-', $class ) );

	$class_file = PRONAMIC_CL_BASE .'/classes/class-'. $class . '.php';

	if ( file_exists( $class_file ) )
		require_once $class_file;
}

spl_autoload_register( 'pronamic_cookie_autoload' );

/**
 * Method to load views for this plugin
 *
 * @param unknown $name   | string | The name of the view (with folders)
 * @param unknown $vars   | array  | Collection of passed variables that are required in the view
 * @param unknown $return | bool | Wether to show to browser or return the view as a string.
 */
function pronamic_cookie_view( $name, $vars = array(), $return = false ) {
	extract( $vars );

	ob_start();

	include PRONAMIC_CL_BASE . DIRECTORY_SEPARATOR . $name . '.php';

	if ( true === $return ) {
		$buffer = ob_get_contents();
		@ob_end_clean();
		return $buffer;
	}

	ob_get_contents();
}

/**
 * ===========
 *
 * START PLUGIN
 *
 * ===========
 */

include PRONAMIC_CL_BASE . '/includes/functions.php';
include PRONAMIC_CL_BASE . '/includes/deprecated.php';

$pronamic_cookie = new Pronamic_Cookies();

if ( is_admin() )
	$pronamic_cookie_admin = new Pronamic_Cookies_Admin();
