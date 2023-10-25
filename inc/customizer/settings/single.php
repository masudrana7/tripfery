<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\tripfery\Customizer\Settings;

use radiustheme\tripfery\Customizer\TripferyTheme_Customizer;
use radiustheme\tripfery\Customizer\Controls\Customizer_Heading_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\tripfery\Customizer\Controls\Customizer_Image_Radio_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Blog_Single_Post_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_blog_single_post_controls' ) );
	}

    /**
     * Blog Post Controls
     */
    public function register_blog_single_post_controls( $wp_customize ) {

        /*Scroll post*/
        $wp_customize->add_setting( 'scroll_post_enable',
            array(
                'default' => $this->defaults['scroll_post_enable'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'scroll_post_enable',
            array(
                'label' => __( 'Scroll Post', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));

        $wp_customize->add_setting( 'post_scroll_limit',
            array(
                'default' => $this->defaults['post_scroll_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'post_scroll_limit',
            array(
                'label' => __( 'Scroll Post Limit', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_single_scroll_post_enabled',
            )
        );
		
		// Post Style
        $wp_customize->add_setting( 'post_style',
            array(
                'default' => $this->defaults['post_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );

        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'post_style',
            array(
                'label' => __( 'Single Post Layout', 'tripfery' ),
                'description' => esc_html__( 'Post single layout variation you can selecr and use.', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/post-style-1.png',
                        'name' => __( 'Layout 1', 'tripfery' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/post-style-3.png',
                        'name' => __( 'Layout 2', 'tripfery' )
                    ),
                )
            )
        ) );
		
		
        $wp_customize->add_setting( 'post_featured_image',
            array(
                'default' => $this->defaults['post_featured_image'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_featured_image',
            array(
                'label' => __( 'Show Featured Image', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_author_name',
            array(
                'default' => $this->defaults['post_author_name'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_author_name',
            array(
                'label' => __( 'Show Author Name', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_date',
            array(
                'default' => $this->defaults['post_date'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_date',
            array(
                'label' => __( 'Show Post Date', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_comment_num',
            array(
                'default' => $this->defaults['post_comment_num'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_comment_num',
            array(
                'label' => __( 'Show Comment', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_cats',
            array(
                'default' => $this->defaults['post_cats'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_cats',
            array(
                'label' => __( 'Show Category', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_tags',
            array(
                'default' => $this->defaults['post_tags'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_tags',
            array(
                'label' => __( 'Show Tags', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share',
            array(
                'default' => $this->defaults['post_share'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share',
            array(
                'label' => __( 'Show Share', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_links',
            array(
                'default' => $this->defaults['post_links'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_links',
            array(
                'label' => __( 'Show Next / Previous post', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_author_bio',
            array(
                'default' => $this->defaults['post_author_bio'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_author_bio',
            array(
                'label' => __( 'Show Author Bio', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_view',
            array(
                'default' => $this->defaults['post_view'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_view',
            array(
                'label' => __( 'Show Views', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_length',
            array(
                'default' => $this->defaults['post_length'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_length',
            array(
                'label' => __( 'Post Reading Length', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));

        $wp_customize->add_setting( 'post_published',
            array(
                'default' => $this->defaults['post_published'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_published',
            array(
                'label' => esc_html__( 'Post Published', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));

        $wp_customize->add_setting( 'post_time_format',
            array(
                'default' => $this->defaults['post_time_format'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'post_time_format',
            array(
                'label' => esc_html__( 'Time Tormat', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'type' => 'select',
                'choices' => array(
                    'modern' => esc_html__( 'Modern', 'tripfery' ),
                    'none' => esc_html__( 'None', 'tripfery' ),
                ),
            )
        );
		
		// Related Post
		$wp_customize->add_setting('post_related', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'post_related', array(
            'label' => esc_html__( 'Related Post Settings', 'tripfery' ),
            'section' => 'single_post_secttings_section',
        )));
		
		$wp_customize->add_setting( 'show_related_post',
            array(
                'default' => $this->defaults['show_related_post'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'show_related_post',
            array(
                'label' => esc_html__( 'Show Related Post', 'tripfery' ),
                'section' => 'single_post_secttings_section',
            )
        ));

		$wp_customize->add_setting( 'related_title',
            array(
                'default' => $this->defaults['related_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );
        $wp_customize->add_control( 'related_title',
            array(
                'label' => esc_html__( 'Related Title', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'type' => 'textarea',
                'active_callback'   => 'rttheme_is_related_post_enabled',
            )
        );

		$wp_customize->add_setting( 'show_related_post_number',
            array(
                'default' => $this->defaults['show_related_post_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'show_related_post_number',
            array(
                'label' => __( 'Show Related Post Number', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_post_enabled',
            )
        );

		$wp_customize->add_setting( 'show_related_post_title_limit',
            array(
                'default' => $this->defaults['show_related_post_title_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'show_related_post_title_limit',
            array(
                'label' => __( 'Show Related Post Title Length', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_post_enabled',
            )
        );
		
		// Post Query 
        $wp_customize->add_setting( 'related_post_query',
            array(
                'default' => $this->defaults['related_post_query'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'related_post_query',
            array(
                'label' => __( 'Query Type', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'description' => esc_html__( 'Post Query', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
                    'cat' => esc_html__( 'Posts in the same Categories', 'tripfery' ),
                    'tag' => esc_html__( 'Posts in the same Tags', 'tripfery' ),
                    'author' => esc_html__( 'Posts by the same Author', 'tripfery' ),
                ),
                'active_callback'   => 'rttheme_is_related_post_enabled',
            )
        );
		
		// Display post Order
        $wp_customize->add_setting( 'related_post_sort',
            array(
                'default' => $this->defaults['related_post_sort'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'related_post_sort',
            array(
                'label' => __( 'Sort Order', 'tripfery' ),
                'section' => 'single_post_secttings_section',
                'description' => esc_html__( 'Display post Order', 'tripfery' ),
                'type' => 'select',
                'choices' => array(
                    'recent' => esc_html__( 'Recent Posts', 'tripfery' ),
                    'rand' => esc_html__( 'Random Posts', 'tripfery' ),
                    'modified' => esc_html__( 'Last Modified Posts', 'tripfery' ),
                    'popular' => esc_html__( 'Most Commented posts', 'tripfery' ),
                    'views' => esc_html__( 'Most Viewed posts', 'tripfery' ),
                ),
                'active_callback'   => 'rttheme_is_related_post_enabled',
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Blog_Single_Post_Settings();
}
