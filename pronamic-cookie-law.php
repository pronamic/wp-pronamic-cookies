<?php

/**
 * Plugin Name: Pronamic Cookie Law
 * Plugin URI: http://www.pronamic.nl
 * Author: Pronamic
 * Author URI: http://www.pronamic.nl
 * Description: Plugin to follow e-Privacy law.
 */

define ( 'PRONAMIC_CL_BASE', dirname( __FILE__ ) );

require_once( PRONAMIC_CL_BASE . '/classes/class-pronamic-loader.php' );
spl_autoload_register( 'Pronamic_Loader::autoload' );

$pronamic_cookie_law = new Pronamic_Cookie_Law;

if( is_admin() )
	$pronamic_cookie_law_admin = new Pronamic_Cookie_Law_Admin;