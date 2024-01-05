<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$tripfery_has_entry_meta  = (TripferyTheme::$options['post_date'] || TripferyTheme::$options['post_author_name'] || TripferyTheme::$options['post_cats'] || TripferyTheme::$options['post_comment_num'] || (TripferyTheme::$options['post_length'] && function_exists('tripfery_reading_time')) || TripferyTheme::$options['post_published'] && function_exists('tripfery_get_time') || (TripferyTheme::$options['post_view'] && function_exists('tripfery_views'))) ? true : false;

$tripfery_comments_number = number_format_i18n(get_comments_number());
$tripfery_comments_html = $tripfery_comments_number == 1 ? esc_html__('Comment', 'tripfery') : esc_html__('Comments', 'tripfery');
$tripfery_comments_html = '<span class="comment-number">' . $tripfery_comments_number . '</span> ' . $tripfery_comments_html;
$tripfery_author_bio = get_the_author_meta('description');

$tripfery_time_html       = sprintf('<span>%s</span><span>%s</span>', get_the_time('d'), get_the_time('M'), get_the_time('Y'));
$tripfery_time_html       = apply_filters('tripfery_single_time', $tripfery_time_html);

$author = $post->post_author;

if (empty(has_post_thumbnail())) {
	$img_class = 'no-image';
} else {
	$img_class = 'show-image';
}

