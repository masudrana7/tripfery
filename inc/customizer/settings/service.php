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
use radiustheme\tripfery\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Service_Post_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_service_post_controls' ) );
	}

    /**
     * Service Post Controls
     */
    public function register_service_post_controls( $wp_customize ) {


        // Archive Service Post
        $wp_customize->add_setting('service_archive_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'service_archive_heading', array(
            'label' => __( 'Archive Service Option', 'tripfery' ),
            'section' => 'rttheme_service_settings',
        )));

        $wp_customize->add_setting( 'service_archive_style',
            array(
                'default' => $this->defaults['service_archive_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'service_archive_style',
            array(
                'label' => __( 'Service Archive Layout', 'tripfery' ),
                'description' => esc_html__( 'Select the gallery layout for gallery page', 'tripfery' ),
                'section' => 'rttheme_service_settings',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.png',
                        'name' => __( 'Layout 1', 'tripfery' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog3.png',
                        'name' => __( 'Layout 2', 'tripfery' )
                    ),
                )
            )
        ) );

        $wp_customize->add_setting( 'service_post_number',
            array(
                'default' => $this->defaults['service_post_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'service_post_number',
            array(
                'label' => __( 'Service Archive Post Limit', 'tripfery' ),
                'section' => 'rttheme_service_settings',
                'type' => 'number',
            )
        );

        $wp_customize->add_setting( 'service_ar_icon',
            array(
                'default' => $this->defaults['service_ar_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'service_ar_icon',
            array(
                'label' => __( 'Show Icon', 'tripfery' ),
                'section' => 'rttheme_service_settings',
            )
        ));

        $wp_customize->add_setting( 'service_ar_action',
            array(
                'default' => $this->defaults['service_ar_action'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'service_ar_action',
            array(
                'label' => __( 'Show Button', 'tripfery' ),
                'section' => 'rttheme_service_settings',
            )
        ));

        $wp_customize->add_setting( 'service_ar_excerpt',
            array(
                'default' => $this->defaults['service_ar_excerpt'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'service_ar_excerpt',
            array(
                'label' => __( 'Show Excerpt', 'tripfery' ),
                'section' => 'rttheme_service_settings',
            )
        ));

        $wp_customize->add_setting( 'service_excerpt_limit',
            array(
                'default' => $this->defaults['service_excerpt_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'service_excerpt_limit',
            array(
                'label' => __( 'Service Archive Excerpt Limit', 'tripfery' ),
                'section' => 'rttheme_service_settings',
                'type' => 'number',
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Service_Post_Settings();
}
