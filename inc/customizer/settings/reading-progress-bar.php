<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\tripfery\Customizer\Settings;

use radiustheme\tripfery\Customizer\TripferyTheme_Customizer;
use radiustheme\tripfery\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Heading_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Progress_Bar_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_progress_bar_controls' ) );
	}

    public function register_progress_bar_controls( $wp_customize ) {
	
		// scroll indicator enable
		 $wp_customize->add_setting( 'scroll_indicator_enable',
            array(
                'default' => $this->defaults['scroll_indicator_enable'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'scroll_indicator_enable',
            array(
                'label' => __( 'Reading Progress Bar', 'tripfery' ),
                'section' => 'reading_progress_bar_section',
            )
        ) );

        // scroll indicator bgcolor
        $wp_customize->add_setting('scroll_indicator_bgcolor', 
            array(
                'default' => $this->defaults['scroll_indicator_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scroll_indicator_bgcolor',
            array(
                'label' => esc_html__('Reading Progress Bar Color', 'tripfery'),
                'section' => 'reading_progress_bar_section', 
                'active_callback'   => 'rttheme_is_post_indicator_enabled',
            )
        ));
        $wp_customize->add_setting('scroll_indicator_bgcolor2', 
            array(
                'default' => $this->defaults['scroll_indicator_bgcolor2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scroll_indicator_bgcolor2',
            array(
                'label' => esc_html__('Reading Progress Bar Color', 'tripfery'),
                'section' => 'reading_progress_bar_section', 
                'active_callback'   => 'rttheme_is_post_indicator_enabled',
            )
        ));

        // scroll indicator height
        $wp_customize->add_setting( 'scroll_indicator_height',
            array(
                'default' => $this->defaults['scroll_indicator_height'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'scroll_indicator_height',
            array(
                'label' => __( 'Height of the Progress Bar', 'tripfery' ),
                'section' => 'reading_progress_bar_section',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_post_indicator_enabled',
            )
        );        

        // scroll indicator position
        $wp_customize->add_setting( 'scroll_indicator_position',
            array(
                'default' => $this->defaults['scroll_indicator_position'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'scroll_indicator_position',
            array(
                'label' => __( 'Reading Progress Bar Position', 'tripfery' ),
                'section' => 'reading_progress_bar_section',
                'type' => 'select',
                'choices' => array(
                    'top' => esc_html__( 'Top', 'tripfery' ),
                    'below' => esc_html__( 'Bottom', 'tripfery' ),
                ),
                'active_callback'   => 'rttheme_is_post_indicator_enabled',
            )
        );        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Progress_Bar_Settings();
}
