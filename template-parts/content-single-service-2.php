<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-service' ); ?>>
	<div class="single-service-inner">
        <h1 class="entry-title single-service-title"><?php the_title();?></h1>
		<?php the_content(); ?>
	</div>
</div>