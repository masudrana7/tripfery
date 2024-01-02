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
    $loc_tex = 'ba_locations';
    $get_id = get_the_ID();
    $loc_cats = get_the_terms($get_id, $loc_tex);
    $term_ids = [];
    $ba_info    = BABE_Post_types::get_post($get_id);
    $booking_map = BABE_html::block_address_map_with_direction($ba_info);
    foreach ($loc_cats as $loc_cat) {
        $term_ids[] = $loc_cat->term_id;
    }
    if (!is_wp_error($loc_cats && $loc_cat)) {
        $args = array(
            'post_type' => 'to_book',
            'posts_per_page' => -1,
            'paged'             => $paged,
        );
        $args['terms'] = $term_ids;
        $args = [
            'terms' => [get_queried_object_id()]
        ];
        $posts    = BABE_Post_types::get_posts($args);
        $lat_code = get_term_meta($loc_cat->term_id, 'ba_locations_meta', true);
        $long_code = get_term_meta($loc_cat->term_id, 'ba_locations_longitude_meta', true);
        $gallery_images = get_term_meta($loc_cat->term_id, 'rt_location_gallery', true);
        $gallerys = explode(',', $gallery_images);
?>
        <div id="primary" class="content-area">
            <div class="rt-gallery-inner hero-img-grid image-gallery">
                <?php
                $i = 1;
                foreach ($gallerys as $gallery) :
                    $image_data = wp_get_attachment_image_src($gallery, 'full');
                    $numbers = count($gallerys);
                ?>
                    <?php if ($i <= 3) { ?>
                        <a href="<?php echo esc_url($image_data[0]) ?>" class="img-grid-item">
                            <img src="<?php echo esc_url($image_data[0]) ?>" class="img-fluid grid-img" alt="">
                        </a>
                    <?php } ?>
                    <?php if (4 == $i) { ?>
                        <a href="<?php echo esc_url($image_data[0]) ?>" class=" img-grid-item">
                            <img src="<?php echo esc_url($image_data[0]) ?>" class="img-fluid grid-img" alt="">
                            <span class="rt-sinlge-btn"><?php echo esc_html('See All Photos', 'tripfery') ?></span>
                        </a>
                    <?php } ?>
                    <?php if (4 <= $i) { ?>
                        <a href="<?php echo esc_url($image_data[0]) ?>" class="img-grid-item hide_image"></a>
                    <?php } ?>
                <?php $i++;
                endforeach; ?>
            </div>
            <div class="container">
                <div class="row align-items-center rt-map-inner">
                    <?php if (!empty($lat_code || $long_code)) { ?>
                        <div class="col-md-6">
                            <div class="rt-booking-map">
                                <div id="google_map_address_with_direction" data-obj-id="<?php echo wp_kses_post($get_id); ?>" data-lat="<?php echo esc_attr($lat_code); ?>" data-lng="<?php echo esc_attr($long_code); ?>" data-address="<?php echo wp_kses_post($loc_cat->name) ?>">
                                    <?php echo wp_kses_post($booking_map); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($loc_cat->name || $loc_cat->description)) { ?>
                        <div class="col-md-6">
                            <div class="rt-booking-content">
                                <?php if ($loc_cat->name) { ?>
                                    <h3 class="rt-booking-title">
                                        <?php echo wp_kses_post($loc_cat->name) ?>
                                    </h3>
                                <?php } ?>

                                <?php if ($loc_cat->description) { ?>
                                    <div class="rt-booking-desc">
                                        <?php echo wp_kses_post($loc_cat->description) ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if (count($posts) > 0) { ?>
                <div class="container rt-swiper-nav rt-booking-item-inner">
                    <?php if (!empty(TripferyTheme::$options['booking_arcive_single_title'])) { ?>
                        <h3><?php echo wp_kses(TripferyTheme::$options['booking_arcive_single_title'], 'alltext_allow'); ?></h3>
                    <?php } ?>
                    <div class="rt-archive-slider swiper  rt-search-services">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($posts as $post) {
                                $post_id     = $post['ID'];
                                $thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
                                $item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
                                $image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
                                $image = $image_srcs ? '<img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '">' : '';
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
                                <span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
                            </div>';
                                } ?>
                                <div class="swiper-slide">
                                    <div class="card-item mb-4">
                                        <div class="listing-card <?php if (!empty($discount)) {
                                                                        echo 'discount_available ';
                                                                    } ?>">
                                            <?php if (!empty($image_srcs)) { ?>
                                                <a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
                                                    <?php echo wp_kses_post($image); ?>
                                                    <?php echo wp_kses_post($discount); ?>
                                                    <?php if ('on' == $featured_text) { ?>
                                                        <div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
                                                    <?php } ?>
                                                </a>
                                            <?php } ?>
                                            <div class="listing-card-content">
                                                <div class="d-flex justify-content-between">
                                                    <?php if (TripferyTheme::$options['booking_locaton']) { ?>
                                                        <?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
                                                        if ($address) {  ?>
                                                            <div class="badge bage-pink">
                                                                <svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
                                                                    <path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
                                                                </svg>
                                                                <span class="badge-text"><?php echo esc_html($address['address']); ?></span>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if (TripferyTheme::$options['booking_wishlist']) { ?>
                                                        <?php if (class_exists('RTWishlist')) {
                                                            echo RTWishlist::wishlist_html($post_id);
                                                        } ?>
                                                    <?php } ?>
                                                </div>
                                                <h3 class="listing-card-title">
                                                    <a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
                                                </h3>

                                                <?php if (TripferyTheme::$options['booking_rating']) { ?>
                                                    <div class="d-flex align-item listing-card-review-area">
                                                        <div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery') ?></div>
                                                        <div class="rt-bookoing-rating">
                                                            <?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="d-flex align-items-center justify-content-between price-area">
                                                    <?php echo wp_kses_post($item_info_price); ?>
                                                    <?php if (TripferyTheme::$options['booking_btn']) { ?>
                                                        <a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated"><?php echo esc_html('View Availability', 'tripfery') ?></a>
                                                    <?php } ?>
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
                    <div class="swiper-navigation">
                        <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>
            <?php } ?>
        </div>
<?php }
} ?>
<?php get_footer(); ?>