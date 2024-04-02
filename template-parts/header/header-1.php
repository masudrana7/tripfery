<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = TripferyTheme_Helper::nav_menu_args();

// Logo
if (!empty(TripferyTheme::$options['logo'])) {
	$logo_dark = wp_get_attachment_image(TripferyTheme::$options['logo'], 'full');
	$tripfery_dark_logo = $logo_dark;
} else {
	$tripfery_dark_logo = get_bloginfo('name');
}

if (!empty(TripferyTheme::$options['logo_light'])) {
	$logo_lights = wp_get_attachment_image(TripferyTheme::$options['logo_light'], 'full');
	$tripfery_light_logo = $logo_lights;
} else {
	$tripfery_light_logo = get_bloginfo('name');
}
$class_width = (TripferyTheme::$header_width === "on" || TripferyTheme::$header_width === 1) ? "container " : "rt-container container-fluid"; ?>
<div id="sticky-placeholder"></div>
<div class="header-menu" id="header-menu">
	<div class="<?php echo esc_attr($class_width); ?>">
		<div class="menu-full-wrap">
			<div class="site-branding">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo wp_kses($tripfery_dark_logo, 'allow_link'); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo wp_kses($tripfery_light_logo, 'allow_link'); ?></a>
			</div>
			<div class="menu-wrap">
				<div id="site-navigation" class="main-navigation">
					<?php if (has_nav_menu('primary')) {
						wp_nav_menu($nav_menu_args);
					} else {
						if (is_user_logged_in()) {
							echo '<ul id="menu" class="nav fallbackcd-menu-item"><li><a class="fallbackcd" href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add a menu', 'tripfery') . '</a></li></ul>';
						}
					} ?>
				</div>
			</div>
			<?php if (TripferyTheme::$options['online_button'] || TripferyTheme::$options['search_icon'] || TripferyTheme::$options['user_icon'] || TripferyTheme::$options['vertical_menu_icon']) { ?>
				<div class="header-icon-area">
					
					<?php if (TripferyTheme::$options['search_icon']) { ?>
						<?php get_template_part('template-parts/header/icon', 'search'); ?>
					<?php } if ( TripferyTheme::$options['cart_icon'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'cart' );?>
				<?php }
					if (TripferyTheme::$options['user_icon']) { ?>
						<?php get_template_part('template-parts/header/icon', 'user'); ?>
					<?php }
					if (TripferyTheme::$options['vertical_menu_icon']) { ?>
						<?php get_template_part('template-parts/header/icon', 'offcanvas'); ?>
					<?php } if (has_nav_menu('currency_menu')) {
						wp_nav_menu(array(
							'theme_location' => 'currency_menu',
							'menu_class'     => 'rt_currency_menu',
							'container'      => 'nav',
						));
					} 
					if (TripferyTheme::$options['online_button']) { ?>
						<?php get_template_part('template-parts/header/icon', 'button'); ?>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>