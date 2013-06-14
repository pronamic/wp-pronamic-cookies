<div class="wrap">
	<?php screen_icon(); ?>

	<?php $current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING ); ?>
	<?php $tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING ); ?>
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php if ( ! $tab ): ?>nav-tab-active<?php endif; ?>" href="<?php echo admin_url( 'options-general.php?page=pronamic_cookie_options_page' ); ?>"><?php echo get_admin_page_title(); ?></a>
		<a class="nav-tab <?php if ( 'advanced' === $tab ): ?>nav-tab-active<?php endif; ?>" href="<?php echo admin_url( 'options-general.php?page=pronamic_cookie_options_page&tab=advanced' ); ?>"><?php _e( 'Advanced', 'pronamic_cookies' ); ?></a>
	</h2>

	<form action="options.php" method="post">
		<?php if ( ! $tab ) : ?>
			<?php settings_fields( 'pronamic_cookie_options' ); ?>
			<?php do_settings_sections( 'pronamic_cookie_options_page' ); ?>
		<?php elseif ( 'advanced' === $tab ) : ?>
			<?php settings_fields( 'pronamic_cookie_options_advanced' ); ?>
			<?php do_settings_sections( 'pronamic_cookie_options_advanced_page' ); ?>
		<?php endif; ?>
		<?php submit_button(); ?>
	</form>
</div>