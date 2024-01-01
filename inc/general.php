<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !isset( $content_width ) ) {
	$content_width = 1200;
}

add_action('after_setup_theme', 'tripfery_setup');
if ( !function_exists( 'tripfery_setup' ) ) {
	function tripfery_setup() {
		// Language
		load_theme_textdomain( 'tripfery', TRIPFERY_BASE_DIR . 'languages' );

		// Theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		remove_theme_support('widgets-block-editor');
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'audio' ) );
		// for gutenberg support
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'Primary Color', 'tripfery' ),
				'slug' => 'tripfery-primary',
				'color' => '#384bff',
			),
			array(
				'name' => esc_html__( 'Secondary Color', 'tripfery' ),
				'slug' => 'tripfery-secondary',
				'color' => '#1b2cc7',
			),
			array(
				'name' => esc_html__( 'dark gray', 'tripfery' ),
				'slug' => 'tripfery-button-dark-gray',
				'color' => '#e7e7e7',
			),
			array(
				'name' => esc_html__( 'light gray', 'tripfery' ),
				'slug' => 'tripfery-button-light-gray',
				'color' => '#f8f8f8',
			),
			array(
				'name' => esc_html__( 'white', 'tripfery' ),
				'slug' => 'tripfery-button-white',
				'color' => '#ffffff',
			),
		) );
		add_theme_support( 'editor-gradient-presets', array(
			array(
				'name'     => esc_html__( 'Gradient Color', 'tripfery' ),
				'gradient' => 'linear-gradient(135deg, rgba(255, 0, 0, 1) 0%, rgba(252, 75, 51, 1) 100%)',
				'slug'     => 'tripfery_gradient_color',
			),
		));	
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' => esc_html__( 'Small', 'tripfery' ),
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => esc_html__( 'Normal', 'tripfery' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => esc_html__( 'Large', 'tripfery' ),
				'size' => 36,
				'slug' => 'large'
			),
			array(
				'name' => esc_html__( 'Huge', 'tripfery' ),
				'size' => 44,
				'slug' => 'huge'
			)
		) );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support('editor-styles');	
		
		// Image sizes
		add_image_size( 'tripfery-size1', 1296, 690, true );   	// fullimage, Blog List layout
		add_image_size( 'tripfery-size2', 960, 520, true );    	// Blog layout 2
		add_image_size( 'tripfery-size4', 860, 420, true );    	// Blog layout 1
		add_image_size( 'tripfery-size3', 520, 330, true );    	// Blog layout 3
		add_image_size( 'tripfery-size5', 416, 360, true );    	// Blog layout 3
		add_image_size( 'tripfery-size6', 230, 200, true );    	// Blog layout 3
		
		// Register menus
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary', 'tripfery' ),
			'topright' => esc_html__( 'Header Right', 'tripfery' ),
		) );		
	}
}

function tripfery_theme_add_editor_styles() {
	add_editor_style( get_stylesheet_uri() );
}
add_action( 'admin_init', 'tripfery_theme_add_editor_styles' );

function tripfery_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'tripfery_pingback_header' );

