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
class TripferyTheme_Booking_Post_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_booking_post_controls' ) );
	}

    /**
     * Booking Post Controls
     */
    public function register_booking_post_controls( $wp_customize ) {


        // Archive Booking Post
        $wp_customize->add_setting('booking_archive_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'booking_archive_heading', array(
            'label' => __( 'Booking Archive Option', 'tripfery' ),
            'section' => 'rttheme_booking_settings',
        )));

        $wp_customize->add_setting( 'booking_archive_style',
            array(
                'default' => $this->defaults['booking_archive_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'booking_archive_style',
            array(
                'label' => __( 'Booking Archive Layout', 'tripfery' ),
                'description' => esc_html__( 'Select the gallery layout for gallery page', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
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

        // Booking Archive option
        $wp_customize->add_setting( 'booking_locaton',
            array(
                'default' => $this->defaults['booking_locaton'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'booking_locaton',
            array(
                'label' => __( 'Show Location', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'booking_wishlist',
            array(
                'default' => $this->defaults['booking_wishlist'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'booking_wishlist',
            array(
                'label' => __( 'Show Wishlist', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'booking_rating',
            array(
                'default' => $this->defaults['booking_rating'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'booking_rating',
            array(
                'label' => __( 'Show Rating', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting('booking_btn',
            array(
                'default' => $this->defaults['booking_btn'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control(new Customizer_Switch_Control(
            $wp_customize,
            'booking_btn',
            array(
                'label' => __('Show Button', 'tripfery'),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting(
            'booking_arcive_single_title',
            array(
                'default' => $this->defaults['booking_arcive_single_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control(
            'booking_arcive_single_title',
            array(
                'label' => __('Discover now', 'tripfery'),
                'section' => 'rttheme_booking_settings',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_related_booking_enabled',
            )
        );


        // Single Booking
        $wp_customize->add_setting('booking_related_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'booking_related_heading', array(
            'label' => __( 'Single Booking Option', 'tripfery' ),
            'section' => 'rttheme_booking_settings',
        )));        

        $wp_customize->add_setting( 'single_booking_cat',
            array(
                'default' => $this->defaults['single_booking_cat'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_cat',
            array(
                'label' => __( 'Booking Single Category', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'single_booking_client',
            array(
                'default' => $this->defaults['single_booking_client'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_client',
            array(
                'label' => __( 'Booking Single Client', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'single_booking_startdate',
            array(
                'default' => $this->defaults['single_booking_startdate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_startdate',
            array(
                'label' => __( 'Booking Single Start Date', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'single_booking_enddate',
            array(
                'default' => $this->defaults['single_booking_enddate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_enddate',
            array(
                'label' => __( 'Booking Single End Date', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'single_booking_weblink',
            array(
                'default' => $this->defaults['single_booking_weblink'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_weblink',
            array(
                'label' => __( 'Booking Single WebLink', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));

        $wp_customize->add_setting( 'single_booking_rating',
            array(
                'default' => $this->defaults['single_booking_rating'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_booking_rating',
            array(
                'label' => __( 'Booking Single Rating', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));
        
        $wp_customize->add_setting( 'show_related_booking',
            array(
                'default' => $this->defaults['show_related_booking'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'show_related_booking',
            array(
                'label' => __( 'Show Related Booking', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
            )
        ));
        
        $wp_customize->add_setting( 'booking_related_title',
            array(
                'default' => $this->defaults['booking_related_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control( 'booking_related_title',
            array(
                'label' => __( 'Related Title', 'tripfery' ),
                'section' => 'rttheme_booking_settings',
                'type' => 'textarea',
                'active_callback'   => 'rttheme_is_related_booking_enabled',
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Booking_Post_Settings();
}
