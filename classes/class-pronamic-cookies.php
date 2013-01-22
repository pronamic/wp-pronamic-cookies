<?php

class Pronamic_Cookies {
	public $plugin_file;

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		add_action( 'wp_footer', array( $this, 'show_message' ) );

		add_shortcode( 'cookie-block', array( $this, 'cookie_block_shortcode' ) );

		add_action( 'wp_ajax_cblock', array( $this, 'ajax_cblock' ) );
		add_action( 'wp_ajax_nopriv_cblock', array( $this, 'ajax_cblock' ) );

	}

	public function init() {
		load_plugin_textdomain( 'pronamic-cookies', false, PRONAMIC_CL_PLUGIN_DIR . '/lang/' );

		register_post_type('pronamic_cblock', 
			array(
			    'labels' => array(
		            'name'                  => _x( 'Cookie Blocks', 'post type plural', 'pronamic-cookies' ),
		            'singular_name'         => _x( 'Cookie Block', 'post type singular', 'pronamic-cookies' ),
		            'add_new'               => _x( 'Add New', 'cookie block', 'pronamic-cookies' ),
		            'add_new_item'          => __( 'Add New Cookie Block', 'pronamic-cookies' ),
		            'edit_item'             => __( 'Edit Cookie Block', 'pronamic-cookies' ),
		            'new_item'              => __( 'New Cookie Block', 'pronamic-cookies' ),
		            'all_items'             => __( 'All Cookie Blocks', 'pronamic-cookies' ),
		            'view_item'             => __( 'View Cookie Block', 'pronamic-cookies' ),
		            'search_items'          => __( 'Search Cookie Blocks', 'pronamic-cookies' ),
		            'not_found'             => __( 'No cookie blocks found', 'pronamic-cookies' ),
		            'not_found_in_trash'    => __( 'No cookie blocks found in Trash', 'pronamic-cookies' ),
		            'parent_item_colon'     => '',
		            'menu_name'             => __( 'Cookie Blocks', 'pronamic-cookies' ),
			    ),
		        'public'                        => false,
		        'publicly_queryable'            => false,
		        'show_ui'                       => true,
		        'show_in_menu'                  => true,
		        'query_var'                     => false,
		        'rewrite'                       => array( 'slug' => 'cookieblock' ),
		        'capability_type'               => 'post',
		        'has_archive'                   => false,
		        'hierarchical'                  => false,
		        'menu_position'                 => 10,
		        'supports'                      => array( 'title', 'editor' )
		  	)
		);
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

		if (  ! $viewed ) {
			pronamic_cookie_view( 'views/message', array(
				'position' => get_option( 'pronamic_cookie_location' ),
				'message'  => get_option( 'pronamic_cookie_text ' ),
				'link'     => get_option( 'pronamic_cookie_link' )
			) );
		}
	}

	public function cookie_block_shortcode( $atts, $shortcode = true )
	{
		if ( $shortcode == true )
		{
			$defaults = array(
				'name' => null
			);

			$attributes = shortcode_atts( $defaults, $atts );

			if( null === $attributes['name'] )
				return;	
		} 
		else
		{
			$attributes['name'] = $atts['name'];
		}

		$attributes['name'] = sanitize_title( $attributes['name'] );

		$block_query = new WP_Query(
			array(
				'post_type' => 'pronamic_cblock',
				'name' => $attributes['name']
			)
		);

		if ( ! empty( $block_query->posts ) )
		{
			// Get the post details
			$post = $block_query->posts[0];

			// Get post meta
			$pronamic_cblock_details = get_post_meta( $post->ID, 'pronamic_cblock_details', true );

			// Check the meta exists, otherwise nothing to block
			if ( ! $pronamic_cblock_details || ! is_array( $pronamic_cblock_details ) )
				return;

			// Default variables
			$pronamic_cblock_blocked_content = '';

			// Extract where key's name variable exists
			extract( $pronamic_cblock_details, EXTR_IF_EXISTS );

			// Get the normal post content
			$pronamic_cblock_content = $post->post_content;

			// Cookie isn't set
			$cookie_set = false;

			// Check it!
			if ( isset( $_COOKIE['pcl_block_' . $attributes['name']] ) || false === $shortcode )
				$cookie_set = true;

			$partial = pronamic_cookie_view( '/views/cookie_block_partial',array(
				'block_name' => $attributes['name'],
				'content' => $pronamic_cblock_content,
				'blocked_content' => $pronamic_cblock_blocked_content,
				'cookie_set' => $cookie_set
			), true );

			if ( false === $shortcode )
				return $partial;

			return pronamic_cookie_view( 'views/cookie_block_shortcode', array(
				'block_name' => $attributes['name'],
				'partial' => $partial 
			), true );
		}
	}

	public function ajax_cblock()
	{
		$name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );

		echo json_encode( array( 
			'html' => $this->cookie_block_shortcode( array( 'name' => $name ), false ),
			'resp' => true
			)
		);

		exit;
	}

	private function _cookie_block_view()
	{

	}
}
