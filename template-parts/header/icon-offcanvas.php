<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$tripfery_socials = TripferyTheme_Helper::socials();

// Logo
if( !empty( TripferyTheme::$options['logo'] ) ) {
	$logo_dark = wp_get_attachment_image( TripferyTheme::$options['logo'], 'full' );
	$tripfery_dark_logo = $logo_dark;
}else {
	$tripfery_dark_logo = get_bloginfo( 'name' ); 
}

if( !empty( TripferyTheme::$options['logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( TripferyTheme::$options['logo_light'], 'full' );
	$tripfery_light_logo = $logo_lights;
}else {
	$tripfery_light_logo = get_bloginfo( 'name' );
}

?>

<div class="additional-menu-area header-offcanvus">
	<div class="sidenav sidecanvas">
		<div class="canvas-content">
			<a href="#" class="closebtn" aria-label="Close btn"><i class="fas fa-times"></i></a>
			<div class="additional-logo">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_light_logo, 'allow_link' ); ?></a>
			</div>

			<div class="sidenav-address">
				<?php if ( !empty ( TripferyTheme::$options['sidetext_label'] ) ) { ?>
				<label><?php echo wp_kses( TripferyTheme::$options['sidetext_label'] , 'alltext_allow' );?></label>
				<?php } ?>
				<?php if ( !empty ( TripferyTheme::$options['sidetext'] ) ) { ?>
				<p><?php echo wp_kses( TripferyTheme::$options['sidetext'] , 'alltext_allow' );?></p>
				<?php } ?>
				<?php if( is_active_sidebar('offcanvas') ) { dynamic_sidebar('offcanvas'); } ?>

				<?php if ( !empty ( TripferyTheme::$options['address_label'] ) ) { ?>
				<label><?php echo wp_kses( TripferyTheme::$options['address_label'] , 'alltext_allow' );?></label>
				<?php } ?>
				<?php if ( TripferyTheme::$options['address'] ) { ?>
				<span><i class="icon-tripfery-location"></i><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?></span>
				<?php } ?>
				<?php if ( TripferyTheme::$options['email'] ) { ?>
				<span><i class="icon-tripfery-message"></i><a href="mailto:<?php echo esc_attr( TripferyTheme::$options['email'] );?>"><?php echo esc_html( TripferyTheme::$options['email'] );?></a></span>
				<?php } ?>			
				<?php if ( TripferyTheme::$options['phone'] ) { ?>
				<span><i class="icon-tripfery-phone"></i><a href="tel:<?php echo esc_attr( TripferyTheme::$options['phone'] );?>"><?php echo esc_html( TripferyTheme::$options['phone'] );?></a></span>
				<?php } ?>

			<?php if ( !empty ( $tripfery_socials ) ) { ?>
				<?php if ( !empty ( TripferyTheme::$options['social_label'] ) ) { ?>
				<label class="social-title"><?php echo wp_kses( TripferyTheme::$options['social_label'] , 'alltext_allow' );?></label>
			<?php } } ?>
				<?php if ( $tripfery_socials ) { ?>
					<div class="sidenav-social">
						<?php foreach ( $tripfery_socials as $tripfery_social ): ?>
							<span><a target="_blank" aria-label="Social Link" href="<?php echo esc_url( $tripfery_social['url'] );?>"><i class="fab <?php echo esc_attr( $tripfery_social['icon'] );?>"></i></a></span>
						<?php endforeach; ?>
					</div>						
				<?php } ?>
			</div>
		</div>
	</div>
    <button type="button" aria-label="button" class="side-menu-open side-menu-trigger">
        <span class="menu-btn-icon">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </span>
      </button>
</div>