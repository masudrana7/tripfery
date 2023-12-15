<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
global $post;
$guided_verifieds       		= get_post_meta($post->ID, 'tripfery_guided_verifieds', true);
$guided_since       			= get_post_meta($post->ID, 'tripfery_guided_since', true); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('quided-single'); ?>>
	<div class="team-single-content has-sidebar">
		<div class="rt-guided-inner">
			<div class="rt-guided-image">
				<div class="team-thumb">
					<?php
					if (has_post_thumbnail()) {
						the_post_thumbnail('full');
					} else {
						if (!empty(TripferyTheme::$options['no_preview_image']['id'])) {
							echo wp_get_attachment_image(TripferyTheme::$options['no_preview_image']['id'], 'full');
						} else {
							echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img('noimage.jpg') . '" alt="' . get_the_title() . '">';
						}
					}
					?>
				</div>
			</div>
			<div class="rt-guided-content">
				<div class="team-contents">
					<div class="rt-guided-title-inner">
						<div class="guided-heading">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<?php if (!empty($guided_since)) { ?>
								<div class="rt-guided-reviews">
									<?php echo esc_html($guided_since); ?>
								</div>
							<?php } ?>
						</div>
						<div class="rt-guided-verify">
							<ul class="verfiy-lists">
								<?php foreach ($guided_verifieds as $value) { ?>
									<li><i class="fa-solid fa-check"></i><span><?php echo esc_html($value['verified_name']); ?></span></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php if (!empty(TripferyTheme::$options['guided_about_me'])) { ?>
						<div class="rt-guided-description">
							<h3 class="guided-about"><?php echo wp_kses(TripferyTheme::$options['guided_about_me'], 'alltext_allow'); ?></h3>
						</div>
					<?php } ?>
					<?php the_content(); ?>
					<?php
					$post_id = get_the_ID();
					$taxonomy = 'categories';
					$terms = wp_get_post_terms($post_id, $taxonomy);
					$args = array(
						'post_type'      => 'to_book',
						'posts_per_page' => -1,
						'meta_query'     => array(
							array(
								'key'     => 'booking_guided',
								'value'   => $post_id,
								'compare' => '=',
							),
						),
					);
					$query = new WP_Query($args);
					if (class_exists('BABE_Functions')) { ?>
						<div class="rt-case-isotope case-multi-isotope-1 rt-isotope-wrapper">
							<div class="row">
								<div class="col-auto">
									<div class="listing-filter-btn d-flex align-items-center flex-wrap">
										<?php
										$term_ids = array();
										if ($query->have_posts()) {
											while ($query->have_posts()) {
												$query->the_post();
												$post_terms = wp_get_post_terms(get_the_ID(), $taxonomy);
												foreach ($post_terms as $term) {
													if (!in_array($term->term_id, $term_ids)) {
														$term_ids[] = $term->term_id; ?>
														<button class="filter-btn <?php echo esc_attr($term->slug); ?>" data-filter=".<?php echo esc_attr($term->slug); ?>">
															<?php echo esc_html($term->name); ?>
														</button>
										<?php }
												}
											}
											wp_reset_postdata();
										} ?>
									</div>
								</div>
							</div>
							<div class="row justify-content-center cardContainer">
								<?php
								$term_ids = array();
								if ($query->have_posts()) {
									while ($query->have_posts()) {
										$query->the_post();
										$post_id = get_the_ID();
										$post_terms = wp_get_post_terms($post_id, $taxonomy);
										$post = BABE_Post_types::get_post($post_id);
										$post_id 	= $post['ID'];
										$url   		= BABE_Functions::get_page_url_with_args($post_id, $_GET);
										$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
										$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
										$gea_text = get_post_meta($post_id, 'tripfery_gea_text', true);
										$guide_id = get_post_meta($post['ID'], 'booking_guided', true);
										$featured_text = get_post_meta($post['ID'], 'tripfery_featured_check', true);
										if ($guide_id) {
											$guided_title = get_the_title($guide_id);
											$guided_link = get_the_permalink($guide_id);
											$post_thumbnail_url = get_the_post_thumbnail_url($guide_id, 'full');
										}
										$price = "";
										if (!isset($post['discount_price_from']) || !isset($post['price_from']) || !isset($post['discount_date_to']) || !isset($post['discount'])) {
											$price = BABE_Post_types::get_post_price_from($post['ID']);
										}
										$discountPrice = BABE_Currency::get_currency_price($price['discount_price_from']);
										$nPrice = BABE_Currency::get_currency_price($price['price_from']);
										foreach ($post_terms as $term) {
											if (!in_array($term->term_id, $term_ids)) {
												$term_ids[] = $term->term_id; ?>
										<?php }
										} ?>
										<!-- Tour Style -->
										<?php
										if ($term->slug == "tour") { ?>
											<div class="card-item rt_booking_style3 col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($term->slug); ?> mb-4">
												<div class="listing-card <?php echo esc_attr($term->name) ?>">
													<?php
													if (!empty($image_srcs)) { ?>
														<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($url); ?>">
															<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
															<?php if ('on' == $featured_text) { ?>
																<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
															<?php } ?>
														</a>
													<?php } ?>

													<div class="listing-card-content">
														<div class="d-flex justify-content-between">
															<?php $address = isset($post['address']) ? $post['address'] : false;
															if ($address) {
															?>
																<div class="badge bage-pink">
																	<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
																		<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
																	</svg>
																	<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
																</div>
															<?php } ?>
															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
														</div>

														<h3 class="listing-card-title">
															<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
														</h3>


														<div class="d-flex align-items-center justify-content-between tour-info-middle">
															<?php if ($nPrice || $discountPrice) { ?>
																<div class="d-flex flex-column">
																	<span class="text-gray"><?php echo esc_html('Start from', 'tripfery')?></span>
																	<?php if ($price['discount_price_from']) { ?>
																		<span class="price-text item_info_price_new">
																			<span class="currency_amount" data-amount="<?php echo esc_attr($discountPrice); ?>"><?php echo wp_kses_post($discountPrice); ?></span>
																		</span>
																	<?php } else { ?>
																		<span class="price-text item_info_price_new">
																			<span class="currency_amount" data-amount="<?php echo esc_attr($nPrice); ?>"><?php echo wp_kses_post($nPrice); ?></span>
																		</span>
																	<?php } ?>
																</div>
															<?php } ?>

															<?php if ($guide_id) { ?>
																<div class="d-flex flex-column">
																	<span class="text-gray"><?php echo esc_html('Guided By', 'tripfery-core') ?></span>
																	<div class="d-flex align-items-center">
																		<?php if (!empty($post_thumbnail_url)) { ?>
																			<div>
																				<img src="<?php echo esc_html($post_thumbnail_url); ?>" class="author-avatar" alt="People">
																			</div>
																		<?php } ?>

																		<h4><a href="<?php echo esc_url($guided_link); ?>" class="author-name"><?php echo esc_html($guided_title); ?></a></h4>

																	</div>
																</div>
															<?php } ?>
														</div>



														<?php if (!empty(BABE_Rating::post_stars_rendering($post['ID']))) { ?>
															<div class="d-flex align-item listing-card-review-area">
																<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
																<div class="rt-bookoing-rating">
																	<?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
																</div>
															</div>
														<?php } ?>

													</div>
												</div>
											</div>

											<!-- Activity Style -->
										<?php } elseif ($term->slug == "activity") { ?>
											<div class="card-item col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($term->slug); ?> mb-4">
												<div class="listing-card <?php echo esc_attr($term->name) ?>">
													<?php if (!empty($image_srcs)) { ?>
														<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($url); ?>">
															<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
															<?php if ('on' == $featured_text) { ?>
																<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
															<?php } ?>
															<span class="booking-top-rating">
																<i class="fa-solid fa-star"></i>
																<?php echo BABE_Rating::get_post_total_rating($post_id); ?>
															</span>

														</a>
													<?php } ?>

													<div class="listing-card-content">
														<div class="d-flex justify-content-between">
															<?php $address = isset($post['address']) ? $post['address'] : false;
															if ($address) {
															?>
																<div class="badge bage-pink">
																	<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
																		<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
																	</svg>
																	<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
																</div>
															<?php } ?>
															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
														</div>

														<h3 class="listing-card-title">
															<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
														</h3>

														<div class="d-flex align-items-center justify-content-between price-area">
															<?php if ($price['discount_price_from']) { ?>
																<span class="price-text item_info_price_new">
																	<span class="currency_amount" data-amount="<?php echo esc_attr($discountPrice); ?>"><?php echo wp_kses_post($discountPrice); ?></span>
																</span>
															<?php } else { ?>
																<span class="price-text item_info_price_new">
																	<span class="currency_amount" data-amount="<?php echo esc_attr($nPrice); ?>"><?php echo wp_kses_post($nPrice); ?></span>
																</span>
															<?php } ?>
															<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
																<?php echo esc_html('Book Now', 'tripfery') ?>
															</a>

														</div>

													</div>
												</div>
											</div>

											<!-- Rental Style -->
										<?php } elseif ($term->slug == "rental") { ?>
											<div class="card-item col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($term->slug); ?> mb-4">
												<div class="listing-card <?php echo esc_attr($term->name) ?>">
													<?php if (!empty($image_srcs)) { ?>
														<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($url); ?>">
															<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
															<?php if ('on' == $featured_text) { ?>
																<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
															<?php } ?>
														</a>
													<?php } ?>

													<div class="listing-card-content">
														<div class="d-flex justify-content-between">
															<?php $address = isset($post['address']) ? $post['address'] : false;
															if ($address) {
															?>
																<div class="badge2 bage-pink">
																	<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
																		<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
																	</svg>
																	<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
																</div>
															<?php } ?>
														</div>

														<h3 class="listing-card-title">
															<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
														</h3>

														<?php if ($price['discount_price_from']) { ?>
															<span class="price-text item_info_price_new">
																<span class="currency_amount" data-amount="<?php echo esc_attr($discountPrice); ?>"><?php echo wp_kses_post($discountPrice); ?></span>
															</span>
														<?php } else { ?>
															<span class="price-text item_info_price_new">
																<span class="currency_amount" data-amount="<?php echo esc_attr($nPrice); ?>"><?php echo wp_kses_post($nPrice); ?></span>
															</span>
														<?php } ?>

													</div>
												</div>
											</div>

											<!-- Car Style -->
										<?php } elseif ($term->slug == "car") { ?>
											<div class="card-item rt-car-style col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($term->slug); ?> mb-4">
												<div class="listing-card  <?php echo esc_attr($term->name) ?> <?php if (!empty($discount)) {
																													echo 'discount_available ';
																												} ?>">
													<div class="top-title">
														<h3 class="listing-card-title">
															<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
														</h3>
														<div class="d-flex justify-content-between">
															<?php $address = isset($post['address']) ? $post['address'] : false;
															if ($address) {
															?>
																<div class="badge2 bage-pink">
																	<span class="badge-text"><?php echo esc_html($address['address']); ?></span>

																</div>
															<?php } ?>
															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
														</div>
													</div>

													<?php if (!empty($image_srcs)) { ?>
														<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($url); ?>">
															<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />

															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
															<?php if ('on' == $featured_text) { ?>
																<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
															<?php } ?>

														</a>
													<?php } ?>

													<div class="listing-card-content">
														<div class="d-flex align-items-center justify-content-between price-area">
															<div class="card-bottom-info-left d-flex">
																<?php if ($post['guests']) { ?>
																	<span class="car-seat">
																		<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<path d="M7.63314 9.05857C7.5498 9.05023 7.4498 9.05023 7.35814 9.05857C5.3748 8.9919 3.7998 7.3669 3.7998 5.3669C3.7998 3.32523 5.4498 1.6669 7.4998 1.6669C9.54147 1.6669 11.1998 3.32523 11.1998 5.3669C11.1915 7.3669 9.61647 8.9919 7.63314 9.05857Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M13.6747 3.3331C15.2914 3.3331 16.5914 4.64143 16.5914 6.24977C16.5914 7.82477 15.3414 9.1081 13.7831 9.16644C13.7164 9.1581 13.6414 9.1581 13.5664 9.16644" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M3.4666 12.1331C1.44993 13.4831 1.44993 15.6831 3.4666 17.0248C5.75827 18.5581 9.5166 18.5581 11.8083 17.0248C13.8249 15.6748 13.8249 13.4748 11.8083 12.1331C9.52493 10.6081 5.7666 10.6081 3.4666 12.1331Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M15.2832 16.6669C15.8832 16.5419 16.4499 16.3002 16.9165 15.9419C18.2165 14.9669 18.2165 13.3586 16.9165 12.3836C16.4582 12.0336 15.8999 11.8002 15.3082 11.6669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																		</svg>
																		<span class="valu"><?php echo esc_attr($post['guests']); ?></span>
																	</span>
																<?php } ?>
																<?php if (!empty($gea_text)) { ?>
																	<span class="manual">
																		<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<path d="M16.6667 11.6667C17.5871 11.6667 18.3333 10.9205 18.3333 10C18.3333 9.07952 17.5871 8.33333 16.6667 8.33333C15.7462 8.33333 15 9.07952 15 10C15 10.9205 15.7462 11.6667 16.6667 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M16.6667 5C17.5871 5 18.3333 4.25381 18.3333 3.33333C18.3333 2.41286 17.5871 1.66667 16.6667 1.66667C15.7462 1.66667 15 2.41286 15 3.33333C15 4.25381 15.7462 5 16.6667 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M16.6667 18.3333C17.5871 18.3333 18.3333 17.5871 18.3333 16.6667C18.3333 15.7462 17.5871 15 16.6667 15C15.7462 15 15 15.7462 15 16.6667C15 17.5871 15.7462 18.3333 16.6667 18.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M3.33366 11.6667C4.25413 11.6667 5.00033 10.9205 5.00033 10C5.00033 9.07952 4.25413 8.33333 3.33366 8.33333C2.41318 8.33333 1.66699 9.07952 1.66699 10C1.66699 10.9205 2.41318 11.6667 3.33366 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M5 10H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																			<path d="M15.0003 3.33333H11.667C10.0003 3.33333 9.16699 4.16667 9.16699 5.83333V14.1667C9.16699 15.8333 10.0003 16.6667 11.667 16.6667H15.0003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
																		</svg>
																		<span class="valu"><?php echo esc_html($gea_text); ?></span>
																	</span>
																<?php } ?>
															</div>

															<div class="pt-0 d-flex align-items-center justify-content-between price-area">
																<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
																	<?php echo esc_html('Booking Now', 'tripfery') ?>
																</a>

															</div>
														</div>
													</div>

												</div>
											</div>
										<?php } else { ?>
											<div class="card-item col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($term->slug); ?> mb-4">
												<div class="listing-card <?php echo esc_attr($term->name) ?> <?php if (!empty($discount)) {
																													echo 'discount_available ';
																												} ?>">
													<?php if (!empty($image_srcs)) { ?>
														<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($url); ?>">
															<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
															<?php if ('on' == $featured_text) { ?>
																<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
															<?php } ?>
														</a>
													<?php } ?>

													<div class="listing-card-content">
														<div class="d-flex justify-content-between">
															<?php $address = isset($post['address']) ? $post['address'] : false;
															if ($address) {
															?>
																<div class="badge bage-pink">
																	<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
																		<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
																	</svg>
																	<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
																</div>
															<?php } ?>
															<?php if (class_exists('RTWishlist')) {
																echo RTWishlist::wishlist_html($post_id);
															} ?>
														</div>

														<h3 class="listing-card-title">
															<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
														</h3>

														<?php if (!empty(BABE_Rating::post_stars_rendering($post['ID']))) { ?>
															<div class="d-flex align-item listing-card-review-area">
																<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
																<div class="rt-bookoing-rating">
																	<?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
																</div>
															</div>
														<?php } ?>

														<div class="d-flex align-items-center justify-content-between price-area">
															<div class="rt-price">

																<?php if ($price['discount_price_from']) { ?>
																	<span class="price-text item_info_price_new">
																		<span class="currency_amount" data-amount="<?php echo esc_attr($discountPrice); ?>"><?php echo wp_kses_post($discountPrice); ?></span>
																	</span>
																<?php } else { ?>
																	<span class="price-text item_info_price_new">
																		<span class="currency_amount" data-amount="<?php echo esc_attr($nPrice); ?>"><?php echo wp_kses_post($nPrice); ?></span>
																	</span>
																<?php } ?>

															</div>
															<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
																<?php echo esc_html('View Availability', 'tripfery') ?>
															</a>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
								<?php }
									wp_reset_postdata();
								} ?>
							</div>
						</div>
					<?php } ?>

					<!-- Comments  -->
					<div class="info-card">
						<?php
						if (comments_open() || get_comments_number()) {
							comments_template();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>