<?php

/**
 * Template Name: Booking List
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// Layout class
if (TripferyTheme::$layout == 'full-width') {
    $tripfery_layout_class = 'col-sm-12 col-12';
} else {
    $tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}
?>
<?php get_header(); ?>
<div id="primary" class="content-area rt-booking-layout">
    <div id="contentHolder">
        <div class="container">
            <div class="row">
                <?php if (TripferyTheme::$layout == 'left-sidebar') {
                    get_sidebar();
                } ?>
                <div class="<?php echo esc_attr($tripfery_layout_class); ?>">
                    <main id="main" class="site-main">
                        <?php get_template_part('template-parts/archive-booking/archive', 'booking-list'); ?>
                    </main>
                </div>
                <?php if (TripferyTheme::$layout == 'right-sidebar') {
                    get_sidebar();
                }    ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>