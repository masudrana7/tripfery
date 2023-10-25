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
class TripferyTheme_Locations_Post_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_locations_post_controls' ) );
	}

    /**
     * Locations Post Controls
     */
    public function register_locations_post_controls( $wp_customize ) {


        // Archive Locations Post
        $wp_customize->add_setting('locations_archive_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'locations_archive_heading', array(
            'label' => __( 'Locations Archive Option', 'tripfery' ),
            'section' => 'rttheme_locations_settings',
        )));

        $wp_customize->add_setting( 'locations_archive_style',
            array(
                'default' => $this->defaults['locations_archive_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'locations_archive_style',
            array(
                'label' => __( 'Locations Archive Layout', 'tripfery' ),
                'description' => esc_html__( 'Select the gallery layout for gallery page', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.png',
                        'name' => __( 'Layout 1', 'tripfery' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog3.png',
                        'name' => __( 'Layout 2', 'tripfery' )
                    ),
                    'style3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog2.png',
                        'name' => __( 'Layout 3', 'tripfery' )
                    ),
                )
            )
        ) );

        // Locations Archive option
        $wp_customize->add_setting( 'locations_post_number',
            array(
                'default' => $this->defaults['locations_post_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'locations_post_number',
            array(
                'label' => __( 'Locations Archive Post Limit', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'type' => 'number',
            )
        );

        $wp_customize->add_setting( 'locations_ar_category',
            array(
                'default' => $this->defaults['locations_ar_category'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'locations_ar_category',
            array(
                'label' => __( 'Show Category', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'locations_ar_action',
            array(
                'default' => $this->defaults['locations_ar_action'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'locations_ar_action',
            array(
                'label' => __( 'Show Action', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'locations_ar_excerpt',
            array(
                'default' => $this->defaults['locations_ar_excerpt'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'locations_ar_excerpt',
            array(
                'label' => __( 'Show Excerpt', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'locations_arexcerpt_limit',
            array(
                'default' => $this->defaults['locations_arexcerpt_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'locations_arexcerpt_limit',
            array(
                'label' => __( 'Locations Archive Excerpt Limit', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'type' => 'number',
            )
        );


        // Single Locations
        $wp_customize->add_setting('locations_related_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'locations_related_heading', array(
            'label' => __( 'Single Locations Option', 'tripfery' ),
            'section' => 'rttheme_locations_settings',
        )));        

        $wp_customize->add_setting( 'single_locations_cat',
            array(
                'default' => $this->defaults['single_locations_cat'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_cat',
            array(
                'label' => __( 'Locations Single Category', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'single_locations_client',
            array(
                'default' => $this->defaults['single_locations_client'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_client',
            array(
                'label' => __( 'Locations Single Client', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'single_locations_startdate',
            array(
                'default' => $this->defaults['single_locations_startdate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_startdate',
            array(
                'label' => __( 'Locations Single Start Date', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'single_locations_enddate',
            array(
                'default' => $this->defaults['single_locations_enddate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_enddate',
            array(
                'label' => __( 'Locations Single End Date', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'single_locations_weblink',
            array(
                'default' => $this->defaults['single_locations_weblink'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_weblink',
            array(
                'label' => __( 'Locations Single WebLink', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));

        $wp_customize->add_setting( 'single_locations_rating',
            array(
                'default' => $this->defaults['single_locations_rating'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_locations_rating',
            array(
                'label' => __( 'Locations Single Rating', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));
        
        $wp_customize->add_setting( 'show_related_locations',
            array(
                'default' => $this->defaults['show_related_locations'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'show_related_locations',
            array(
                'label' => __( 'Show Related Locations', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
            )
        ));
        
        $wp_customize->add_setting( 'locations_related_title',
            array(
                'default' => $this->defaults['locations_related_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control( 'locations_related_title',
            array(
                'label' => __( 'Related Title', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'type' => 'textarea',
                'active_callback'   => 'rttheme_is_related_locations_enabled',
            )
        );
        
        $wp_customize->add_setting( 'related_locations_number',
            array(
                'default' => $this->defaults['related_locations_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'related_locations_number',
            array(
                'label' => __( 'Team Post', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_locations_enabled',
            )
        );
        
        $wp_customize->add_setting( 'related_locations_title_limit',
            array(
                'default' => $this->defaults['related_locations_title_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'related_locations_title_limit',
            array(
                'label' => __( 'Title Limit', 'tripfery' ),
                'section' => 'rttheme_locations_settings',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_locations_enabled',
            )
        );
    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Locations_Post_Settings();
}
