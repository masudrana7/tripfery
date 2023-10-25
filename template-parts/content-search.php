<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TripferyTheme::$options['search_excerpt_length'], '' );

$tripfery_has_entry_meta  = ( TripferyTheme::$options['blog_author_name'] || TripferyTheme::$options['blog_date'] || TripferyTheme::$options['blog_cats'] ) ? true : false;

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-layout-1' ); ?>>
	<div class="blog-box">		
		<div class="entry-content">
			<?php if ( $tripfery_has_entry_meta ) { ?>
			<ul class="entry-meta">
				<?php if ( TripferyTheme::$options['blog_author_name'] ) { ?>
				<li class="post-author"><i class="icon-tripfery-user"></i><?php esc_html_e( 'by ', 'tripfery' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( TripferyTheme::$options['blog_date'] ) { ?>	
				<li class="post-date"><i class="icon-tripfery-calendar"></i><?php echo get_the_date(); ?></li>
				<?php } if ( TripferyTheme::$options['blog_cats'] && has_category() ) { ?>
				<li class="entry-categories"><i class="icon-tripfery-tags"></i><?php echo the_category( ', ' );?></li>
				<?php } ?>
			</ul>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php if ( TripferyTheme::$options['blog_content'] ) { ?>
			<div class="entry-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>
		</div>
	</div>
</div>