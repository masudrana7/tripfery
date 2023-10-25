<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use Rtrs\Models\Review; 
use Rtrs\Helpers\Functions; 

class WC_Functions {

	protected static $instance = null;

	public function __construct() {
		/* Theme supports for WooCommerce */
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		/* Shop builder support */
		add_action('rdtheme_after_actions_button', [$this, 'actions_button_control' ], 10, 2 );

		/* ====== Shop/Archive Wrapper ====== */
		// Remove
		add_filter( 'woocommerce_show_page_title',        '__return_false' );
		remove_action( 'woo_main_before',                 'woo_display_breadcrumbs', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_after_shop_loop',     'woocommerce_pagination', 10 );
		// Add
		add_action( 'woocommerce_before_main_content',     array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content',      array( $this, 'wrapper_end' ), 10 );
		add_action( 'loop_shop_per_page',                  array( $this, 'tripfery_loop_shop_per_page' ), 20 );
		add_action( 'woocommerce_after_shop_loop',         array( $this, 'tripfery_products_paginations' ), 10 );
		// Columns
		add_filter( 'loop_shop_columns',                    array( $this, 'loop_shop_columns' ) );

		/* ====== Shop/Details ====== */
		remove_action( 'woocommerce_product_description_heading',  '__return_null' );
		remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_upsell_display', 15 );

		/* Shop top tab */
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_catalog_ordering', 30 );
		add_action( 'woocommerce_before_shop_loop',                    array( $this, 'shop_topbar' ), 20 );


		// Single Product Layout
		add_action( 'init', array( $this, 'single_product_layout_hooks' ) );
		// Hide some tab headings
		add_filter( 'woocommerce_product_description_heading',            '__return_false' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
		// Single product review
		add_filter( 'woocommerce_product_review_comment_form_args',    array( $this, 'product_review_form' ) );

		/* ====== Checkout Page ====== */
		add_filter( 'woocommerce_checkout_fields', array( $this, 'tripfery_checkout_fields' ) );

		/* ====== Mini Cart ====== */
		add_action( 'tripfery_woo_cart_icon', array( $this, 'tripfery_wc_cart_count' ) );
		add_action( 'woocommerce_add_to_cart_fragments', array( $this, 'tripfery_header_add_to_cart_fragment' ) );
		add_action( 'wp_ajax_tripfery_product_remove', array( $this, 'tripfery_product_remove' ) );
        add_action( 'wp_ajax_nopriv_tripfery_product_remove', array( $this, 'tripfery_product_remove' ) );
	}


	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function theme_support() {
		add_theme_support( 'woocommerce', 
			array(
				// 'gallery_thumbnail_image_width' => 150,
			) 
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_post_type_support( 'product', 'page-attributes' );
	}

	/*body class*/
	public function body_classes( $classes ) {
		if( isset( $_GET["shopview"] ) && $_GET["shopview"] == 'list' ) {
			$classes[] = 'product-list-view';
		}
		else {
			$classes[] = 'product-grid-view';
		}
		return $classes;
	}

	public function wrapper_start() {
		self::get_custom_template_part( 'shop-header' );
	}

	public function wrapper_end() {
		self::get_custom_template_part( 'shop-footer' );
	}

	public function shop_topbar() {
		self::get_custom_template_part( 'shop-top' );
	}

	public function loop_shop_columns(){
		if( isset($_GET["shopview"]) && $_GET["shopview"] == 'list' ) {
			$cols = 1;
		}else {
			$cols = TripferyTheme::$options['products_cols_width'];
		}
		return $cols;
	}

	public function tripfery_products_paginations(){
		TripferyTheme_Helper::pagination();
	}

	// Template Loader
	public static function get_template_part( $template, $args = array() ){
		extract( $args );
		$template = '/' . $template . '.php';
		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		}
		else {
			$file = get_template_directory() . $template;
		}
		require $file;
	}
	public static function get_custom_template_part( $template, $args = array() ){
		$template = 'woocommerce/custom/template-parts/' . $template;
		self::get_template_part( $template, $args );
	} 

	/* = Single Page
	=============================================================================*/
	public function single_product_layout_hooks() {
		// Remove Action
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		// Add Action

		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );

		add_action('rdtheme_after_actions_button_product_page', [$this, 'single_meta_actions_button' ], 10, 2 );

		add_action( 'woocommerce_single_product_summary', function(){
			global $product;
			$module_data = [
				'wc_shop_wishlist_icon' => TripferyTheme::$options['wc_product_wishlist_icon'],
				'wc_shop_compare_icon' => TripferyTheme::$options['wc_product_compare_icon'],
			];?>
			<div class="single-product-yith"><?php do_action('rdtheme_after_actions_button_product_page', $product, $module_data); ?></div>
			<?php
		}, 31 );

		// Add to cart button
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'add_to_cart_button_wrapper_start' ), 3 );
		add_action( 'woocommerce_after_add_to_cart_button',  array( $this, 'add_to_cart_button_wrapper_end' ), 90 );
	}

