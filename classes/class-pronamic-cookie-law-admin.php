<?php

class Pronamic_Cookie_Law_Admin
{
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function admin_menu()
	{
		add_submenu_page( 
			'options-general.php', 
			__( 'Pronamic Cookie Law', 'pronamic_cookie_law' ), 
			__( 'Pronamic Cookie Law', 'pronamic_cookie_law' ), 
			'manage_options', 
			'pronamic_cookie_law', 
			array( $this, 'display_options_page' )
		);
	}

	public function display_options_page()
	{
		pronamic_cookie_law_view( 'views/admin/display_options_page' );
	}

	public function register_settings()
	{
		$input = new Pronamic_Settings;

		add_settings_section( 
			'pronamic_cookie_law_options', 
			__('Pronamic Cookie Law Options', 'pronamic_cookie_law' ), 
			array( $this, 'settings_section' ), 
			'pronamic_cookie_law' 
		);
	}

}