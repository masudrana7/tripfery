<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
get_header();
if (class_exists('BABE_Functions')) {
	$tripfery_layout_class = (TripferyTheme::$layout == 'full-width') ? 'col-md-12' : 'col-md-8';
	$post_id = 	get_the_ID();
	$booking_faqs = "";
	$ba_info	= BABE_Post_types::get_post($post_id);
	error_log(print_r($ba_info, true), 3, __DIR__ . '/log.txt');
	if (!empty($ba_info) && isset($ba_info['faq']) && !empty($ba_info['faq'])) {
		$booking_faqs = BABE_Post_types::get_post_faq($ba_info);
	}
	$booking_map = "";
	$booking_map = BABE_html::block_address_map_with_direction($ba_info);
	$booking_steps = isset($ba_info['steps']) ? $ba_info['steps'] : false;
	$address = isset($ba_info['address']) ? $ba_info['address'] : false;
	$price = "";
	if (!isset($ba_info['discount_price_from']) || !isset($ba_info['price_from']) || !isset($ba_info['discount_date_to']) || !isset($ba_info['discount'])) {
		$price = BABE_Post_types::get_post_price_from($ba_info['ID']);
	} else {
		$price = $ba_info;
	}
	$type_name = "";
	$type_link = "";
	$booking_types = wp_get_post_terms($post_id, 'ba_booking-type');
	if (!is_wp_error($booking_types) && !empty($booking_types)) {
		foreach ($booking_types as $booking_type) {
			$type_name = $booking_type->name;
			$type_link = get_term_link($booking_type);
		}
	}
	$group_peoples = ($ba_info['guests'] == '1') ? "People" : "Peoples";
	$group_max_size = $ba_info['guests'] . ' ' . $group_peoples;
	$arr = array();
	$valu_duration = '';
	if (!empty($ba_info) && isset($ba_info['duration']) && !empty($ba_info['duration'])) {
		if (!empty($ba_info['duration']['d'])) {
			$arr[] = $ba_info['duration']['d'] . ' ' . ($ba_info['duration']['d'] == '1' ? __('day', 'tripfery') : __('days', 'tripfery'));
		}
		if (!empty($ba_info['duration']['h'])) {
			$arr[] = $ba_info['duration']['h'] . ' ' . ($ba_info['duration']['h'] == '1' ? __('hour', 'tripfery') : __('hours', 'tripfery'));
		}
		if (!empty($ba_info['duration']['i'])) {
			$arr[] = $ba_info['duration']['i'] . ' ' . ($ba_info['duration']['i'] == '1' ? __('minute', 'tripfery') : __('minutes', 'tripfery'));
		}
		$valu_duration .= implode(' ', $arr);
	}
	$rt_stars = BABE_Rating::post_stars_rendering($post_id);
	$property_title = get_post_meta($post_id, 'tripfery_booking_property_title', true);
	$booking_propertys = get_post_meta($post_id, 'tripfery_booking_property', true);
	$property_name = get_post_meta($post_id, 'property_name', true);
	$property_image = get_post_meta($post_id, 'property_image', true);
	$booking_rules = get_post_meta($post_id, 'tripfery_booking_rules', true);
	$rules_title = get_post_meta($post_id, 'tripfery_booking_rules_title', true);
	$rules_time = get_post_meta($post_id, 'rules_time', true);
	$booking_highlights = get_post_meta($post_id, 'tripfery_booking_highlights', true);
	$highlights_title = get_post_meta($post_id, 'tripfery_booking_highlights_title', true);
	$booking_included = get_post_meta($post_id, 'tripfery_booking_included', true);
	$booking_excluded = get_post_meta($post_id, 'tripfery_booking_excluded', true);
	$included_title = get_post_meta($post_id, 'tripfery_booking_included_title', true);
	$itinerary_title = get_post_meta($post_id, 'tripfery_itinerary_title', true);
	$booking_durations = get_post_meta($post_id, 'tripfery_booking_durations', true);
	$durations_title = get_post_meta($post_id, 'tripfery_booking_durations_title', true);
	$booking_languages = get_post_meta($post_id, 'tripfery_booking_languages', true);
	$language_title = get_post_meta($post_id, 'tripfery_booking_language_title', true);
	$faq_title = get_post_meta($post_id, 'tripfery_faq_title', true);
	$map_title = get_post_meta($post_id, 'tripfery_map_title', true);
	$car_specifications = get_post_meta($post_id, 'tripfery_car_specifications', true);
	$booking_features = get_post_meta($post_id, 'tripfery_booking_features', true);
	$feature_title = get_post_meta($post_id, 'tripfery_booking_feature_title', true);
	$booking_brands = get_post_meta($post_id, 'tripfery_booking_brands', true);
	$brand_title = get_post_meta($post_id, 'tripfery_booking_brand_title', true);


	$total_rating = BABE_Rating::get_post_total_rating($post_id);
	$total_votes  = BABE_Rating::get_post_total_votes($post_id);
	$stars_num    = BABE_Settings::get_rating_stars_num($post_id);
	$booking_coloum = "col-md-12";
	$rating_criteria = BABE_Settings::get_rating_criteria();
	if (is_active_sidebar('booking-form')) {
		$booking_coloum = "col-md-8";
	}
	$discountPrice = BABE_Currency::get_currency_price($price['discount_price_from']);
	$nPrice = BABE_Currency::get_currency_price($price['price_from']);
	$languages 		= get_post_meta($post_id, 'tripfery_languages', true);
	$args = array(
		'tripfery_layout_class' => $tripfery_layout_class,
		'post_id' 				=> $post_id,
		'ba_info' 				=> $ba_info,
		'address' 				=> $address,
		'booking_coloum' 		=> $booking_coloum,
		'rating_criteria' 		=> $rating_criteria,
		'stars_num' 			=> $stars_num,
		'total_votes' 			=> $total_votes,
		'total_rating' 			=> $total_rating,
		'rules_time' 			=> $rules_time,
		'rules_title' 			=> $rules_title,
		'booking_rules' 		=> $booking_rules,
		'booking_highlights' 	=> $booking_highlights,
		'highlights_title' 		=> $highlights_title,
		'property_image' 		=> $property_image,
		'property_name' 		=> $property_name,
		'booking_propertys' 	=> $booking_propertys,
		'property_title' 		=> $property_title,
		'price' 				=> $price,
		'rt_stars' 				=> $rt_stars,
		'discountPrice' 		=> $discountPrice,
		'nPrice' 				=> $nPrice,
		'valu_duration'			=> $valu_duration,
		'type_name' 			=> $type_name,
		'type_link' 			=> $type_link,
		'group_max_size' 		=> $group_max_size,
		'languages' 			=> $languages,
		'booking_included' 		=> $booking_included,
		'booking_excluded' 		=> $booking_excluded,
		'included_title' 		=> $included_title,
		'booking_steps' 		=> $booking_steps,
		'itinerary_title' 		=> $itinerary_title,
		'booking_durations' 	=> $booking_durations,
		'durations_title' 		=> $durations_title,
		'booking_languages' 	=> $booking_languages,
		'language_title' 		=> $language_title,
		'booking_faqs' 			=> $booking_faqs,
		'faq_title' 			=> $faq_title,
		'car_specifications' 	=> $car_specifications,
		'booking_map' 			=> $booking_map,
		'map_title' 			=> $map_title,
		'booking_features' 		=> $booking_features,
		'feature_title' 		=> $feature_title,
		'booking_brands' 		=> $booking_brands,
		'brand_title' 		=> $brand_title,
	);
?>
	<div id="primary" class="rt-booking-single content-area rt_booking_single_<?php echo esc_attr(TripferyTheme::$booking_style); ?>">
		<div id="contentHolder">
			<?php get_template_part('template-parts/single-booking/layout', TripferyTheme::$booking_style, $args); ?>
		</div>
	</div>

<?php } ?>
<?php get_footer(); ?>