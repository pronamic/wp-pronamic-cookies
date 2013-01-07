<?php

class Pronamic_Cookies {
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		add_action( 'wp_footer', array( $this, 'show_message' ) );
	}

	public function init() {
		load_plugin_textdomain( 'pronamic-cookies', false, 'pronamic-cookies/lang/' );
	}

	public function styles() {
		wp_register_style( 'pronamic_cookie_style', plugins_url( 'pronamic-cookies/assets/pronamic-cookie-law-style.css' ) );
		wp_enqueue_style( 'pronamic_cookie_style' );
	}

	public function scripts() {
		wp_register_script( 'pronamic_cookie_js', plugins_url( 'pronamic-cookies/assets/pronamic-cookie-law.js' ), 'jquery' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'pronamic_cookie_js' );
	}

	public function show_message() {
		$viewed = ( isset( $_COOKIE['pcl_viewed'] )?: false );

		if (  ! $viewed ) {
			pronamic_cookie_view( 'views/message', array(
					'position' => get_option( 'pronamic_cookie_location' ),
					'message' => get_option( 'pronamic_cookie_text ' ),
					'link' => get_option( 'pronamic_cookie_link' )
				) );
		}
	}
}
