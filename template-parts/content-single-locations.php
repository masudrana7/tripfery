<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'tripfery-size2';

global $post;
$tripfery_project_title 		= get_post_meta( $post->ID, 'tripfery_project_title', true );
$tripfery_project_text 			= get_post_meta( $post->ID, 'tripfery_project_text', true );
$tripfery_project_client 		= get_post_meta( $post->ID, 'tripfery_project_client', true );
$tripfery_project_start 		= get_post_meta( $post->ID, 'tripfery_project_start', true );
$tripfery_project_end 			= get_post_meta( $post->ID, 'tripfery_project_end', true );
$tripfery_project_web 			= get_post_meta( $post->ID, 'tripfery_project_web', true );

$ratting	 	= get_post_meta( $id, 'tripfery_project_rating', true );
$locations_rating = 5- intval( $ratting ) ;

?>
<div id="post-<?php the_ID();?>" <?php post_class( 'locations-single' );?>>	
	<div class="locations-single-content">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="locations-thumbnail">
					<?php if ( has_post_thumbnail() ) { ?>
					<?php 
						the_post_thumbnail( $thumb_size );
					} ?>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div class="locations-info">
					<?php if ( !empty( $tripfery_project_title ) ) { ?>
						<div class="rt-section-title style3 has-animation">
							<h2 class="entry-title"><?php echo esc_html( $tripfery_project_title );?><span class="line"></span></h2>							
						</div>
					<?php } if ( !empty( $tripfery_project_text ) ) { ?>
					<p><?php echo esc_html( $tripfery_project_text );?></p>
					<?php } ?>
					<ul class="info-list">
						<?php if( TripferyTheme::$options['single_locations_cat'] ) { ?>
						<li><label><?php esc_html_e( 'Category', 'tripfery' );?>: </label>
							<span class="locations-cat"><?php
								$i = 1;
								$term_lists = get_the_terms( get_the_ID(), 'tripfery_locations_category' );
								if( $term_lists ) {
								foreach ( $term_lists as $term_list ){ 
								$link = get_term_link( $term_list->term_id, 'tripfery_locations_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?>
							</span>
						</li>
						<?php } ?>
						<?php if ( !empty( $tripfery_project_client ) && TripferyTheme::$options['single_locations_client'] ) { ?>
						<li><label><?php esc_html_e( 'Client', 'tripfery' );?>: </label><?php echo esc_html( $tripfery_project_client );?></li>
						<?php } if ( !empty( $tripfery_project_start ) && TripferyTheme::$options['single_locations_startdate'] ) { ?>
						<li><label><?php esc_html_e( 'Starts On', 'tripfery' );?>: </label><?php echo esc_html( $tripfery_project_start );?></li>
						<?php } if ( !empty( $tripfery_project_end ) && TripferyTheme::$options['single_locations_enddate'] ) { ?>
						<li><label><?php esc_html_e( 'Ends On', 'tripfery' );?>: </label><?php echo esc_html( $tripfery_project_end );?></li>
						<?php } if ( !empty( $tripfery_project_web ) && TripferyTheme::$options['single_locations_weblink'] ) { ?>
						<li><label><?php esc_html_e( 'Web Link', 'tripfery' );?>: </label><?php echo esc_html( $tripfery_project_web );?></li>
						<?php } ?>

						<?php if( TripferyTheme::$options['single_locations_rating'] ) { ?>
						<?php if( $ratting != -1) { ?>
						<li><label><?php esc_html_e( 'Rating', 'tripfery' );?>: </label>
							<ul class="rating">
								<?php for ($i=0; $i < $ratting; $i++) { ?>
									<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>			
								<?php for ($i=0; $i < $locations_rating; $i++) { ?>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>
							</ul>
						</li>
					<?php } } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="locations-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php the_content();?>
		</div>
	</div>	
</div>