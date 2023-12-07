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
class TripferyTheme_Guided_Post_Settings extends TripferyTheme_Customizer
{
    public function __construct()
    {
        parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action('customize_register', array($this, 'register_guided_post_controls'));
    }

    /**
     * Guided Post Controls
     */
    public function register_guided_post_controls($wp_customize)
    {
        // Archive Guided Post
        $wp_customize->add_setting('guided_archive_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'guided_archive_heading', array(
            'label' => __('Archive Guided Option', 'tripfery'),
            'section' => 'rttheme_guided_settings',
        )));

        $wp_customize->add_setting(
            'guided_archive_style',
            array(
                'default' => $this->defaults['guided_archive_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control(new Customizer_Image_Radio_Control(
            $wp_customize,
            'guided_archive_style',
            array(
                'label' => __('Guided Archive Layout', 'tripfery'),
                'description' => esc_html__('Select the gallery layout for gallery page', 'tripfery'),
                'section' => 'rttheme_guided_settings',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit(get_template_directory_uri()) . 'assets/img/blog1.png',
                        'name' => __('Layout 1', 'tripfery')
                    ),
                    'style2' => array(
                        'image' => trailingslashit(get_template_directory_uri()) . 'assets/img/blog3.png',
                        'name' => __('Layout 2', 'tripfery')
                    ),
                )
            )
        ));

        $wp_customize->add_setting(
            'guided_post_number',
            array(
                'default' => $this->defaults['guided_post_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control(
            'guided_post_number',
            array(
                'label' => __('Guided Archive Post Limit', 'tripfery'),
                'section' => 'rttheme_guided_settings',
                'type' => 'number',
            )
        );

        $wp_customize->add_setting(
            'guided_ar_icon',
            array(
                'default' => $this->defaults['guided_ar_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control(new Customizer_Switch_Control(
            $wp_customize,
            'guided_ar_icon',
            array(
                'label' => __('Show Icon', 'tripfery'),
                'section' => 'rttheme_guided_settings',
            )
        ));

        $wp_customize->add_setting(
            'guided_ar_action',
            array(
                'default' => $this->defaults['guided_ar_action'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control(new Customizer_Switch_Control(
            $wp_customize,
            'guided_ar_action',
            array(
                'label' => __('Show Button', 'tripfery'),
                'section' => 'rttheme_guided_settings',
            )
        ));

        $wp_customize->add_setting(
            'guided_ar_excerpt',
            array(
                'default' => $this->defaults['guided_ar_excerpt'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control(new Customizer_Switch_Control(
            $wp_customize,
            'guided_ar_excerpt',
            array(
                'label' => __('Show Excerpt', 'tripfery'),
                'section' => 'rttheme_guided_settings',
            )
        ));

        $wp_customize->add_setting(
            'guided_excerpt_limit',
            array(
                'default' => $this->defaults['guided_excerpt_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control(
            'guided_excerpt_limit',
            array(
                'label' => __('Guided Archive Excerpt Limit', 'tripfery'),
                'section' => 'rttheme_guided_settings',
                'type' => 'number',
            )
        );
    }
}

/**
 * Initialise our Customizer settings only when they're required
 */
if (class_exists('WP_Customize_Control')) {
    new TripferyTheme_Guided_Post_Settings();
}
