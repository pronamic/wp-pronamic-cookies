<?php

/**
 * Plugin Name: Pronamic Cookie Law
 * Plugin URI: http://www.pronamic.nl
 * Author: Pronamic
 * Author URI: http://www.pronamic.nl
 * Description: Plugin to follow e-Privacy law.
 */

define( 'PRONAMIC_CL_BASE', dirname( __FILE__ ) );

/**
 * Method to load classes for this plugin
 *
 * @param unknown $class | string | The auto passed name of class
 */
function pronamic_cookie_law_autoload( $class ) {
	$class = strtolower( str_replace( '_' , '-', $class ) );

	$classFile = PRONAMIC_CL_BASE . '/classes/class-'. $class . '.php';

	if ( file_exists( $classFile ) )
		require_once $classFile;
}

spl_autoload_register( 'pronamic_cookie_law_autoload' );

/**
 * Method to load views for this plugin
 *
 * @param unknown $name   | string | The name of the view (with folders)
 * @param unknown $vars   | array  | Collection of passed variables that are required in the view
 * @param unknown $return | bool | Wether to show to browser or return the view as a string.
 */
function pronamic_cookie_law_view( $name, $vars = array(), $return = false ) {
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

$pronamic_cookie_law = new Pronamic_Cookie_Law;

if ( is_admin() )
	$pronamic_cookie_law_admin = new Pronamic_Cookie_Law_Admin;
