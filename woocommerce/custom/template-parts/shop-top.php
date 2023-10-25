<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !woocommerce_products_will_display() ) {
    return;
}

?>
<div class="woo-shop-top">
    <div class="view-mode" id="shop-view-mode">
        <ul>
            <li class="grid-view-nav selected"><a href="<?php echo TripferyTheme_Helper::shop_grid_page_url(); ?>" ><i class="fa fa-th-large"></i></a></li> 
            <li class="list-view-nav"><a href="<?php echo TripferyTheme_Helper::shop_list_page_url(); ?>"><i class="fa fa-list"></i></a></li>
        </ul>
    </div>
    <div class="limit-show"><?php woocommerce_result_count();?></div>
    <div class="sort-list"><?php woocommerce_catalog_ordering();?></div>
</div>