<?php
// Customizer Default Data
if ( ! function_exists( 'rttheme_generate_defaults' ) ) {
    function rttheme_generate_defaults() {
        $customizer_defaults = array(

            // General  
            'logo'               	=> '',
            'logo_light'          	=> '',
            'logo_width'            => '',
            'mobile_logo_width'     => '',
			'image_blend'			=> 'normal',			
			'container_width'		=> '1290',
            'preloader'          	=> 0,
            'preloader_image'    	=> '',
			'preloader_bg_color' 	=> '#ffffff',
            'back_to_top'     		=> 1,
            'display_no_preview_image' => 0,

            'sidetext_label'        => '',
            'sidetext'              => '',
            'welcome_text'          => '',
            'address_label'         => '',
            'address'               => '',
            'email_label'           => '',
            'email'                 => '',
            'phone_label'           => '',
            'phone'                 => '',
            'opening_label'         => '',
            'opening'               => '',

            // Contact Socials            
            'social_label'   	=> '',
            'social_facebook'  	=> '',
            'social_twitter'   	=> '',
            'social_linkedin'   => '',
            'social_behance' 	=> '',
            'social_dribbble'  	=> '',
            'social_youtube'    => '',
            'social_pinterest'  => '',
            'social_instagram'  => '',
            'social_skype'      => '',
            'social_rss'       	=> '',
            'social_snapchat'   => '',
			
			// Color
			'primary_color' 			=> '',
			'secondary_color' 			=> '',
			'body_color' 				=> '',			
            'body_bg_color'             => '',          
			'menu_color' 				=> '',
			'menu_hover_color' 			=> '',
			'menu_color_tr' 			=> '',			
			'submenu_color' 			=> '',
			'submenu_hover_color' 		=> '',
			'submenu_bgcolor' 			=> '',

			// reading progress bar
			'scroll_indicator_enable' 	=> 0,
			'scroll_indicator_bgcolor' 	=> '',
            'scroll_indicator_bgcolor2' => '',
			'scroll_indicator_height' 	=> '',
			'scroll_indicator_position' => 'top',

            // header
			'top_bar'  					=> 0,
			'top_bar_style'  			=> 1,
			'top_bar_bgcolor'			=> '',
			'top_bar_color'				=> '',
            'top_link_color'            => '',
			'top_hover_color'			=> '',

			'mobile_topbar'  			=> 0,
			'mobile_date'  				=> 1,
            'mobile_address'            => 1,			
            'mobile_opening'            => 1,         
            'mobile_phone'              => 0,         
            'mobile_email'              => 0,         
			'mobile_social'  			=> 0,
			'mobile_search'  			=> 0,
            'mobile_cart'               => 0,
            'mobile_button'             => 0,

            'header_width'              => 0,
            'header_bg_color'           => '',
			'header_opt'       			=> 1,
			'sticky_menu'       		=> 1,
            'tr_header'                 => 0,
            'body_line_animate'         => 0,
            'header_style'      		=> 1,
            'search_icon'      			=> 0,
            'user_icon_link'      		=> '#',
            'vertical_menu_icon' 		=> 0,
            'user_icon' 				=> 0,
            'address_icon'              => 0,
            'phone_icon'                => 0,
            'email_icon'                => 0,
            'opening_icon'              => 0,
            'online_button'             => 0,
            'online_button_text'        => esc_html__('Get a Quote', 'tripfery'),
            'online_button_link'        => '#',
            'login_icon'                => 0,
            'login_text'                => esc_html__('Login', 'tripfery'),
            'login_link'                => '#',
            'offer_icon'                => 0,
            'offer_text'                => esc_html__('Special Offer !', 'tripfery'),
            'offer_link'                => '#',

            //footer Fun Fact
            'footer_fun_fact'           => 1,
            'footer_fun_fact_column'    => 3,
            'fff_image_one'             => '',
            'fff_title_one'             => '',
            'fff_desc_one'              => '',
            'fff_image_two'             => '',
            'fff_title_two'             => '',
            'fff_desc_two'              => '',
            'fff_image_three'           => '',
            'fff_title_three'           => '',
            'fff_desc_three'            => '',

			// Footer
            'footer_style'        		=> 1,
            'copyright_text'      		=> '&copy; ' . date('Y') . ' tripfery. All Rights Reserved by <a target="_blank" rel="nofollow" href="' . TRIPFERY_AUTHOR_URI . '">RadiusTheme</a>',
			'footer_column_1'			=> 4,
            'footer_column_2'           => 4,
            'footer_column_3'           => 4,
			'footer_area'				=> 1,
            'copyright_area'            => 1,
            'copyright_menu'            => 1,
            'logo_display'              => 1,
			'footer_bgtype' 			=> 'fbgcolor',
            'footer_bgtype2'            => 'fbgcolor2',
            'footer_bgtype3'            => 'fbgcolor3',
			'fbgcolor' 					=> '#101010',
            'fbgcolor2'                 => '#101010',
            'fbgcolor3'                 => '#ffffff',
			'fbgimg'					=> '',
            'fbgimg2'                   => '',
            'fbgimg3'                   => '',
			'footer_title_color' 		=> '',
			'footer_color' 				=> '',
			'footer_link_color' 		=> '',
			'footer_link_hover_color' 	=> '',
            'footer_logo_light'         => '',
            'copyright_text_color'      => '',
            'copyright_link_color'      => '',
            'copyright_hover_color'     => '',
            'copyright_bg_color'        => '',
            'footer_logo2'              => '',
			
			// Banner 
			'breadcrumb_link_color' 	=> '',
			'breadcrumb_link_hover_color' => '',
			'breadcrumb_active_color' 	=> '',
			'breadcrumb_seperator_color'=> '',
			'banner_bg_opacity' 		=> 0.5,
			'banner_top_padding'    	=> 100,
            'banner_bottom_padding' 	=> 100,
            'breadcrumb_active' 		=> 0,
			
			// Post Type Slug
			'team_slug' 				=> 'team',
            'booking_slug'            => 'booking',
			'team_cat_slug' 			=> 'team-category',		    
            'booking_cat_slug'        => 'booking-category',     
			
            // Page Layout Setting 
            'page_layout'        => 'full-width',
            'page_sidebar'        => '',
			'page_padding_top'    => 120,
            'page_padding_bottom' => 120,
            'page_banner' => 1,
            'page_breadcrumb' => 0,
            'page_bgtype' => 'bgcolor',
            'page_bgcolor' => '',
            'page_bgimg' => '',
            'page_page_bgimg' => '',
            'page_page_bgcolor' => '',
			
			//Blog Layout Setting 
            'blog_layout' => 'right-sidebar',
            'blog_sidebar'        => '',
			'blog_padding_top'    => 120,
            'blog_padding_bottom' => 120,
            'blog_banner' => 1,
            'blog_breadcrumb' => 0,			
			'blog_bgtype' => 'bgcolor',
            'blog_bgcolor' => '',
            'blog_bgimg' => '',
            'blog_page_bgimg' => '',
            'blog_page_bgcolor' => '',
			
			//Single Post Layout Setting 
			'single_post_layout' => 'right-sidebar',
            'single_post_sidebar'        => '',
			'single_post_padding_top'    => 120,
            'single_post_padding_bottom' => 120,
            'single_post_banner' => 1,
            'single_post_breadcrumb' => 0,			
			'single_post_bgtype' => 'bgcolor',
            'single_post_bgcolor' => '',
            'single_post_bgimg' => '',
            'single_post_page_bgimg' => '',
            'single_post_page_bgcolor' => '',

            //Team Layout Setting 
			'team_archive_layout' => 'full-width',
            'team_archive_sidebar'        => '',
			'team_archive_padding_top'    => 120,
            'team_archive_padding_bottom' => 120,
            'team_archive_banner' => 1,
            'team_archive_breadcrumb' => 0,			
			'team_archive_bgtype' => 'bgcolor',
            'team_archive_bgcolor' => '',
            'team_archive_bgimg' => '',
            'team_archive_page_bgimg' => '',
            'team_archive_page_bgcolor' => '',
			
			//Team Single Layout Setting 
			'team_layout' => 'full-width',
            'team_sidebar'        => '',
			'team_padding_top'    => 120,
            'team_padding_bottom' => 120,
            'team_banner' => 1,
            'team_breadcrumb' => 0,			
			'team_bgtype' => 'bgcolor',
            'team_bgcolor' => '',
            'team_bgimg' => '',
            'team_page_bgimg' => '',
            'team_page_bgcolor' => '',
            
            //guided Single Layout Setting 
            'guided_padding_top'    => 120,
            'guided_padding_bottom' => 120,
            'guided_banner' => 1,
            'guided_breadcrumb' => 0,         
            'guided_bgtype' => 'bgcolor',
            'guided_bgcolor' => '',
            'guided_bgimg' => '',
            'guided_page_bgimg' => '',
            'guided_page_bgcolor' => '',
            'guided_about_me' => 'About Me',

            //Booking Layout Setting 
            'booking_archive_sidebar'        => '',
            'booking_archive_padding_top'    => 120,
            'booking_archive_padding_bottom' => 120,
            'booking_archive_banner' => 1,
            'booking_archive_breadcrumb' => 0,         
            'booking_archive_bgtype' => 'bgcolor',
            'booking_archive_bgcolor' => '',
            'booking_archive_bgimg' => '',
            'booking_archive_page_bgimg' => '',
            'booking_archive_page_bgcolor' => '',
            
            //Booking Single Layout Setting 
            'booking_layout' => 'full-width',
            'booking_style' => 'style1',
            'booking_sidebar'        => '',
            'booking_padding_top'    => 120,
            'booking_padding_bottom' => 120,
            'booking_banner' => 1,
            'booking_breadcrumb' => 0,         
            'booking_bgtype' => 'bgcolor',
            'booking_bgcolor' => '',
            'booking_bgimg' => '',
            'booking_page_bgimg' => '',
            'booking_page_bgcolor' => '',
			
			//Search Layout Setting 
			'search_layout' => 'right-sidebar',
			'search_padding_top'    => 120,
            'search_padding_bottom' => 120,
            'search_banner' => 1,
            'search_breadcrumb' => 0,			
			'search_bgtype' => 'bgcolor',
            'search_bgcolor' => '',
            'search_bgimg' => '',
            'search_page_bgimg' => '',
            'search_page_bgcolor' => '',
            'search_excerpt_length' => 40,
			
			//Error Layout Setting 
			'error_padding_top'    => 120,
            'error_padding_bottom' => 120,
            'error_banner' => 1,
            'error_breadcrumb' => 0,			
			'error_bgtype' => 'bgcolor',
            'error_bgcolor' => '',
            'error_bgimg' => '',
            'error_page_bgimg' => '',
            'error_page_bgcolor' => '',
			
			//Shop Archive Layout Setting 
			'shop_layout' => 'left-sidebar',
            'shop_sidebar'        => '',
			'shop_padding_top'    => 120,
            'shop_padding_bottom' => 120,
            'shop_banner' => 1,
            'shop_breadcrumb' => 0,			
			'shop_bgtype' => 'bgcolor',
            'shop_bgcolor' => '',
            'shop_bgimg' => '',
            'shop_page_bgimg' => '',
            'shop_page_bgcolor' => '',

            'products_cols_width' => 4,
			'products_per_page' => 8,
			'wc_shop_cart_icon' => 1,
			'wc_shop_quickview_icon' => 1,
			'wc_shop_compare_icon' => 0,
            'wc_shop_wishlist_icon' => 0,
            'wc_shop_sale_flash' => 0,
			'wc_shop_rating' => 0,
			
			//Product Single Layout Setting 
			'product_layout' => 'full-width',
            'product_sidebar'        => '',
			'product_padding_top'    => 120,
            'product_padding_bottom' => 120,
            'product_banner' => 1,
            'product_breadcrumb' => 0,			
			'product_bgtype' => 'bgcolor',
            'product_bgcolor' => '',
            'product_bgimg' => '',
            'product_page_bgimg' => '',
            'product_page_bgcolor' => '',

            'wc_product_meta' => 0,
            'wc_product_wishlist_icon' => 0,
            'wc_product_compare_icon' => 0,
			'related_woo_product' => 1,
			'related_product_title' => esc_html__('Related Products', 'tripfery'),

            // Blog Archive
			'blog_style'				=> 'style1',
            'blog_loadmore'             => 'pagination',
            'load_more_limit'           => 4,            
			'post_banner_title'  		=> '',
			'post_content_limit'  		=> '20',
			'blog_content'  			=> 1,
			'blog_content3'  			=> 1,
			'blog_date'  				=> 1,
			'blog_author_name'  		=> 1,
			'blog_author_name3'  		=> 1,
			'blog_comment_num'  		=> 0,
			'blog_cats'  				=> 1,
			'blog_view'  				=> 0,
			'blog_length'  				=> 0,
            'blog_video'                => 0,
            'blog_read_more'            => 1,
			'blog_animation'  			=> 'hide',
			'blog_animation_effect'  	=> 'fadeInUp',
			
			// Post
            'post_style'                => 'style1',
			'scroll_post_enable'		=> 0,
            'post_scroll_limit'         => 1,
			'post_featured_image'		=> 1,
			'post_author_name'			=> 1,
			'post_date'					=> 1,
			'post_comment_num'			=> 1,
			'post_cats'					=> 1,
			'post_tags'					=> 1,
			'post_share'				=> 1,
			'post_links'				=> 0,
			'post_author_bio'			=> 0,
			'post_view'					=> 1,
			'post_length'				=> 0,
			'post_published'			=> 0,
			'show_related_post'			=> 0,
			'show_related_post_number'	=> 5,
			'related_title'				=> esc_html__('You May Also Like', 'tripfery'),
			'show_related_post_title_limit'	=> 8,
			'related_post_query'		=> 'cat',
			'related_post_sort'			=> 'recent',
			'post_time_format'			=> 'modern',
			
			// Post Share
			'post_share_facebook' 		=> 1,
			'post_share_twitter' 		=> 1,
			'post_share_youtube' 		=> 1,
			'post_share_linkedin' 		=> 1,
			'post_share_pinterest' 		=> 1,
			'post_share_whatsapp' 		=> 0,
			'post_share_cloud' 			=> 0,
			'post_share_dribbble' 		=> 0,
			'post_share_tumblr' 		=> 0,
			'post_share_reddit' 		=> 0,
			'post_share_email' 			=> 0,
			'post_share_print' 			=> 0,

			// Team
			'team_archive_style' 		=> 'style2',
			'team_post_number' 		    => 8,
            'team_arexcerpt_limit'      => 12,
			'team_ar_excerpt' 			=> 0,
			'team_ar_position' 			=> 1,
			'team_ar_social' 			=> 1,
			'team_info' 				=> 1,
			'team_skill' 				=> 1,
            'team_contact'              => 0,
            'team_contact_title'        => esc_html__('Contact Us', 'tripfery'),
			'show_related_team' 		=> 1,
			'team_related_title' 		=> esc_html__('Related Chef', 'tripfery'),
			'related_team_number' 		=> 5,
			'related_team_title_limit' 	=> 5,

            // guided
            'guided_post_number'       => 8,

            // Booking
            'booking_archive_style'     => 'style1',
            'booking_rating'            => 1,
            'booking_wishlist'          => 1,
            'booking_locaton'           => 1,
            'booking_btn'               => 1,
            'booking_arcive_single_title' => esc_html__('Discover now', 'tripfery'),

            'single_booking_cat'        => 1,
            'single_booking_client'     => 1,
            'single_booking_startdate'  => 1,
            'single_booking_enddate'    => 1,
            'single_booking_weblink'    => 1,
            'single_booking_rating'     => 1,
            'show_related_booking'      => 0,
            'booking_related_title'     => esc_html__('Availability', 'tripfery'),
            'related_booking_number'    => 5,
			
            // Error
            'error_bodybg_color' 		=> '',
            'error_text1_color' 		=> '',
            'error_text2_color' 		=> '',
			'error_image' 				=> '',
			'error_image2' 				=> '',
            'error_text1' 				=> esc_html__('Oops... Page Not Found!', 'tripfery'),
            'error_text2' 				=> esc_html__('Sorry! This Page Is Not Available!', 'tripfery'),
            'error_buttontext' 			=> esc_html__('Go Back To Home Page', 'tripfery'),
            'error_animation' 			=> 'hide',
            'error_animation_effect' 	=> 'fadeInUp',
            
            // Typography
            'typo_body' => json_encode(
                array(
                    'font' => 'Inter',
                    'regularweight' => '400',
                )
            ),
            'typo_body_size' => '16px',
            'typo_body_height'=> '26px',

            //Menu Typography
            'typo_menu' => json_encode(
                array(
                    'font' => 'Inter',
                    'regularweight' => '500',
                )
            ),
            'typo_menu_size' => '16px',
            'typo_menu_height'=> '22px',

            //Sub Menu Typography
            'typo_sub_menu' => json_encode(
                array(
                    'font' => 'Inter',
                    'regularweight' => '500',
                )
            ),
            'typo_submenu_size' => '14px',
            'typo_submenu_height'=> '22px',


            // Heading Typography
            'typo_heading' => json_encode(
                array(
                    'font' => 'Inter',
                    'regularweight' => '700',
                )
            ),
            //H1
            'typo_h1' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '700',
                )
            ),
            'typo_h1_size' => '44px',
            'typo_h1_height' => '54px',

            //H2
            'typo_h2' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '700',
                )
            ),
            'typo_h2_size' => '36px',
            'typo_h2_height'=> '42px',

            //H3
            'typo_h3' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '700',
                )
            ),
            'typo_h3_size' => '28px',
            'typo_h3_height'=> '36px',

            //H4
            'typo_h4' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h4_size' => '22px',
            'typo_h4_height'=> '28px',

            //H5
            'typo_h5' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '500',
                )
            ),
            'typo_h5_size' => '18px',
            'typo_h5_height'=> '24px',

            //H6
            'typo_h6' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '500',
                )
            ),
            'typo_h6_size' => '14px',
            'typo_h6_height'=> '18px',

            
        );

        return apply_filters( 'rttheme_customizer_defaults', $customizer_defaults );
    }
}