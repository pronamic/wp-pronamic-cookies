<?php

class Pronamic_Cookies_Admin {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );

		add_action( 'save_post', array( $this, 'save_pronamic_cookie_block_meta_box' ) );
	}

	public function admin_menu() {
		add_submenu_page(
			'options-general.php',
			__( 'Pronamic Cookies', 'pronamic-cookies' ),
			__( 'Pronamic Cookies', 'pronamic-cookies' ),
			'manage_options',
			'pronamic_cookie_options_page',
			array( $this, 'display_options_page' )
		);
	}

	public function meta_boxes()
	{
		add_meta_box(
			'pronamic-cookie-block',
			__( 'Cookie Block Details', 'pronamic-cookies' ),
			array( $this, 'view_pronamic_cookie_block_meta_box' ),
			'pronamic_cblock',
			'normal',
			'high'
		);
	}

	public function view_pronamic_cookie_block_meta_box()
	{
		global $post;

		// Get the meta information
		$block_information = get_post_meta( get_the_ID(), 'pronamic_cblock_details', true );

		// Check that some exist for this id (and is an array)
		if ( ! $block_information || ! is_array( $block_information ) )
			$block_information = array();

		// Default values
		$pronamic_cblock_blocked_content = '';

		// Extra those values from the block information meta
		extract( $block_information, EXTR_IF_EXISTS );

		// Generate nonce
		$nonce = wp_nonce_field( 'pronamic_cblock', 'pronamic_cblock_nonce', true, false );

		pronamic_cookie_view( 'views/admin/view_pronamic_cookie_block_meta_box', array(
			'block_content' => $pronamic_cblock_blocked_content,
			'nonce' => $nonce
		) );

	}

	public function save_pronamic_cookie_block_meta_box( $post_id )
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		if ( ! isset( $_POST['pronamic_cblock_nonce'] ) )
			return;

		if ( ! wp_verify_nonce( $_POST['pronamic_cblock_nonce'], 'pronamic_cblock' ) )
			return;

		$block_information = get_post_meta( get_the_ID(), 'pronamic_cblock_details', true );

		if ( ! $block_information || ! is_array( $block_information ) )
			$block_information = array();

		$block_information['pronamic_cblock_blocked_content'] = $_POST['pronamic_cblock_blocked_content'];

		update_post_meta( $post_id, 'pronamic_cblock_details', $block_information );

	}

	public function display_options_page() {
		pronamic_cookie_view( 'views/admin/display_options_page' );
	}

	public function register_settings() {
		add_settings_section(
			'pronamic_cookie_options',
			__( 'Pronamic Cookies Options', 'pronamic-cookies' ),
			array( $this, 'settings_section' ),
			'pronamic_cookie_options_page'
		);

		add_settings_field(
			'pronamic_cookie_location',
			__( 'Location', 'pronamic-cookies' ),
			array( $this, 'select' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_options',
			array(
				'label_for' => 'pronamic_cookie_location',
				'options'   => array(
					array(
						'label_for' => __( 'Top', 'pronamic-cookies' ),
						'value'     => 'top'
					),
					array(
						'label_for' => __( 'Bottom', 'pronamic-cookies' ),
						'value'     => 'bottom'
					)
				)
			)
		);

		add_settings_field(
			'pronamic_cookie_text',
			__( 'Text', 'pronamic-cookies' ),
			array( $this, 'text' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_options',
			array( 'label_for' => 'pronamic_cookie_text' )
		);

		add_settings_field(
			'pronamic_cookie_link',
			__( 'Link', 'pronamic-cookies' ),
			array( $this, 'text' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_options',
			array( 'label_for' => 'pronamic_cookie_link' )
		);

		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_location' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_text' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_link', array( $this, 'verifiy_url' ) );
	}

	public function settings_section() {}

	public function text( $args ) {
		printf(
			'<input name="%s" id="%s" type="text" value="%s" class="%s" />',
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			esc_attr( get_option( $args['label_for'] ) ),
			'regular-text code'
		);
	}

	public function select( $args ) {
		$chosen = get_option( $args['label_for'] );

		$html = "<select name='{$args['label_for']}'>";

		foreach ( $args['options'] as $option ) {
			if ( $chosen == $option['value'] ) {
				$html .= "<option value='{$option['value']}' selected='selected'>{$option['label_for']}</option>";
			}
			else {
				$html .= "<option value='{$option['value']}'>{$option['label_for']}</option>";
			}
		}

		$html .= '</select>';

		echo $html;
	}

	public function textarea( $args ) {
		printf(
			'<textarea name="%s" id="%s" class="%s">%s</textarea>',
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			'regular-text code',
			esc_attr( get_option( $args['label_for'] ) )
		);
	}

	public function verifiy_url( $raw_url )
	{
		if( empty( $raw_url) || 'http://' == $raw_url )
			return;

		$url = parse_url( $raw_url );
		
		if( ! $url || ! isset( $url['scheme'] ) ) {
			$raw_url = 'http://' . $raw_url;
		}

		return filter_var( $raw_url, FILTER_VALIDATE_URL );
	}
}
