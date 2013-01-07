<?php

class Pronamic_Cookie_Law_Admin {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function admin_menu() {
		add_submenu_page(
			'options-general.php',
			__( 'Pronamic Cookie Law', 'pronamic_cookie_law' ),
			__( 'Pronamic Cookie Law', 'pronamic_cookie_law' ),
			'manage_options',
			'pronamic_cookie_law_options_page',
			array( $this, 'display_options_page' )
		);
	}

	public function display_options_page() {
		pronamic_cookie_law_view( 'views/admin/display_options_page' );
	}

	public function register_settings() {

		add_settings_section(
			'pronamic_cookie_law_options',
			__( 'Pronamic Cookie Law Options', 'pronamic_cookie_law' ),
			array( $this, 'settings_section' ),
			'pronamic_cookie_law_options_page'
		);

		add_settings_field(
			'pronamic_cookie_law_location',
			__( 'Location', 'pronamic_cookie_law' ),
			array( $this, 'select' ),
			'pronamic_cookie_law_options_page',
			'pronamic_cookie_law_options',
			array(
				'name' => 'pronamic_cookie_law_location',
				'options' => array(
					array(
						'name' => __( 'Top', 'pronamic_cookie_law' ),
						'value' => 'top'
					),
					array(
						'name' => __( 'Bottom', 'pronamic_cookie_law' ),
						'value' => 'bottom'
					)
				)
			)
		);

		add_settings_field(
			'pronamic_cookie_law_text',
			__( 'Text', 'pronamic_cookie_law' ),
			array( $this, 'text' ),
			'pronamic_cookie_law_options_page',
			'pronamic_cookie_law_options',
			array( 'name' => 'pronamic_cookie_law_text' )
		);

		register_setting ( 'pronamic_cookie_law_options', 'pronamic_cookie_law_location' );
		register_setting ( 'pronamic_cookie_law_options', 'pronamic_cookie_law_text' );
	}

	public function settings_section() {}

	public function text( $args ) {
		printf(
			'<input name="%s" id="%s" type="text" value="%s" class="%s" />',
			esc_attr( $args['name'] ),
			esc_attr( $args['name'] ),
			esc_attr( get_option( $args['name'] ) ),
			'regular-text code'
		);
	}

	public function select( $args ) {
		$chosen = get_option( $args['name'] );

		$html = "<select name='{$args['name']}'>";

		foreach ( $args['options'] as $option ) {
			if ( $chosen == $option['value'] ) {
				$html .= "<option value='{$option['value']}' selected='selected'>{$option['name']}</option>";
			}
			else {
				$html .= "<option value='{$option['value']}'>{$option['name']}</option>";
			}
		}

		$html .= '</select>';

		echo $html;
	}

	public function textarea( $args ) {
		printf(
			'<textarea name="%s" id="%s" class="%s">%s</textarea>',
			esc_attr( $args['name'] ),
			esc_attr( $args['name'] ),
			'regular-text code',
			esc_attr( get_option( $args['name'] ) )
		);
	}

}
