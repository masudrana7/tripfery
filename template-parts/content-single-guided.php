<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
global $post;
$guided_verifieds       		= get_post_meta($post->ID, 'tripfery_guided_verifieds', true);
$guided_since       			= get_post_meta($post->ID, 'tripfery_guided_since', true);

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('quided-single'); ?>>
	<div class="team-single-content has-sidebar">
		<div class="rt-guided-inner">
			<div class="rt-guided-image">
				<div class="team-thumb">
					<?php
					if (has_post_thumbnail()) {
						the_post_thumbnail('full');
					} else {
						if (!empty(TripferyTheme::$options['no_preview_image']['id'])) {
							echo wp_get_attachment_image(TripferyTheme::$options['no_preview_image']['id'], 'full');
						} else {
							echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img('noimage.jpg') . '" alt="' . get_the_title() . '">';
						}
					}
					?>
				</div>
			</div>
			<div class="rt-guided-content">
				<div class="team-contents">

					<div class="rt-guided-title-inner">
						<div class="guided-heading">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<?php if (!empty($guided_since)) { ?>
								<div class="rt-guided-reviews">
									<?php echo esc_html($guided_since); ?>
								</div>
							<?php } ?>
						</div>
						<div class="rt-guided-verify">
							<ul class="verfiy-lists">
								<?php foreach ($guided_verifieds as $value) { ?>
									<li><i class="fa-solid fa-check"></i><span><?php echo esc_html($value['verified_name']); ?></span></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php if (!empty(TripferyTheme::$options['guided_about_me'])) { ?>
						<div class="rt-guided-description">
							<h3 class="guided-about"><?php echo wp_kses(TripferyTheme::$options['guided_about_me'], 'alltext_allow'); ?></h3>
						</div>
					<?php } ?>

					<?php the_content(); ?>

					<?php

					$post_id = get_the_ID();
					$taxonomy = 'categories';
					$terms = wp_get_post_terms($post_id, $taxonomy);
					

						$args = array(
							'post_type' => 'to_book', 
							'posts_per_page' => -1, 
							'meta_query' => array(
								array(
									'key' => 'booking_guided', 
									'value' => $post_id, 
									'compare' => '=', 
								),
							),
						);


						$query = new WP_Query($args);
						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post();
								$taxonomy = 'categories';
								$terms = wp_get_post_terms(get_the_ID(), $taxonomy);



									$get = isset($_GET[$taxonomy]) ? $_GET['to_book'] : null;

				
								
								
								?>


								

								<?php if (!empty($terms)) {
									foreach ($terms as $term) {
										echo 'Term Name: ' . $term->name . '<br>';
									}
								} else {
									echo 'No terms found.';
								}



							}
							wp_reset_postdata();
						} 


						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post();
								the_title();
								echo '<br>';
							}
							wp_reset_postdata(); 
						} else {
							echo 'No posts found.';
						}
					?>

					<!-- Comments  -->
					<div class="info-card">
						<?php
						if (comments_open() || get_comments_number()) {
							comments_template();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>