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
$class_width = (TripferyTheme::$header_width == "on" || TripferyTheme::$header_width == 1) ? "container " : "rt-container container-fluid";

?>
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
					<?php if (TripferyTheme::$options['phone']) { ?>
						<div class="rt-header2-phone"><svg width="11" height="11" viewBox="0 0 11 11" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M9.98047 7.80859L9.51172 9.78125C9.45312 10.0742 9.21875 10.2695 8.92578 10.2695C4.00391 10.25 0 6.24609 0 1.32422C0 1.03125 0.175781 0.796875 0.46875 0.738281L2.44141 0.269531C2.71484 0.210938 3.00781 0.367188 3.125 0.621094L4.04297 2.75C4.14062 3.00391 4.08203 3.29688 3.86719 3.45312L2.8125 4.3125C3.47656 5.66016 4.57031 6.75391 5.9375 7.41797L6.79688 6.36328C6.95312 6.16797 7.24609 6.08984 7.5 6.1875L9.62891 7.10547C9.88281 7.24219 10.0391 7.53516 9.98047 7.80859Z" fill="#D2D2D2"></path>
							</svg><a href="tel:<?php echo esc_attr( TripferyTheme::$options['phone'] );?>" class="rt-tf-phone-number"><?php echo wp_kses( TripferyTheme::$options['phone'] , 'alltext_allow' );?></a></div>
					<?php } ?>	
					<?php if (TripferyTheme::$options['user_icon']) { ?>
						<?php get_template_part('template-parts/header/icon', 'user'); ?>
					<?php }
					if (TripferyTheme::$options['vertical_menu_icon']) { ?>
						<?php get_template_part('template-parts/header/icon', 'offcanvas'); ?>
					<?php } if (TripferyTheme::$options['online_button']) { ?>
						<?php get_template_part('template-parts/header/icon', 'button'); ?>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>