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
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Footer_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_footer_controls' ) );
	}

    public function register_footer_controls( $wp_customize ) {
		
		// Footer off & on
		$wp_customize->add_setting( 'footer_area',
            array(
                'default' => $this->defaults['footer_area'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'footer_area',
            array(
                'label' => __( 'Footer Top', 'tripfery' ),
                'section' => 'footer_section',
            )
        ) );
        $wp_customize->add_setting( 'copyright_area',
            array(
                'default' => $this->defaults['copyright_area'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'copyright_area',
            array(
                'label' => __( 'Footer Copyright', 'tripfery' ),
                'section' => 'footer_section',
            )
        ) );
		
        // Footer Style
        $wp_customize->add_setting( 'footer_style',
            array(
                'default' => $this->defaults['footer_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );

        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'footer_style',
            array(
                'label' => __( 'Footer Layout', 'tripfery' ),
                'description' => esc_html__( 'You can set default footer form here.', 'tripfery' ),
                'section' => 'footer_section',
                'choices' => array(
                    '1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-1.jpg',
                        'name' => __( 'Layout 1', 'tripfery' )
                    ),                  
                    '2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-2.jpg',
                        'name' => __( 'Layout 2', 'tripfery' )
                    ),
                    '3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-3.jpg',
                        'name' => __( 'Layout 3', 'tripfery' )
                    ),
                )
            )
        ) );
		// Footer 1 column
		$wp_customize->add_setting( 'footer_column_1',
            array(
                'default' => $this->defaults['footer_column_1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );
        $wp_customize->add_control( 'footer_column_1',
            array(
                'label' => __( 'Number of Columns for Footer', 'tripfery' ),
                'section' => 'footer_section',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'tripfery' ),
                    '2' => esc_html__( '2 Columns', 'tripfery' ),
                    '3' => esc_html__( '3 Columns', 'tripfery' ),
                    '4' => esc_html__( '4 Columns', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );

        // Footer 2 column
        $wp_customize->add_setting( 'footer_column_2',
            array(
                'default' => $this->defaults['footer_column_2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );
        $wp_customize->add_control( 'footer_column_2',
            array(
                'label' => __( 'Number of Columns for Footer', 'tripfery' ),
                'section' => 'footer_section',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'tripfery' ),
                    '2' => esc_html__( '2 Columns', 'tripfery' ),
                    '3' => esc_html__( '3 Columns', 'tripfery' ),
                    '4' => esc_html__( '4 Columns', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );

        // Footer 3 column
        $wp_customize->add_setting( 'footer_column_3',
            array(
                'default' => $this->defaults['footer_column_3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_column_3',
            array(
                'label' => __( 'Number of Columns for Footer', 'tripfery' ),
                'section' => 'footer_section',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'tripfery' ),
                    '2' => esc_html__( '2 Columns', 'tripfery' ),
                    '3' => esc_html__( '3 Columns', 'tripfery' ),
                    '4' => esc_html__( '4 Columns', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        );        
		
		// Footer 1 bgtype
		$wp_customize->add_setting( 'footer_bgtype',
            array(
                'default' => $this->defaults['footer_bgtype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_bgtype',
            array(
                'label' => __( 'Background Type', 'tripfery' ),
                'section' => 'footer_section',
                'description' => esc_html__( 'This is banner background type.', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
					'fbgcolor' => esc_html__( 'BG Color', 'tripfery' ),
                    'fbgimg' => esc_html__( 'BG Image', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );

        // Footer 1 background color
        $wp_customize->add_setting('fbgcolor', 
            array(
                'default' => $this->defaults['fbgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor',
            array(
                'label' => esc_html__('Background Color', 'tripfery'),
                'settings' => 'fbgcolor', 
                'section' => 'footer_section', 
                'active_callback' => 'rttheme_footer1_bgcolor_type_condition',
            )
        ));
        // Footer 1 background image
        $wp_customize->add_setting( 'fbgimg',
            array(
                'default' => $this->defaults['fbgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg',
            array(
                'label' => __( 'Background Image', 'tripfery' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'tripfery' ),
                'section' => 'footer_section',
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
                'active_callback' => 'rttheme_footer1_bgimg_type_condition',
            )
        ) );

        // Footer 2 bgtype
        $wp_customize->add_setting( 'footer_bgtype2',
            array(
                'default' => $this->defaults['footer_bgtype2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_bgtype2',
            array(
                'label' => __( 'Background Type', 'tripfery' ),
                'section' => 'footer_section',
                'description' => esc_html__( 'This is banner background type.', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
                    'fbgcolor2' => esc_html__( 'BG Color', 'tripfery' ),
                    'fbgimg2' => esc_html__( 'BG Image', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );		
        // Footer 2 background color
        $wp_customize->add_setting('fbgcolor2', 
            array(
                'default' => $this->defaults['fbgcolor2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor2',
            array(
                'label' => esc_html__('Background Color', 'tripfery'),
                'settings' => 'fbgcolor2', 
                'section' => 'footer_section', 
                'active_callback' => 'rttheme_footer2_bgcolor_type_condition',
            )
        ));		

        // Footer 2 background image
        $wp_customize->add_setting( 'fbgimg2',
            array(
                'default' => $this->defaults['fbgimg2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg2',
            array(
                'label' => __( 'Background Image', 'tripfery' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'tripfery' ),
                'section' => 'footer_section',
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
                'active_callback' => 'rttheme_footer2_bgimg_type_condition',
            )
        ) );

        // Footer 3 bgtype
        $wp_customize->add_setting( 'footer_bgtype3',
            array(
                'default' => $this->defaults['footer_bgtype3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_bgtype3',
            array(
                'label' => __( 'Background Type', 'tripfery' ),
                'section' => 'footer_section',
                'description' => esc_html__( 'This is banner background type.', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
                    'fbgcolor3' => esc_html__( 'BG Color', 'tripfery' ),
                    'fbgimg3' => esc_html__( 'BG Image', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        );      
        // Footer 2 background color
        $wp_customize->add_setting('fbgcolor3', 
            array(
                'default' => $this->defaults['fbgcolor3'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor3',
            array(
                'label' => esc_html__('Background Color', 'tripfery'),
                'settings' => 'fbgcolor3', 
                'section' => 'footer_section', 
                'active_callback' => 'rttheme_footer3_bgcolor_type_condition',
            )
        ));     

        // Footer 2 background image
        $wp_customize->add_setting( 'fbgimg3',
            array(
                'default' => $this->defaults['fbgimg3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg3',
            array(
                'label' => __( 'Background Image', 'tripfery' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'tripfery' ),
                'section' => 'footer_section',
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
                'active_callback' => 'rttheme_footer3_bgimg_type_condition',
            )
        ) );

        /*Footer 1, 2 and 3 Color*/ 
		$wp_customize->add_setting('footer_title_color', 
            array(
                'default' => $this->defaults['footer_title_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color',
            array(
                'label' => esc_html__('Footer Title Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));
		
		$wp_customize->add_setting('footer_color', 
            array(
                'default' => $this->defaults['footer_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color',
            array(
                'label' => esc_html__('Footer Text Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));
		
		$wp_customize->add_setting('footer_link_color', 
            array(
                'default' => $this->defaults['footer_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color',
            array(
                'label' => esc_html__('Footer Link Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));
		
		$wp_customize->add_setting('footer_link_hover_color', 
            array(
                'default' => $this->defaults['footer_link_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_hover_color',
            array(
                'label' => esc_html__('Footer Link Hover Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));
        // Footer 2 copyright bg color
        $wp_customize->add_setting('copyright_text_color', 
            array(
                'default' => $this->defaults['copyright_text_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color',
            array(
                'label' => esc_html__('Copyright Text Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));

        $wp_customize->add_setting('copyright_link_color', 
            array(
                'default' => $this->defaults['copyright_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_color',
            array(
                'label' => esc_html__('Copyright Link Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        )); 

        $wp_customize->add_setting('copyright_hover_color', 
            array(
                'default' => $this->defaults['copyright_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_hover_color',
            array(
                'label' => esc_html__('Copyright Hover Color', 'tripfery'),
                'section' => 'footer_section', 
            )
        ));

        /* = Footer Copyright
        ======================================================*/
        $wp_customize->add_setting('copyright_bg_color', 
            array(
                'default' => $this->defaults['copyright_bg_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color',
            array(
                'label' => esc_html__('Copyright Background Color', 'tripfery'),
                'section' => 'footer_section', 
                'active_callback' => 'rttheme_is_copyright_bg_color_enabled',
            )
        ));
		
		// Copyright Text
        $wp_customize->add_setting( 'copyright_text',
            array(
                'default' => $this->defaults['copyright_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control( 'copyright_text',
            array(
                'label' => __( 'Copyright Text', 'tripfery' ),
                'section' => 'footer_section',
                'type' => 'textarea',
            )
        );

        $wp_customize->add_setting( 'copyright_menu',
            array(
                'default' => $this->defaults['copyright_menu'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'copyright_menu',
            array(
                'label' => __( 'Copyright Menu Display', 'tripfery' ),
                'section' => 'footer_section',
            )
        ) );

        $wp_customize->add_setting( 'logo_display',
            array(
                'default' => $this->defaults['logo_display'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'logo_display',
            array(
                'label' => __( 'Footer Logo Display', 'tripfery' ),
                'section' => 'footer_section',
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        ) );
        
        /*footer 2 logo*/
        $wp_customize->add_setting('footer_logo2',
            array(
              'default'           => $this->defaults['footer_logo2'],
              'transport'         => 'refresh',
              'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo2',
            array(
                'label'         => esc_html__('Footer Logo', 'tripfery'),
                'description'   => esc_html__('This is the description for the Media Control', 'tripfery'),
                'section'       => 'footer_section',
                'mime_type'     => 'image',
                'button_labels' => array(
                    'select'       => esc_html__('Select File', 'tripfery'),
                    'change'       => esc_html__('Change File', 'tripfery'),
                    'default'      => esc_html__('Default', 'tripfery'),
                    'remove'       => esc_html__('Remove', 'tripfery'),
                    'placeholder'  => esc_html__('No file selected', 'tripfery'),
                    'frame_title'  => esc_html__('Select File', 'tripfery'),
                    'frame_button' => esc_html__('Choose File', 'tripfery'),
                ),
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        ));        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Footer_Settings();
}
