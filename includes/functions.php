<?php

/**
 * Check if the cookies for the specified section are accepted
 * 
 * @param string $name
 * @return boolean true if accepted, false otherwise
 */
function pronamic_cookies_is_section_accepted( $name ) {
    return isset( $_COOKIE['pcl_section_' . $name] );
}

/**
 * Render an accept cookies button for an specific section
 * 
 * @param string $name the name of an section
 * @param array $arguments
 */
function pronamic_cookies_button( $name, $arguments = array() ) { 
    $title       = __( 'Cookie Law Notice', 'pronamic-cookes' );
    $button      = __( 'Accept cookie', 'pronamic-cookies' );
    $description = get_option( 'pronamic_cookie_text' );

    if ( is_array( $arguments ) && ! empty( $arguments ) )
        extract( $arguments, EXTR_IF_EXISTS );

    ?>
    <a href='#' class='pronamic_csection_show_button jShowCookieLawModal'><?php echo $button; ?></a>
    <div class="pronamic_csection_modal">
        <h2><?php echo $title; ?></h2>
        <a href="#" class="jCloseModal pronamic_csection_modal_close">&times;</a>
        <?php if ( $description ) : ?>
	        <div class="pronamic_csection_modal_content">
	            <?php if ( get_option( 'pronamic_cookie_link' ) ) : ?>
	                <a target="_blank" href="<?php echo esc_url( get_option( 'pronamic_cookie_link' ) ); ?>">
	                    <?php echo $description; ?>
	                </a>
	            <?php else : ?>
	                <?php echo $description; ?>
	            <?php endif;?>
	        </div>
        <?php endif;?>
        <div class="pronamic_csection_modal_footer">
            <a href="#" class="pronamic_csection_button pronamic_csection_button_green jAcceptCookie" data-name="<?php echo $name; ?>"><?php _e( 'Accept cookie', 'pronamic-cookies' ); ?></a>
            <a href="#" class="pronamic_csection_button pronamic_csection_button_red jCloseModal"><?php _e( 'Decline cookie', 'pronamic-cookies' ); ?></a>
        </div>
    </div>
	<?php 
}

/**
 * Render an cookies modal
 * 
 * @param string $name the name of an section
 * @param array $arguments
 */
function pronamic_cookies_modal( $name, $arguments = array() ) { 
    $title       = __( 'Cookie Law Notice', 'pronamic-cookes' );
    $description = get_option( 'pronamic_cookie_text' );

    if ( is_array( $arguments ) && ! empty( $arguments ) )
        extract( $arguments, EXTR_IF_EXISTS );

    ?>
    <div class="pronamic_csection_modal">
        <h2><?php echo $title; ?></h2>
        <a href="#" class="jCloseModal pronamic_csection_modal_close">&times;</a>
        <?php if ( $description ) : ?>
	        <div class="pronamic_csection_modal_content">
	            <?php if ( get_option( 'pronamic_cookie_link' ) ): ?>
	                <a target="_blank" href="<?php echo esc_url( get_option( 'pronamic_cookie_link' ) ); ?>">
	                    <?php echo $description; ?>
	                </a>
	            <?php else : ?>
	                <?php echo $description; ?>
	            <?php endif;?>
	        </div>
        <?php endif;?>
        <div class="pronamic_csection_modal_footer">
            <a href="#" class="pronamic_csection_button pronamic_csection_button_green jAcceptCookie" data-name="<?php echo $name; ?>"><?php _e( 'Accept cookie', 'pronamic-cookies' ); ?></a>
            <a href="#" class="pronamic_csection_button pronamic_csection_button_red jCloseModal"><?php _e( 'Decline cookie', 'pronamic-cookies' ); ?></a>
        </div>
    </div>
	<?php
}
