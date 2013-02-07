<?php

class Pronamic_Cookies_Admin {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
	}

	public function scripts() {
		wp_register_script( 'pronamic_cookie_admin_js', plugins_url( 'assets/pronamic-cookie-law-admin.js', PRONAMIC_CL_PLUGIN_DIR ), array( 'jquery', 'wp-color-picker' ) );
		wp_enqueue_script( 'pronamic_cookie_admin_js' );
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

	public function display_options_page() {
		pronamic_cookie_view( 'views/admin/display_options_page' );
	}

	public function register_settings() {
		// Base Settings
		add_settings_section(
			'pronamic_cookie_options',
			__( 'Bar', 'pronamic-cookies' ),
			array( $this, 'settings_section' ),
			'pronamic_cookie_options_page'
		);

		add_settings_field(
			'pronamic_cookie_base_active',
			__( 'Active?', 'pronamic-cookies' ),
			array( $this, 'select' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_options',
			array(
				'label_for' => 'pronamic_cookie_base_active',
				'options' => array(
					array(
						'label_for' => __( 'Yes', 'pronamic-cookies' ),
						'value'     => 1
					),
					array(
						'label_for' => __( 'No', 'pronamic-cookies' ),
						'value'     => 0
					)
				)
			)
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

		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_base_active' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_location' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_text' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_link', array( $this, 'verifiy_url' ) );

		// Blocker Settings
		add_settings_section(
			'pronamic_cookie_blocker_options',
			__( 'Wall', 'pronamic-cookies' ),
			array( $this, 'settings_section' ),
			'pronamic_cookie_options_page'
		);

		add_settings_field(
			'pronamic_cookie_blocker_active',
			__( 'Active?', 'pronamic-cookies' ),
			array( $this, 'select' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array(
				'label_for' => 'pronamic_cookie_blocker_active',
				'options' => array(
					array(
						'label_for' => __( 'Yes', 'pronamic-cookies' ),
						'value' => 1
					),
					array(
						'label_for' => __( 'No', 'pronamic-cookies' ),
						'value' => 0
					)
				)
			)
		);

		add_settings_field(
			'pronamic_cookie_blocker_title',
			__( 'Title', 'pronamic-cookies' ),
			array( $this, 'text' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array( 'label_for' => 'pronamic_cookie_blocker_title' )
		);

		add_settings_field(
			'pronamic_cookie_blocker_text',
			__( 'Text', 'pronamic-cookies' ),
			array( $this, 'editor' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array( 'label_for' => 'pronamic_cookie_blocker_text' )
		);

		add_settings_field(
			'pronamic_cookie_blocker_show_link',
			__( 'Show link?', 'pronamic-cookies' ),
			array( $this, 'select' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array(
				'label_for' => 'pronamic_cookie_blocker_show_link',
				'options' => array(
					array(
						'label_for' => __( 'Yes', 'pronamic-cookies' ),
						'value' => 1,
					),
					array(
						'label_for' => __( 'No', 'pronamic-cookies' ),
						'value' => 0
					)
				)
			)
		);

		add_settings_field(
			'pronamic_cookie_blocker_image',
			__( 'Background Image', 'pronamic-cookies' ),
			array( $this, 'uploader' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array( 'label_for' => 'pronamic_cookie_blocker_image' )
		);

		add_settings_field(
			'pronamic_cookie_blocker_bgcolor',
			__( 'Background Color', 'pronamic-cookies' ),
			array( $this, 'colorpicker' ),
			'pronamic_cookie_options_page',
			'pronamic_cookie_blocker_options',
			array( 'label_for' => 'pronamic_cookie_blocker_bgcolor' )
		);

		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_active' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_title' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_text' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_show_link' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_image' );
		register_setting( 'pronamic_cookie_options', 'pronamic_cookie_blocker_bgcolor' );

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

	public function editor( $args ) {
		wp_editor( get_option( $args['label_for'] ), $args['label_for'] );
	}

	public function uploader( $args ) {
		wp_enqueue_media();

		$string = 	'<div class="uploader">' .
						'<input type="text" name="%s" id="%s" value="%s" class="widefat"/>' .
						'<input type="button" class="button button-secondary jMediaUploader" name="%s_button" id="%s_button" value="%s" />' .
					'</div>';

		printf(
			$string,
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			get_option( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			__( 'Upload' )
		);
	}

	public function colorpicker( $args ) {
		wp_enqueue_style( 'wp-color-picker' );

		printf(
			'<input type="text" class="jColorPicker" name="%s" value="%s"/>',
			esc_attr( $args['label_for'] ),
			get_option( $args['label_for'] )
		);
	}

	public function verifiy_url( $raw_url ) {
		if ( empty( $raw_url) || 'http://' == $raw_url )
			return;

		$url = parse_url( $raw_url );
		
		if ( ! $url || ! isset( $url['scheme'] ) ) {
			$raw_url = 'http://' . $raw_url;
		}

		return filter_var( $raw_url, FILTER_VALIDATE_URL );
	}
}
