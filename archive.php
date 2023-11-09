<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if (is_post_type_archive("to_book") || is_tax("categories")) {
	get_template_part('template-parts/archive', 'booking');
	return;
}
// Layout class
if ( TripferyTheme::$layout == 'full-width' ) {
	$tripfery_layout_class = 'col-sm-12 col-12';
}
else{
	$tripfery_layout_class = TripferyTheme_Helper::has_active_widget();
}
$tripfery_is_post_archive = is_home() || ( is_archive() && get_post_type() == 'post' ) ? true : false;

if ( is_post_type_archive( "tripfery_team" ) || is_tax( "tripfery_team_category" ) ) {
		get_template_part( 'template-parts/archive', 'team' );
	return;
}
if ( is_post_type_archive( "tripfery_service" ) || is_tax( "tripfery_service_category" ) ) {
		get_template_part( 'template-parts/archive', 'service' );
	return;
}

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
			<div class="<?php echo esc_attr( $tripfery_layout_class );?>">
				<main id="main" class="site-main">
					<?php if( ! empty( category_description() ) ) { ?>
					<div class="rt-cat-description">
					 	<h2 class="cat-title"><?php single_cat_title(); ?></h2>
						<?php echo category_description(); ?>
					</div>
					<?php } ?>
					<div class="rt-sidebar-sapcer">
					<?php
					if ( have_posts() ) { ?>
						<?php
						if ( $tripfery_is_post_archive && TripferyTheme::$options['blog_style'] == 'style1' ) {
							echo '<div class="loadmore-items">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
							echo '</div>';
						} else if ( $tripfery_is_post_archive && TripferyTheme::$options['blog_style'] == 'style2' ) {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-2', get_post_format() );
							endwhile;
						} else if ( $tripfery_is_post_archive && TripferyTheme::$options['blog_style'] == 'style3' ) {
							echo '<div class="row g-4 rt-masonry-grid">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-3', get_post_format() );
							endwhile;
							echo '</div>';
						} else if ( class_exists( 'Tripfery_Core' ) ) {
							if ( is_tax( 'tripfery_locations_category' ) ) {
								echo '<div class="row rt-masonry-grid">';
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content-1', get_post_format() );
								endwhile;
								echo '</div>';
							}							
						}
						else {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
						} ?>
						<?php if( TripferyTheme::$options['blog_loadmore'] == 'loadmore' && TripferyTheme::$options['blog_style'] == 'style1' ) { ?> 
							<div class="text-center blog-loadmore">
						      	<a href="#" id="loadMore" class="loadMore"><?php esc_html_e( 'Load More', 'tripfery' ) ?></a>
						    </div> 
						<?php } else { ?>
							<?php TripferyTheme_Helper::pagination(); ?>
						<?php } ?>  

					<?php } else {?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php } ?>
					</div>
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
