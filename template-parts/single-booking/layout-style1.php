<?php

use Rtrs\Models\Review;
use Rtrs\Helpers\Functions;

extract($args);
$images = isset($ba_info['images']) ? $ba_info['images'] : array();
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="details-content-container mb-4 mb-lg-0">
                <div class="details-content d-flex flex-column flex-sm-row align-items-md-center">
                    <?php if (class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) {
                        echo Functions::review_stars($avg_rating);
                    } ?>
                </div>
                <?php if (!empty($address['address'])) { ?>
                    <div class="details-address-info align-items-center">
                        <p class="details-address">
                            <span class="address-icon"><i class="icon-tripfery-map-iocn"></i></span>
                            <span class="address-text"><?php echo esc_html($address['address']); ?></span>
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex share-link-area justify-content-lg-end align-items-center">
                <div class="d-flex">
                    <?php echo esc_html('From', 'tripfery') ?>
                    <?php if ($discountPrice) { ?>
                        <div class="rt-single-price rt-old-price">
                            <?php echo wp_kses_post($discountPrice); ?>
                        </div>
                    <?php } else { ?>
                            <div class="rt-single-price rt-new-price">
                                <?php echo wp_kses_post($nPrice); ?>
                            </div>
                    <?php }  if (!empty($tripfery_per_rate)) { ?>
                        <span class="rt-type"><?php echo esc_html($tripfery_per_rate); ?>
                        <?php } ?>
                </div>
                <div class="d-flex share-btns-link">
                    <div class="rt-share-service">
                        <a href="#" class="share-btn">
                            <svg width="16" height="15" viewBox="0 0 16 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.7363 6.52539L9.58008 10.9492C9.14062 11.3301 8.4375 11.0078 8.4375 10.4219V7.87305C3.86719 7.93164 1.93359 9.04492 3.25195 13.293C3.39844 13.7617 2.8125 14.1426 2.43164 13.8496C1.14258 12.9121 0 11.125 0 9.33789C0 4.88477 3.7207 3.91797 8.4375 3.85938V1.54492C8.4375 0.929688 9.14062 0.607422 9.58008 0.988281L14.7363 5.41211C15.0586 5.73438 15.0586 6.23242 14.7363 6.52539Z" />
                            </svg>
                            <?php if (function_exists('tripfery_post_share')) {
                                tripfery_post_share();
                            } ?>
                        </a>
                    </div>
                    <?php if (class_exists('RTWishlist')) {
                        echo RTWishlist::wishlist_html($post_id);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid-gallery">
    <div class="hero-img-grid image-gallery">
        <?php
        $i = 1;
        foreach ($images as $key => $image) {
            $image_id = $image['image_id'];
            $image_url = wp_get_attachment_image_url($image_id, 'full');
        ?>
            <?php if ($i <= 3) { ?>
                <a href="<?php echo esc_url($image_url); ?>" class="img-grid-item">
                    <img src="<?php echo esc_url($image_url); ?>" class="img-fluid grid-img" alt="" />
                </a>
            <?php } ?>

            <?php if (4 == $i) { ?>
                <?php if (!empty($tripfery_video_link)) { ?>
                    <a href="https://www.youtube.com/watch?v=XHOmBV4js_E" class="img-grid-item rt-video-popup">
                        <i class="rt-book-video fa-solid fa-play"></i>
                    <?php } else { ?>
                        <a href="<?php echo esc_url($image_url); ?>" class="img-grid-item">
                            <span class="rt-sinlge-btn"><?php echo esc_html('See All Photos', 'tripfery') ?></span>
                        <?php } ?>
                        <img src="<?php echo esc_url($image_url); ?>" class="img-fluid grid-img" alt="" />
                        </a>
                    <?php } ?>

                    <?php if (5 <= $i) { ?>
                        <a href="<?php echo esc_url($image_url); ?>" class="img-grid-item hide_image"></a>
                    <?php } ?>

                <?php $i++;
            } ?>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php if (TripferyTheme::$layout == 'left-sidebar' && is_active_sidebar('booking-sidebar')) { ?>
            <div class="col-md-4 tripfery-column-sticky">
                <div class="info-card rt-booking-form">
                    <?php dynamic_sidebar('booking-sidebar'); ?>
                </div>
            </div>
        <?php } ?>

        <div class="<?php echo esc_attr($tripfery_layout_class); ?> tripfery-column-sticky">
            <!-- Description Text  -->
            <div class="rt-booking-content info-card">
                <h3 class="rt-overview-title"><?php echo esc_html('Overview', 'tripfery'); ?></h3>
                <?php the_content(); ?>
            </div>

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
                            <li class="highligts-item d-flex align-items-center">
                                <?php if ($image_url) { ?>
                                    <img src="<?php echo esc_url($image_url); ?>" class="img-fluid--- grid-img---" alt="" />
                                <?php } ?>
                                <h4 class="highligts-name"><?php echo esc_html($booking_property['property_name']) ?></h4>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>


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
            

            <!-- Related Services  -->
            <?php 
            $post_id = get_the_ID();
		    $ba_post = BABE_Post_types::get_post($post_id);
            if(!empty($ba_post['related_items']))    {                        
            if (TripferyTheme::$options['show_related_booking'] == '1') { ?>
                <div class="info-card">
                    <?php tripfery_related_booking(); ?>
                </div>
            <?php } } ?>

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
            <div class="col-lg-4 tripfery-column-sticky">
                <div class="info-card rt-booking-form">
                    <?php dynamic_sidebar('booking-sidebar'); ?>
                </div>
            </div>
        <?php } ?>

    </div>
</div>