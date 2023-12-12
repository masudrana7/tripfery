<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if (is_404()) {
	$tripfery_title = "Error Page";
} elseif (is_search()) {
	$tripfery_title = esc_html__('Search Results for : ', 'tripfery') . get_search_query();
} elseif (is_home()) {
	if (get_option('page_for_posts')) {
		$tripfery_title = get_the_title(get_option('page_for_posts'));
	} else {
		$tripfery_title = apply_filters('theme_blog_title', esc_html__('All Posts', 'tripfery'));
	}
} elseif (is_post_type_archive('tripfery_team')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Our Teams', 'tripfery'));
} elseif (is_post_type_archive('tripfery_guided')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Our Guided', 'tripfery'));
} elseif (is_post_type_archive('to_book')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Our Bookings', 'tripfery'));
} elseif (is_post_type_archive('tripfery_service')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Our Services', 'tripfery'));
} elseif (is_archive()) {
	$tripfery_title = apply_filters('theme_blog_title', esc_html__('All Posts', 'tripfery'));
} elseif (is_singular('tripfery_team')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Team Details', 'tripfery'));
} elseif (is_singular('tripfery_guided')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Guided Details', 'tripfery'));
} elseif (is_singular('tripfery_booking')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Booking Details', 'tripfery'));
} elseif (is_singular('tripfery_service')) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Service Details', 'tripfery'));
} elseif (is_single()) {
	$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Blog Details', 'tripfery'));
} else {
	$tripfery_title = get_the_title();
}
if (class_exists('BABE_Functions')) {
	if (is_singular('to_book')) {
		$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Booking Details', 'tripfery'));
	} elseif (is_archive('to_book')) {
		$tripfery_title  = apply_filters('theme_blog_title', esc_html__('Booking Location', 'tripfery'));
	} else {
		$tripfery_title = $tripfery_title;
	}
}
if (class_exists('WooCommerce')) {
	if (is_shop()) {
		$tripfery_title = esc_html__('Shop Page', 'tripfery');
	} elseif (is_product_category()) {
		$category = get_queried_object();
		if ($category) {
			$tripfery_title = $category->name;
		}
	} elseif (is_product()) {
		$tripfery_title = esc_html__('Shop Details', 'tripfery');
	} else {
		$tripfery_title = $tripfery_title;
	}
}
$banner_opacity = '';
if (TripferyTheme::$bgtype == 'bgimg') {
	$banner_opacity = "opacity-on";
} else {
	$banner_opacity = "opacity-off";
}
if (!empty(TripferyTheme::$options['banner_shape1'])) {
	$banner_shape1 = wp_get_attachment_image_src(TripferyTheme::$options['banner_shape1'], 'full', true);
	$banner_bg_img1 = $banner_shape1[0];
} else {
	$banner_bg_img1 = TRIPFERY_ASSETS_URL . 'img/hero_top_vactor.svg';
}
if (!empty(TripferyTheme::$options['banner_shape2'])) {
	$banner_shape2 = wp_get_attachment_image_src(TripferyTheme::$options['banner_shape2'], 'full', true);
	$banner_bg_img2 = $banner_shape2[0];
} else {
	$banner_bg_img2 = TRIPFERY_ASSETS_URL . 'img/hero_bottom_vactor.svg';
} ?>
<?php if (TripferyTheme::$has_banner == 1 || TripferyTheme::$has_banner == 'on') { ?>
	<div class="entry-banner <?php echo esc_attr($banner_opacity); ?>">
		<?php if (TripferyTheme::$options['banner_shape']) { ?>
		<div class="banner-shape1 wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="1.2s" style="--tripfery-banner-shape1:url(<?php echo esc_url($banner_bg_img1); ?>);"></div><?php } ?>
		<div class="container">
			<div class="entry-banner-content">


				<?php if (is_post_type_archive('to_book')) { ?>
				<div class="rt-search-norlam">
					<?php dynamic_sidebar('booking-form'); ?>
				</div>
				<?php } elseif(is_singular('tripfery_guided')){ ?>
					<div class="rt-search-norlam">
						<?php dynamic_sidebar('booking-form'); ?>
					</div>
				<?php } else if (is_single()) { ?>
					<h1 class="blog-title"><?php echo wp_kses($tripfery_title, 'alltext_allow'); ?></h1>
				<?php } else if (is_page()) { ?>
					<h1 class="entry-title"><?php echo wp_kses($tripfery_title, 'alltext_allow'); ?></h1>
				<?php } else { ?>
					<h1 class="entry-title"><?php echo wp_kses($tripfery_title, 'alltext_allow'); ?></h1>
				<?php } ?>

				<?php if ((TripferyTheme::$has_breadcrumb == 1) && (!is_post_type_archive('to_book')) && (!is_post_type_archive('tripfery_guided'))) { ?>
					<?php get_template_part('template-parts/content', 'breadcrumb'); ?>
				<?php } ?>

			</div>
		</div>
		<?php if (TripferyTheme::$options['banner_shape']) { ?>
		<div class="banner-shape2 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.2s" style="--tripfery-banner-shape2:url(<?php echo esc_url($banner_bg_img2); ?>);"></div><?php } ?>
	</div>
<?php } ?>