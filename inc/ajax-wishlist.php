<?php
class RTWishlist{
    public function __construct() {
        add_action('wp_ajax_tripfery_wishlist', array($this, 'wishlist_add'));
        add_action('wp_ajax_nopriv_tripfery_wishlist', array($this, 'wishlist_add'));
    }
    public function wishlist_add(){
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
            $wishlist = get_user_meta($user_id, 'lt_wishlist', true);
            if (is_array($wishlist)) {
                if (!in_array($post_id, $wishlist)) {
                    $wishlist[] = $post_id;
                    update_user_meta($user_id, 'lt_wishlist', $wishlist);
                }
            } else {
                $wishlist = array($post_id);
                update_user_meta($user_id, 'lt_wishlist', $wishlist);
            }
            echo json_encode(array('logged_in' => true, 'add_wishlist' => 'added', 'mode' => 'add'));
            die();
        }

        if ($mode == 'remove') {
            $wishlist = get_user_meta($user_id, 'lt_wishlist', true);
            if (is_array($wishlist)) {
                foreach ($wishlist as $key => $value) {
                    if ($post_id == $value) {
                        unset($wishlist[$key]);
                    }
                }
            }
            update_user_meta($user_id, 'lt_wishlist', $wishlist);
            echo json_encode(array('logged_in' => true, 'remove_wishlist' => 'removed', 'mode' => 'remove'));
            die();
        }

    }

}
?>