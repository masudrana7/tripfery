<?php
use Rtrs\Models\Review;
use Rtrs\Helpers\Functions;
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if (!function_exists('tripfery_related_booking_two') && class_exists('BABE_Functions')) {
	function tripfery_related_booking_two()
	{
		$post_id = get_the_ID();
		$ba_post = BABE_Post_types::get_post($post_id);
		$related_arr = $ba_post['related_items'];
		$swiper_data = array(
			'slidesPerView' 	=> 2,
			'centeredSlides'	=> false,
			'loop'				=> true,
			'spaceBetween'		=> 0,
			'slideToClickedSlide' => true,
			'slidesPerGroup' => 1,
			'autoplay'				=> array(
				'delay'  => 1,
			),
			'speed'      => 500,
			'breakpoints' => array(
				'0'    => array('slidesPerView' => 1),
				'576'    => array('slidesPerView' => 2),
				'768'    => array('slidesPerView' => 2),
				'992'    => array('slidesPerView' => 3),
				'1200'    => array('slidesPerView' => 4),
				'1600'    => array('slidesPerView' => 4)
			),
			'auto'   => false
		);
		$swiper_data = json_encode($swiper_data); ?>
		<h3 class="info-card-title"><?php echo wp_kses(TripferyTheme::$options['booking_related_title'], 'alltext_allow'); ?></h3>
		<div class="rt-swiper-slider" data-xld='<?php echo esc_attr($swiper_data); ?>'>
			<div class="swiper-wrapper">
				<?php
				foreach ($related_arr as $rel_post) {
					$post = get_post($rel_post, ARRAY_A);
					$post_id 	= $post['ID'];
					$ba_post 	= BABE_Post_types::get_post($post_id);
					$url = BABE_Functions::get_page_url_with_args($post_id, $_GET);
					$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
					$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $thumbnail);
					$image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $url . '"><img class="listing-thumb w-100 img-fluid" src="' . $image_srcs[0] . '"></a>' : '';

					if (!isset($ba_post['discount_price_from']) || !isset($ba_post['price_from']) || !isset($ba_post['discount_date_to']) || !isset($ba_post['discount'])) {
						$prices = BABE_Post_types::get_post_price_from($post_id);
					} else {
						$prices = $ba_post;
					}
				?>
					<div class="swiper-slide id-<?php echo absint($rel_post) ?>">
						<div class="listing-card">
							<?php echo wp_kses_post($image); ?>
							<div class="listing-card-content">
								<div class="d-flex justify-content-between">
									<?php $address = isset($ba_post['address']) ? $ba_post['address'] : false;
									if ($address) { ?>
										<div class="badge bage-pink">
											<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
												<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
											</svg>
											<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
										</div>
									<?php } ?>

									<div class="wishlist">
										<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</div>
								</div>
								<h3 class="listing-card-title">
									<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
								</h3>
								<?php if (class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) { ?>
									<div class="d-flex align-item listing-card-review-area">
										<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
										<div class="rtrs-rating-item">
											<div class="rating-icon">
												<?php echo Functions::review_stars($avg_rating); ?>
												<span class="rating-percent">
													(<?php $total_rating = Review::getTotalRatings($post_id);
														printf(
															esc_html(_n('%s Review', '%s Reviews', $total_rating, 'revieweb')),
															esc_html($total_rating)
														); ?>)
												</span>
											</div>
										</div>
									</div>
								<?php } ?>

								<div class="d-flex align-items-center justify-content-between price-area">
									<?php
									$discount_price_from = isset($prices['discount_price_from']) ? $prices['discount_price_from'] : false;
									$price_from = isset($prices['price_from']) ? $prices['price_from'] : false;
									if ($discount_price_from || $price_from) {
										echo '<div class="rt-price">';
										if ($discount_price_from) {
											echo '<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($prices['discount_price_from']) . '</span>';
										}
										if ($discount_price_from && $price_from && ($discount_price_from < $price_from)) {
											echo '<span class="item_info_price_old">' .  BABE_Currency::get_currency_price($prices['price_from']) . '</span>';
										}
										echo '</div>';
									}
									?>
									<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated"><?php echo esc_html('View Availability', 'tripfery-core') ?></a>
								</div>
							</div>
						</div>
					</div>
				<?php }
				?>
			</div>
		</div>
<?php }
}
?>