<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( TripferyTheme::$layout == 'full-width' ) {
	$tripfery_layout_class = 'col-sm-12 col-12';
}
else{
	$tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}

// Template
$iso					= 'g-4 no-equal-team';

$post_classes = "";
if (TripferyTheme::$layout == 'right-sidebar' || TripferyTheme::$layout == 'left-sidebar') {
	$post_classes = 'col-sm-6 col-lg-4';
} else {
	$post_classes = 'col-sm-6 col-xl-3 col-lg-4';
}

if ( TripferyTheme::$options['service_archive_style'] == 'style1' ){
	$sercices_archive_layout = "rt-service-default rt-service-layout-1";
	$template 				 = 'services-1';
}elseif( TripferyTheme::$options['service_archive_style'] == 'style2' ){
	$sercices_archive_layout = "rt-service-default rt-service-layout-2";
	$template 				 = 'services-2';
}else{
	$sercices_archive_layout = "rt-service-default rt-service-layout-1";
	$template 				 = 'services-1';
}



if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$service_post_number = TripferyTheme::$options['service_post_number'];
$args = array(
	'posts_per_page'    => $service_post_number,
	'post_type'			=> 'tripfery_service',
	'post_status'		=> 'publish',
	'paged'             => $paged,
);

$query = new WP_Query( $args );

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">

			<?php
			if ( TripferyTheme::$layout == 'left-sidebar' ) {
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('tripfery_service');
				} else {
					get_sidebar();
				}
			}?>

			<div class="<?php echo esc_attr( $sercices_archive_layout );?> <?php echo esc_attr( $tripfery_layout_class );?>">
				<main id="main" class="site-main">
					<div class="rt-sidebar-sapcer">
					<?php if ( $query->have_posts() ) :?>
						<div class="row <?php echo esc_attr( $iso );?>">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="<?php echo esc_attr( $post_classes );?>">
									<?php get_template_part( 'template-parts/content', $template ); ?>
								</div>
							<?php endwhile; ?>
						</div>
 
					<?php TripferyTheme_Helper::pagination(); ?>	
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
					</div>
				</main>
			</div>

			<?php
			if ( TripferyTheme::$layout == 'right-sidebar' ) {				
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('tripfery_service');
				} else {
					get_sidebar();
				}
			}
			?>


		</div>
	</div>
</div>
<?php get_footer(); ?>
