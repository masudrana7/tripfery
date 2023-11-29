<?php
if (TripferyTheme::$layout == 'full-width') {
    $tripfery_layout_class = 'col-sm-12 col-12';
} else {
    $tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}
if (TripferyTheme::$options['booking_archive_style'] == 'style1') {
    $tripfery_archive_class = "rt_grid_service";
} else {
    $tripfery_archive_class = "rt_list_service";
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

    $loc_tex = 'ba_booking-locations';
    $get_id = get_the_ID();
    $loc_cats = get_the_terms($get_id, $loc_tex);

    $term_ids = [];
    foreach ($loc_cats as $loc_cat) {
        $term_ids[] = $loc_cat->term_id;
    }

    var_dump($loc_cats);
    var_dump($term_ids);

    if ($loc_cats && !is_wp_error($loc_cats)) {

    $args = array(
        'post_type' => 'to_book',
        'tax_query' => array(
            array(
                'taxonomy' => $loc_tex,
                'field' => 'term_id',
                'terms' => $term_ids,
            ),
        ),
    );

    $posts = BABE_Post_types::get_posts($args);

?>
    <div id="primary" class="content-area">
        <div class="container">
            <div class="row rt-search-services">
                <?php
                foreach ($posts as $post) {
                    $post_id     = $post['ID'];
                    $thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
                    $item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
                    $image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
                    $image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $item_url . '"><img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '"></a>' : '';
                    $url           = BABE_Functions::get_page_url_with_args($post_id, $_GET);
                    $item_terms = get_the_terms($post_id, 'categories');
                    $price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
                    $price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
                    $discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '%</div>' : '';
                    $item_info_price = '';
                    $ba_info     = BABE_Post_types::get_post($post_id);
                    if (!empty($post['discount_price_from'])) {
                        $item_info_price = '
                        <div class="rt-price">	
                            ' . $price_old . '
                            <span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
                            ' . $discount . ' 
                        </div>';
                    } ?>
                    <div class="col-md-6 col-lg-3 card-item mb-4">
                        <div class="listing-card">
                            <?php echo wp_kses_post($image); ?>
                            <div class="listing-card-content">
                                <div class="d-flex justify-content-between">

                                    <?php if (TripferyTheme::$options['booking_locaton']) { ?>
                                        <?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
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
                                    <?php } ?>


                                    <?php if (TripferyTheme::$options['booking_wishlist']) { ?>
                                        <div class="wishlist">
                                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    <?php } ?>
                                </div>
                                <h3 class="listing-card-title">
                                    <a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
                                </h3>

                                <?php if (TripferyTheme::$options['booking_rating']) { ?>
                                    <div class="d-flex align-item listing-card-review-area">
                                        <div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
                                        <div class="rt-bookoing-rating">
                                            <?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="d-flex align-items-center justify-content-between price-area">
                                    <?php echo wp_kses_post($item_info_price); ?>

                                    <?php if (TripferyTheme::$options['booking_btn']) { ?>
                                        <a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated"><?php echo esc_html('View Availability', 'tripfery-core') ?></a>
                                    <?php } ?>


                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                $posts_pages = BABE_Post_types::$get_posts_pages;
                $pagination = BABE_Functions::pager($posts_pages);
                echo $pagination;
                ?>
            </div>


        </div>
    </div>



<?php } } ?>
<?php get_footer(); ?>