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
class TripferyTheme_Blog_Post_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_blog_post_controls' ) );
	}

    /**
     * Blog Post Controls
     */
    public function register_blog_post_controls( $wp_customize ) {

        // Blog Post Style
        $wp_customize->add_setting( 'blog_style',
            array(
                'default' => $this->defaults['blog_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );

        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'blog_style',
            array(
                'label' => __( 'Blog/Archive Layout', 'tripfery' ),
                'description' => esc_html__( 'Blog Post layout variation you can selecr and use.', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog3.png',
                        'name' => __( 'Layout 1', 'tripfery' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog2.png',
                        'name' => __( 'Layout 2', 'tripfery' )
                    ),
                    'style3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.png',
                        'name' => __( 'Layout 3', 'tripfery' )
                    ),
                )
            )
        ) );

        /*Loadmore*/
        $wp_customize->add_setting( 'blog_loadmore',
            array(
                'default' => $this->defaults['blog_loadmore'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_loadmore',
            array(
                'label' => __( 'Blog Pagination', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'pagination' => esc_html__( 'Pagination', 'tripfery' ),
                    'loadmore' => esc_html__( 'Load More', 'tripfery' ),
                ),
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        );

        $wp_customize->add_setting( 'load_more_limit',
            array(
                'default' => $this->defaults['load_more_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'load_more_limit',
            array(
                'label' => __( 'Load More Limit', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'type' => 'number',
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        );

		$wp_customize->add_setting( 'post_content_limit',
            array(
                'default' => $this->defaults['post_content_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'post_content_limit',
            array(
                'label' => __( 'Blog Content Limit', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'blog_content',
            array(
                'default' => $this->defaults['blog_content'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_content',
            array(
                'label' => __( 'Show Content', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        ) );

        $wp_customize->add_setting( 'blog_content3',
            array(
                'default' => $this->defaults['blog_content3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );

        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_content3',
            array(
                'label' => __( 'Show Content', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'active_callback' => 'rttheme_is_blog_style3_enabled',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_date',
            array(
                'default' => $this->defaults['blog_date'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_date',
            array(
                'label' => __( 'Show Date', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_author_name',
            array(
                'default' => $this->defaults['blog_author_name'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_author_name',
            array(
                'label' => __( 'Show Author', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        ) );

        $wp_customize->add_setting( 'blog_author_name3',
            array(
                'default' => $this->defaults['blog_author_name3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_author_name3',
            array(
                'label' => __( 'Show Author', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'active_callback' => 'rttheme_is_blog_style3_enabled',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_comment_num',
            array(
                'default' => $this->defaults['blog_comment_num'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_comment_num',
            array(
                'label' => __( 'Show Comment', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_cats',
            array(
                'default' => $this->defaults['blog_cats'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_cats',
            array(
                'label' => __( 'Show Category', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_view',
            array(
                'default' => $this->defaults['blog_view'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_view',
            array(
                'label' => __( 'Show Views', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_length',
            array(
                'default' => $this->defaults['blog_length'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_length',
            array(
                'label' => __( 'Show Reading Length', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        $wp_customize->add_setting( 'blog_video',
            array(
                'default' => $this->defaults['blog_video'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_video',
            array(
                'label' => __( 'Show Video', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        $wp_customize->add_setting( 'blog_read_more',
            array(
                'default' => $this->defaults['blog_read_more'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_read_more',
            array(
                'label' => __( 'Show Read More', 'tripfery' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        /*Animation*/
        $wp_customize->add_setting( 'blog_animation',
            array(
                'default' => $this->defaults['blog_animation'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_animation',
            array(
                'label' => __( 'Animation On/Off', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'wow' => esc_html__( 'Animation On', 'tripfery' ),
                    'hide' => esc_html__( 'Animation Off', 'tripfery' ),
                ),
            )
        );

        $wp_customize->add_setting( 'blog_animation_effect',
            array(
                'default' => $this->defaults['blog_animation_effect'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_animation_effect',
            array(
                'label' => __( 'Entrance Animation', 'tripfery' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'none' => esc_html__( 'none', 'tripfery' ),
                    'bounce' => esc_html__( 'bounce', 'tripfery' ),
                    'flash' => esc_html__( 'flash', 'tripfery' ),
                    'pulse' => esc_html__( 'pulse', 'tripfery' ),
                    'rubberBand' => esc_html__( 'rubberBand', 'tripfery' ),
                    'shakeX' => esc_html__( 'shakeX', 'tripfery' ),
                    'shakeY' => esc_html__( 'shakeY', 'tripfery' ),
                    'headShake' => esc_html__( 'headShake', 'tripfery' ),
                    'swing' => esc_html__( 'swing', 'tripfery' ),                 
                    'fadeIn' => esc_html__( 'fadeIn', 'tripfery' ),
                    'fadeInDown' => esc_html__( 'fadeInDown', 'tripfery' ),
                    'fadeInLeft' => esc_html__( 'fadeInLeft', 'tripfery' ),
                    'fadeInRight' => esc_html__( 'fadeInRight', 'tripfery' ),
                    'fadeInUp' => esc_html__( 'fadeInUp', 'tripfery' ),                   
                    'bounceIn' => esc_html__( 'bounceIn', 'tripfery' ),
                    'bounceInDown' => esc_html__( 'bounceInDown', 'tripfery' ),
                    'bounceInLeft' => esc_html__( 'bounceInLeft', 'tripfery' ),
                    'bounceInRight' => esc_html__( 'bounceInRight', 'tripfery' ),
                    'bounceInUp' => esc_html__( 'bounceInUp', 'tripfery' ),           
                    'slideInDown' => esc_html__( 'slideInDown', 'tripfery' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'tripfery' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'tripfery' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'tripfery' ), 
                ),
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Blog_Post_Settings();
}
