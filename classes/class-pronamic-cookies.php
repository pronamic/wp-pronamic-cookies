<?php

class Pronamic_Cookies {
	public $plugin_file;

	public $spiders = array(
		'Googlebot', 'Yammybot', 'Openbot',
		'Yahoo', 'Slurp', 'manbot', 'ia_archiver',
		'Lycos', 'Scooter', 'AltaVista', 'Teoma',
		'Gigabot', 'Googlebot-Mobile'
	);

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		add_action( 'template_redirect', array( $this, 'blocker' ) );

		add_action( 'wp_footer', array( $this, 'show_message' ) );

	}

	public function init() {
		load_plugin_textdomain( 'pronamic-cookies', false, PRONAMIC_CL_PLUGIN_DIR . '/lang/' );
	}

	public function styles() {
		wp_register_style( 'pronamic_cookie_style', plugins_url( PRONAMIC_CL_PLUGIN_DIR . '/assets/pronamic-cookie-law-style.css' ) );
		wp_enqueue_style( 'pronamic_cookie_style' );
	}

	public function scripts() {
		wp_register_script( 'pronamic_cookie_js', plugins_url( PRONAMIC_CL_PLUGIN_DIR . '/assets/pronamic-cookie-law.js' ), array( 'jquery' ) );
		wp_enqueue_script( 'pronamic_cookie_js' );
	}

	public function show_message() {
		$viewed = ( isset( $_COOKIE['pcl_viewed'] ) ? : false );

		$bar_active = get_option( 'pronamic_cookie_base_active' );

		if (  ! $viewed && $bar_active == 1 ) {
			pronamic_cookie_view( 'views/message', array(
				'position' => get_option( 'pronamic_cookie_location' ),
				'message'  => get_option( 'pronamic_cookie_text ' ),
				'link'     => get_option( 'pronamic_cookie_link' )
			) );
		}
	}

	public function blocker()
	{
		$blocker_active = get_option( 'pronamic_cookie_blocker_active' );

		if ( $blocker_active == 1 && ! $this->is_a_spider() && ! isset( $_COOKIE['pcl_viewed'] ) )
		{
			// intercept!
			pronamic_cookie_view( 'views/blocker', array(
				'javascript_url' => plugins_url( PRONAMIC_CL_PLUGIN_DIR . '/assets/pronamic-cookie-law.js' ),
				'title' => get_option( 'pronamic_cookie_blocker_title' ),
				'text' => get_option( 'pronamic_cookie_blocker_text' ),
				'image' => get_option( 'pronamic_cookie_blocker_image' ),
				'color' => get_option( 'pronamic_cookie_blocker_bgcolor' ),
				'cookie_law_link_show' => get_option( 'pronamic_cookie_blocker_show_link' ),
				'cookie_law_link' => get_option( 'pronamic_cookie_link' ),
				'accept_button_text' => __( 'Accept', 'pronamic-cookies' ),
				'law_link_text' => __( 'Read more about the cookies on this site here', 'pronamic-cookies' ),
			) );

			exit;

		}
	}

	public function is_a_spider()
	{
		if ( array_search( $_SERVER['HTTP_USER_AGENT'], $this->spiders ) === false )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
