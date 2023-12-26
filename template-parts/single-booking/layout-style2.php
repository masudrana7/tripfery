<?php
extract($args);
$images = isset($ba_info['images']) ? $ba_info['images'] : array();
?>
<div class="container-fluid-gallery">
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
</div>
<div class="container">
    <div class="row align-items-center rt-booking-price-area">
        <div class="col-lg-5 col-xl-5 col-xxl-4">
            <div class="mb-4 mb-xxl-0">
                <h3 class="activity-title"><?php the_title(); ?></h3>
                <?php if (!empty($address['address'])) { ?>
                    <address class="activity-location">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.50469 8.39365C8.58164 8.39365 9.45469 7.52061 9.45469 6.44365C9.45469 5.3667 8.58164 4.49365 7.50469 4.49365C6.42773 4.49365 5.55469 5.3667 5.55469 6.44365C5.55469 7.52061 6.42773 8.39365 7.50469 8.39365Z" stroke="#E7233A" stroke-opacity="0.99" />
                            <path d="M2.2611 5.30631C3.49235 -0.106188 11.5111 -0.0999374 12.7361 5.31256C13.4548 8.48756 11.4798 11.1751 9.7486 12.8376C8.49235 14.0501 6.50485 14.0501 5.24235 12.8376C3.51735 11.1751 1.54235 8.48131 2.2611 5.30631Z" stroke="#E7233A" stroke-opacity="0.99" />
                        </svg>
                        <?php echo esc_html($address['address'], 'tripfery'); ?>
                    </address>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-8 col-xl-7 col-xxl-6">
            <ul class="activity-info-container d-flex flex-wrap mb-4 mb-xl-0">
                <?php if (!empty($valu_duration)) { ?>
                    <li class="d-flex align-items-center info-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.7089 15.18L12.6089 13.33C12.0689 13.01 11.6289 12.24 11.6289 11.61V7.51001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="d-flex flex-column info-text">
                            <span class="info-text-one"><?php echo esc_html('Duration', 'tripfery') ?></span>
                            <span class="info-text-two"><?php echo esc_attr($valu_duration); ?></span>
                        </div>
                    </li>
                <?php } ?>

                <?php if (!empty($type_name)) { ?>
                    <li class="d-flex align-items-center info-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.31993 13.28H12.4099V20.48C12.4099 21.54 13.7299 22.04 14.4299 21.24L21.9999 12.64C22.6599 11.89 22.1299 10.72 21.1299 10.72H18.0399V3.52003C18.0399 2.46003 16.7199 1.96003 16.0199 2.76003L8.44994 11.36C7.79994 12.11 8.32993 13.28 9.31993 13.28Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.5 4H1.5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.5 20H1.5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 12H1.5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="d-flex flex-column info-text">
                            <span class="info-text-one"><?php echo esc_html('Tour Type', 'tripfery') ?></span>
                            <span class="info-text-two"><a href="<?php echo esc_url($type_link); ?>"><?php echo esc_attr($type_name); ?></a></span>
                        </div>
                    </li>
                <?php } ?>

                <?php if (!empty($group_max_size)) { ?>
                    <li class="d-flex align-items-center info-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.9981 7.16C17.9381 7.15 17.8681 7.15 17.8081 7.16C16.4281 7.11 15.3281 5.98 15.3281 4.58C15.3281 3.15 16.4781 2 17.9081 2C19.3381 2 20.4881 3.16 20.4881 4.58C20.4781 5.98 19.3781 7.11 17.9981 7.16Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.9675 14.44C18.3375 14.67 19.8475 14.43 20.9075 13.72C22.3175 12.78 22.3175 11.24 20.9075 10.3C19.8375 9.59004 18.3075 9.35003 16.9375 9.59003" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.97047 7.16C6.03047 7.15 6.10047 7.15 6.16047 7.16C7.54047 7.11 8.64047 5.98 8.64047 4.58C8.64047 3.15 7.49047 2 6.06047 2C4.63047 2 3.48047 3.16 3.48047 4.58C3.49047 5.98 4.59047 7.11 5.97047 7.16Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.0014 14.44C5.6314 14.67 4.12141 14.43 3.06141 13.72C1.65141 12.78 1.65141 11.24 3.06141 10.3C4.13141 9.59004 5.6614 9.35003 7.0314 9.59003" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.9981 14.63C11.9381 14.62 11.8681 14.62 11.8081 14.63C10.4281 14.58 9.32812 13.45 9.32812 12.05C9.32812 10.62 10.4781 9.46997 11.9081 9.46997C13.3381 9.46997 14.4881 10.63 14.4881 12.05C14.4781 13.45 13.3781 14.59 11.9981 14.63Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.08875 17.78C7.67875 18.72 7.67875 20.26 9.08875 21.2C10.6888 22.27 13.3087 22.27 14.9087 21.2C16.3187 20.26 16.3187 18.72 14.9087 17.78C13.3187 16.72 10.6888 16.72 9.08875 17.78Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="d-flex flex-column info-text">
                            <span class="info-text-one"><?php echo esc_html('Group Size', 'tripfery') ?></span>
                            <span class="info-text-two"><?php echo esc_attr($group_max_size); ?></span>
                        </div>
                    </li>
                <?php } ?>

                <?php if (!empty($booking_languages)) { ?>
                    <li class="d-flex align-items-center info-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.9917 8.96002H7.01172" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 7.28003V8.96002" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.5 8.94C14.5 13.24 11.14 16.72 7 16.72" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.9992 16.72C15.1992 16.72 13.5992 15.76 12.4492 14.25" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <?php if (!empty(esc_html('Languages'))) { ?>
                            <div class="d-flex flex-column info-text">
                                <span class="info-text-one"><?php echo esc_html('Languages', 'tripfery') ?></span>
                                <span class="info-text-two"><?php echo esc_attr($languages); ?></span>
                            </div>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-4 col-xl">
            <div class="rt-price-single-inner activity-price align-items-center d-flex">
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