<?php

/**
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

$iso						= 'g-4 no-equal-gallery';

if (TripferyTheme::$options['locations_archive_style'] == 'style1') {
	$locations_archive_layout 	= "rt-locations-default rt-locations-multi-layout-1";
	$template 				 	= 'booking-1';
} elseif (TripferyTheme::$options['locations_archive_style'] == 'style2') {
	$locations_archive_layout 	= "rt-locations-default rt-locations-multi-layout-2";
	$template 				 	= 'booking-2';
} elseif (TripferyTheme::$options['locations_archive_style'] == 'style3') {
	$locations_archive_layout 	= "rt-locations-default rt-locations-multi-layout-3";
	$template 				 	= 'booking-3';
} else {
	$locations_archive_layout 	= "rt-locations-default rt-locations-multi-layout-1";
	$template 				 	= 'booking-1';
}

$post_classes = "";
if (TripferyTheme::$layout == 'right-sidebar' || TripferyTheme::$layout == 'left-sidebar') {
	$post_classes = 'col-sm-6 col-md-6';
} else {
	$post_classes = 'col-sm-6 col-xl-4';
}

if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}
$locations_post_number = TripferyTheme::$options['locations_post_number'];
$args = array(
	'posts_per_page'    => $locations_post_number,
	'post_type'			=> 'to_book',
	'post_status'		=> 'publish',
	'paged'             => $paged,
);

$query = new WP_Query($args);

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php
			if (TripferyTheme::$layout == 'left-sidebar') {
				get_sidebar();
			}
			?>
			<div class="<?php echo esc_attr($locations_archive_layout); ?> <?php echo esc_attr($tripfery_layout_class); ?>">
				<main id="main" class="site-main">
					<?php if ($query->have_posts()) : ?>
						<div class="row <?php echo esc_attr($iso); ?>">

							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<div class="<?php echo esc_attr($post_classes); ?>">

									<?php get_template_part( 'template-parts/content', $template ); ?>

								</div>
							<?php endwhile; ?>

						</div>
						<?php TripferyTheme_Helper::pagination(); ?>
					<?php else : ?>
						<?php get_template_part('template-parts/content', 'none'); ?>
					<?php endif; ?>
				</main>
			</div>
			<?php
			if (TripferyTheme::$layout == 'right-sidebar') {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>