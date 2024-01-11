<?php
if (TripferyTheme::$layout == 'full-width') {
    $tripfery_layout_class = 'col-sm-12 col-12';
} else {
    $tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
?>
<?php get_header();
if (class_exists('BABE_Functions')) {
    $loc_tex = 'ba_locations-car';
    $get_id = get_the_ID();
    $term_ids = [];
    $ba_info    = BABE_Post_types::get_post($get_id);
    $args = array(
        'post_type' => 'to_book',
        'posts_per_page' => -1,
        'paged'             => $paged,
    );
    $args = [
        'terms' => [get_queried_object_id()]
    ];
    $posts    = BABE_Post_types::get_posts($args);
?>
        <div id="primary" class="content-area">
            <?php if (count($posts) > 0) { ?>
                <div class="container rt-swiper-nav rt-booking-item-inner">
                    <?php if (!empty(TripferyTheme::$options['booking_arcive_single_title'])) { ?>
                        <h5 class="rt-car-active-title"><?php echo count($posts); ?><?php echo esc_html(" car found ");?></h5>
                    <?php } ?>
                    <div class="row  rt-search-services">
                        <?php
                        foreach ($posts as $post) {
                            $post_id     = $post['ID'];
                            $thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
                            $item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
                            $image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
                            $image = $image_srcs ? '<img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '">' : '';
                            $gea_text = get_post_meta($post_id, 'tripfery_gea_text', true);
                            $tripfery_per_rate ="";
                            $tripfery_per_rate = get_post_meta($post_id, 'tripfery_per_rate', true);
                            $url           = BABE_Functions::get_page_url_with_args($post_id, $_GET);
                            $item_terms = get_the_terms($post_id, 'categories');
                            $price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
                            $price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
                            $discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '% Off</div>' : '';
                            $featured_text = get_post_meta($post['ID'], 'tripfery_featured_check', true);
                            $item_info_price = '';

                            $ba_info     = BABE_Post_types::get_post($post_id);
                            if (!empty($post['discount_price_from'])) {
                                $item_info_price = '
                                <div class="rt-price">	
                                    ' . $price_old . '
                                    <span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span><span class="activity-person">'.$tripfery_per_rate.'</span> 
                                </div>';
                            } ?>

                            <div class="card-item rt-car-style col-lg-3 col-md-4 col-sm-6  mb-4">
                                <div class="listing-card <?php if (!empty($discount)) { echo 'discount_available '; } ?>">
                                    <div class="top-title">
                                        <h3 class="listing-card-title">
                                            <a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
                                        </h3>
                                        <div class="d-flex justify-content-between">
                                            <?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
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
										<a class="<?php if (!empty($discount)) {
                                                echo 'discount_available ';
                                            } ?> text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>

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
                                                <div class="rt-price">
                                                    <?php echo wp_kses_post($item_info_price); ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php }
                        $posts_pages = BABE_Post_types::$get_posts_pages;
                        $pagination = BABE_Functions::pager($posts_pages);
                        echo wp_kses_post($pagination);
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
<?php } ?>
<?php get_footer(); ?>