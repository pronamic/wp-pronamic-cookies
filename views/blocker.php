<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			body {
				font-family:sans-serif;
			}

			.container {
				width:500px;
				margin:100px auto;
				background:#fff;
				padding:20px;
				border-radius:20px;
				font-size:16px;
				line-height:22px;
			}

				.container p {
					font-size:16px;
					line-height:22px;
				}

				.container a {
					color:#999;
				}

			.container-header {
				background:#fff;
				color:#333;
				font-size:30px;
				font-weight:bold;
				border-bottom:1px solid #ccc;
				padding-bottom:10px;
				margin-bottom:20px;
				text-align:center;
			}

			.container-footer {

			}

				.container-footer a {
					color:#999;
					font-size:12px;
				}

			.pronamic_accept_button {
				background:#81d742;
				padding:10px;
				display:block;
				text-align:center;
				font-size:23px !important;
				font-weight:bold;
				color:#fff !important;
				border-radius:10px;
				-moz-border-radius:10px;
				-webkit-border-radius:10px;
				margin-top:15px;
				margin-bottom:10px;
				text-decoration:none;
			}
		</style>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $javascript_url; ?>"></script>
		<script type="text/javascript">jQuery(Pronamic_Cookies.blocker.ready);</script>
		<script type="text/javascript">
			
			<?php $expires_date = new DateTime( get_option( 'pronamic_cookie_options_advanced_expires', '1 year' ), new DateTimeZone( 'GMT' ) ); ?>
			var Pronamic_Cookies_Vars = {
				cookie: {
					path:"<?php echo get_option( 'pronamic_cookie_options_advanced_path', '/' ); ?>",
					expires: "<?php echo $expires_date->format( 'D, d M Y H:i:s e' ); ?>"
				}
			};
		</script>
	</head>

	<body style="background-image:url('<?php echo $image; ?>');background-repeat:no-repeat;background-position:top center;background-color:<?php echo $color; ?>">
		<div class="container">
			<div class="container-header">
				<?php echo $title;?>
			</div>

			<?php echo nl2br( $text ); ?>

			<div class="container-footer">
				<a class="pronamic_accept_button jBlockerAccept" href="#" data-refresh="true"><?php echo $accept_button_text; ?></a>

				<?php if ( $cookie_law_link_show == 1 ): ?>
					<a href="<?php echo $cookie_law_link; ?>"><?php echo $law_link_text; ?></a>
				<?php endif;?>
			</div>
		</div>
	</body>
</html>
