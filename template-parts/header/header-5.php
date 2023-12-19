<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = TripferyTheme_Helper::nav_menu_args();

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
<div id="sticky-placeholder"></div>
<div class="header-menu header-top" id="header-middlebar">
	<div class="container">
		<div class="menu-full-wrap">
			<div class="site-branding">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_light_logo, 'allow_link' ); ?></a>
			</div>
			<div class="header-top-icon">
				<?php if ( TripferyTheme::$options['address_icon'] || TripferyTheme::$options['email_icon'] || TripferyTheme::$options['opening_icon'] || TripferyTheme::$options['phone_icon'] ) { ?>
				<div class="header-info-wrap">
					<?php if ( TripferyTheme::$options['address_icon'] ) { ?>
					<div class="header-info header-address">
						<div class="info-icon address-icon">
							<i class="icon-tripfery-location"></i>
						</div>
						<div class="info-text address">
							<span><?php echo wp_kses( TripferyTheme::$options['address_label'] , 'alltext_allow' );?></span><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?>
						</div>
					</div>
					<?php } if ( TripferyTheme::$options['email_icon'] ) { ?>
					<div class="header-info header-email">
						<div class="info-icon email-icon">
							<i class="icon-tripfery-message"></i>
						</div>
						<div class="info-text email">
							<span><?php echo wp_kses( TripferyTheme::$options['email_label'] , 'alltext_allow' );?></span><a href="mailto:<?php echo esc_attr( TripferyTheme::$options['email'] );?>"><?php echo wp_kses( TripferyTheme::$options['email'] , 'alltext_allow' );?></a>
						</div>
					</div>
					<?php } if ( TripferyTheme::$options['opening_icon'] ) { ?>
					<div class="header-info header-opening">
						<div class="info-icon opening-icon">
							<i class="icon-tripfery-time"></i>
						</div>
						<div class="info-text opening">
							<span><?php echo wp_kses( TripferyTheme::$options['opening_label'] , 'alltext_allow' );?></span><?php echo wp_kses( TripferyTheme::$options['opening'] , 'alltext_allow' );?>
						</div>
					</div>
					<?php } if ( TripferyTheme::$options['phone_icon'] ) { ?>
					<div class="header-info header-phone">
						<div class="info-icon phone-icon">
							<i class="icon-tripfery-phone"></i>
						</div>
						<div class="info-text phone-no">
							<span><?php echo wp_kses( TripferyTheme::$options['phone_label'] , 'alltext_allow' );?></span><a href="tel:<?php echo esc_attr( TripferyTheme::$options['phone'] );?>"><?php echo wp_kses( TripferyTheme::$options['phone'] , 'alltext_allow' );?></a>
						</div>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="header-menu header-bottom" id="header-menu">
	<div class="container">
		<div class="menu-full-wrap header-dark">
			<div class="menu-wrap">
				<?php if ( TripferyTheme::$options['vertical_menu_icon'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'offcanvas' );?>
				<?php } ?>
				<div id="site-navigation" class="main-navigation">
					<?php wp_nav_menu( $nav_menu_args );?>
				</div>
			</div>
			<?php if ( TripferyTheme::$options['search_icon'] || TripferyTheme::$options['cart_user'] || TripferyTheme::$options['online_button'] ) { ?>
			<div class="header-icon-area">
				<?php if ( TripferyTheme::$options['online_button'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'button' );?>
				<?php } if ( TripferyTheme::$options['cart_user'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'user' );?>
				<?php } if ( TripferyTheme::$options['search_icon'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'search' );?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>