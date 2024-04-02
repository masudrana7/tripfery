<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
</div><!--#content-->
	<!-- progress-wrap -->
	<?php if (TripferyTheme::$options['back_to_top']) { ?>
		<div class="scroll-wrap">
			<svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
			</svg>
		</div>
	<?php } ?>
	<footer>
		<div id="footer-<?php echo esc_attr(TripferyTheme::$footer_style); ?>" class="footer-area">
			<?php
			get_template_part('template-parts/footer/footer', 'fun-fact');
			?>
			<?php
			get_template_part('template-parts/footer/footer', TripferyTheme::$footer_style);
			?>
		</div>
	</footer>

	<?php if ((TripferyTheme::$options['scroll_indicator_enable'] == '1') && (TripferyTheme::$options['scroll_indicator_position'] == 'below')) { ?>
		<div class="tripfery-progress-container bottom">
			<div class="tripfery-progress-bar" id="tripferyBar"></div>
		</div>
	<?php } ?>

	<?php if (!is_user_logged_in()) { ?>
		<div id="rt-login-form" class="rt-popup-login-register my_account_page_content_wrapper rt-login-form-container">
                <ul class="nav" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-menu active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo esc_html__('Login', 'tripfery')?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-menu" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo esc_html__('Register', 'tripfery')?></button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <h3 class="rt-form-title"><?php echo esc_html__('Sign in to your account', 'tripfery')?></h3>
	                    <?php
	                    $register_link = site_url('/wp-login.php?action=register');
	                    if (class_exists('BABE_Settings')) {
		                    $register_link = BABE_Settings::get_my_account_page_url() . '?action=register';
	                    }
	                    ?>
                        <div class="rt-login-form">
		                    <?php echo BABE_My_account::get_login_form(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h3 class="rt-form-title"><?php echo esc_html__('Sign up to your account', 'tripfery')?></h3>
                        <?php
                        $html = BABE_My_account::get_register_form();
                        $html = str_replace('modal fade', 'registration-wrapper', $html);
                        $html = str_replace('modal-dialog modal-dialog-centered modal-lg', '', $html);
                        $html = str_replace('modal-body', 'form-content', $html);
                        $html = str_replace('modal-content', 'form-content-inner', $html);
                        if (!get_option('users_can_register')) {
                            $html = '<div class="alert alert-info">' . esc_html__('Website does not permission Sign Up', 'tripfery') . '</div>';
                        }
                        if (isset($image_options['url']) && $image_options['url']) {
                            $register_image = $image_options['url'];
                        }
                        $login_link = site_url('/wp-login.php?action=login&redirect_to=' . get_permalink());
                        if (class_exists('BABE_Settings')) {
                            $login_link = BABE_Settings::get_my_account_page_url() . '?action=login';
                        }
                        ?>
                        <div class="rt-signup-form">
                            <div class="rt-signup-form">
                                <?php echo html_entity_decode($html); ?>
                            </div>
                        </div>
                    </div>
                </div>
		</div>
	<?php } ?>

</div>
<?php wp_footer(); ?>
</body>

</html>