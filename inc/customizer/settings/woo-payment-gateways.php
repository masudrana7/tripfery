<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\tripfery\Customizer\Settings;

use radiustheme\tripfery\Customizer\TripferyTheme_Customizer;
use radiustheme\tripfery\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Image_Radio_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Woo_Payment_Pateways_Settings extends TripferyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', array( $this, 'register_woo_payment_controls' ) );
	}

	public function register_woo_payment_controls( $wp_customize ) {

		// Meta
		$wp_customize->add_setting( 'wc_payment_geteways',
			array(
				'default' => $this->defaults['wc_payment_geteways'],
				'transport' => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			)
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'wc_payment_geteways',
			array(
				'label' => __( 'Payment Geteways ', 'tripfery' ),
				'section' => 'wc_payment_gateways_settings',
			)
		) );


	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Woo_Payment_Pateways_Settings();
}
