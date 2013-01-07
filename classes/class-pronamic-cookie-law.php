<?php

class Pronamic_Cookie_Law {
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		add_action( 'wp_footer', array( $this, 'show_message' ) );
	}

	public function init() {
		load_plugin_textdomain( 'pronamic_cookie_law', false, 'pronamic-cookie-law/lang/' );
	}

	public function styles() {
		wp_register_style( 'pronamic_cookie_law_style', plugins_url( 'pronamic-cookie-law/assets/pronamic-cookie-law-style.css' ) );
		wp_enqueue_style( 'pronamic_cookie_law_style' );
	}

	public function scripts() {
		wp_register_script( 'pronamic_cookie_law_js', plugins_url( 'pronamic-cookie-law/assets/pronamic-cookie-law.js' ), 'jquery' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'pronamic_cookie_law_js' );
	}

	public function show_message() {
		$viewed = $_COOKIE['pcl_viewed'];

		if ( !isset( $viewed ) ) {
			pronamic_cookie_law_view( 'views/message', array(
					'position' => get_option( 'pronamic_cookie_law_location' ),
					'message' => get_option( 'pronamic_cookie_law_text ' )
				) );
		}
	}
}
