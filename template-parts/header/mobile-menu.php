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

?>
<div id="mobile-sticky-placeholder"></div>
<div class="rt-header-menu mean-container" id="meanmenu">
    <?php if (TripferyTheme::$options['mobile_topbar']) { ?>
        <?php get_template_part('template-parts/header/mobile', 'topbar'); ?>
    <?php } ?>
    <div class="mobile-mene-bar">
        <div class="mean-bar">

            <?php if (TripferyTheme::$options['mobile_cart']) { ?>
                <div class="info">
                    <?php get_template_part('template-parts/header/icon', 'user'); ?>
                </div>
            <?php } ?>

            <a class="mobile-logo dark-logo" aria-label="Mobile Logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo wp_kses($tripfery_dark_logo, 'alltext_allow'); ?></a>
            
            <div class="mean-bar-search">
                <span class="sidebarBtn ">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </span>
                <?php if (TripferyTheme::$options['mobile_search']) { ?>
                    <?php get_template_part('template-parts/header/icon', 'search'); ?>
                <?php } ?>
            </div>

        </div>
        <div class="rt-slide-nav">
            <div class="offscreen-navigation">
                <?php wp_nav_menu($nav_menu_args); ?>
            </div>
        </div>
    </div>
</div>