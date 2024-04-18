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
	// add_action( 'init', function (){
	//     if ( '1' == TripferyTheme::$options['wc_payment_geteways'] ) {
	//         require_once TRIPFERY_BASE_DIR . 'WooPayment/init.php';
	//     }
	// } );
