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
<div class="header-menu header-top" id="header-menu">
	<div class="container">
		<div class="menu-full-wrap">
			<div class="site-branding">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $tripfery_light_logo, 'allow_link' ); ?></a>
			</div>
			<div class="content-branding">
				<?php if ( TripferyTheme::$options['address_icon'] || TripferyTheme::$options['email_icon'] || TripferyTheme::$options['phone_icon'] ) { ?>
				<div class="content-top">
					<ul class="header-info">
						<?php if ( TripferyTheme::$options['address_icon'] ) { ?>
						<li><i class="icon-tripfery-location"></i><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?></li>
						<?php } if ( TripferyTheme::$options['email_icon'] ) { ?>
						<li><i class="icon-tripfery-message"></i><a href="mailto:<?php echo esc_attr( TripferyTheme::$options['email'] );?>"><?php echo wp_kses( TripferyTheme::$options['email'] , 'alltext_allow' );?></a></li>
						<?php } if ( TripferyTheme::$options['phone_icon'] ) { ?>
						<li><i class="icon-tripfery-phone"></i><a href="tel:<?php echo esc_attr( TripferyTheme::$options['phone'] );?>"><?php echo wp_kses( TripferyTheme::$options['phone'] , 'alltext_allow' );?></a></li>
						<?php } ?>
					</ul>
					<?php if ( TripferyTheme::$options['online_button'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'button' );?>
					<?php } ?>
				</div>
				<?php } ?>
				<div class="content-bottom">
					<div class="menu-wrap">
						<div id="site-navigation" class="main-navigation">
							<?php wp_nav_menu( $nav_menu_args );?>
						</div>
						<?php if ( TripferyTheme::$options['search_icon'] || TripferyTheme::$options['cart_user'] || TripferyTheme::$options['vertical_menu_icon'] ) { ?>
						<div class="header-icon-area">	
							<?php if ( TripferyTheme::$options['search_icon'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'search' );?>	
							<?php } if ( TripferyTheme::$options['cart_user'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'user' );?>
							<?php } if ( TripferyTheme::$options['vertical_menu_icon'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'offcanvas' );?>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