$news_author_fb = get_user_meta($author, 'tripfery_facebook', true);
$news_author_tw = get_user_meta($author, 'tripfery_twitter', true);
$news_author_ld = get_user_meta($author, 'tripfery_linkedin', true);
$news_author_pr = get_user_meta($author, 'tripfery_pinterest', true);
$news_author_ins = get_user_meta($author, 'tripfery_instagram', true);
$tripfery_author_designation = get_user_meta($author, 'tripfery_author_designation', true);
$youtube_link = get_post_meta(get_the_ID(), 'tripfery_youtube_link', true); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="main-wrap <?php echo esc_attr($img_class); ?>">
		<?php
		$swiper_data = array(
			'slidesPerView' 	=> 1,
			'centeredSlides'	=> false,
			'loop'				=> true,
			'spaceBetween'		=> 20,
			'slideToClickedSlide' => true,
			'slidesPerGroup' => 1,
			'autoplay'				=> array(
				'delay'  => 1,
			),
			'speed'      => 500,
			'breakpoints' => array(
				'0'    => array('slidesPerView' => 1),
				'576'    => array('slidesPerView' => 1),
				'768'    => array('slidesPerView' => 1),
				'992'    => array('slidesPerView' => 1),
				'1200'    => array('slidesPerView' => 1),
				'1600'    => array('slidesPerView' => 1)
			),
			'auto'   => false
		);

		$swiper_data = json_encode($swiper_data);
		$tripfery_post_gallerys_raw = get_post_meta(get_the_ID(), 'tripfery_post_gallery', true);
		$tripfery_post_gallerys = explode(",", $tripfery_post_gallerys_raw);
		if (!empty($tripfery_post_gallerys_raw) && 'gallery' == get_post_format($id)) { ?>
			<div class="rt-swiper-slider single-post-slider rt-swiper-nav" data-xld='<?php echo esc_attr($swiper_data); ?>'>
				<div class="swiper-wrapper">
					<?php foreach ($tripfery_post_gallerys as $tripfery_posts_gallery) { ?>
						<div class="swiper-slide">
							<?php echo wp_get_attachment_image($tripfery_posts_gallery, 'full', "", array("class" => "img-responsive"));
							?>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-navigation">
					<div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__('Prev', 'tripfery') ?></div>
					<div class="swiper-button-next"><?php echo esc_html__('Next', 'tripfery') ?><i class="icon-tripfery-right-arrow"></i></div>
				</div>
			</div>
		<?php } else { ?>
			<?php if (has_post_thumbnail() && (TripferyTheme::$options['post_featured_image'] == true)) { ?>
				<div class="entry-thumbnail-area"><?php the_post_thumbnail('tripfery-size4', ['class' => 'img-responsive']); ?></div>
			<?php } ?>
		<?php } ?>

		<div class="rt-single-post-content">
			<div class="entry-header">
				<?php if ($tripfery_has_entry_meta) { ?>
					<ul class="entry-meta top-meta">
						<?php if (TripferyTheme::$options['post_cats']) { ?>
							<li><?php echo the_category(', '); ?></li>
						<?php } ?>
					</ul>
				<?php } ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</div>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array(
					'before'      => '<div class="page-links">' . esc_html__('Pages:', 'tripfery'),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)); ?>
			</div>

			<?php if ((function_exists('get_post_format') && 'video' == get_post_format($id) && !empty($youtube_link))) {
				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_link, $match);
				$youtube_id = $match[1];
			} ?>
			<?php if (!empty($youtube_id)) { ?>
				<?php if ((function_exists('get_post_format') && 'video' == get_post_format($id))) { ?>
					<div class="entry-content embed-responsive-16by9">
						<div class="embed-responsive">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" allowfullscreen></iframe>
						</div>
					</div>
				<?php } ?>
			<?php } ?>

			<?php if ($tripfery_has_entry_meta || (TripferyTheme::$options['post_share']  && (function_exists('tripfery_post_share')))) { ?>
				<div class="entry-footer">
					<div class="entry-footer-meta">
						<?php if ($tripfery_has_entry_meta) { ?>
							<ul class="entry-meta bottom-meta">
								<?php if (TripferyTheme::$options['post_author_name']) { ?>
									<li class="item-author"><i class="icon-tripfery-user"></i><?php esc_html_e('by ', 'tripfery'); ?><?php the_author_posts_link(); ?></li>
								<?php }
								if (TripferyTheme::$options['post_date']) { ?>
									<li><i class="icon-tripfery-calendar"></i><?php echo get_the_date(); ?></li>
								<?php }
								if (TripferyTheme::$options['post_comment_num']) { ?>
									<li><i class="icon-tripfery-comment"></i><?php echo wp_kses($tripfery_comments_html, 'alltext_allow'); ?></li>
								<?php }
								if (TripferyTheme::$options['post_length'] && function_exists('tripfery_reading_time')) { ?>
									<li class="meta-reading-time meta-item"><i class="icon-tripfery-time"></i><?php echo tripfery_reading_time(); ?></li>
								<?php }
								if (TripferyTheme::$options['post_view'] && function_exists('tripfery_views')) { ?>
									<li><span class="meta-views meta-item "><i class="fa-regular fa-eye"></i><?php echo tripfery_views(); ?></span></li>
								<?php }
								if (TripferyTheme::$options['post_published'] && function_exists('tripfery_get_time')) { ?>
									<li><i class="icon-tripfery-calendar-alt"></i><?php echo tripfery_get_time(); ?></li>
								<?php } ?>
							</ul>
						<?php } ?>

						<?php if ((TripferyTheme::$options['post_share']) && (function_exists('tripfery_post_share'))) { ?>
							<div class="post-share"><span class="meta-title"><?php esc_html_e('Follow Us:', 'tripfery'); ?></span><?php tripfery_post_share(); ?></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if (TripferyTheme::$options['post_tags'] && has_tag()) { ?>
				<div class="meta-tags">
					<?php echo get_the_term_list($post->ID, 'post_tag', ''); ?>
				</div>
			<?php } ?>


			<!-- author bio -->
			<?php if (TripferyTheme::$options['post_author_bio'] == '1') { ?>
				<?php if (!empty($tripfery_author_bio)) { ?>
					<div class="media about-author">
						<div class="<?php if (is_rtl()) { ?>pull-right<?php } else { ?>pull-left<?php } ?>">
							<?php echo get_avatar($author, 110); ?>
						</div>
						<div class="media-body">
							<div class="about-author-info">
								<h3 class="author-title"><?php the_author_posts_link(); ?></h3>
								<div class="author-designation">
									<?php if (!empty($tripfery_author_designation)) {
										echo esc_html($tripfery_author_designation);
									} else {
										$user_info = get_userdata($author);
										echo esc_html(implode(', ', $user_info->roles));
									} ?>
								</div>
							</div>
							<?php if ($tripfery_author_bio) { ?>
								<div class="author-bio"><?php echo esc_html($tripfery_author_bio); ?></div>
							<?php } ?>
							<ul class="author-box-social">
								<?php if (!empty($news_author_fb)) { ?><li><a href="<?php echo esc_attr($news_author_fb); ?>"><i class="fab fa-facebook-f"></i></a></li><?php } ?>
								<?php if (!empty($news_author_tw)) { ?><li><a href="<?php echo esc_attr($news_author_tw); ?>"><i class="fab fa-twitter"></i></a></li><?php } ?>
								<?php if (!empty($news_author_ld)) { ?><li><a href="<?php echo esc_attr($news_author_ld); ?>"><i class="fab fa-linkedin-in"></i></a></li><?php } ?>
								<?php if (!empty($news_author_pr)) { ?><li><a href="<?php echo esc_attr($news_author_pr); ?>"><i class="fab fa-pinterest-p"></i></a></li><?php } ?>
								<?php if (!empty($news_author_ins)) { ?><li><a href="<?php echo esc_url($news_author_ins); ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
							</ul>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			<!-- next/prev post -->
			<?php if (TripferyTheme::$options['post_links']) {
				tripfery_post_links_next_prev();
			} ?>
			<!-- related post -->
			<?php if (TripferyTheme::$options['show_related_post'] == '1' && is_single() && !empty(tripfery_related_post())) { ?>
				<div class="related-post">
					<?php tripfery_related_post(); ?>
				</div>
			<?php } ?>
			<?php
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
			?>
		</div>
	</div>
</div>