<?php
extract($args);
$images = isset($ba_info['images']) ? $ba_info['images'] : array();
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="details-content-container mb-4 mb-lg-0">
                <div class="details-content d-flex flex-column flex-sm-row align-items-md-center">
                    <h3 class="details-title me-3">
                        <?php the_title(); ?>
                    </h3>
                    <?php echo $rt_stars; ?>
                </div>
                <?php if(!empty($address['address'])){?>
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
                    <?php if ($price['discount_price_from'] < $price['price_from']) { ?>
                        <div class="rt-single-price rt-old-price">
                            <?php echo BABE_Currency::get_currency_price($price['price_from']); ?>
                        </div>
                    <?php } else { ?>
                        <div class="rt-single-price rt-new-price">
                            <?php echo BABE_Currency::get_currency_price($price['discount_price_from']); ?>
                        </div>
                    <?php } ?>

                </div>
                <div class="d-flex share-btns-link">
                    <a href="rental-details.html" class="share-btn">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.7363 6.52539L9.58008 10.9492C9.14062 11.3301 8.4375 11.0078 8.4375 10.4219V7.87305C3.86719 7.93164 1.93359 9.04492 3.25195 13.293C3.39844 13.7617 2.8125 14.1426 2.43164 13.8496C1.14258 12.9121 0 11.125 0 9.33789C0 4.88477 3.7207 3.91797 8.4375 3.85938V1.54492C8.4375 0.929688 9.14062 0.607422 9.58008 0.988281L14.7363 5.41211C15.0586 5.73438 15.0586 6.23242 14.7363 6.52539Z" />
                        </svg>
                    </a>
                    <a href="rental-details.html" class="share-btn">
                        <svg width="17" height="14" viewBox="0 0 17 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.5352 1.7207C13.832 1.10547 12.9531 0.8125 12.0742 0.8125C10.9902 0.8125 9.87695 1.28125 9.05664 2.10156L8.5 2.7168L7.91406 2.10156C7.09375 1.28125 5.98047 0.8125 4.89648 0.8125C4.01758 0.8125 3.13867 1.10547 2.43555 1.7207C0.589844 3.30273 0.501953 6.11523 2.14258 7.81445L7.82617 13.6738C8.00195 13.8496 8.23633 13.9375 8.4707 13.9375C8.73438 13.9375 8.96875 13.8496 9.14453 13.6738L14.8281 7.81445C16.4688 6.11523 16.3809 3.30273 14.5352 1.7207ZM13.8027 6.84766L8.5 12.3262L3.16797 6.84766C2.23047 5.85156 1.99609 3.94727 3.34375 2.80469C4.51562 1.7793 6.12695 2.27734 6.88867 3.09766L8.5 4.73828L10.082 3.09766C10.8438 2.30664 12.4551 1.7793 13.627 2.80469C14.9746 3.94727 14.7695 5.85156 13.8027 6.84766Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-img-grid image-gallery">
        <?php
        foreach ($images as $key => $image) {
            $image_id = $image['image_id'];
            $image_url = wp_get_attachment_image_url($image_id, 'full');
        ?>
            <a href="<?php echo esc_url($image_url); ?>" class="img-grid-item">
                <img src="<?php echo esc_url($image_url); ?>" class="img-fluid grid-img" alt="" />
            </a>
        <?php } ?>
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

            <!-- Related Services  -->
            <?php if (TripferyTheme::$options['show_related_booking'] == '1') { ?>
                <div class="info-card">
                    <?php tripfery_related_booking(); ?>
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

        <?php if (TripferyTheme::$layout == 'right-sidebar' && is_active_sidebar('booking-sidebar')) { ?>
            <div class="col-md-4">
                <div class="info-card rt-booking-form">
                    <?php dynamic_sidebar('booking-sidebar'); ?>
                </div>
            </div>
        <?php } ?>

    </div>
</div>