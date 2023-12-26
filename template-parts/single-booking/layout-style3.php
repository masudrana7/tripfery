<?php
extract($args);
$images = isset($ba_info['images']) ? $ba_info['images'] : array(); ?>
<div class="container">
    <div class="swiper largeSwiper">
        <div class="swiper-wrapper">
            <?php
            foreach ($images as $key => $image) {
                $image_id = $image['image_id'];
                $image_url = wp_get_attachment_image_url($image_id, 'full');
            ?>
                <div class="swiper-slide">
                    <div class="slider-img-wrapper">
                        <img src="<?php echo esc_url($image_url); ?>" class="slider-img img-fluid" alt="" />
                    </div>
                </div>
            <?php } ?>
        </div>
        <div thumbsSlider="" class="swiper largeSwiperThumb">
            <div class="swiper-wrapper">
                <?php
                foreach ($images as $key => $image) {
                    $image_id = $image['image_id'];
                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                ?>
                    <div class="swiper-slide">
                        <div class="slider-thumb-img">
                            <img src="<?php echo esc_url($image_url); ?>" class="img-fluid thumb-img" alt="" />
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row align-items-center rt-booking-price-area">
        <div class="col-lg-5 col-xl-5 col-xxl-4">
            <div class="mb-4 mb-xxl-0">
                <h3 class="activity-title"><?php the_title(); ?></h3>
                <?php if (!empty($address['address'])) { ?>
                    <address class="activity-location mb-0"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.50469 8.39365C8.58164 8.39365 9.45469 7.52061 9.45469 6.44365C9.45469 5.3667 8.58164 4.49365 7.50469 4.49365C6.42773 4.49365 5.55469 5.3667 5.55469 6.44365C5.55469 7.52061 6.42773 8.39365 7.50469 8.39365Z" stroke="#E7233A" stroke-opacity="0.99" />
                            <path d="M2.2611 5.30631C3.49235 -0.106188 11.5111 -0.0999374 12.7361 5.31256C13.4548 8.48756 11.4798 11.1751 9.7486 12.8376C8.49235 14.0501 6.50485 14.0501 5.24235 12.8376C3.51735 11.1751 1.54235 8.48131 2.2611 5.30631Z" stroke="#E7233A" stroke-opacity="0.99" />
                        </svg>
                        <?php echo esc_html($address['address'], 'tripfery'); ?>
                    </address>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-8 col-xl-7 col-xxl-6">
            <?php if (!empty($car_specifications)) { ?>
                <ul class="r-feature-list rt-two-col rt-mp-0">
                    <?php foreach ($car_specifications as $car_specification) { ?>
                        <li class="d-flex r-feature-list-item align-items-center">
                            <i class="fa-solid fa-circle-check"></i>
                            <?php echo esc_html($car_specification['specification_name']) ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <div class="col-lg-4 col-xl">
            <div class="activity-price rt-price-single-inner align-items-center d-flex">
                <div class="price-area">
                    <span class="from"><?php echo esc_html('From', 'tripfery') ?></span>
                    <?php if ($discountPrice) { ?>
                        <div class="rt-single-price rt-old-price">
                            <?php echo $discountPrice; ?>
                        </div>
                    <?php } else { ?>
                        <div class="rt-single-price rt-new-price">
                            <?php echo $nPrice; ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if (function_exists('tripfery_post_share')) { ?>
                    <div class="rt-share-service">
                        <a href="#" class="share-btn">
                            <svg width="16" height="15" viewBox="0 0 16 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.7363 6.52539L9.58008 10.9492C9.14062 11.3301 8.4375 11.0078 8.4375 10.4219V7.87305C3.86719 7.93164 1.93359 9.04492 3.25195 13.293C3.39844 13.7617 2.8125 14.1426 2.43164 13.8496C1.14258 12.9121 0 11.125 0 9.33789C0 4.88477 3.7207 3.91797 8.4375 3.85938V1.54492C8.4375 0.929688 9.14062 0.607422 9.58008 0.988281L14.7363 5.41211C15.0586 5.73438 15.0586 6.23242 14.7363 6.52539Z" />
                            </svg>
                            <?php tripfery_post_share(); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if (TripferyTheme::$layout == 'left-sidebar' && is_active_sidebar('booking-sidebar')) { ?>
            <div class="col-md-4">
                <div class="info-card rt-booking-form">
                    <?php dynamic_sidebar('booking-sidebar'); ?>
                </div>
            </div>
        <?php } ?>
        <div class="<?php echo esc_attr($tripfery_layout_class); ?>">
            <?php if (!empty($booking_propertys)) { ?>
                <div class="info-card">
                    <?php if (!empty($property_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($property_title); ?></h3>
                    <?php } ?>
                    <ul class="highligts d-flex flex-wrap">
                        <?php foreach ($booking_propertys as $booking_property) {
                            $image_id = $booking_property['property_image'];
                            $image_url = wp_get_attachment_image_url($image_id, 'full');
                        ?>
                            <li class="highligts-item d-flex align-items-center justify-content-center">
                                <img src="<?php echo esc_url($image_url); ?>" class="img-fluid--- grid-img---" alt="" />
                                <h4 class="highligts-name"><?php echo esc_html($booking_property['property_name']) ?></h4>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <!-- Description Text  -->
            <div class="rt-booking-content info-card">
                <h3 class="rt-overview-title"><?php echo esc_html('Overview', 'tripfery'); ?></h3>
                <?php the_content(); ?>
            </div>

            <!-- Hotel Rules  -->
            <?php if (!empty($booking_rules)) { ?>
                <div class="info-card">
                    <?php if (!empty($rules_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($rules_title); ?></h3>
                    <?php } ?>
                    <ul class="d-flex flex-wrap hotel-rules-list">
                        <?php foreach ($booking_rules as $booking_rule) {
                        ?>
                            <li class="hotel-rules-list-item d-flex justify-content-between">
                                <?php if ($booking_rule['rules_name']) { ?>
                                    <h4 class="rule-name"><?php echo esc_html($booking_rule['rules_name']) ?></h4>
                                <?php } ?>
                                <?php if ($booking_rule['rules_time']) { ?>
                                    <span class="supporting-text"><?php echo esc_html($booking_rule['rules_time']) ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <!-- highlight Content  -->
            <?php if (!empty($booking_highlights)) { ?>
                <div class="info-card highlight-content">
                    <?php if (!empty($highlights_title)) { ?>
                        <h3 class="info-card-title rt-mb-10"><?php echo esc_html($highlights_title, 'tripfery'); ?></h3>
                    <?php } ?>
                    <ul class="col info-list rt-two-col rt-mp-0">
                        <?php foreach ($booking_highlights as $booking_highlight) {
                        ?>
                            <li class="info-list-item d-flex align-items-center"><i class="fa-solid fa-circle info-list-icon"></i><?php echo esc_html($booking_highlight['rules_name']) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <!-- Included/Excluded  -->
            <?php if (!empty($booking_included || $booking_excluded)) { ?>
                <div class="info-card included-content">
                    <?php if (!empty($included_title)) { ?>
                        <h3 class="info-card-title rt-mb-10"><?php echo esc_html($included_title); ?></h3>
                    <?php } ?>

                    <div class="rt-included-meta-text">
                        <?php if (!empty($booking_included)) { ?>
                            <ul class="col info-list rt-mp-0">
                                <?php foreach ($booking_included as $included) {
                                ?>
                                    <li class="info-list-item d-flex align-items-center"><i class="fa-solid fa-check info-list-icon-check success"></i></i><?php echo esc_html($included['rules_name']) ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                        <?php if (!empty($booking_excluded)) { ?>
                            <ul class="col info-list rt-mp-0">
                                <?php foreach ($booking_excluded as $excluded) {
                                ?>
                                    <li class="info-list-item d-flex align-items-center"><i class="fa-solid fa-check info-list-icon-check warning"></i><?php echo esc_html($excluded['rules_name']) ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>

            <!-- Itinerary -->
            <div class="info-card">
                <?php if (!empty($itinerary_title)) { ?>
                    <h3 class="info-card-title"><?php echo esc_html($itinerary_title); ?></h3>
                <?php } ?>
                <div class="info-card-accordion ">
                    <div class="accordion accordion-flush" id="accordionFlush">
                        <?php $i = 0;
                        foreach ($booking_steps as $booking_step) {
                            $uniqid = wp_rand(5);
                            $i++;
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne-<?php echo esc_attr($uniqid); ?>">
                                    <button class="accordion-button <?php echo ($i == 1 ? '' : 'collapsed') ?> shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-<?php echo esc_attr($uniqid); ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <!-- <span class="highlighted-text">Day 1.</span> -->
                                        <?php echo esc_html($booking_step['title']); ?>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne-<?php echo esc_attr($uniqid); ?>" class="accordion-collapse collapse <?php echo ($i == 1 ? ' show' : '') ?>" aria-labelledby="flush-headingOne-<?php echo esc_attr($uniqid); ?>" data-bs-parent="#accordionFlush">
                                    <div class="accordion-body">
                                        <p class="mb-0"><?php echo esc_html($booking_step['attraction']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- durations Content  -->
            <?php if (!empty($booking_durations)) { ?>
                <div class="info-card">
                    <?php if (!empty($durations_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($durations_title); ?></h3>
                    <?php } ?>
                    <ul class="col info-list rt-three-col rt-mp-0">
                        <?php foreach ($booking_durations as $booking_duration) { ?>
                            <li class="info-list-item d-flex align-items-center"><i class="fa-solid fa-circle info-list-icon"></i><?php echo esc_html($booking_duration['duration_name']) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <!-- language Content  -->
            <?php if (!empty($booking_languages)) { ?>
                <div class="info-card">
                    <?php if (!empty($language_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($language_title, 'tripfery'); ?></h3>
                    <?php } ?>
                    <ul class="col info-list rt-three-col rt-mp-0">
                        <?php foreach ($booking_languages as $booking_language) { ?>
                            <li class="info-list-item d-flex align-items-center"><i class="fa-solid fa-circle info-list-icon"></i><?php echo esc_html($booking_language['language_name'], 'tripfery') ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>


            <!-- Faqs Content  -->
            <?php if (!empty($ba_info) && isset($ba_info['faq']) && !empty($ba_info['faq'])) { ?>
                <div class="info-card">
                    <?php if (!empty($faq_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($faq_title, 'tripfery'); ?></h3>
                    <?php } ?>
                    <div class="info-card-accordion ">
                        <div class="accordion accordion-flush" id="accordionFaqs">
                            <?php $i = 0;
                            foreach ($booking_faqs as $booking_faq) {
                                $uniqid = wp_rand(6);
                                $i++;
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne-<?php echo esc_attr($uniqid); ?>">
                                        <button class="accordion-button <?php echo ($i == 1 ? '' : 'collapsed') ?> shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-<?php echo esc_attr($uniqid); ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <!-- <span class="highlighted-text">Day 1.</span> -->
                                            <?php echo esc_html($booking_faq['post_title'], 'tripfery'); ?>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne-<?php echo esc_attr($uniqid); ?>" class="accordion-collapse collapse <?php echo ($i == 1 ? ' show' : '') ?>" aria-labelledby="flush-headingOne-<?php echo esc_attr($uniqid); ?>" data-bs-parent="#accordionFaqs">
                                        <div class="accordion-body">
                                            <p class="mb-0"><?php echo esc_html($booking_faq['post_content']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Car Featured  -->
            <?php if (!empty($booking_features)) { ?>
                <div class="info-card rt-cart-featured">
                    <?php if (!empty($feature_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($feature_title, 'tripfery'); ?></h3>
                    <?php } ?>

                    <ul class="highligts d-flex flex-wrap">
                        <?php foreach ($booking_features as $booking_feature) { ?>
                            <li class="highligts-item restaurant-item d-flex align-items-center justify-content-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.8203 2H7.18031C5.05031 2 3.32031 3.74 3.32031 5.86V19.95C3.32031 21.75 4.61031 22.51 6.19031 21.64L11.0703 18.93C11.5903 18.64 12.4303 18.64 12.9403 18.93L17.8203 21.64C19.4003 22.52 20.6903 21.76 20.6903 19.95V5.86C20.6803 3.74 18.9503 2 16.8203 2Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9.59375 11L11.0938 12.5L15.0938 8.5" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <h4 class="highligts-name"><?php echo esc_html($booking_feature['features_name'], 'tripfery') ?></h4>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <!-- Car Brand  -->
            <?php if (!empty($booking_brands)) { ?>
                <div class="info-card rt-cart-featured">
                    <?php if (!empty($brand_title)) { ?>
                        <h3 class="info-card-title"><?php echo esc_html($brand_title, 'tripfery'); ?></h3>
                    <?php } ?>
                    <ul class="highligts d-flex flex-wrap">
                        <?php foreach ($booking_brands as $booking_brand) { ?>
                            <li class="highligts-item restaurant-item d-flex align-items-center justify-content-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.8203 2H7.18031C5.05031 2 3.32031 3.74 3.32031 5.86V19.95C3.32031 21.75 4.61031 22.51 6.19031 21.64L11.0703 18.93C11.5903 18.64 12.4303 18.64 12.9403 18.93L17.8203 21.64C19.4003 22.52 20.6903 21.76 20.6903 19.95V5.86C20.6803 3.74 18.9503 2 16.8203 2Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9.59375 11L11.0938 12.5L15.0938 8.5" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <h4 class="highligts-name"><?php echo esc_html($booking_brand['brand_name'], 'tripfery') ?></h4>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php if (!empty($map_title)) { ?>
                <h3 class="rt-single-map-title"><?php echo esc_html($map_title, 'tripfery'); ?></h3>
            <?php } ?>

            <?php echo $booking_map;  ?>

            <!-- Comments  -->
            <div class="info-card">
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </div>
        </div>
        <?php if (TripferyTheme::$layout == 'right-sidebar' && is_active_sidebar('booking-sidebar')) { ?>
            <div class="col-md-4">
                <div class="info-card rt-booking-form">
                    <?php dynamic_sidebar('booking-sidebar'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Related Services  -->
    <?php if (TripferyTheme::$options['show_related_booking'] == '1') { ?>
        <div class="rt-related-style3 related-deals">
            <?php tripfery_related_booking_two(); ?>
        </div>
    <?php } ?>

</div>