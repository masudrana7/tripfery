<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\Tripfery_Core;

use TripferyTheme;
use TripferyTheme_Helper;
use \WP_Query;  

/**
 * 
 */
class AjaxLoadMore {
	
	function __construct() {
		/*use archive layout*/
		add_action( 'wp_ajax_load_more_blog', array(&$this, 'tripfery_load_more_func' ));
    	add_action( 'wp_ajax_nopriv_load_more_blog', array(&$this, 'tripfery_load_more_func' ));
	}

	/* - Ajax Loadmore Function for Bolg Layout 1
	--------------------------------------------------------*/
	public function tripfery_load_more_func() {

	    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
	    $load_more_limit =  TripferyTheme::$options['load_more_limit'];

		query_posts(array(
			'post_type' => 'post',
			'posts_per_page' => $load_more_limit,
			'post_status'   => 'publish',
			'paged'          => $page,
			'post__not_in' => get_option( 'sticky_posts')
		)); 

		$ul_class = $post_classes = '';

		$thumb_size = 'tripfery-size2';

		$tripfery_has_entry_meta  = ( TripferyTheme::$options['blog_author_name'] || TripferyTheme::$options['blog_date'] || TripferyTheme::$options['blog_cats'] || TripferyTheme::$options['blog_comment_num'] || TripferyTheme::$options['blog_length'] && function_exists( 'tripfery_reading_time' ) || TripferyTheme::$options['blog_view'] && function_exists( 'tripfery_views' ) ) ? true : false;

		$tripfery_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
		$tripfery_time_html       = apply_filters( 'tripfery_single_time', $tripfery_time_html );

		$tripfery_comments_number = number_format_i18n( get_comments_number() );
		$tripfery_comments_html = $tripfery_comments_number == 1 ? esc_html__( 'Comment' , 'tripfery' ) : esc_html__( 'Comments' , 'tripfery' );
		$tripfery_comments_html = '<span class="comment-number">'. $tripfery_comments_number .'</span> ' . $tripfery_comments_html;

		$id = get_the_ID();

		$youtube_link = get_post_meta( get_the_ID(), 'tripfery_youtube_link', true );

		$wow = TripferyTheme::$options['blog_animation'];
		$effect = TripferyTheme::$options['blog_animation_effect'];

		$img_class = empty(has_post_thumbnail() ) ? 'no-image' : 'show-image';
		$preview = TripferyTheme::$options['display_no_preview_image'] == '1' ? 'show-preview' : 'no-preview';

	    if(have_posts()) : while(have_posts()) : the_post();

	    $content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = wp_trim_words( get_the_excerpt(), TripferyTheme::$options['post_content_limit'], '.' );
	    ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class( "blog-layout-1 " . $wow . ' ' . $effect ); ?> data-wow-duration="1.5s">
			<div class="blog-box <?php echo esc_attr($img_class); ?> <?php echo esc_attr($preview); ?>">
				<div class="blog-img-holder">
					<div class="blog-img">
						<?php if ( TripferyTheme::$options['blog_video'] && ( 'video' == get_post_format( $id ) && !empty( $youtube_link ) ) ) { ?>
							<div class="rt-video"><a class="rt-play play-btn-white rt-video-popup" href="<?php echo esc_url( $youtube_link );?>"><i class="fas fa-play"></i></a></div>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="img-opacity-hover"><?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
							<?php } else {
								if ( TripferyTheme::$options['display_no_preview_image'] == '1' ) {
									if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
										$thumbnail = wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );						
									}
									elseif ( empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
										$thumbnail = '<img class="wp-post-image" src="'.FAKTORIE_ASSETS_URL.'img/noimage_1296X690.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
									}
									echo wp_kses( $thumbnail , 'alltext_allow' );
								}
							}
						?>
						</a>
					</div>				
				</div>
				<div class="entry-content">
					<?php if ( $tripfery_has_entry_meta ) { ?>
					<ul class="entry-meta">
						<?php if ( TripferyTheme::$options['blog_author_name'] ) { ?>
						<li class="post-author"><i class="icon-tripfery-user"></i><?php esc_html_e( 'by ', 'tripfery' );?><?php the_author_posts_link(); ?></li>
						<?php } if ( TripferyTheme::$options['blog_cats'] ) { ?>
						<li class="entry-categories"><i class="icon-tripfery-tags"></i><?php echo the_category( ', ' );?></li>
						<?php } if ( TripferyTheme::$options['blog_date'] ) { ?>	
						<li class="post-date"><i class="icon-tripfery-calendar"></i><?php echo get_the_date(); ?></li>				
						<?php } if ( TripferyTheme::$options['blog_comment_num'] ) { ?>
						<li class="post-comment"><i class="icon-tripfery-comment"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $tripfery_comments_html , 'alltext_allow' );?></a></li>
						<?php } if ( TripferyTheme::$options['blog_length'] && function_exists( 'tripfery_reading_time' ) ) { ?>
						<li class="post-reading-time meta-item"><i class="icon-tripfery-time"></i><?php echo tripfery_reading_time(); ?></li>
						<?php } if ( TripferyTheme::$options['blog_view'] && function_exists( 'tripfery_views' ) ) { ?>
						<li><i class="fa-regular fa-eye"></i><span class="post-views"><?php echo tripfery_views(); ?></span></li>
						<?php } ?>
					</ul>
					<?php } ?>
					<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
					<?php if ( TripferyTheme::$options['blog_content'] ) { ?>
					<div class="entry-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
					<?php } ?>	
					<?php if ( TripferyTheme::$options['blog_read_more'] ) { ?>
					<div class="post-read-more"><a class="button-style-3 btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'Continue Reading', 'tripfery' );?><i class="icon-tripfery-right-arrow"></i></a>
		          	</div>	
		          	<?php } ?>
				</div>
			</div>
		</div>

	    <?php endwhile; endif;
	      wp_reset_query();
	      die();
	}	
}

new AjaxLoadMore();