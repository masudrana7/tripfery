<?php if (TripferyTheme::$footer_fun_fact == 1) {

    $footer_column = TripferyTheme::$options['footer_fun_fact_column'];
    $colum ="4";
    if('1' == $footer_column){
        $colum = "12";
    }
    if('2' == $footer_column){
        $colum = "6";
    }
    if('3' == $footer_column){
        $colum = "4";
    }
    if('4' == $footer_column){
        $colum = "3";
    }
?>

    <?php if (!empty(TripferyTheme::$options['fff_title_one']) || !empty(TripferyTheme::$options['fff_title_two'] || !empty(TripferyTheme::$options['fff_title_three']))) { ?>
    <div class="fun-fact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-<?php echo esc_attr($colum); ?> col-md-6 mb-4 mb-lg-0">
                    <div class="single-fun-fact">
                        <?php if (!empty(TripferyTheme::$options['fff_image_one'])) {
                            $img_one = wp_get_attachment_image(TripferyTheme::$options['fff_image_one'], 'full', true);  ?>
                            <div class="fun-fact-icon">
                                <?php echo wp_kses_post($img_one); ?>
                            </div>
                        <?php } ?>
                        <div class="fun-fact-content">
                            <?php if (!empty(TripferyTheme::$options['fff_title_one'])) { ?>
                                <h3 class="fun-fact-title"><?php echo esc_html(TripferyTheme::$options['fff_title_one']); ?></h3>
                            <?php } ?>

                            <?php if (!empty(TripferyTheme::$options['fff_desc_one'])) { ?>
                                <p class="fun-fact-desc">
                                    <?php echo esc_html(TripferyTheme::$options['fff_desc_one']); ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo esc_attr($colum); ?> col-md-6 mb-4 mb-lg-0">
                    <div class="single-fun-fact">
                        <?php if (!empty(TripferyTheme::$options['fff_image_two'])) {
                            $img_two = wp_get_attachment_image(TripferyTheme::$options['fff_image_two'], 'full', true);  ?>
                            <div class="fun-fact-icon">
                                <?php echo wp_kses_post($img_two); ?>
                            </div>
                        <?php } ?>
                        <div class="fun-fact-content">
                            <?php if (!empty(TripferyTheme::$options['fff_title_two'])) { ?>
                                <h3 class="fun-fact-title"><?php echo esc_html(TripferyTheme::$options['fff_title_two']); ?></h3>
                            <?php } ?>

                            <?php if (!empty(TripferyTheme::$options['fff_desc_two'])) { ?>
                                <p class="fun-fact-desc">
                                    <?php echo esc_html(TripferyTheme::$options['fff_desc_two']); ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo esc_attr($colum); ?> col-md-6 mb-4 mb-lg-0">
                    <div class="single-fun-fact">
                        <?php if (!empty(TripferyTheme::$options['fff_image_three'])) {
                            $img_three = wp_get_attachment_image(TripferyTheme::$options['fff_image_three'], 'full', true);  ?>
                            <div class="fun-fact-icon">
                                <?php echo wp_kses_post($img_three); ?>
                            </div>
                        <?php } ?>
                        <div class="fun-fact-content">
                            <?php if (!empty(TripferyTheme::$options['fff_title_three'])) { ?>
                                <h3 class="fun-fact-title"><?php echo esc_html(TripferyTheme::$options['fff_title_three']); ?></h3>
                            <?php } ?>

                            <?php if (!empty(TripferyTheme::$options['fff_desc_three'])) { ?>
                                <p class="fun-fact-desc">
                                    <?php echo esc_html(TripferyTheme::$options['fff_desc_three']); ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>


<?php } ?>