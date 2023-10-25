<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size 			= 'tripfery-size7';
$id            			= get_the_id();
$tripfery_service_icon= get_post_meta( get_the_ID(), 'tripfery_service_icon', true );
$icon_class 			= '' ;
if ( empty( $tripfery_service_icon ) ) {
	$icon_class 		= ' no-icon';	
}

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TripferyTheme::$options['service_excerpt_limit'], '' );

?>

<article id="post-<?php the_ID(); ?>">
	<div class="service-item <?php echo esc_attr( $icon_class ); ?>">
		<div class="service-figure">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ){
						the_post_thumbnail( $thumb_size, ['class' => 'img-fluid'] );
					} else {
						if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
							echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
						} else {
							echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_400X271.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
						}
					}
				?>
			</a>
		</div>
		<div class="service-content">
			<?php if (!empty( $tripfery_service_icon ) && TripferyTheme::$options['service_ar_icon'] ) { ?>
			<div class="service-icon"><i class="<?php echo wp_kses( $tripfery_service_icon , 'alltext_allow' );?>"></i></div>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php if ( TripferyTheme::$options['service_ar_excerpt'] ) { ?>
			<div class="service-text"><?php echo wp_kses( $content , 'alltext_allow' ); ?></div>
			<?php } if ( TripferyTheme::$options['service_ar_action'] ) { ?>
			<div class="service-action"><a class="button-style-1 btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'See Details', 'tripfery' );?><i class="icon-tripfery-right-arrow"></i></a>
      		</div>
      		<?php } ?>
		</div>
	</div>
</article>