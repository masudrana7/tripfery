<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use Rtrs\Models\Review; 
global $product;
$product_id  = $product->get_id();
$product_bg    = get_post_meta( $product_id, 'tripfery_product_bgc', true );
$product_bgc = "";
if( !empty($product_bg) ) {
	$product_bgc = 'style="background-color: ' . $product_bg . '"';
}

?>
<div class="rt-product-block rt-product-list">
	<div class="rt-thumb-wrapper" <?php echo wp_specialchars_decode( esc_attr( $product_bgc ), ENT_COMPAT ); ?>>
		<div class="rt-thumb">
			<a href="<?php the_permalink();?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
			<div class="rt-buttons">				
				<div class="btn-icons">
					<?php
						if ( TripferyTheme::$options['wc_shop_cart_icon'] ) WC_Functions::print_add_to_cart_icon( $product_id, true, true );
						$module_data = [
							'wc_shop_quickview_icon' => TripferyTheme::$options['wc_shop_quickview_icon'],
							'wc_shop_wishlist_icon' => TripferyTheme::$options['wc_shop_wishlist_icon'],
							'wc_shop_compare_icon' => TripferyTheme::$options['wc_shop_compare_icon'],
						];
						do_action('rdtheme_after_actions_button', $product, $module_data);
					?>
				</div>
			</div>
		</div>
		<?php if ( TripferyTheme::$options['wc_shop_sale_flash'] ) woocommerce_show_product_loop_sale_flash(); ?>
	</div>
	<div class="content-box">
		<div class="rt-price-area">
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<div class="rt-price"><?php echo wp_kses_post( $price_html ); ?></div>
			<?php endif; ?>
		</div>	
		<div class="rt-title-area">
			<h3 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		</div>
		<?php if ( TripferyTheme::$options['wc_shop_rating'] == 1 ) { ?>
		<div class="rating-custom">
			<?php wc_get_template( 'rating.php' ); ?>
		</div>
		<?php } ?>		
		<div class="rtin-excerpt"><?php the_excerpt();?></div>		
	</div>
</div>