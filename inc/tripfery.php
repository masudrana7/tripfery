<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( !class_exists( 'TripferyTheme' ) ) {

	class TripferyTheme {

		protected static $instance = null;

		// Sitewide static variables
		public static $options = null;
		public static $team_social_fields = null;

		// Template specific variables
		public static $sticky_menu = null;
		public static $layout = null;
		public static $sidebar = null;
		public static $tr_header = null;
		public static $top_bar = null;
		public static $header_opt = null;
		public static $headerbg_color = null;
		public static $footer_area = null;
		public static $footer_area2 = null;
		public static $copyright_area = null;
		public static $copyright_area2 = null;
		public static $top_bar_style = null;
		public static $header_style = null;
		public static $booking_style = null;
		public static $footer_style = null;
		public static $padding_top = null;
		public static $padding_bottom = null;
		public static $has_banner = null;
		public static $has_breadcrumb = null;
		public static $bgtype = null;
		public static $bgimg = null;
		public static $bgcolor = null;
		public static $pagebgimg = null;
		public static $pagebgcolor = null;
		public static $footer_top_widget = null;

		private function __construct() {

			add_action( 'after_setup_theme', array( $this, 'set_options' ) );
			add_action('customize_preview_init', array($this, 'set_options'));
			
		}

		public static function instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/*customizer set option*/
		public function set_options() {
            $defaults  = rttheme_generate_defaults();
            $newData = [];
            foreach ($defaults as $key => $dValue) {
                $value = get_theme_mod($key, $defaults[$key]);
                $newData[$key] = $value;
            }
            self::$options  = $newData;
        }
	}
}

TripferyTheme::instance();

// Remove Redux NewsFlash
if ( ! class_exists( 'reduxNewsflash' ) ){
	class reduxNewsflash {
		public function __construct( $parent, $params ) {}
	}
}