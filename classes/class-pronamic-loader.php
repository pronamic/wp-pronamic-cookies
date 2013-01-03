<?php

class Pronamic_Loader
{
	public static function autoload($class)
	{
		$class = strtolower( str_replace( '_' , '-', $class ) );

		$classFile = PRONAMIC_FEEDS_BASE . '/classes/class-'. $class . '.php';

		if( file_exists( $classFile ) )
			require_once $classFile;
	}

	public static function view( $name, $vars = array(), $return = false )
	{
		extract( $vars );

		ob_start();

		include(PRONAMIC_FEEDS_BASE . DIRECTORY_SEPARATOR . $name . '.php' );

		if( true === $return )
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}

		ob_get_contents();
	}
}