<?php $user_info = wp_get_current_user(); ?>
<?php if ($user_info->ID > 0) : ?>
    <?php $check_role = BABE_My_account::validate_role($user_info); ?>

    <?php if ($check_role) : ?>
        <div id="my_account_page_wrapper">
            <?php
            $nav_arr = BABE_My_account::get_nav_arr($check_role);
            $current_nav_slug_arr = BABE_My_account::get_current_nav_slug($nav_arr);
            $current_nav_slug = key($current_nav_slug_arr);
            ?>
            <div class="my_account_page_nav_wrapper">
                <input type="text" class="my_account_page_nav_selector" name="<?php echo esc_attr($current_nav_slug); ?>_label" value="<?php echo esc_attr($current_nav_slug_arr[$current_nav_slug]); ?>">
                <i class="fas fa-chevron-down my_account_page_nav_selector_i"></i>
                <div class="my_account_page_nav_list">
                    <?php echo BABE_My_account::get_nav_html($nav_arr, $current_nav_slug); ?>
                </div>
            </div>
            <div class="my_account_page_content_wrapper">
                <div class="my_account-content-inner">
                    <?php
                    if (isset($_GET['inner_page']) && $_GET['inner_page'] == 'posts-wishlist') {
                        do_action('gowilds_get_all_posts_wishlist');
                    } else {
                        echo apply_filters('babe_myaccount_page_content_' . $check_role, '', $user_info);
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else : ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'lostpassword') : ?>
        <div class="my_account_page_content_wrapper rt-login-signin">
            <div class="rt-login-form">
                <div class="form-content">
                    <?php echo BABE_My_account::get_lostpassword_form(); ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="my_account_page_content_wrapper rt-login-signin">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'register') : ?>
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
                    <div class="content-account text-center">
                        <span class="text"><?php echo esc_html__('Already have an account?', ''); ?></span>
                        <a class="btn-theme btn-small login-link" href="<?php echo esc_url($login_link); ?>">
                            <?php echo esc_html__('Log In', ''); ?>
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <?php
                $register_link = site_url('/wp-login.php?action=register');
                if (class_exists('BABE_Settings')) {
                    $register_link = BABE_Settings::get_my_account_page_url() . '?action=register';
                }
                ?>
                <div class="rt-login-form">
                    <?php echo BABE_My_account::get_login_form(); ?>
                    <div class="registration-here text-center">
                        <?php echo esc_html__("Don't have an account?", ""); ?>
                        <a class="quick-login-link" href="<?php echo $register_link; ?>"><?php echo esc_html__('Sign Up', ''); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>