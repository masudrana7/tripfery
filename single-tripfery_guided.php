<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// Layout class
?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<main id="main" class="site-main">
			<?php							
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content-single', 'guided' );
				endwhile;						
			?>
		</main>
	</div>
</div>
<?php get_footer(); ?>