// Initialize Widgets
add_action( 'widgets_init', 'tripfery_widgets_register' );
if ( !function_exists( 'tripfery_widgets_register' ) ) {
	function tripfery_widgets_register() {
		
		$footer_widget_titles1 = array(
			'1' => esc_html__( 'Footer (Style 1) 1', 'tripfery' ),
			'2' => esc_html__( 'Footer (Style 1) 2', 'tripfery' ),
			'3' => esc_html__( 'Footer (Style 1) 3', 'tripfery' ),
			'4' => esc_html__( 'Footer (Style 1) 4', 'tripfery' ),
		);	
		
		$footer_widget_titles2 = array(
			'1' => esc_html__( 'Footer (Style 2) 1', 'tripfery' ),
			'2' => esc_html__( 'Footer (Style 2) 2', 'tripfery' ),
			'3' => esc_html__( 'Footer (Style 2) 3', 'tripfery' ),
			'4' => esc_html__( 'Footer (Style 2) 4', 'tripfery' ),
		);

		// Register Widget Areas ( Common )
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'tripfery' ),
			'id'            => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="rt-widget-title-holder"><h4 class="widgettitle has-animation">',
			'after_title'   => '</h4></div>',
		) );			
		
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name'          => 'Shop Sidebar',
				'id'            => 'shop-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widgettitle has-animation">',
				'after_title'   => '</h2>',
			) );
		}
		
		register_sidebar( array(
			'name'          => esc_html__( 'Booking Form', 'tripfery' ),
			'id'            => 'booking-form',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="rt-widget-title-holder">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Booking Sidebar', 'tripfery' ),
			'id'            => 'booking-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="rt-widget-title-holder">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Offcanvas Info', 'tripfery' ),
			'id'            => 'offcanvas',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="hidden">',
			'after_title'   => '</h3>',
		) );	

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Fun Fact', 'tripfery' ),
			'id'            => 'footer-funfact',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="rt-widget-title-holder">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Copyright Widgets', 'tripfery' ),
			'id'            => 'copyright-menu',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="hidden">',
			'after_title'   => '</h3>',
		) );	

		/*footer 1 register*/
		if ( !empty(TripferyTheme::$options['footer_column_1']) ){
			$item_widget = TripferyTheme::$options['footer_column_1'];
		} else {
			$item_widget = 4;
		}		
		for ( $i = 1; $i <= $item_widget; $i++ ) {
			register_sidebar( array(
				'name'          => $footer_widget_titles1[$i],
				'id'            => 'footer-style-1-'. $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle has-animation '. TripferyTheme::$footer_style .'">',
				'after_title'   => '</h4>',
			) );
		}
		/*footer 2 register*/
		if ( !empty(TripferyTheme::$options['footer_column_2']) ){
			$item_widget = TripferyTheme::$options['footer_column_2'];
		} else {
			$item_widget = 4;
		}		
		for ( $i = 1; $i <= $item_widget; $i++ ) {
			register_sidebar( array(
				'name'          => $footer_widget_titles2[$i],
				'id'            => 'footer-style-2-'. $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle has-animation '. TripferyTheme::$footer_style .'">',
				'after_title'   => '</h4>',
			) );
		}				
		
	}
}
/*Allow HTML for the kses post*/
function tripfery_kses_allowed_html($tags, $context) {
    switch($context) {
        case 'social':
            $tags = array(
                'a' => array('href' => array()),
                'b' => array()
            );
            return $tags;
		case 'allow_link':
            $tags = array(
                'a' => array(
                    'class' => array(),
                    'href'  => array(),
                    'rel'   => array(),
                    'title' => array(),
					'target' => array(),					
                ),
				'img' => array(
                    'alt'    => array(),
                    'class'  => array(),
                    'height' => array(),
                    'src'    => array(),
                    'srcset' => array(),
                    'width'  => array(),
                ),
                'b' => array()
            );
            return $tags;
		case 'allow_title':
            $tags = array(
				'a' => array(
                    'class' => array(),
                    'href'  => array(),
                    'rel'   => array(),
                    'title' => array(),
					'target' => array(),
                ),
                'span' => array(
                    'class' => array(),
                    'style' => array(),
                ),
                'b' => array()
            );
            return $tags;
			
        case 'alltext_allow':
            $tags = array(
                'a' => array(
                    'class' => array(),
                    'href'  => array(),
                    'rel'   => array(),
                    'title' => array(),
					'target' => array(),
                ),
                'abbr' => array(
                    'title' => array(),
                ),
                'b' => array(),
                'br' => array(),
                'sub' => array(),
                'blockquote' => array(
                    'cite'  => array(),
                ),
                'cite' => array(
                    'title' => array(),
                ),
                'code' => array(),
                'del' => array(
                    'datetime' => array(),
                    'title' => array(),
                ),
                'dd' => array(),
                'div' => array(
                    'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),
                ),
                'dl' => array(),
                'dt' => array(),
                'em' => array(),
                'h1' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),),
                'h2' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),),
                'h3' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),),
                'h4' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),),
                'h5' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),),
                'h6' => array(
                	'class' => array(),
                    'title' => array(),
                    'style' => array(),
                    'id' 	=> array(),
                ),
                'i' => array(
					'class' => array(),
				),
                'img' => array(
                    'alt'    => array(),
                    'class'  => array(),
                    'height' => array(),
                    'src'    => array(),
                    'srcset' => array(),
                    'width'  => array(),
                ),
                'li' => array(
                    'class' => array(),
                ),
                'ol' => array(
                    'class' => array(),
                ),
                'p' => array(
                    'class' => array(),
                ),
                'q' => array(
                    'cite' => array(),
                    'title' => array(),
                ),
                'span' => array(
                    'class' => array(),
                    'title' => array(),
                    'style' => array(),
                ),
                'strike' => array(),
                'strong' => array(),
                'ul' => array(
                    'class' => array(),
                ),
            );
            return $tags;
        default:
            return $tags;
    }
}
add_filter( 'wp_kses_allowed_html', 'tripfery_kses_allowed_html', 10, 2);

