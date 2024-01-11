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
$tripfery_has_entry_meta  = ( TripferyTheme::$options['post_date'] || TripferyTheme::$options['post_author_name'] || TripferyTheme::$options['post_comment_num'] || ( TripferyTheme::$options['post_length'] && function_exists( 'tripfery_reading_time' ) ) || TripferyTheme::$options['post_published'] && function_exists( 'tripfery_get_time' ) || ( TripferyTheme::$options['post_view'] && function_exists( 'tripfery_views' ) ) ) ? true : false;

$tripfery_comments_number = number_format_i18n( get_comments_number() );
$tripfery_comments_html = $tripfery_comments_number == 1 ? esc_html__( 'Comment' , 'tripfery' ) : esc_html__( 'Comments' , 'tripfery' );
$tripfery_comments_html = '<span class="comment-number">'. $tripfery_comments_number .'</span> '. $tripfery_comments_html;
$tripfery_author_bio = get_the_author_meta( 'description' );

$tripfery_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$tripfery_time_html       = apply_filters( 'tripfery_single_time', $tripfery_time_html );
$youtube_link = get_post_meta( get_the_ID(), 'tripfery_youtube_link', true );

if ( empty(has_post_thumbnail() ) ) {
	$img_class ='no-image';
}else {
	$img_class ='show-image';
}

?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<input type="hidden" id="tripfery-cat-ids" value="<?php echo implode(',', wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) ) ); ?>">
	<?php if ( TripferyTheme::$options['post_style'] == 'style1' ) { ?>
		<div id="contentHolder">
			<div class="container">
				<div class="row">				
					<?php if ( TripferyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
						<div class="<?php echo esc_attr( $tripfery_layout_class );?>">
							<main id="main" class="site-main"> 
								<div class="rt-sidebar-sapcer <?php echo ( TripferyTheme::$options['scroll_post_enable'] == 1 ) ? esc_attr( 'ajax-scroll-post' ) : ''; ?>">
								<?php while ( have_posts() ) : the_post(); ?>
									<?php get_template_part( 'template-parts/content-single', get_post_format() );?>						
								<?php endwhile; ?> 
								</div> 
							</main>
						</div>
					<?php if ( TripferyTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
				</div>
			</div>
		</div>
	<?php } else if ( TripferyTheme::$options['post_style'] == 'style2' ) { ?>
	<div id="contentHolder">
		<div class="container">
			<div class="row">
				<?php if ( TripferyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
					<div class="<?php echo esc_attr( $tripfery_layout_class );?>">
						<main id="main" class="site-main">
							<div class="rt-sidebar-sapcer <?php echo ( TripferyTheme::$options['scroll_post_enable'] == 1 ) ? esc_attr( 'ajax-scroll-post' ) : ''; ?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content-single-2', get_post_format() );?>						
							<?php endwhile; ?>
							</div>
						</main>					
					</div>
				<?php if ( TripferyTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php get_footer(); ?>