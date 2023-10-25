<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\tripfery\Customizer\Settings;

use radiustheme\tripfery\Customizer\TripferyTheme_Customizer;
use radiustheme\tripfery\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Locations_Single_Layout_Settings extends TripferyTheme_Customizer {

	public function __construct() {
        parent::instance();
        $this->populated_default_data();
        // Register Page Controls
        add_action( 'customize_register', array( $this, 'register_locations_single_layout_controls' ) );
	}

    public function register_locations_single_layout_controls( $wp_customize ) {

        $wp_customize->add_setting( 'locations_layout',
            array(
                'default' => $this->defaults['locations_layout'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'locations_layout',
            array(
                'label' => __( 'Sidebar Layout', 'tripfery' ),
                'description' => esc_html__( 'Select the default template layout for Pages', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'choices' => array(
                    'left-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-left.png',
                        'name' => __( 'Left Sidebar', 'tripfery' )
                    ),
                    'full-width' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-full.png',
                        'name' => __( 'Full Width', 'tripfery' )
                    ),
                    'right-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-right.png',
                        'name' => __( 'Right Sidebar', 'tripfery' )
                    )
                )
            )
        ) );

        /**
         * Separator
         */
        $wp_customize->add_setting('separator_page', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Separator_Control($wp_customize, 'separator_page', array(
            'settings' => 'separator_page',
            'section' => 'locations_single_layout_section',
        )));
		
		// Content padding top
        $wp_customize->add_setting( 'locations_padding_top',
            array(
                'default' => $this->defaults['locations_padding_top'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'locations_padding_top',
            array(
                'label' => __( 'Content Padding Top', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'type' => 'number',
            )
        );
        // Content padding bottom
        $wp_customize->add_setting( 'locations_padding_bottom',
            array(
                'default' => $this->defaults['locations_padding_bottom'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'locations_padding_bottom',
            array(
                'label' => __( 'Content Padding Bottom', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'type' => 'number',
            )
        );
		
		$wp_customize->add_setting( 'locations_banner',
            array(
                'default' => $this->defaults['locations_banner'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'locations_banner',
            array(
                'label' => __( 'Banner', 'tripfery' ),
                'section' => 'locations_single_layout_section',
            )
        ) );
		
		$wp_customize->add_setting( 'locations_breadcrumb',
            array(
                'default' => $this->defaults['locations_breadcrumb'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'locations_breadcrumb',
            array(
                'label' => __( 'Breadcrumb', 'tripfery' ),
                'section' => 'locations_single_layout_section',
            )
        ) );
		
        // Banner BG Type 
        $wp_customize->add_setting( 'locations_bgtype',
            array(
                'default' => $this->defaults['locations_bgtype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'locations_bgtype',
            array(
                'label' => __( 'Banner Background Type', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'description' => esc_html__( 'This is banner background type.', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
                    'bgimg' => esc_html__( 'BG Image', 'tripfery' ),
                    'bgcolor' => esc_html__( 'BG Color', 'tripfery' ),
                ),
            )
        );

        $wp_customize->add_setting( 'locations_bgimg',
            array(
                'default' => $this->defaults['locations_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'locations_bgimg',
            array(
                'label' => __( 'Banner Background Image', 'tripfery' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'tripfery' ),
                    'change' => __( 'Change File', 'tripfery' ),
                    'default' => __( 'Default', 'tripfery' ),
                    'remove' => __( 'Remove', 'tripfery' ),
                    'placeholder' => __( 'No file selected', 'tripfery' ),
                    'frame_title' => __( 'Select File', 'tripfery' ),
                    'frame_button' => __( 'Choose File', 'tripfery' ),
                ),
            )
        ) );

        // Banner background color
        $wp_customize->add_setting('locations_bgcolor', 
            array(
                'default' => $this->defaults['locations_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'locations_bgcolor',
            array(
                'label' => esc_html__('Banner Background Color', 'tripfery'),
                'settings' => 'locations_bgcolor', 
                'priority' => 10, 
                'section' => 'locations_single_layout_section', 
            )
        ));
		
		// Page background image
		$wp_customize->add_setting( 'locations_page_bgimg',
            array(
                'default' => $this->defaults['locations_page_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'locations_page_bgimg',
            array(
                'label' => __( 'Page / Post Background Image', 'tripfery' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'tripfery' ),
                'section' => 'locations_single_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'tripfery' ),
                    'change' => __( 'Change File', 'tripfery' ),
                    'default' => __( 'Default', 'tripfery' ),
                    'remove' => __( 'Remove', 'tripfery' ),
                    'placeholder' => __( 'No file selected', 'tripfery' ),
                    'frame_title' => __( 'Select File', 'tripfery' ),
                    'frame_button' => __( 'Choose File', 'tripfery' ),
                ),
            )
        ) );
		
		$wp_customize->add_setting('locations_page_bgcolor', 
            array(
                'default' => $this->defaults['locations_page_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'locations_page_bgcolor',
            array(
                'label' => esc_html__('Page / Post Background Color', 'tripfery'),
                'settings' => 'locations_page_bgcolor', 
                'section' => 'locations_single_layout_section', 
            )
        ));
        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Locations_Single_Layout_Settings();
}