/**
 * @param Wp_Query $query
 * @return mixed
 */
function advanced_search_query($query) {
    if($query->is_search()) {
        // category terms search.
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $query->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array($_GET['category']) )
            ));
        }    
    }
    return $query;
}
add_action('pre_get_posts', 'advanced_search_query', 1000);

/*find newest post/product with time*/
function tripfery_is_new( $id ) {
	$now    = time();
	$published_date = get_post_time('U');
	$diff =  $now - $published_date;
	if ( $diff < 604800 ) { ?>
		<span class="new-post"><?php esc_html_e( 'New' , 'tripfery' ); ?></span>
	<?php }
}

if( ! function_exists( 'tripfery_post_img_src' )){
	function tripfery_post_img_src( $size = 'tripfery-size1' ){
		$post_id  = get_the_ID();
		if ( has_post_thumbnail( $post_id ) ) {			
			$image_id = get_post_thumbnail_id( $post_id );			
			$image    = wp_get_attachment_image_src( $image_id, $size );
			return $image[0];
		} else {
			return;
		}
	}
}

/*Post Time & time format*/
if( ! function_exists( 'tripfery_get_time' )){

	function tripfery_get_time( $return = false ){

		$post = get_post();
		
		# Date is disabled globally ----------
		if( TripferyTheme::$options['post_time_format'] == 'none' ){
			return false;
		}
		# Human Readable Post Dates ----------
		elseif(  TripferyTheme::$options['post_time_format'] == 'modern' ){

			$time_now  = current_time( 'timestamp' );
			$post_time = get_the_time( 'U' ) ;
			$since = sprintf( esc_html__( '%s ago' , 'tripfery' ), human_time_diff( $post_time, $time_now ) );			
		}
		else{
			$since = get_the_date();
		}

		$post_time = '<span class="date meta-item"><span>'.$since.'</span></span>';

		if( $return ){
			return $post_time;
		}

		echo wp_kses( $post_time , 'alltext_allow' );
	}

}

function widgets_scripts( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );
	
}
add_action( 'admin_enqueue_scripts', 'widgets_scripts' );

/*Module: Last Post update Date*/
function tripfery_last_update() { 

	$lastupdated_args = array(
		'orderby' => 'modified',
		'posts_per_page' => 1,
		'ignore_sticky_posts' => '1'
	);
 
	$lastupdated_loop = new WP_Query( $lastupdated_args );
	
	while( $lastupdated_loop->have_posts() )  {
		$lastupdated_loop->the_post();
		echo get_the_modified_date( 'M j, Y g:i a' );
	}	
	wp_reset_postdata();
}

/*
* for most use of the get_term cached 
* This is because all time it hits and single page provide data quickly
*/
function get_img( $img ){
	$img = get_stylesheet_directory_uri() . '/assets/img/' . $img;
	return $img;
}
function get_css( $file ){
	$file = get_stylesheet_directory_uri() . '/assets/css/' . $file . '.css';
	return $file;
}
function get_js( $file ){
	$file = get_stylesheet_directory_uri() . '/assets/js/' . $file . '.js';
	return $file;
}
function filter_content( $content ){
	// wp filters
	$content = wptexturize( $content );
	$content = convert_smilies( $content );
	$content = convert_chars( $content );
	$content = wpautop( $content );
	$content = shortcode_unautop( $content );

	// remove shortcodes
	$pattern= '/\[(.+?)\]/';
	$content = preg_replace( $pattern,'',$content );

	// remove tags
	$content = strip_tags( $content );

	return $content;
}

