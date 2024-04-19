<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( TripferyTheme::$layout == 'full-width' ) {
	$tripfery_layout_class = 'col-sm-12 col-12';
} else {
	$tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}
$payment = ( '1' == TripferyTheme::$options['wc_payment_geteways'] ) ? "rt-woo-payment" : "ba-booking-payment";
?>
<?php get_header(); ?>
<div id="primary" class="content-area <?php echo esc_attr($payment); ?>">
	<div class="container">
		<div class="row">
			<?php
			if ( TripferyTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}
			?>
			<div class="<?php echo esc_attr( $tripfery_layout_class );?>">
				<main id="main" class="site-main">
					<?php while ( have_posts() ) : the_post(); ?>					
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
						<?php
						if ( comments_open() || get_comments_number() ){
							comments_template();
						}
						?>
					<?php endwhile; ?>
				</main>
			</div>
			<?php
			if( TripferyTheme::$layout == 'right-sidebar' ){				
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>