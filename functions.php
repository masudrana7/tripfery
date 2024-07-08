<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$tripfery_theme_data = wp_get_theme();
	$action  = 'tripfery_theme_init';
	do_action( $action );

	define( 'TRIPFERY_VERSION', ( WP_DEBUG ) ? time() : $tripfery_theme_data->get( 'Version' ) );
	define( 'TRIPFERY_AUTHOR_URI', $tripfery_theme_data->get( 'AuthorURI' ) );
	define( 'TRIPFERY_NAME', 'tripfery' );

	// DIR
	define( 'TRIPFERY_BASE_DIR',    get_template_directory(). '/' );
	define( 'TRIPFERY_INC_DIR',     TRIPFERY_BASE_DIR . 'inc/' );
	define( 'TRIPFERY_ASSETS_DIR',  TRIPFERY_BASE_DIR . 'assets/' );
	define( 'TRIPFERY_WOO_DIR',     TRIPFERY_BASE_DIR . 'woocommerce/' );

	// URL
	define( 'TRIPFERY_BASE_URL',    get_template_directory_uri(). '/' );
	define( 'TRIPFERY_ASSETS_URL',  TRIPFERY_BASE_URL . 'assets/' );

	// BA Book Everything
	if (defined('BABE_VERSION')) {
		require_once TRIPFERY_INC_DIR . 'account_dashboard.php';
	}

	// icon trait Plugin Activation
	require_once TRIPFERY_INC_DIR . 'icon-trait.php';
	// Includes
	require_once TRIPFERY_INC_DIR . 'helper-functions.php';
	require_once TRIPFERY_INC_DIR . 'tripfery.php';
	require_once TRIPFERY_INC_DIR . 'general.php';
	require_once TRIPFERY_INC_DIR . 'ajax-tab.php';
	require_once TRIPFERY_INC_DIR . 'ajax-loadmore.php';
	require_once TRIPFERY_INC_DIR . 'scripts.php';
	require_once TRIPFERY_INC_DIR . 'template-vars.php';
	require_once TRIPFERY_INC_DIR . 'includes.php';
	require_once TRIPFERY_INC_DIR . 'ajax-wishlist.php';
	require_once TRIPFERY_INC_DIR . 'lc-helper.php';
	require_once TRIPFERY_INC_DIR . 'lc-utility.php';

	if( is_admin() ) {
		// TGM Plugin Activation
		require_once TRIPFERY_BASE_DIR . 'lib/class-tgm-plugin-activation.php';
		require_once TRIPFERY_INC_DIR . 'tgm-config.php';
	} else {
		// Includes Modules
		require_once TRIPFERY_INC_DIR . 'modules/rt-post-related.php';
		require_once TRIPFERY_INC_DIR . 'modules/rt-team-related.php';
		require_once TRIPFERY_INC_DIR . 'modules/rt-booking-related.php';
		require_once TRIPFERY_INC_DIR . 'modules/rt-booking-related-two.php';
		require_once TRIPFERY_INC_DIR . 'modules/rt-breadcrumbs.php';
	}
	add_editor_style( 'style-editor.css' );

	//user rol
	if ( class_exists('BABE_Functions')) {
//		function rt_customer_myorder( $orders, $user_info ) {
//			if ( ! $user_info instanceof WP_User ) {
//				return $orders;
//			}
//
//			if ( in_array( 'customer', $user_info->roles ) ) {
//				$current_user_id = $user_info->ID;
//				$customer_orders = wc_get_orders( array(
//					'customer' => $current_user_id,
//					'status'   => array_keys( wc_get_order_statuses() ),
//				) );
//				$order_details = array();
//				foreach ( $customer_orders as $order ) {
//					$order_total = $order->get_total();
//					$order_details[] = $order;
//				}
//				// $orders = $order_details;
//			}
//			return $orders;
//			error_log( print_r( $orders, true ) . "\n\n", 3, __DIR__.'/log.txt');
//		}
//
//		add_filter( 'babe_myaccount_my_bookings_all_orders', 'rt_customer_myorder', 15, 2 );


		function validate_role( $user_info ) {
			$check_role = in_array( 'customer', $user_info->roles ) || in_array( 'administrator', $user_info->roles ) ? 'customer' : '';
			$check_role = in_array( 'manager', $user_info->roles ) || in_array( 'administrator', $user_info->roles ) ? 'manager' : $check_role;
			$check_role = apply_filters( 'babe_myaccount_validate_role', $check_role, $user_info );
			return $check_role;
		}
		function rt_customer_myorder( $orders, $user_info ) {
			$check_role = validate_role( $user_info );
			if ( $check_role == 'customer' ) {
				error_log( print_r( $orders, true ) . "\n\n", 3, __DIR__.'/log.txt');
				$orders = BABE_Order::get_customer_orders($user_info->ID);
			}
			return $orders;
		}
		add_filter( 'babe_myaccount_my_bookings_all_orders', 'rt_customer_myorder', 15, 2 );

	}

if ( function_exists( 'WC' ) && function_exists( 'cptwooint' ) ) {
	add_filter( 'cptwooint_post_types', 'cptwooint_default_settings', 15 );
	/**
	 * @return false|string
	 */
	function cptwooint_default_settings( $post_type_array ) {
		$post_type_array[] = [
			'value' => 'order',
			'label' => 'Order ( BA Book Everything )',
		];
		return $post_type_array;
	}
	add_action( 'init', function (){
	require_once TRIPFERY_BASE_DIR . 'WooPayment/init.php';
}, 15 );

}