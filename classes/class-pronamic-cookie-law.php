<?php

class Pronamic_Cookie_Law
{
	public function __construct()
	{
		add_action( 'init', array( $this, 'init') );
	}

	public function init()
	{
		load_plugin_textdomain( 'pronamic_cookie_law', false, 'pronamic_cookie_law/lang/' );
	}
}