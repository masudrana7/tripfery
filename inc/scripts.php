<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Plugin; 
use Rtrs\Models\Review; 

function tripfery_get_maybe_rtl( $filename ){
	$file = get_template_directory_uri() . '/assets/';
	if ( is_rtl() ) {
		return $file . 'rtl-css/' . $filename;
	}
	else {
		return $file . 'css/' . $filename;
	}
}
add_action( 'wp_enqueue_scripts','tripfery_enqueue_high_priority_scripts', 1500 );
function tripfery_enqueue_high_priority_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'rtlcss', FAKTORIE_ASSETS_URL . 'css/rtl.css', array(), FAKTORIE_VERSION );
	}
}
//elementor animation dequeue
add_action('elementor/frontend/after_enqueue_scripts', function(){
    wp_deregister_style( 'e-animations' );
    wp_dequeue_style( 'e-animations' );
});

add_action( 'wp_enqueue_scripts', 'tripfery_register_scripts', 12 );
if ( !function_exists( 'tripfery_register_scripts' ) ) {
	function tripfery_register_scripts(){
		wp_deregister_style( 'font-awesome' );
        wp_deregister_style( 'layerslider-font-awesome' );
        wp_deregister_style( 'yith-wcwl-font-awesome' );

		/*CSS*/
		// animate CSS	
		wp_register_style( 'magnific-popup',     tripfery_get_maybe_rtl('magnific-popup.css'), array(), FAKTORIE_VERSION );		
		wp_register_style( 'animate',        	 tripfery_get_maybe_rtl('animate.min.css'), array(), FAKTORIE_VERSION );

		/*JS*/
		// magnific popup
		wp_register_script( 'magnific-popup',    FAKTORIE_ASSETS_URL . 'js/jquery.magnific-popup.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );

		// theia sticky
		wp_register_script( 'theia-sticky',    	 FAKTORIE_ASSETS_URL . 'js/theia-sticky-sidebar.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );
		
		// parallax scroll js
		wp_register_script( 'rt-parallax',   	 FAKTORIE_ASSETS_URL . 'js/rt-parallax.js', array( 'jquery' ), FAKTORIE_VERSION, true );
		
		// wow js
		wp_register_script( 'rt-wow',   		 FAKTORIE_ASSETS_URL . 'js/wow.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );

		// isotope js
		wp_register_script( 'isotope-pkgd',      FAKTORIE_ASSETS_URL . 'js/isotope.pkgd.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );		
		wp_register_script( 'swiper-min',        FAKTORIE_ASSETS_URL . 'js/swiper.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );

		// counterup js
		wp_register_script( 'waypoints',        FAKTORIE_ASSETS_URL . 'js/waypoints.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );
		wp_register_script( 'counterup',        FAKTORIE_ASSETS_URL . 'js/jquery.counterup.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );
		
	}
}

add_action( 'wp_enqueue_scripts', 'tripfery_enqueue_scripts', 15 );
if ( !function_exists( 'tripfery_enqueue_scripts' ) ) {
	function tripfery_enqueue_scripts() {
		$dep = array( 'jquery' );
		/*CSS*/
		// Google fonts
		wp_enqueue_style( 'tripfery-gfonts', 	TripferyTheme_Helper::fonts_url(), array(), FAKTORIE_VERSION );
		// Bootstrap CSS  //@rtl
		wp_enqueue_style( 'bootstrap', 				tripfery_get_maybe_rtl('bootstrap.min.css'), array(), FAKTORIE_VERSION );
		
		// Flaticon CSS
		wp_enqueue_style( 'flaticon-tripfery',    FAKTORIE_ASSETS_URL . 'fonts/flaticon-tripfery/flaticon.css', array(), FAKTORIE_VERSION );
		
		elementor_scripts();
		//Video popup
		wp_enqueue_style( 'magnific-popup' );
		// font-awesome CSS
		wp_enqueue_style( 'font-awesome',       	FAKTORIE_ASSETS_URL . 'css/font-awesome.min.css', array(), FAKTORIE_VERSION );
		// animate CSS
		wp_enqueue_style( 'animate',            	tripfery_get_maybe_rtl('animate.min.css'), array(), FAKTORIE_VERSION );
		// main CSS // @rtl
		wp_enqueue_style( 'tripfery-default',    	tripfery_get_maybe_rtl('default.css'), array(), FAKTORIE_VERSION );
		// vc modules css
		wp_enqueue_style( 'tripfery-elementor',   tripfery_get_maybe_rtl('elementor.css'), array(), FAKTORIE_VERSION );
			
		// Style CSS
		wp_enqueue_style( 'tripfery-style',     	tripfery_get_maybe_rtl('style.css'), array(), FAKTORIE_VERSION );
		
		// Template Style
		wp_add_inline_style( 'tripfery-style',   	tripfery_template_style() );

		/*JS*/
		// bootstrap js
		wp_enqueue_script( 'bootstrap',         	FAKTORIE_ASSETS_URL . 'js/bootstrap.min.js', array( 'jquery' ), FAKTORIE_VERSION, true );
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'theia-sticky' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'rt-parallax' );
		wp_enqueue_script( 'isotope-pkgd' );
		wp_enqueue_script( 'swiper-min' );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'tripfery-main',    	FAKTORIE_ASSETS_URL . 'js/main.js', $dep , FAKTORIE_VERSION, true );
		
		// localize script
		$tripfery_localize_data = array(
			'stickyMenu' 	=> TripferyTheme::$options['sticky_menu'],
			'siteLogo'   	=> '<a href="' . esc_url( home_url( '/' ) ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '">' . '</a>',
			'extraOffset' => TripferyTheme::$options['sticky_menu'] ? 70 : 0,
			'extraOffsetMobile' => TripferyTheme::$options['sticky_menu'] ? 52 : 0,
			'rtl' => is_rtl()?'rtl':'ltr',
			
			// Ajax
			'ajaxURL' => admin_url('admin-ajax.php'),
			'post_scroll_limit' => TripferyTheme::$options['post_scroll_limit'],
			'nonce' => wp_create_nonce( 'tripfery-nonce' )
		);
		wp_localize_script( 'tripfery-main', 'tripferyObj', $tripfery_localize_data );
	}	
}

function elementor_scripts() {
	
	if ( !did_action( 'elementor/loaded' ) ) {
		return;
	}
	
	if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		// do stuff for preview		
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'counterup' );
		wp_enqueue_script( 'waypoints' );
	} 

	/*review rating*/
	if( class_exists( Review::class )){
		wp_enqueue_style( 'rtrs-app' );
		return true;
	}
	return false;

}

add_action( 'wp_enqueue_scripts', 'tripfery_high_priority_scripts', 1500 );
if ( !function_exists( 'tripfery_high_priority_scripts' ) ) {
	function tripfery_high_priority_scripts() {
		// Dynamic style
		TripferyTheme_Helper::dynamic_internal_style();
	}
}

function tripfery_template_style(){
	
	ob_start();
	?>
	
	.entry-banner {
		<?php if ( TripferyTheme::$bgtype == 'bgcolor' ): ?>
			<?php if( !empty( TripferyTheme::$bgcolor ) ) { ?>
				background-color: <?php echo TripferyTheme::$bgcolor; ?>;
			<?php } ?>
		<?php else: ?>
			background: url(<?php echo esc_url( TripferyTheme::$bgimg );?>) no-repeat scroll center center / cover;
		<?php endif; ?>
	}

	.content-area {
		padding-top: <?php echo esc_html( TripferyTheme::$padding_top );?>px; 
		padding-bottom: <?php echo esc_html( TripferyTheme::$padding_bottom );?>px;
	}

	<?php if( isset( TripferyTheme::$pagebgcolor ) || isset( TripferyTheme::$pagebgimg ) ) { ?>
	#page .content-area {
		background-image: url( <?php echo TripferyTheme::$pagebgimg; ?> );
		<?php if( !empty( TripferyTheme::$pagebgcolor ) ) { ?>
		background-color: <?php echo TripferyTheme::$pagebgcolor; ?>;
		<?php } ?>
	}
	<?php } ?>	
	
	<?php
	return ob_get_clean();
}

function load_custom_wp_admin_script_gutenberg() {
	wp_enqueue_style( 'tripfery-gfonts', TripferyTheme_Helper::fonts_url(), array(), FAKTORIE_VERSION );
	// font-awesome CSS
	wp_enqueue_style( 'font-awesome',       FAKTORIE_ASSETS_URL . 'css/font-awesome.min.css', array(), FAKTORIE_VERSION );
	// Flaticon CSS
	wp_enqueue_style( 'flaticon-tripfery',    FAKTORIE_ASSETS_URL . 'fonts/flaticon-tripfery/flaticon.css', array(), FAKTORIE_VERSION );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script_gutenberg', 1 );

function load_custom_wp_admin_script() {
	wp_enqueue_style( 'tripfery-admin-style',  FAKTORIE_ASSETS_URL . 'css/admin-style.css', false, FAKTORIE_VERSION );
	wp_enqueue_script( 'tripfery-admin-main',  FAKTORIE_ASSETS_URL . 'js/admin.main.js', false, FAKTORIE_VERSION, true );
	
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );

/*Topbar menu function*/
if ( !function_exists( 'tripfery_top_menu' ) ) {
	function tripfery_top_menu() {
	    $menus = wp_get_nav_menus();
	    if(!empty($menus)){
	      	$menu_links = array();
	      	foreach ($menus as $key => $value) {
	        	$menu_links[$value->slug] = $value->name;  
	      	}
	      	return $menu_links;
	    }
	}
}
