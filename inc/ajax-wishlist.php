<?php

class RTWishlist
{
    public function __construct()
    {
        add_action('wp_ajax_tripfery_wishlist', array($this, 'wishlist_add'));
        add_action('wp_ajax_nopriv_tripfery_wishlist', array($this, 'wishlist_add'));
    }
    public function wishlist_add()
    {
        // Checking nonce.
        check_ajax_referer('tripfery-nonce', 'security');
        $mode = $_POST['mode'];
        $post_id = $_POST['post_id'];
        $user_id = get_current_user_id();

        if (!is_user_logged_in()) {
            echo json_encode(array('logged_in' => false, 'add_wishlist' => ''));
            die();
        }
        if ($mode == 'add') {
            $wishlist = get_user_meta($user_id, 'rt_wishlist', true);
            if (is_array($wishlist)) {
                if (!in_array($post_id, $wishlist)) {
                    $wishlist[] = $post_id;
                    update_user_meta($user_id, 'rt_wishlist', $wishlist);
                }
            } else {
                $wishlist = array($post_id);
                update_user_meta($user_id, 'rt_wishlist', $wishlist);
            }
            echo json_encode(array('logged_in' => true, 'add_wishlist' => 'added', 'mode' => 'add'));
            die();
        }

        if ($mode == 'remove') {
            $wishlist = get_user_meta($user_id, 'rt_wishlist', true);
            if (is_array($wishlist)) {
                foreach ($wishlist as $key => $value) {
                    if ($post_id == $value) {
                        unset($wishlist[$key]);
                    }
                }
            }
            update_user_meta($user_id, 'rt_wishlist', $wishlist);
            echo json_encode(array('logged_in' => true, 'remove_wishlist' => 'removed', 'mode' => 'remove'));
            die();
        }
        wp_die();
    }

    public static function wishlist_html($post_id)
    {
        $user_id = get_current_user_id();
        $data = get_user_meta($user_id, 'rt_wishlist', true);
        $check_wishlist = false;
        if (is_array($data)) {
            if (in_array($post_id, $data)) {
                $check_wishlist = true;
            }
        } else {
            if ($post_id == $data) {
                $check_wishlist = true;
            }
        }
        ob_start(); ?>
        <div data-post_id="<?php echo esc_attr($post_id); ?>" class="wishlist <?php echo (!$check_wishlist ? 'add-wishlist' : 'remove-wishlist added-wishlist') ?>">
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

    <?php return ob_get_clean(); }
    }
new RTWishlist();
?>