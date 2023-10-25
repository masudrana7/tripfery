<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */
$swiper_data=array(
	'slidesPerView' 	=>2,
	'centeredSlides'	=>false,
	'loop'				=>true,
	'spaceBetween'		=>20,
	'slideToClickedSlide' =>true,
	'slidesPerGroup' => 1,
	'autoplay'				=>array(
		'delay'  => 1,
	),
	'speed'      =>500,
	'breakpoints' =>array(
		'0'    =>array('slidesPerView' =>1),
		'576'    =>array('slidesPerView' =>2),
		'768'    =>array('slidesPerView' =>2),
		'992'    =>array('slidesPerView' =>3),
		'1200'    =>array('slidesPerView' =>4),				
		'1600'    =>array('slidesPerView' =>4)				
	),
	'auto'   =>false
);

$swiper_data = json_encode( $swiper_data );
$pro_no =  count($related_products);
?>
<?php if( TripferyTheme::$options['related_woo_product'] && $pro_no > 1 ) { ?>
<div class="rt-related-product products">
	<div class="rt-swiper-slider woo-related-product" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
	    <div class="rt-related-title">
			<h2 class="entry-title has-animation"><?php echo wp_kses( TripferyTheme::$options['related_product_title'] , 'alltext_allow' ); ?></h2>
			<div class="swiper-button">
                <div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__( 'Prev' , 'tripfery' ) ?></div>
                <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'tripfery' ) ?><i class="icon-tripfery-right-arrow"></i></div>
            </div>
        </div>
		<div class="swiper-wrapper">		
			<?php foreach ( $related_products as $related_product ) : ?>
			<div class="swiper-slide">
				<ul class="products">
					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); 

					wc_get_template_part( 'content', 'product' );
					?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php } ?>