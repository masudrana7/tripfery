<?php
$tripfery_footer_column = TripferyTheme::$options['footer_column_2'];
switch ( $tripfery_footer_column ) {
	case '1':
	$tripfery_footer_class = 'col-12';
	break;
	case '2':
	$tripfery_footer_class = 'col-xl-6 col-md-6';
	break;
	case '3':
	$tripfery_footer_class = 'col-xl-4 col-md-6';
	break;		
	default:
	$tripfery_footer_class = 'col-xl-3 col-md-6';
	break;
}
// Logo
if( !empty( TripferyTheme::$options['footer_logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( TripferyTheme::$options['footer_logo_light'], 'full' );
	$tripfery_light_logo = $logo_lights;
}else {
	$tripfery_light_logo = "<img width='162' height='52' src='" . TRIPFERY_ASSETS_URL . 'img/logo-light.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}

$tripfery_socials = TripferyTheme_Helper::socials();

if( !empty( TripferyTheme::$options['fbgimg2'] ) ) {
	$f1_bg = wp_get_attachment_image_src( TripferyTheme::$options['fbgimg2'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = TRIPFERY_ASSETS_URL . 'img/footer_bg.jpg';
}

if ( TripferyTheme::$options['footer_bgtype2'] == 'fbgcolor2' ) {
	$tripfery_bg = TripferyTheme::$options['fbgcolor2'];
} else {
	$tripfery_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}


$bgc = $menu_on = $copyright_on = '';
if ( TripferyTheme::$options['footer_bgtype2'] == 'fbgimg2' ) {
	$bgc = 'footer-bg-opacity';
}

$menu_on = ( TripferyTheme::$options['copyright_menu'] ) ? "menu-on" : "menu-off";
$copyright_on = ( TripferyTheme::$options['copyright_text'] ) ? "copyright-on" : "copyright-off";
$logo_on = ( TripferyTheme::$options['logo_display'] ) ? "logo-on" : "logo-off";

if( !empty( TripferyTheme::$options['footer_logo2'] ) ) {
	$footer_logo = wp_get_attachment_image( TripferyTheme::$options['footer_logo2'], 'full' );
	$tripfery_footer_logo = $footer_logo;
}else {
	$tripfery_footer_logo = get_bloginfo( 'name' ); 
}

?>
<div class="footer-top-area <?php echo esc_attr( $bgc ); ?>" style="background:<?php echo esc_html( $tripfery_bg ); ?>">
	<?php if ( TripferyTheme::$footer_area == 1 ) { ?>
	<div class="footer-content-area">
		<div class="container">				
			<div class="row">
				<?php
				for ( $i = 1; $i <= $tripfery_footer_column; $i++ ) {
					echo '<div class="' . $tripfery_footer_class . '">';
					dynamic_sidebar( 'footer-style-2-'. $i );
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

