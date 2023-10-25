<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$tripfery_socials = TripferyTheme_Helper::socials();
$container = ( TripferyTheme::$header_style == 6 ) ? 'container-custom' : 'container';
?>
<div id="tophead" class="header-top-bar align-items-center">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="row">
			<div class="col-lg-7">
				<div class="tophead-contact">
					<?php if ( is_active_sidebar( 'topbar-left' ) ) dynamic_sidebar( 'topbar-left' );?>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="tophead-right">
					<?php if ( is_active_sidebar( 'topbar-right' ) ) dynamic_sidebar( 'topbar-right' );?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>