<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$thumb_size = 'tripfery-size1';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-service' ); ?>>
	<div class="single-service-inner">
		<div class="service-thumb">
			<?php
				if ( has_post_thumbnail() ){
					the_post_thumbnail( $thumb_size );
				} else {
					if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
						echo wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );
					} else {
						echo '<img class="wp-post-image" src="' . TechkitTheme_Helper::get_img( 'noimage_1296X880.jpg' ) . '" alt="'.get_the_title().'">';
					}
				}
			?>
		</div>
		<h1 class="entry-title single-service-title"><?php the_title();?></h1>
		<?php the_content(); ?>
	</div>
</div>