<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( ! function_exists( 'tripfery_related_locations' )){
	
	function tripfery_related_locations(){
		$thumb_size 			= 'tripfery-size5';
		$post_id = get_the_id();	
		$number_of_avail_post = '';
		$current_post = array( $post_id );
		$title_length = TripferyTheme::$options['related_locations_title_limit'] ? TripferyTheme::$options['related_locations_title_limit'] : '';
		$related_post_number = TripferyTheme::$options['related_locations_number'];
		
		$locations_related_title  = get_post_meta( get_the_ID(), 'locations_related_title', true );

		# Making ready to the Query ...
		$query_type = TripferyTheme::$options['related_post_query'];

		$args = array(
			'post_type'				 => 'tripfery_locations',
			'post__not_in'           => $current_post,
			'posts_per_page'         => $related_post_number,
			'no_found_rows'          => true,
			'post_status'            => 'publish',
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
		);

		# Checking Related Posts Order ----------
		if( TripferyTheme::$options['related_post_sort'] ){

			$post_order = TripferyTheme::$options['related_post_sort'];

			if( $post_order == 'rand' ){

				$args['orderby'] = 'rand';
			}
			elseif( $post_order == 'views' ){

				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'tripfery_views';
			}
			elseif( $post_order == 'popular' ){

				$args['orderby'] = 'comment_count';
			}
			elseif( $post_order == 'modified' ){

				$args['orderby'] = 'modified';
				$args['order']   = 'ASC';
			}
			elseif( $post_order == 'recent' ){

				$args['orderby'] = '';
				$args['order']   = '';
			}
		}


		# Get related posts by author ----------
		if( $query_type == 'author' ){
			$args['author'] = get_the_author_meta( 'ID' );
		}

		# Get related posts by tags ----------
		elseif( $query_type == 'tag' ){
			$tags_ids  = array();
			$post_tags = get_the_terms( $post_id, 'post_tag' );

			if( ! empty( $post_tags ) ){
				foreach( $post_tags as $individual_tag ){
					$tags_ids[] = $individual_tag->term_id;
				}

				$args['tag__in'] = $tags_ids;
			}
		}

		# Get related posts by categories ----------
		else{
			
			$terms = get_the_terms( $post_id, 'tripfery_locations_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
			 
				$port_cat_links = array();
			 
				foreach ( $terms as $term ) {
					$port_cat_links[] = $term->term_id;
				}
			}
			
			$args['tax_query'] = array (
				array (
					'taxonomy' => 'tripfery_locations_category',
					'field'    => 'ID',
					'terms'    => $port_cat_links,
				)
			);

		}

		# Get the posts ----------
		$related_query = new wp_query( $args );
		/*the_carousel*/
		$swiper_data=array(
			'slidesPerView' 	=>2,
			'centeredSlides'	=>false,
			'loop'				=>true,
			'spaceBetween'		=>24,
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
				'1200'    =>array('slidesPerView' =>3),				
				'1600'    =>array('slidesPerView' =>3)				
			),
			'auto'   =>false
		);

		$swiper_data = json_encode( $swiper_data );
		
		if( $related_query->have_posts() ) { ?>
		
		<div class="rt-locations-default rt-locations-multi-layout-2 related-locations">
			<div class="rt-swiper-slider" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
				<div class="rt-related-title">
					<div class="title-holder">
						<h3 class="entry-title has-animation"><?php echo wp_kses( TripferyTheme::$options['locations_related_title'] , 'alltext_allow' ); ?></h3>
					</div>
					<div class="swiper-button">
		                <div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__( 'Prev' , 'tripfery' ) ?></div>
		                <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'tripfery' ) ?><i class="icon-tripfery-right-arrow"></i></div>
		            </div>
	            </div>
				<div class="swiper-wrapper" >
					<?php
						while ( $related_query->have_posts() ) {
						$related_query->the_post();
						$trimmed_title = wp_trim_words( get_the_title(), $title_length, '' );
						$id = get_the_ID();

					?>
						<div class="locations-item swiper-slide">
							<div class="locations-figure">
								<a href="<?php the_permalink(); ?>">
									<?php
										if ( has_post_thumbnail() ){
											the_post_thumbnail( $thumb_size, ['class' => 'img-fluid mb-10 width-100'] );
										} else {
											if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
												echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
											} else {
												echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_610X414.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
											}
										}
									?>
								</a>
								
							</div>
							<div class="locations-content">
								<div class="content-info">
									<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $trimmed_title ); ?></a></h3>
									<?php if ( TripferyTheme::$options['locations_ar_category'] ) { ?>
									<span class="locations-cat"><?php
										$i = 1;
										$term_lists = get_the_terms( get_the_ID(), 'tripfery_locations_category' );
										if( $term_lists ) {
										foreach ( $term_lists as $term_list ){ 
										$link = get_term_link( $term_list->term_id, 'tripfery_locations_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?>
									</span>
									<?php } ?>				
									<?php if ( TripferyTheme::$options['locations_ar_excerpt'] ) { ?>
										<p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
									<?php } ?>
								</div>
								<?php if ( TripferyTheme::$options['locations_ar_action'] ) { ?>
								<div class="content-action">
									<a href="<?php the_permalink();?>"><i class="icon-tripfery-right-arrow"></i></a>
								</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php }
		wp_reset_postdata();
	}
}
?>