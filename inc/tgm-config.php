<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'tgmpa_register', 'tripfery_register_required_plugins' );
function tripfery_register_required_plugins() {
	$plugins = array(
		// Bundled
		array(
			'name'         => 'Tripfery Core',
			'slug'         => 'tripfery-core',
			'source'       => 'tripfery-core.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.4.5'
		),
		array(
			'name'         => 'RT Framework',
			'slug'         => 'rt-framework',
			'source'       => 'rt-framework.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '2.4'
		),
		array(
			'name'         => 'RT Demo Importer',
			'slug'         => 'rt-demo-importer',
			'source'       => 'rt-demo-importer.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '6.0.1'
		),
		array(
			'name'         => 'Review Schema Pro',
			'slug'         => 'review-schema-pro',
			'source'       => 'review-schema-pro.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.1.6'
		),

		// Repository
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		),
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'WP Fluent Forms',
			'slug'     => 'fluentform',
			'required' => false,
		),
		array(
			'name'     => 'Review Schema',
			'slug'     => 'review-schema',
			'required' => false,
		),
		array(
			'name'     => 'BA Book Everything',
			'slug'     => 'ba-book-everything',
			'required' => true,
		),
		array(
			'name'     => 'Woocommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => 'ShopBuilder - Elementor WooCommerce Builder Addons',
			'slug'     => 'shopbuilder',
			'required' => false,
		),
		array(
			'name'     => 'Custom Post Type WooCommerce Integration',
			'slug'     => 'cpt-woo-integration',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'tripfery',                 	// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => TRIPFERY_INC_DIR. '/plugins/', // Default absolute path to bundled plugins.
		'menu'         => 'tripfery-install-plugins', 	// Menu slug.
		'has_notices'  => true,                    		// Show admin notices or not.
		'dismissable'  => true,                    		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   		// Automatically activate plugins after installation or not.
		'message'      => '',                      		// Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}