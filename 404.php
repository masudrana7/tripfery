
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

wp_head();
if( !empty( TripferyTheme::$options['error_image'] ) ) {
	$error_bg = wp_get_attachment_image( TripferyTheme::$options['error_image'], 'full', true );
	$tripfery_error_img = $error_bg;
}else {
	$tripfery_error_img = "<img src='" . TRIPFERY_ASSETS_URL . 'img/404.png' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}
$error_bg2 = "";
if( !empty( TripferyTheme::$options['error_image2'] ) ) {
	$error_bg2 = wp_get_attachment_image( TripferyTheme::$options['error_image2'], 'full', true );
}
?>
<div id="primary" class="content-area error-page-area">
	<div class="container">
		<div class="error-page-content">
			<div class="item-img">
				<span class="error-img 

				<?php echo esc_attr( TripferyTheme::$options['error_animation'] );?> <?php echo esc_attr( TripferyTheme::$options['error_animation_effect'] );?>" data-wow-delay=".5s" data-wow-duration="1s"><?php echo wp_kses( $tripfery_error_img, 'allow_link' ); ?>
			</span>
			</div>
			<div class="rocket-img"><?php echo wp_kses( $error_bg2, 'allow_link' ); ?></div>
			<?php if ( !empty( TripferyTheme::$options['error_text1']) ) { ?>
			<h2 class="error-title <?php echo esc_attr( TripferyTheme::$options['error_animation'] );?> <?php echo esc_attr( TripferyTheme::$options['error_animation_effect'] );?>" data-wow-delay=".7s" data-wow-duration="1s"><?php echo wp_kses( TripferyTheme::$options['error_text1'] , 'alltext_allow' );?></h2>
			<?php } ?>
			<?php if ( !empty(TripferyTheme::$options['error_text2'])) { ?>
			<p class="<?php echo esc_attr( TripferyTheme::$options['error_animation'] );?> <?php echo esc_attr( TripferyTheme::$options['error_animation_effect'] );?>" data-wow-delay=".9s" data-wow-duration="1s"><?php echo wp_kses( TripferyTheme::$options['error_text2'] , 'alltext_allow' );?></p>
			<?php } ?>
			<div class="go-home <?php echo esc_attr( TripferyTheme::$options['error_animation'] );?> <?php echo esc_attr( TripferyTheme::$options['error_animation_effect'] );?>" data-wow-delay="1.1s" data-wow-duration="1s">
			  <a class="button-style-2 btn-common" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo esc_html( TripferyTheme::$options['error_buttontext'] );?></a>
			</div>
		</div>
	</div>
</div>