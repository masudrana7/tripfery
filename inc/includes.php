<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

require_once TRIPFERY_INC_DIR . 'customizer/customizer-default-data.php';
require_once TRIPFERY_INC_DIR . 'customizer/init.php';
require_once TRIPFERY_INC_DIR . 'rt-cat-meta.php';
/*woocommerce*/
if ( class_exists( 'WooCommerce' ) ) {
    require_once TRIPFERY_WOO_DIR . 'custom/functions.php';
}