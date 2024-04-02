<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$tripfery_socials = TripferyTheme_Helper::socials();
$class_width = (TripferyTheme::$header_width === "on" || TripferyTheme::$header_width === 1) ? "container " : "rt-container container-fluid"; ?>
<div id="tophead" class="header-top-bar">
	<div class="<?php echo esc_attr($class_width); ?>">
		<div class="top-bar-wrap">
			<div class="topbar-left">
				<div class="rt-tf-topbar-right d-flex align-items-center justify-content-end">
				<ul class="top-address">
					<?php if (TripferyTheme::$options['email']) { ?>
						<li><svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.9805 0.972656L9.73047 9.07812C9.71094 9.27344 9.59375 9.44922 9.41797 9.54688C9.32031 9.58594 9.22266 9.625 9.10547 9.625C9.02734 9.625 8.94922 9.60547 8.87109 9.56641L6.48828 8.57031L5.49219 10.0547C5.41406 10.1914 5.27734 10.25 5.14062 10.25C4.92578 10.25 4.75 10.0742 4.75 9.85938V7.98438C4.75 7.82812 4.78906 7.69141 4.86719 7.59375L9.125 2.125L3.38281 7.30078L1.37109 6.46094C1.15625 6.36328 1 6.16797 1 5.91406C0.980469 5.64062 1.09766 5.44531 1.3125 5.32812L10.0625 0.347656C10.2578 0.230469 10.5312 0.230469 10.7266 0.367188C10.9219 0.503906 11.0195 0.738281 10.9805 0.972656Z" fill="#D2D2D2"></path>
							</svg><a href="mailto:<?php echo esc_attr( TripferyTheme::$options['email'] );?>" class="info-email"><?php echo wp_kses( TripferyTheme::$options['email'] , 'alltext_allow' );?></a>
						</li>
					<?php } ?>
					<?php if (TripferyTheme::$options['address']) { ?>
						<li><svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.28125 10.0156C2.26562 8.74609 0 5.71875 0 4C0 1.92969 1.66016 0.25 3.75 0.25C5.82031 0.25 7.5 1.92969 7.5 4C7.5 5.71875 5.21484 8.74609 4.19922 10.0156C3.96484 10.3086 3.51562 10.3086 3.28125 10.0156ZM3.75 5.25C4.43359 5.25 5 4.70312 5 4C5 3.31641 4.43359 2.75 3.75 2.75C3.04688 2.75 2.5 3.31641 2.5 4C2.5 4.70312 3.04688 5.25 3.75 5.25Z" fill="#D2D2D2"></path>
						</svg><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?></li>
					<?php } ?>

				</ul>
				<?php if ( $tripfery_socials ) { ?>	
				<div class="tophead-socials">
					<span class="social-link-text"><?php echo wp_kses( TripferyTheme::$options['social_label'] , 'alltext_allow' );?></span>	
					<ul class="tophead-social">
						<?php foreach ( $tripfery_socials as $tripfery_social ): ?>
							<li><a target="_blank" aria-label="Social Link" href="<?php echo esc_url( $tripfery_social['url'] );?>"><i class="fab <?php echo esc_attr( $tripfery_social['icon'] );?>"></i></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php } ?>
				</div>
			</div>

			
			<div class="tophead-right">		
				<div class="rt-tf-topbar-right d-flex align-items-center justify-content-end">
					<div class="tophead-address">
						<div class="tophead-text">
							<?php if (TripferyTheme::$options['search_icon']) { ?>
								<?php get_template_part('template-parts/header/icon', 'search'); ?>
							<?php } ?>
							<?php if (has_nav_menu('currency_menu')) {
								wp_nav_menu(array(
									'theme_location' => 'currency_menu',
									'menu_class'     => 'rt_currency_menu',
									'container'      => 'nav',
								));
							} ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>