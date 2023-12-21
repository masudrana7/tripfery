<?php
$tripfery_footer_column = TripferyTheme::$options['footer_column_1'];
switch ( $tripfery_footer_column ) {
	case '1':
	$tripfery_footer_class = 'col-12';
	break;
	case '2':
	$tripfery_footer_class = 'col-lg-3 col-md-6';
	break;
	case '3':
	$tripfery_footer_class = 'col-lg-3 col-md-6';
	break;		
	default:
	$tripfery_footer_class = 'col-lg-3 col-md-6';
	break;
}

$tripfery_socials = TripferyTheme_Helper::socials();

if( !empty( TripferyTheme::$options['fbgimg'] ) ) {
	$f1_bg = wp_get_attachment_image_src( TripferyTheme::$options['fbgimg'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = TRIPFERY_ASSETS_URL . 'img/footer_bg.jpg';
}

if ( TripferyTheme::$options['footer_bgtype'] == 'fbgcolor' ) {
	$tripfery_bg = TripferyTheme::$options['fbgcolor'];
} else {
	$tripfery_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}
$bgc = $menu_on = $copyright_on = '';
if ( TripferyTheme::$options['footer_bgtype'] == 'fbgimg' ) {
	$bgc = 'footer-bg-opacity';
}

$menu_on = ( TripferyTheme::$options['copyright_menu'] ) ? "menu-on" : "menu-off";
$copyright_on = ( TripferyTheme::$options['copyright_text'] ) ? "copyright-on" : "copyright-off";

?>
<div class="footer-top-area <?php echo esc_attr( $bgc ); ?>" style="background:<?php echo esc_html( $tripfery_bg ); ?>">
	<?php if ( is_active_sidebar( 'footer-style-1-1' ) && TripferyTheme::$footer_area == 1 ) { ?>
	<div class="footer-content-area">
		<div class="container">			
			<div class="row">
				<?php
				for ( $i = 1; $i <= $tripfery_footer_column; $i++ ) {
					echo '<div class="' . $tripfery_footer_class . '">';
					dynamic_sidebar( 'footer-style-1-'. $i );
					echo '</div>';
				}
				?>
			</div>			
		</div>
	</div>
	<?php } ?>

	<?php if ( TripferyTheme::$copyright_area == 1 ) { ?>
	<div class="footer-copyright-area">
		<div class="container">
			<div class="copyright-area <?php echo esc_attr( $copyright_on ); ?> <?php echo esc_attr( $menu_on ); ?>">
				<div class="copyright-menu-wrap">
					<?php if ( TripferyTheme::$options['copyright_text'] ) { ?>
					<div class="copyright"><?php echo wp_kses( TripferyTheme::$options['copyright_text'] , 'allow_link' );?></div>
					<?php } ?>
				</div>
				<?php if ( TripferyTheme::$options['copyright_menu'] ) { ?>	
					<div class="copyright-menu"><?php dynamic_sidebar('copyright-menu'); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

