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

$iso						= 'g-4 no-equal-team';

if ( TripferyTheme::$options['team_archive_style'] == 'style1' ){
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-1";
	$template 				 	= 'team-1';
}elseif( TripferyTheme::$options['team_archive_style'] == 'style2' ){
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-2";
	$template 				 	= 'team-2';
}else{
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-1";
	$template 				 	= 'team-1';
}

$post_classes = "";
if (  TripferyTheme::$layout == 'right-sidebar' || TripferyTheme::$layout == 'left-sidebar' ){
	$post_classes = 'col-sm-6 col-lg-4';
} else {
	$post_classes = 'col-sm-6 col-xl-3 col-lg-4';
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

$team_post_number = TripferyTheme::$options['team_post_number'];
$args = array(
	'posts_per_page'    => $team_post_number,
	'post_type'			=> 'tripfery_team',
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
					get_sidebar();
				}
			?>
			<div class="<?php echo esc_attr( $team_archive_layout );?> <?php echo esc_attr( $tripfery_layout_class );?>">
				<main id="main" class="site-main">	
					<?php if ( $query->have_posts() ) :?>
						<div class="row <?php echo esc_attr( $iso );?>">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="<?php echo esc_attr( $post_classes );?>">
									<?php get_template_part( 'template-parts/content', $template ); ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
					<?php TripferyTheme_Helper::pagination(); ?>	
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
