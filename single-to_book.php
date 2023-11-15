<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
get_header();
if (class_exists('BABE_Functions')) {

	$tripfery_layout_class = (TripferyTheme::$layout == 'full-width') ? 'col-md-12' : 'col-md-8';
	$post_id = get_the_ID();
	$ba_info	= BABE_Post_types::get_post($post_id);

	$address = isset($ba_info['address']) ? $ba_info['address'] : false;
	$images = isset($ba_info['images']) ? $ba_info['images'] : array();
	if (!isset($ba_info['discount_price_from']) || !isset($ba_info['price_from']) || !isset($ba_info['discount_date_to']) || !isset($ba_info['discount'])) {
		$price = BABE_Post_types::get_post_price_from($ba_info['ID']);
	} else {
		$price = $ba_info;
	}
	$property_title = get_post_meta($post_id, 'tripfery_booking_property_title', true);
	$booking_propertys = get_post_meta($post_id, 'tripfery_booking_property', true);
	$property_name = get_post_meta($post_id, 'property_name', true);
	$property_image = get_post_meta($post_id, 'property_image', true);
	$booking_rules = get_post_meta($post_id, 'tripfery_booking_rules', true);
	$rules_title = get_post_meta($post_id, 'tripfery_booking_rules_title', true);
	$rules_time = get_post_meta($post_id, 'rules_time', true);

	$total_rating = BABE_Rating::get_post_total_rating($post_id);
	$total_votes  = BABE_Rating::get_post_total_votes($post_id);
	$stars_num    = BABE_Settings::get_rating_stars_num($post_id);

	$booking_coloum = "col-md-12";
	$rating_criteria = BABE_Settings::get_rating_criteria();
	if (is_active_sidebar('booking-form')) {
		$booking_coloum = "col-md-8";
	}
	$booking_style = TripferyTheme::$options['booking_style'];

	// Create an associative array of variables
	$args = array(
		'tripfery_layout_class' => $tripfery_layout_class,
		'post_id' => $post_id,
		'address' => $address,
		'booking_coloum' => $booking_coloum,
	);



?>
	<div id="primary" class="rt-booking-single content-area">
		<div id="contentHolder">
			<div class="container">
				<?php get_template_part('template-parts/single-booking/layout', $booking_style, $args); ?>
			</div>
		</div>
	</div>

<?php } ?>
<?php get_footer(); ?>