<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Rtcl\Helpers\Functions;

add_action( 'template_redirect', 'tripfery_template_vars' );
if( !function_exists( 'tripfery_template_vars' ) ) {
    function tripfery_template_vars() {
        // Single Pages
        if( is_single() || is_page() ) {
            $post_type = get_post_type();
            $post_id   = get_the_id();
            switch( $post_type ) {
                case 'page':
                $prefix = 'page';
                break;
                case 'product':
                $prefix = 'product';
                break;
                default:
                $prefix = 'single_post';
                break;              
                case 'tripfery_team':
                $prefix = 'team';
                break;
                case 'tripfery_guided':
                $prefix = 'guided';
                break;        
                case 'to_book':
                $prefix = 'booking';
                break; 
            }
			
			$layout_settings    = get_post_meta( $post_id, 'tripfery_layout_settings', true );
            $tripfery_booking_style = get_post_meta(get_the_ID(), 'tripfery_booking_style', true);
            
            TripferyTheme::$layout = ( empty( $layout_settings['tripfery_layout'] ) || $layout_settings['tripfery_layout']  == 'default' ) ? TripferyTheme::$options[$prefix . '_layout'] : $layout_settings['tripfery_layout'];

            TripferyTheme::$sidebar = ( empty( $layout_settings['tripfery_sidebar'] ) || $layout_settings['tripfery_sidebar'] == 'default' ) ? TripferyTheme::$options[$prefix . '_sidebar'] : $layout_settings['tripfery_sidebar'];

            TripferyTheme::$top_bar = ( empty( $layout_settings['tripfery_top_bar'] ) || $layout_settings['tripfery_top_bar'] == 'default' ) ? TripferyTheme::$options['top_bar'] : $layout_settings['tripfery_top_bar'];
            
            TripferyTheme::$top_bar_style = ( empty( $layout_settings['tripfery_top_bar_style'] ) || $layout_settings['tripfery_top_bar_style'] == 'default' ) ? TripferyTheme::$options['top_bar_style'] : $layout_settings['tripfery_top_bar_style'];

            TripferyTheme::$headerbg_color = (empty($layout_settings['tripfery_header_bgcolor']) || $layout_settings['tripfery_header_bgcolor'] == 'default') ? TripferyTheme::$options['header_bg_color'] : $layout_settings['tripfery_header_bgcolor'];
			
			TripferyTheme::$header_opt = ( empty( $layout_settings['tripfery_header_opt'] ) || $layout_settings['tripfery_header_opt'] == 'default' ) ? TripferyTheme::$options['header_opt'] : $layout_settings['tripfery_header_opt'];

            TripferyTheme::$tr_header = ( empty( $layout_settings['tripfery_tr_header'] ) || $layout_settings['tripfery_tr_header'] == 'default' ) ? TripferyTheme::$options['tr_header'] : $layout_settings['tripfery_tr_header'];
            
            TripferyTheme::$header_style = ( empty( $layout_settings['tripfery_header'] ) || $layout_settings['tripfery_header'] == 'default' ) ? TripferyTheme::$options['header_style'] : $layout_settings['tripfery_header'];
			
            TripferyTheme::$footer_style = ( empty( $layout_settings['tripfery_footer'] ) || $layout_settings['tripfery_footer'] == 'default' ) ? TripferyTheme::$options['footer_style'] : $layout_settings['tripfery_footer'];
			
			TripferyTheme::$footer_area = ( empty( $layout_settings['tripfery_footer_area'] ) || $layout_settings['tripfery_footer_area'] == 'default' ) ? TripferyTheme::$options['footer_area'] : $layout_settings['tripfery_footer_area'];

            TripferyTheme::$booking_style = (empty($tripfery_booking_style) || $tripfery_booking_style == 'default') ? TripferyTheme::$options['booking_style'] : $tripfery_booking_style;

            TripferyTheme::$copyright_area = ( empty( $layout_settings['tripfery_copyright_area'] ) || $layout_settings['tripfery_copyright_area'] == 'default' ) ? TripferyTheme::$options['copyright_area'] : $layout_settings['tripfery_copyright_area'];
			
            $padding_top = ( empty( $layout_settings['tripfery_top_padding'] ) || $layout_settings['tripfery_top_padding'] == 'default' ) ? TripferyTheme::$options[$prefix . '_padding_top'] : $layout_settings['tripfery_top_padding'];
			
            TripferyTheme::$padding_top = (int) $padding_top;
            $padding_bottom = ( empty( $layout_settings['tripfery_bottom_padding'] ) || $layout_settings['tripfery_bottom_padding'] == 'default' ) ? TripferyTheme::$options[$prefix . '_padding_bottom'] : $layout_settings['tripfery_bottom_padding'];
			
            TripferyTheme::$padding_bottom = (int) $padding_bottom;

            TripferyTheme::$has_banner = ( empty( $layout_settings['tripfery_banner'] ) || $layout_settings['tripfery_banner'] == 'default' ) ? TripferyTheme::$options[$prefix . '_banner'] : $layout_settings['tripfery_banner'];
            
            TripferyTheme::$has_breadcrumb = ( empty( $layout_settings['tripfery_breadcrumb'] ) || $layout_settings['tripfery_breadcrumb'] == 'default' ) ? TripferyTheme::$options[ $prefix . '_breadcrumb'] : $layout_settings['tripfery_breadcrumb'];
            
            TripferyTheme::$bgtype = ( empty( $layout_settings['tripfery_banner_type'] ) || $layout_settings['tripfery_banner_type'] == 'default' ) ? TripferyTheme::$options[$prefix . '_bgtype'] : $layout_settings['tripfery_banner_type'];
            
            TripferyTheme::$bgcolor = empty( $layout_settings['tripfery_banner_bgcolor'] ) ? TripferyTheme::$options[$prefix . '_bgcolor'] : $layout_settings['tripfery_banner_bgcolor'];
			
			if( !empty( $layout_settings['tripfery_banner_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['tripfery_banner_bgimg'], 'full', true );
                TripferyTheme::$bgimg = $attch_url[0];
            } elseif( !empty( TripferyTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TripferyTheme::$options[$prefix . '_bgimg'], 'full', true );
                TripferyTheme::$bgimg = $attch_url[0];
            } else {
                TripferyTheme::$bgimg = TRIPFERY_ASSETS_URL . 'img/banner.jpg';
            }
            TripferyTheme::$pagebgcolor = empty( $layout_settings['tripfery_page_bgcolor'] ) ? TripferyTheme::$options[$prefix . '_page_bgcolor'] : $layout_settings['tripfery_page_bgcolor'];			
            
            if( !empty( $layout_settings['tripfery_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['tripfery_page_bgimg'], 'full', true );
                TripferyTheme::$pagebgimg = $attch_url[0];
            } elseif( !empty( TripferyTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TripferyTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                TripferyTheme::$pagebgimg = $attch_url[0];
            }
        }
        
        // Blog and Archive
        elseif( is_home() || is_archive() || is_search() || is_404() ) {
            if( is_search() ) {
                $prefix = 'search';
            } else if( is_404() ) {
                $prefix                                = 'error';
                TripferyTheme::$options[$prefix . '_layout'] = 'full-width';
            } elseif( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
                $prefix = 'shop';
            } elseif( is_post_type_archive( "tripfery_team" ) || is_tax( "tripfery_team_category" ) ) {
                $prefix = 'team_archive'; 
            } elseif( is_post_type_archive( "tripfery_guided" ) || is_tax("tripfery_guided_category" ) ) {
                $prefix = 'guided_archive';            
            } elseif( is_post_type_archive("to_book" ) || is_tax("categories" ) ) {
                $prefix = 'booking_archive'; 
            } else {
                $prefix = 'blog';
            }
            
            TripferyTheme::$layout         		= TripferyTheme::$options[$prefix . '_layout'];
            TripferyTheme::$top_bar        		= TripferyTheme::$options['top_bar'];
            TripferyTheme::$header_opt      	= TripferyTheme::$options['header_opt'];
            TripferyTheme::$headerbg_color      = TripferyTheme::$options['header_bg_color'];
            TripferyTheme::$tr_header           = TripferyTheme::$options['tr_header'];
            TripferyTheme::$footer_area     	= TripferyTheme::$options['footer_area'];
            TripferyTheme::$copyright_area      = TripferyTheme::$options['copyright_area'];
            TripferyTheme::$top_bar_style  		= TripferyTheme::$options['top_bar_style'];
            TripferyTheme::$header_style   		= TripferyTheme::$options['header_style'];
            TripferyTheme::$footer_style   		= TripferyTheme::$options['footer_style'];
            TripferyTheme::$booking_style   	= TripferyTheme::$options['booking_style'];
            TripferyTheme::$padding_top    		= TripferyTheme::$options[$prefix . '_padding_top'];
            TripferyTheme::$padding_bottom 		= TripferyTheme::$options[$prefix . '_padding_bottom'];
            TripferyTheme::$has_banner     		= TripferyTheme::$options[$prefix . '_banner'];
            TripferyTheme::$has_breadcrumb 		= TripferyTheme::$options[$prefix . '_breadcrumb'];
            TripferyTheme::$bgtype         		= TripferyTheme::$options[$prefix . '_bgtype'];
            TripferyTheme::$bgcolor        		= TripferyTheme::$options[$prefix . '_bgcolor'];
			
            if( !empty( TripferyTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TripferyTheme::$options[$prefix . '_bgimg'], 'full', true );
                TripferyTheme::$bgimg = $attch_url[0];
            } else {
                TripferyTheme::$bgimg = TRIPFERY_ASSETS_URL . 'img/banner.jpg';
            }
			
            TripferyTheme::$pagebgcolor = TripferyTheme::$options[$prefix . '_page_bgcolor'];
            if( !empty( TripferyTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TripferyTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                TripferyTheme::$pagebgimg = $attch_url[0];
            }
			
			
        }
    }
}

// Add body class
add_filter( 'body_class', 'tripfery_body_classes' );
if( !function_exists( 'tripfery_body_classes' ) ) {
    function tripfery_body_classes( $classes ) {
		
		// Header
    	if ( TripferyTheme::$options['sticky_menu'] == 1 ) {
			$classes[] = 'sticky-header';
		}

        if ( TripferyTheme::$tr_header === 1 || TripferyTheme::$tr_header === "on" ){
           $classes[] = 'tr-header';
        }
		
        $classes[] = 'header-style-'. TripferyTheme::$header_style;		
        $classes[] = 'footer-style-'. TripferyTheme::$footer_style;

        if ( TripferyTheme::$top_bar == 1 || TripferyTheme::$top_bar == 'on' ){
            $classes[] = 'has-topbar topbar-style-'. TripferyTheme::$top_bar_style;
        }
        
        $classes[] = ( TripferyTheme::$layout == 'full-width' ) ? 'no-sidebar' : 'has-sidebar';
		
		$classes[] = ( TripferyTheme::$layout == 'left-sidebar' ) ? 'left-sidebar' : 'right-sidebar';
        
		if ( is_singular('post') ) {
			$classes[] =  ' post-detail-' . TripferyTheme::$options['post_style'];
        }
        return $classes;
    }
}