function get_current_post_content( $post = false ) {
	if ( !$post ) {
		$post = get_post();				
	}
	$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
	$content = filter_content( $content );
	return $content;
}

function cached_get_term_by( $field, $value, $taxonomy, $output = OBJECT, $filter = 'raw' ){
	// ID lookups are cached
	if ( 'id' == $field )
		return get_term_by( $field, $value, $taxonomy, $output, $filter );

	$cache_key = $field . '|' . $taxonomy . '|' . md5( $value );
	$term_id = wp_cache_get( $cache_key, 'get_term_by' );

	if ( false === $term_id ){
		$term = get_term_by( $field, $value, $taxonomy );
		if ( $term && ! is_wp_error( $term ) )
			wp_cache_set( $cache_key, $term->term_id, 'get_term_by' );
		else
			wp_cache_set( $cache_key, 0, 'get_term_by' ); // if we get an invalid value, let's cache it anyway
	} else {
		$term = get_term( $term_id, $taxonomy, $output, $filter );
	}

	if ( is_wp_error( $term ) )
		$term = false;

	return $term;
}

/*for avobe reason*/
function cached_get_term_link( $term, $taxonomy = null ){
	// ID- or object-based lookups already result in cached lookups, so we can ignore those.
	if ( is_numeric( $term ) || is_object( $term ) ){
		return get_term_link( $term, $taxonomy );
	}

	$term_object = cached_get_term_by( 'slug', $term, $taxonomy );
	return get_term_link( $term_object );
}

/*only to show the first category in the post - primary category*/
function tripfery_if_term_exists( $term, $taxonomy = '', $parent = null ){
	if ( null !== $parent ){
		return term_exists( $term, $taxonomy, $parent );
	}

	if ( ! empty( $taxonomy ) ){
		$cache_key = $term . '|' . $taxonomy;
	}else{
		$cache_key = $term;
	}

	$cache_value = wp_cache_get( $cache_key, 'term_exists' );

	//term_exists frequently returns null, but (happily) never false
	if ( false  === $cache_value ){
		$term_exists = term_exists( $term, $taxonomy );
		wp_cache_set( $cache_key, $term_exists, 'term_exists' );
	}else{
		$term_exists = $cache_value;
	}

	if ( is_wp_error( $term_exists ) )
		$term_exists = null;

	return $term_exists;
}

// Head Script
if( !function_exists( 'tripfery_head' ) ) {
	function tripfery_head(){
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}	
}
add_action( 'wp_head', 'tripfery_head', 1 );

//find the post type function 
if ( ! function_exists ( 'tripfery_post_type' ) ) {
	function tripfery_post_type() {
		$tripfery_post_type_var =get_post_type( get_the_ID());
		echo esc_html( $tripfery_post_type_var );
	}
}

