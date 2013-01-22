<?php if( $cookie_set ): ?>
    <?php echo $blocked_content; ?>
<?php else: ?>
    <?php echo $content; ?>
    <a href="#" class="pronamic_cblock_show_button" data-name="<?php echo $block_name; ?>">Show</a>
<?php endif;?>