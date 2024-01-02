<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if (!function_exists('tripfery_related_booking') && class_exists('BABE_Functions')) {
	function tripfery_related_booking()
	{
		$post_id = get_the_ID();
		$ba_post = BABE_Post_types::get_post($post_id);
		$related_arr = $ba_post['related_items']; ?>
		<h3 class="info-card-title m-0"><?php echo wp_kses(TripferyTheme::$options['booking_related_title'], 'alltext_allow'); ?></h3>
		<div class="available-rooms">
			<?php
			foreach ($related_arr as $rel_post) {
				$post = get_post($rel_post, ARRAY_A);
				$post_id 	= $post['ID'];
				$ba_post 	= BABE_Post_types::get_post($post_id);
				$url = BABE_Functions::get_page_url_with_args($post_id, $_GET);
				$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
				$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $thumbnail);
				$image = $image_srcs ? '<a href="' . $url . '"><img class="room-thumb img-fluid" src="' . $image_srcs[0] . '"></a>' : '';
				if (!isset($ba_post['discount_price_from']) || !isset($ba_post['price_from']) || !isset($ba_post['discount_date_to']) || !isset($ba_post['discount'])) {
					$prices = BABE_Post_types::get_post_price_from($post_id);
				} else {
					$prices = $ba_post;
				}
				$tripfery_room_square = get_post_meta($post_id, 'tripfery_room_square', true);
				$tripfery_bed_room = get_post_meta($post_id, 'tripfery_bed_room', true);
				$group_peoples = ($ba_post['guests'] == '1') ? "Guest" : "Guests";
				$group_max_size = $ba_post['guests'] . ' ' . $group_peoples;
			?>
				<div class="d-md-flex single-available-room">
					<div class="room-thumb-wrapper">
						<?php echo wp_kses_post($image); ?>
					</div>
					<div class="single-available-room-info flex-grow-1 d-flex flex-column">
						<div class="d-flex justify-content-between">
							<h4 class="room-name"><a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a></h4>
							<span class="price"><?php echo esc_html('From', 'tripfery') ?></span>

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
						</div>
						<ul class="room-info-list d-flex">
							<?php if (!empty($tripfery_room_square)) { ?>
								<li class="info-text-wrapper d-flex align-items-center">
									<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.91667 1.66669C7.80616 1.66669 7.70018 1.71059 7.62204 1.78873C7.5439 1.86687 7.5 1.97285 7.5 2.08335C7.5 2.19386 7.5439 2.29984 7.62204 2.37798C7.70018 2.45612 7.80616 2.50002 7.91667 2.50002H11.9125L8.05833 6.35419C8.01472 6.39154 7.97929 6.43751 7.95428 6.4892C7.92927 6.54089 7.91522 6.5972 7.913 6.65458C7.91078 6.71196 7.92045 6.76919 7.9414 6.82265C7.96235 6.87612 7.99412 6.92469 8.03473 6.96529C8.07534 7.0059 8.1239 7.03767 8.17737 7.05862C8.23083 7.07957 8.28806 7.08924 8.34544 7.08702C8.40282 7.0848 8.45913 7.07075 8.51082 7.04574C8.56251 7.02073 8.60848 6.9853 8.64583 6.94169L12.5 3.08752V7.08335C12.5 7.19386 12.5439 7.29984 12.622 7.37798C12.7002 7.45612 12.8062 7.50002 12.9167 7.50002C13.0272 7.50002 13.1332 7.45612 13.2113 7.37798C13.2894 7.29984 13.3333 7.19386 13.3333 7.08335V1.66669H7.91667Z" fill="black" />
										<path d="M1.66797 7.91667C1.66797 7.80616 1.71187 7.70018 1.79001 7.62204C1.86815 7.5439 1.97413 7.5 2.08464 7.5C2.19514 7.5 2.30112 7.5439 2.37926 7.62204C2.4574 7.70018 2.5013 7.80616 2.5013 7.91667V11.9125L6.35547 8.05833C6.39282 8.01472 6.43879 7.97929 6.49048 7.95428C6.54217 7.92927 6.59848 7.91522 6.65586 7.913C6.71325 7.91078 6.77047 7.92045 6.82394 7.9414C6.87741 7.96235 6.92597 7.99412 6.96657 8.03473C7.00718 8.07534 7.03895 8.1239 7.0599 8.17737C7.08085 8.23083 7.09052 8.28806 7.0883 8.34544C7.08608 8.40282 7.07203 8.45913 7.04702 8.51082C7.02201 8.56251 6.98659 8.60848 6.94297 8.64583L3.0888 12.5H7.08464C7.19514 12.5 7.30112 12.5439 7.37926 12.622C7.4574 12.7002 7.5013 12.8062 7.5013 12.9167C7.5013 13.0272 7.4574 13.1332 7.37926 13.2113C7.30112 13.2894 7.19514 13.3333 7.08464 13.3333H1.66797V7.91667Z" fill="black" />
									</svg>
									<span class="info-text"><?php echo esc_attr($tripfery_room_square); ?></span>
								</li>
							<?php } ?>

							<?php if (!empty($tripfery_bed_room)) { ?>
								<li class="info-text-wrapper d-flex align-items-center">
									<svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.9506 3.2311H8.61628V8.64406H7.62209V6.80412C7.62093 5.76165 7.20631 4.76221 6.46918 4.02506C5.73205 3.28792 4.73262 2.87327 3.69015 2.87209H1.43605V0H0V15.4375H1.43605V13.295L20.1047 13.4443V15.4375H21.5407V6.82122C21.5396 5.86939 21.161 4.95686 20.488 4.28382C19.8149 3.61078 18.9024 3.23219 17.9506 3.2311ZM1.43605 4.30814H3.69015C4.35187 4.30889 4.98627 4.57209 5.45418 5.04C5.92209 5.50791 6.18529 6.14231 6.18604 6.80403V8.64397H1.43605V4.30814ZM20.1047 12.0082L1.43605 11.8589V10.0801H20.1047V12.0082ZM20.1047 8.64406H10.0523V4.66715H17.9506C18.5217 4.6678 19.0692 4.89496 19.473 5.29878C19.8768 5.70261 20.104 6.25013 20.1047 6.82122V8.64406Z" fill="#2B2B2B"></path>
									</svg>
									<span class="info-text"><?php echo esc_attr($tripfery_bed_room); ?></span>
								</li>
							<?php } ?>

							<li class="info-text-wrapper d-flex align-items-center">
								<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.8215 16.9768L14.2455 12.3652C14.1639 11.712 13.8464 11.1111 13.3528 10.6756C12.8593 10.24 12.2236 9.99975 11.5653 10H9.58169C8.92372 10.0002 8.28846 10.2406 7.79527 10.6762C7.30207 11.1117 6.98488 11.7123 6.90329 12.3652L6.32639 16.9768C6.29473 17.2302 6.31733 17.4874 6.3927 17.7313C6.46807 17.9753 6.59448 18.2004 6.76353 18.3918C6.93258 18.5831 7.14041 18.7363 7.37321 18.8412C7.60601 18.946 7.85846 19.0002 8.11379 19H13.035C13.2902 19.0001 13.5426 18.9458 13.7753 18.8409C14.008 18.736 14.2157 18.5828 14.3847 18.3914C14.5536 18.2001 14.6799 17.975 14.7552 17.7311C14.8306 17.4872 14.8531 17.2301 14.8215 16.9768V16.9768Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M10.575 6.4C12.0662 6.4 13.275 5.19117 13.275 3.7C13.275 2.20883 12.0662 1 10.575 1C9.08383 1 7.875 2.20883 7.875 3.7C7.875 5.19117 9.08383 6.4 10.575 6.4Z" stroke="black" />
									<path d="M3.37812 9.1C4.37224 9.1 5.17812 8.29411 5.17812 7.3C5.17812 6.30589 4.37224 5.5 3.37812 5.5C2.38401 5.5 1.57812 6.30589 1.57812 7.3C1.57812 8.29411 2.38401 9.1 3.37812 9.1Z" stroke="black" />
									<path d="M17.7766 9.1C18.7707 9.1 19.5766 8.29411 19.5766 7.3C19.5766 6.30589 18.7707 5.5 17.7766 5.5C16.7824 5.5 15.9766 6.30589 15.9766 7.3C15.9766 8.29411 16.7824 9.1 17.7766 9.1Z" stroke="black" />
									<path d="M3.37532 11.8H3.09992C2.67383 11.7999 2.26153 11.951 1.93638 12.2264C1.61123 12.5018 1.39431 12.8836 1.32422 13.3039L1.02452 15.1039C0.981512 15.3618 0.9952 15.6259 1.06463 15.878C1.13407 16.1301 1.25758 16.364 1.42658 16.5635C1.59557 16.763 1.806 16.9233 2.04323 17.0332C2.28045 17.1431 2.53877 17.2 2.80022 17.2H6.07532M17.7753 11.8H18.0507C18.4768 11.7999 18.8891 11.951 19.2143 12.2264C19.5394 12.5018 19.7563 12.8836 19.8264 13.3039L20.1261 15.1039C20.1691 15.3618 20.1554 15.6259 20.086 15.878C20.0166 16.1301 19.8931 16.364 19.7241 16.5635C19.5551 16.763 19.3446 16.9233 19.1074 17.0332C18.8702 17.1431 18.6119 17.2 18.3504 17.2H15.0753" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
								<span class="info-text"><?php echo esc_attr($group_max_size); ?></span>
							</li>
						</ul>
						<div class="d-flex">
							<a href="<?php echo esc_url($url); ?>" class="btn-xs"><?php echo esc_html('Room Detail', 'tripfery') ?></a>
							<a href="<?php echo esc_url($url); ?>" class="btn-xs active"><?php echo esc_html('Book Now', 'tripfery') ?></a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

<?php }
}
?>