	public function add_to_cart_button_wrapper_start(){
		echo '<div class="single-add-to-cart-wrapper">';
	}

	public function add_to_cart_button_wrapper_end(){
		echo '</div>';
	}
 
	/* = Shop Page
	=============================================================================*/
	public static function get_product_thumbnail( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		$thumbnail   = $product->get_image( $thumb_size, array(), false );
		if ( !$thumbnail ) {
			$thumbnail = wc_placeholder_img( $thumb_size );
		}
		return $thumbnail;
	}
	public static function get_product_thumbnail_link( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		return '<a href="'.esc_attr( $product->get_permalink() ).'">'.self::get_product_thumbnail( $product, $thumb_size ).'</a>';
	}
	public static function print_add_to_cart_icon( $product_id, $icon = true, $text = true ){
		global $product;
		$quantity = 1;
		$class = implode( ' ', array_filter( array(
			'action-cart',
			'product_type_' . $product->get_type(),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
		) ) );

		$html = '';

		$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	    $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

		if ( $in_cart ) {
			if ( $text ) {
				$html .= '<i class="fas fa-check"></i>';
			}
		} else {
			if ( $icon ) {
				$html .= '<i class="icon-tripfery-cart"></i>';
			}
			if ( $text ) {
				$html .= '<span>' . $product->add_to_cart_text() . '</span>';
			}
		}
		
	    if ( $in_cart ) {
			echo sprintf( '<a rel="nofollow" title="%s" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s">' . $html . '</a>',
				esc_attr( $product->add_to_cart_text() ),
				esc_url( wc_get_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() )
			);
		} else {
			echo sprintf( '<a rel="nofollow" title="%s" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">' . $html . '</a>',
				esc_attr( $product->add_to_cart_text() ),
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'action-cart' )
			);
		}
	}

    public function tripfery_loop_shop_per_page( $products ) {
        $shop_posts_per_page = TripferyTheme::$options['products_per_page'];
        if (!empty($shop_posts_per_page)) {
           $products = $shop_posts_per_page;
        } else {
            $products = '9';
        }
        return $products;
    }

	public static function tripfery_product_social_share(){
		$url   = urlencode( get_permalink() );
		$title = urlencode( get_the_title() );
		$defaults = array(
			'facebook' => array(
				'url'  => "http://www.facebook.com/sharer.php?u=$url",
				'icon' => 'fab fa-facebook-f',
				'class' => 'bg-fb'
			),
			'twitter'  => array(
				'url'  => "https://twitter.com/intent/tweet?source=$url&text=$title:$url",
				'icon' => 'fab fa-twitter',
				'class' => 'bg-twitter'
			),
			'linkedin' => array(
				'url'  => "http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title",
				'icon' => 'fab fa-linkedin-in',
				'class' => 'bg-linked'
			),
			'pinterest'=> array( 
				'url'  => "http://pinterest.com/pin/create/button/?url=$url&description=$title",
				'icon' => 'fab fa-pinterest-square',
				'class' => 'bg-pinterst'
			),
		);

		foreach ( $defaults as $key => $value ) {
			if ( !$value ) {
				unset( $defaults[$key] );
			}
		}
		$sharers = apply_filters( 'rdtheme_social_sharing_icons', $defaults );
		?>
		<div class="post-share-btn">
			<h5 class="item-label"><?php esc_html_e( 'Share:', 'tripfery' );?></h5>
			<div class="post-social-sharing">
				<ul class="item-social">
					<?php foreach ( $sharers as $key => $sharer ){ ?>
		            <li>
		            	<a href="<?php echo esc_url( $sharer['url'] );?>" class="<?php echo esc_attr( $sharer['class'] );?>">
		            		<i class="<?php echo esc_attr( $sharer['icon'] );?>"></i>
		            	</a>
		            </li>
		            <?php } ?>
		        </ul>
			</div>
		</div>
	<?php }

	public static function get_stock_status() {
		global $product;
		return $product->is_in_stock() ? esc_html__( 'In Stock', 'tripfery' ) : esc_html__( 'Out of Stock', 'tripfery' );
	}

	public function product_review_form( $comment_form ){
		$commenter = wp_get_current_commenter();
		$comment_form['fields'] = array(
			'author' => '<div class="row"><div class="col-sm-6"><div class="comment-form-author form-group"><input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name *', 'tripfery' ) . '" required /></div></div>',
			'email'  => '<div class="comment-form-email col-sm-6"><div class="form-group"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email *', 'tripfery' ) . '" required /></div></div></div>',
		);

		$comment_form['comment_field'] = '';

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'tripfery' ) .'</label>
			<select name="rating" id="rating" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'tripfery' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'tripfery' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'tripfery' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'tripfery' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'tripfery' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'tripfery' ) . '</option>
			</select></p>';
		}

		$comment_form['comment_field'] .= '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" class="form-control" placeholder="' . esc_attr__( 'Your Review *', 'tripfery' ) . '" cols="45" rows="8" required></textarea></div>';

		return $comment_form;
	}

	// WooCommerce Checkout Fields Hook
    public function tripfery_checkout_fields( $fields ) {
        $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
        $fields['billing']['billing_first_name']['label'] = false;
        $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
        $fields['billing']['billing_last_name']['label'] = false;

        $fields['billing']['billing_company']['placeholder'] = 'Company Name';
        $fields['billing']['billing_company']['label'] = false;

        $fields['billing']['billing_country']['placeholder'] = 'Country';
        $fields['billing']['billing_country']['label'] = 'Select Your Country';

        $fields['billing']['billing_address_1']['placeholder'] = 'Street Address';
        $fields['billing']['billing_address_1']['label'] = false;
        $fields['billing']['billing_address_2']['placeholder'] = 'Apartment, Unite ( optional )';
        $fields['billing']['billing_address_2']['label'] = false;

        $fields['billing']['billing_city']['placeholder'] = 'Town / City';
        $fields['billing']['billing_city']['label'] = false;

        $fields['billing']['billing_state']['placeholder'] = 'County';
        $fields['billing']['billing_state']['label'] = false;

        $fields['billing']['billing_postcode']['placeholder'] = 'Post Code / Zip';
        $fields['billing']['billing_postcode']['label'] = false;

        $fields['billing']['billing_email']['placeholder'] = 'Email Address';
        $fields['billing']['billing_email']['label'] = false;

        $fields['billing']['billing_phone']['placeholder'] = 'Phone';
        $fields['billing']['billing_phone']['label'] = false;

        return $fields;
    }

    /*----------------------------------------------------------------------------------*/
    /* Woo Mini Cart
    /*----------------------------------------------------------------------------------*/

    //Minicart Callback Function
    public static function TripferyWooMiniCart(){
        ob_start();
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            do_action( 'tripfery_woo_cart_icon' );
        }
        $woo_cart_out = ob_get_clean();
        $woo_cart_out = '<div class="header-action-item cart-area mini-cart-items header-shop-cart">'. $woo_cart_out .'</div>';
        echo wp_kses_stripslashes( $woo_cart_out );
    }

    /* Add Cart icon and count to header if WC is active */
    public function tripfery_cart_items(){
        $empty_cart = '<li class="cart-item d-flex align-items-center"><h5 class="text-center no-cart-items">'. apply_filters( 'tripfery_woo_mini_cart_empty', esc_html__('Your cart is empty', 'tripfery') ) .'</h5></li>';
        if(is_null(WC()->cart)) {
        	return $empty_cart;
		}
		if ( WC()->cart->get_cart_contents_count() == 0 ) return $empty_cart;
        ob_start();
        $shop_page_url = get_permalink( wc_get_page_id( 'cart' ) );
        $remove_loader = apply_filters('woo_mini_cart_loader', TripferyTheme_Helper::get_img( 'spinner2.gif' ));
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            ?>
                <li class="cart-item d-flex align-items-center">
	                <?php
	                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
	                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
	                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
	                ?>
	                <div class="cart-single-product">
						<div class="media">
							<div class="cart-product-img">
								<?php
		                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
		                            if ( ! $product_permalink ) {
		                                echo ( ''. $thumbnail );
		                            } else {
		                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
		                            }
		                        ?>
							</div>
							<div class="media-body cart-content">
								<ul>
									<li class="minicart-title">
										<div class="cart-title-line1">
											<?php echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key ); ?>
										</div>
										<div class="cart-title-line2">
										<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?> &#9747; <?php echo esc_attr( $cart_item['quantity'] ); ?>
										</div>
									</li>
									<li class="minicart-remove">
										<?php
				                            echo apply_filters(
				                                'woocommerce_cart_item_remove_link',
				                                sprintf(
				                                    '<a href="%s" class="remove_from_cart_button remove-cart-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fas fa-trash-alt"></i></a>',
				                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
				                                    esc_attr__( 'Remove this item', 'tripfery' ),
				                                    esc_attr( $product_id ),
				                                    esc_attr( $cart_item_key ),
				                                    esc_attr( $_product->get_sku() )
				                                ),
				                                $cart_item_key
				                            );
				                        ?>
									</li>
								</ul>
							</div>
							<span class="remove-item-overlay text-center"><img src="<?php echo esc_url($remove_loader); ?>" alt="<?php esc_attr_e('Loader..', 'tripfery') ?>" /></span>
						</div>
					</div>

	                <?php
	                    }//if
	                ?>
                </li>
                <?php
                }//foreach
            ?>
            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
            <li class="cart-total">
                <div class="total-price">
                    <span class="f-left"><?php _e( 'Total:', 'tripfery' ); ?></span>
                    <span class="f-right"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                </div>
            </li>
            <li class="cart-btn">
                <div class="checkout-link">
                    <a class="button wc-forward" href="<?php echo wc_get_cart_url(); ?>"><?php _e( 'View Cart', 'tripfery' ); ?></a>
                    <a class="button wc-forward checkout" href="<?php echo wc_get_checkout_url(); ?>"><?php _e( 'Checkout', 'tripfery' ); ?></a>
                </div>
            </li>
            <?php endif; ?>
        <?php 
        $out = ob_get_clean();
        return $out;
    }

    public function tripfery_wc_cart_count() {     
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
   			if(is_null(WC()->cart)) {
			    $count = WC()->cart->cart_contents_count;
			} else {
				$count = 0;
			}
			// $count = WC()->cart->cart_contents_count();
            $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
            ?>
            <div class="cart-list-trigger">
	            <a class="cart-contents cart-trigger-icon" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'tripfery' ); ?>"><i class="icon-tripfery-cart"></i> <?php if ( $count > 0 ) echo '(' . $count . '2' . ')'; ?></a>
                <div class="cart-wrapper">
                    <ul class="minicart">
		            	<?php echo wp_kses_stripslashes( $this->tripfery_cart_items() ); ?>
		            </ul>
                </div>
            </div>
            <?php
        }
    }

    /* Ensure cart contents update when products are added to the cart via AJAX */
    public function tripfery_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        if(!is_null(WC()->cart)) {
		    $count = WC()->cart->cart_contents_count;
		} else {
			$count = 0;
		}
        $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
        ?>
            <div class="header-action-item cart-area mini-cart-items header-shop-cart">
            	<div class="cart-list-trigger">
	                <a class="cart-contents cart-trigger-icon" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'tripfery' ); ?>"><i class="icon-tripfery-cart"></i> <?php if ( $count >= 0 ) echo '<span>' . $count . '</span>'; ?></a>
	                <div class="cart-wrapper">
		                <ul class="minicart">
		                <?php echo wp_kses_stripslashes( $this->tripfery_cart_items() ); ?>
		                </ul>
		            </div>
	            </div>
            </div>
        <?php
        $fragments['div.mini-cart-items'] = ob_get_clean();
        return $fragments;
    }

    public function tripfery_wc_cart_ajax() {
        $output = '';
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        	if(!is_null(WC()->cart)) {
			    $count = WC()->cart->cart_contents_count;
			} else {
				$count = 0;
			}
            $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
            ob_start();
            ?>
            <a class="cart-contents" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'tripfery' ); ?>"><i class="icon-tripfery-cart"></i> <?php if ( $count > 0 ) echo '(' . $count . ')'; ?></a>
            <ul class="minicart">
            <?php
                echo wp_kses_stripslashes( $this->tripfery_cart_items() );
            ?>
            </ul>
            <?php
            $output = ob_get_clean();
        }
        return  $output;
    }

    public function tripfery_product_remove() {
        global $wpdb, $woocommerce;
        session_start();
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item){
            if($cart_item['product_id'] == $_POST['product_id'] ){
                $woocommerce->cart->remove_cart_item($cart_item_key);
            }
        }
        $return["mini_cart"] = $this->tripfery_wc_cart_ajax();
        echo json_encode($return);
        exit();
    }

    /*Shop meta action*/
    public function actions_button_control( $product, $module_data ) {
        if( ! $product ){
            return ;
        }
        $product_id = $product->get_id();

        if( isset( $module_data['wc_shop_wishlist_icon'] ) && $module_data['wc_shop_wishlist_icon'] ){
        	do_action( 'rtsb/modules/wishlist/print_button', $product_id );  
        }
        if( isset( $module_data['wc_shop_quickview_icon'] ) && $module_data['wc_shop_quickview_icon'] ){
        	do_action( 'rtsb/modules/quick_view/print_button', $product_id ); 
        }
        if( isset( $module_data['wc_shop_compare_icon'] ) && $module_data['wc_shop_compare_icon'] ){
        	do_action( 'rtsb/modules/compare/print_button', $product_id );
        }
    }

    /*Product single meta action*/
    public function single_meta_actions_button( $product, $module_data ) {
        if( ! $product ){
            return ;
        }
        $product_id = $product->get_id();
        if( isset( $module_data['wc_shop_wishlist_icon'] ) && $module_data['wc_shop_wishlist_icon'] ){ ?>
        	<span class="wishlist"><?php do_action( 'rtsb/modules/wishlist/print_button', $product_id );echo esc_html("Add To Wishlist", 'tripfery'); ?></span>
		<?php }
        if( isset( $module_data['wc_shop_compare_icon'] ) && $module_data['wc_shop_compare_icon'] ){ ?>
        	<span class="compare"><?php do_action( 'rtsb/modules/compare/print_button', $product_id );echo esc_html("Add To Compare", 'tripfery'); ?></span>
        <?php }

    }

}

WC_Functions::instance();