/*next previous post links*/
if ( !function_exists( 'tripfery_post_links_next_prev' ) ) {
	function tripfery_post_links_next_prev() {
	$next_post = get_next_post();
    $previous_post = get_previous_post();	
	?>
	<div class="divider post-navigation">
		<?php if ( !empty( get_next_post_link())){ ?>
			<div class="rt-nav-post <?php if ( empty( get_previous_post_link())){ ?>-offset-md-6<?php } ?> <?php if ( is_rtl() ){ echo esc_attr( 'text-left' ); } else { echo esc_attr( 'text-left' ); } ?>">
				<div class="pad-lr-15">
					<?php if( has_post_thumbnail() ) { ?>
					<div class="nav-image">
						<?php next_post_link('%link', get_the_post_thumbnail($next_post->ID,'thumbnail'));?>
					</div>
					<?php } ?>
					<div class="nav-text">
						<span class="nav-article prev-article">
							<?php next_post_link( '%link', esc_html__('Previous Post' , 'tripfery' ) );?>
						</span>
						<?php next_post_link( '<h4 class="post-nav-title">%link</h4>' ); ?>
					</div>

				</div>			
			</div>
		<?php } ?>
		<?php if ( !empty( get_previous_post_link())){ ?>
			<div class="rt-nav-post  <?php if ( empty( get_next_post_link())){ ?>offset-md-6<?php } ?> <?php if ( is_rtl() ){ echo esc_attr( 'text-right' ); } else { echo esc_attr( 'text-right' ); } ?>">
				<div class="pad-lr-15">
					<div class="nav-image">
						<?php next_post_link('%link', get_the_post_thumbnail($previous_post->ID,'thumbnail'));?>
					</div>
					<div class="nav-text">
						<span class="nav-article prev-article">
							<?php previous_post_link( '%link', esc_html__('Next Post' , 'tripfery' ) );?>
						</span>
						<?php previous_post_link('<h4 class="post-nav-title">%link</h4>'); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php }
}

/*Remove the archive label*/
function tripfery_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'tripfery_archive_title' );

/*facebook post image setup*/
function insert_social_in_head() {
	global $post;

	if ( ! isset( $post ) ) {
		return;
	}

	$title = get_the_title();

	if ( is_singular('post') ) {
		$link = get_the_permalink() . '?v='.time();
		echo '<meta property="og:url" content="' . $link . '" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:title" content="' . $title . '" />';

		if ( ! empty( $post->post_content ) ) {
			echo '<meta property="og:description" content="' . wp_trim_words( $post->post_content,
					150 ) . '" />';
		}
		$attachment_id = get_post_thumbnail_id( $post->ID );
		if ( ! empty( $attachment_id ) ) {
			$thumbnail = wp_get_attachment_image_src( $attachment_id, 'full' );
			if ( ! empty( $thumbnail ) ) {
				$thumbnail[0] .= '?v='.time();
				echo '<meta property="og:image" content="' . $thumbnail[0] . '" />';
			}
		}
		echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '" />';
		echo '<meta name="twitter:card" content="summary" />';
		echo '<meta property="og:updated_time" content="'.time().'" />';
	}
}
add_action( 'wp_head', 'insert_social_in_head' );

// define the language_attributes callback 
add_filter( 'language_attributes', 	'filter_language_attributes', 10, 2 ); 
function filter_language_attributes( $output, $doctype ) { 
    $attributes = array();

    if ( function_exists( 'is_rtl' ) && is_rtl() )
            $attributes[] = 'dir="rtl"';

    if ( $lang = get_bloginfo('language') ) {
            if ( get_option('html_type') == 'text/html' || $doctype == 'html' )
                    $attributes[] = "lang=\"$lang\"";

            if ( get_option('html_type') != 'text/html' || $doctype == 'xhtml' )
                    $attributes[] = "xml:lang=\"$lang\"";
    }

    $output = implode(' ', $attributes);

    return $output; 
}

//W3C validator passing code
function w3c_validator() {
    ob_start( function( $buffer ){
        $buffer = str_replace( array( '<script type="text/javascript">', "<script type='text/javascript'>" ), '<script>', $buffer );
        return $buffer;
    });
    ob_start( function( $buffer2 ){
        $buffer2 = str_replace( array( "<script type='text/javascript' src" ), '<script src', $buffer2 );
        return $buffer2;
    });
    ob_start( function( $buffer3 ){
        $buffer3 = str_replace( array( 'type="text/css"', "type='text/css'", 'type="text/css"', ), '', $buffer3 );
        return $buffer3;
    });
    ob_start( function( $buffer4 ){
        $buffer4 = str_replace( array( '<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"', ), '<iframe', $buffer4 );
        return $buffer4;
    });
	ob_start( function( $buffer5 ){
        $buffer5 = str_replace( array( 'aria-required="true"', ), '', $buffer5 );
        return $buffer5;
    });
}
add_action( 'template_redirect',  'w3c_validator' );