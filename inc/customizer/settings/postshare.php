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

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TripferyTheme_Single_Post_Share_Settings extends TripferyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_single_post_share_controls' ) );
	}

    /**
     * Blog Post Controls
     */
    public function register_single_post_share_controls( $wp_customize ) {
		
        $wp_customize->add_setting( 'post_share_facebook',
            array(
                'default' => $this->defaults['post_share_facebook'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_facebook',
            array(
                'label' => __( 'Show Facebook Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_twitter',
            array(
                'default' => $this->defaults['post_share_twitter'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_twitter',
            array(
                'label' => __( 'Show Twitter Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));

        $wp_customize->add_setting( 'post_share_youtube',
            array(
                'default' => $this->defaults['post_share_youtube'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_youtube',
            array(
                'label' => __( 'Show Youtube Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));		
		
		$wp_customize->add_setting( 'post_share_linkedin',
            array(
                'default' => $this->defaults['post_share_linkedin'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_linkedin',
            array(
                'label' => __( 'Show Linkedin Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_pinterest',
            array(
                'default' => $this->defaults['post_share_pinterest'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_pinterest',
            array(
                'label' => __( 'Show Pinterest Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_whatsapp',
            array(
                'default' => $this->defaults['post_share_whatsapp'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_whatsapp',
            array(
                'label' => __( 'Show Whatsapp Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));

        $wp_customize->add_setting( 'post_share_cloud',
            array(
                'default' => $this->defaults['post_share_cloud'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_cloud',
            array(
                'label' => __( 'Show Cloud Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_dribbble',
            array(
                'default' => $this->defaults['post_share_dribbble'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_dribbble',
            array(
                'label' => __( 'Show Dribbble Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_tumblr',
            array(
                'default' => $this->defaults['post_share_tumblr'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_tumblr',
            array(
                'label' => __( 'Show Tumblr Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_reddit',
            array(
                'default' => $this->defaults['post_share_reddit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_reddit',
            array(
                'label' => __( 'Show Reddit Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_email',
            array(
                'default' => $this->defaults['post_share_email'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_email',
            array(
                'label' => __( 'Show Email Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));
		
		$wp_customize->add_setting( 'post_share_print',
            array(
                'default' => $this->defaults['post_share_print'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_share_print',
            array(
                'label' => __( 'Show Print Share Button', 'tripfery' ),
                'section' => 'single_post_share_section',
            )
        ));

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TripferyTheme_Single_Post_Share_Settings();
}
