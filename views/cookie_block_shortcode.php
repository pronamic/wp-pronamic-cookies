<script type="text/javascript">
Pronamic_Cookies.config.ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

jQuery(Pronamic_Cookies.blocks.ready);
</script>
<div class="pronamic_cblock_holder pcl_block_<?php echo $block_name; ?>">
<?php echo $partial; ?>
</div>