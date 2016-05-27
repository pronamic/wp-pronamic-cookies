<div id="pronamic_cookie_holder" class='pronamic_cookie_position_<?php echo $position; ?> <?php if ( is_admin_bar_showing() && 'top' == $position ) : ?> admin-bar-showing <?php endif; ?>'>
	<p>
		<?php if ( ! empty( $link ) ) : ?>
			<a href="<?php echo $link; ?>" target="<?php echo $link_target; ?>"><?php echo $message; ?></a>
		<?php else: ?>
			<?php echo $message;?>
		<?php endif;?>

		<a class='pronamic_cookie_close_button'><?php _e( 'Close', 'pronamic-cookies' ); ?></a>
	</p>
</div>