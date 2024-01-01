<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\tripfery\Customizer\Settings;

use radiustheme\tripfery\Customizer\TripferyTheme_Customizer;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Slug_Settings extends TripferyTheme_Customizer {

	public function __construct() {
        parent::instance();
        $this->populated_default_data();
        // Register Page Controls
        add_action( 'customize_register', array( $this, 'register_slug_controls' ) );
	}

    public function register_slug_controls( $wp_customize ) {
	
		$wp_customize->add_setting( 'team_slug',
            array(
                'default' => $this->defaults['team_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'team_slug',
            array(
                'label' => __( 'Team Slug', 'tripfery' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		
		$wp_customize->add_setting( 'booking_slug',
            array(
                'default' => $this->defaults['booking_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'booking_slug',
            array(
                'label' => __( 'Booking Slug', 'tripfery' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		// Category
		$wp_customize->add_setting( 'team_cat_slug',
            array(
                'default' => $this->defaults['team_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'team_cat_slug',
            array(
                'label' => __( 'Team Category Slug', 'tripfery' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'booking_cat_slug',
            array(
                'default' => $this->defaults['booking_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'booking_cat_slug',
            array(
                'label' => __( 'Booking Category Slug', 'tripfery' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Slug_Settings();
}
