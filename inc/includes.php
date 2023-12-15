<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

require_once TRIPFERY_INC_DIR . 'customizer/customizer-default-data.php';
require_once TRIPFERY_INC_DIR . 'customizer/init.php';
require_once TRIPFERY_INC_DIR . 'rt-cat-meta.php';
/*woocommerce*/
if ( class_exists( 'WooCommerce' ) ) {
    require_once TRIPFERY_WOO_DIR . 'custom/functions.php';
}
// Update Breadcrumb Separator
add_action('bcn_after_fill', 'tripfery_hseparator_breadcrumb_trail', 1);
function tripfery_hseparator_breadcrumb_trail($object)
{
    $object->opt['hseparator'] = '<span class="dvdr"> / </span>';
    return $object;
}
/*review comment most count*/
add_filter('pre_wp_update_comment_count_now', function ($counts, $old, $post_id) {
    global $wpdb;
    return (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_parent = 0 AND comment_approved = '1'", $post_id));
}, 999, 3);
/*post order*/
add_action('admin_init', 'rt_add_page_attributes');
function rt_add_page_attributes()
{
    add_post_type_support('post', 'page-attributes');
}

add_action('init', 'rt_remove_comment', 15);
function rt_remove_comment()
{
    if (!function_exists('rtrs')) {
        return;
    }
    remove_filter('comment_form_field_comment', array(\BABE_Rating::class, 'comment_form_field_comment'), 10);
    remove_filter('get_comment_text', array(\BABE_Rating::class, 'get_comment_text'), 10, 3);
}
add_action('rtrs_avg_rating_meta_save', 'rtrs_avg_rating_meta_save', 15, 3);
function rtrs_avg_rating_meta_save($avRatingValue, $comment_id, $post_id)
{
    if (!$post_id || !$comment_id) {
        return;
    }
    $post = get_post($post_id);
    if ('to_book' !== $post->post_type) {
        return;
    }
    update_post_meta($post_id, '_rating', $avRatingValue);
    update_comment_meta($comment_id, '_rating', $avRatingValue);
}
add_filter('babe_get_posts_sort_arg', function ($sort, $args) {
    return $sort;
}, 15, 2);

// Tripfery User Account Page
if (class_exists('BABE_Functions')) {
    class Tripfery_BA_My_Account
    {
        function __construct()
        {
            add_filter('template_include', [$this, 'template_include'], 11);
        }
        public function template_include($template)
        {
            $account_page = intval(BABE_Settings::$settings['my_account_page']);
            if (intval($account_page) === get_the_ID()) {
                return locate_template(array('acount_dashboard.php'));
            }
            return $template;
        }
    }
    new Tripfery_BA_My_Account();
}