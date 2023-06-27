<?php
/**
 * tinyDancer functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tinyDancer
 * @since 1.0.0
 */
if ( !defined ( 'TINYDANCER_VER' ) ) { define ( 'TINYDANCER_VER', time() ); }
// FAST LOADER References ( find @#id in DocBlocks )
// ------------------------- Actions ---------------------------
// A1
add_action( 'after_setup_theme',   'tinydancer_theme_setup' );
// A2
add_action( 'after_setup_theme',     'tinydancer_theme_content_width', 0 );
// A3
add_action( 'wp_enqueue_scripts',      'tinydancer_theme_enqueue_styles' );
// A4
add_action( 'widgets_init',              'tinydancer_theme_widgets_init' );
// A5
add_action( 'admin_init',                  'tinydancer_theme_add_editor_styles' );
// A6
add_action( 'tinydancer_render_attachment', 'tinydancer_render_attachment_link' );
// A7
add_action( 'tinydancer_excerpt_attachment', 'tinydancer_excerpt_attachment_toanchor' );
// A8
add_action('tinydancer_render_hero', 'tinydancer_render_hero_section');
// A9
add_action( 'tinydancer_check_pagination', 'tinydancer_check_pagination_pre' );
// ------------------------- Filters -----------------------------
// F2
add_filter( 'widget_tag_cloud_args',    'tinydancer_theme_widget_tag_cloud_args' );
// F3
add_filter('excerpt_more',          'tinydancer_custom_excerpt_more'); 
// F4
add_filter( 'body_class',       'tinydancer_theme_heropage_class' );
// F5
add_filter('body_class',      'tinydancer_theme_browser_body_class');
// F6
add_filter( 'body_class',   'tinydancer_theme_bloglayout_class' );
/**
 * Add backwards compatibility support for wp_body_open function.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/** #A1
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own tinydancer_setup() function to override in a child theme.
 *
 * @since Classic Sixteen 1.0
 */
if ( ! function_exists( 'tinydancer_theme_setup' ) ) :

	function tinydancer_theme_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		* If you're building a theme based on tinydancer, use a find and replace
		* to change 'tinydancer' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'tinydancer', get_template_directory_uri() . '/languages' );

		/* a.
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		/* b.
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded "title" tag in the document head, and expect WordPress to provide it for us.
		*
		* Enable support for Post Thumbnails on posts and pages.
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		// a.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// b.
		add_theme_support( 'title-tag' );
    	add_theme_support( 'automatic-feed-links' ); // rss feederz
    
		/*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails', array( 'post', 'page') );
		// register new phone-landscape featured image size. @width, @height, and @crop
		add_image_size( 'tinydancer-featured', 520, 300, false);   
		add_image_size( 'tinydancer-hero-image', 1080, '' );
		/*
		 * Enable support for custom logo.
		 *
		 *  @since Classic Sixteen 1.2
		 */
		add_theme_support( 'custom-logo' );

		//page background image and color support
		add_theme_support( 'custom-background', 
			array( 
		   'default-color'      => '#fcfcfc',
		   'default-image'       => '',
		   'wp-head-callback'     => '_custom_background_cb',
		   'admin-head-callback'   => '',
		   'admin-preview-callback' => ''
		) );
		add_theme_support( 'custom-logo' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary-menu' => __( 'Primary Main Menu', 'tinydancer' ),
				'secondary-menu'  => __( 'Secondary Top Menu', 'tinydancer' ),
			)
		);
	}
endif;


/** #A2
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Classic Sixteen 1.0
 */
function tinydancer_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tinydancer_content_width', 520 );
}

/** #A3
 * Enqueues scripts and styles.
 *
 * @since Classic Sixteen 1.0
 */
function tinydancer_theme_enqueue_styles() {
	wp_enqueue_style( 
		'tinydancer-style', 
		get_stylesheet_directory_uri() .'/style.css',
		array(),
		TINYDANCER_VER
	);
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 
			'comment-reply' 
		);
	}

    wp_enqueue_script( 
		'tinydancer-script', 
		get_template_directory_uri() . '/rels/tinydancer-script.js', 
		array(), 
		TINYDANCER_VER, 
		true 
	);
/*
	wp_localize_script(
		'tinydancer-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'tinydancer' ),
			'collapse' => __( 'collapse child menu', 'tinydancer' ),
		)
	); */
}


/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Classic Sixteen 1.0
 */
function tinydancer_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'tinydancer' ),
			'id'            => 'sidebar-page',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'tinydancer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Section One', 'tinydancer' ),
			'id'            => 'footer-one',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tinydancer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Section Two', 'tinydancer' ),
			'id'            => 'footer-two',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tinydancer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
		array(
			'name'          => __( 'Footer Section Three', 'tinydancer' ),
			'id'            => 'footer-three',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tinydancer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/** #A5
 * Registers an editor stylesheet for the theme.
 *
 * @since 1.0.0
 */
function tinydancer_theme_add_editor_styles() {

    add_editor_style( 'editor-style.css' );
}


/**
 * Support for logo upload, output. 
 *
 * @since 1.0.1 
 */
function tinydancer_theme_custom_logo() {
    $output = '';

    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

        if ( has_custom_logo() ) {
            $output = '<div class="header-logo"><img src="'. esc_url( $logo[0] ) .'" 
            alt="'. get_bloginfo( 'name' ) .'"></div>'; 
        } else { 
            $output = ''; 
        }
    }

        // Output sanitized in header to assure all html displays.
        return $output;
}

/** #A6
 * Attachment link for featured images
 *
 * @since 1.0.2
 * @return HTML
 */
function tinydancer_render_attachment_link(){
?>  
    <figure class="linked-attachment-container">
    <a class="imgwrap-link"
       href ="<?php echo esc_url( get_attachment_link( get_post_thumbnail_id() ) ); ?>" 
       title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
    <?php 
    the_post_thumbnail( 'tinydancer-featured', array( 
            'itemprop' => 'image', 
            'class'  => 'tinydancer-featured',
            'alt'  => get_attachment_link( get_post_thumbnail_id() )
        ) 
    ); ?></a>
    </figure><?php 
}


/** #A7
 * Attachment render for excerpts
 *
 * @since 1.0.2
 * @return HTML
 */

function tinydancer_excerpt_attachment_toanchor(){

	?>                 
		<figure class="linked-attachment-container-sm">
		<a class="exceprtwrap-link"
		   href ="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" 
		   title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
		<?php 
		the_post_thumbnail( 'tinydancer-featured', array( 
				'itemprop' => 'image', 
				'class'  => 'tinydancer-featured',
				'alt'  => get_the_title()
			) 
		); ?></a>
		</figure><?php 
}

/** 
 * Customizer
 * suport footer background & text color
 * header background & color
 * page background & color
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/theme-page-options.php';

/** #A8
 * Render hero section
 * @since 1.0
 * @param string $himg Theme mod url of hero image.
 * @param string $hout Image inline as background.
 * @param string $htitle theme mod text
 * 
 */
function tinydancer_render_hero_section() {

	$cta_text = '';
	if ( get_theme_mods() )  : 
		
		$cta_url  = get_theme_mod( 'tinydancer_hero_calltourl' );
		$cta_text = get_theme_mod( 'tinydancer_hero_calltotext' );
	endif;

	// Check if the image really exists
	$himg = wp_get_attachment_url( get_theme_mod( 
		'tinydancer_hero_image' ) );
	if ( empty($himg) ) { 

		$himg = get_template_directory_uri() . '/imgs/default-hero.jpg'; 
	}
	$hout = 'style="background-image: url( '. $himg .' );"'; ?>

	<div class="home-wide-top">
		<div class="hero-inner-content" <?php print( $hout ); ?>>
			<header class="hgroup">
			<?php
			if( $htitle = get_theme_mod('tinydancer_hero_title') ) {

				echo '<h2 class="hero-title">' . $htitle . '</h2>';
			}
			if( $hheading = get_theme_mod( 'tinydancer_hero_heading', '' ) ) {

				echo '<h3 class="hero-heading">' . $hheading . '</h3>';
			} ?>
			</header>
			<?php if ( '' != $cta_text ) : ?>

			<div class="call-to-action">
				<span>
					<a class="button cta-tinyd" href="<?php 
						echo esc_url( $cta_url ); ?>" title=""><?php 
						echo esc_html( $cta_text ); ?></a>
				</span>
			</div>
			<?php endif; ?>

		</div>
	</div>
	<?php 
}

/** #A9
 * Show prenav text if pagination
 * 
 * @since 1.0
 * @param string $prev_link Boolean
 * @param string $next_link Boolean
 */
function tinydancer_check_pagination_pre(){
    $prev_link = get_previous_posts_link();
	$next_link = get_next_posts_link();
	
	if ($prev_link || $next_link) { 

	echo '<span class="prenav">' . esc_html__( 'More Pages', 'tinydancer' ) . '</span>';
	} else { 

	echo '<span class="prenav">' . esc_html__( 'No more entries for this page.', 'tinydancer' ) . '</span>';
	} 
}


/** #F2
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function tinydancer_theme_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}

/** #F3
 * Remove ellipsis and set read more text.
 * Dev note: Title attribute is not attribute realted, 
 * it is text from the theme_mod only. Only `get_the_title` would work
 * if you want the actual title of the post.
 */
function tinydancer_custom_excerpt_more($link) {
    //make sure admin tables not effected
    if ( is_admin() ) {
		return $link;
	}
    $post = get_post();
    if( get_theme_mods() ) {
    $title = get_theme_mod( 'tinydancer_readon_text_setting' );
    }
        $link = ' <a class="more-link" href="'. esc_url( get_permalink($post->ID) ) 
                . '" title="' . esc_attr( $title ) . '">' 
                . esc_html( $title ) .'</a>';
        return tinydancer_sanitize_text( $link );
}

/** #F4
 * Adding body class to the hero wide template page
 * 
 * @since 1.0
 */
function tinydancer_theme_heropage_class( $classes ) {
	if ( is_page_template( 'hero-page.php' ) ) {
        $classes[] = 'hero-page';
    }
	return $classes;
} 

/** #F5
 * Check if WordPress detected a specific browser and add body_class
 * 
 * @since 1.0
 * @param Global WP Browser detect
 * @return body class added to opening body tag
 */
function tinydancer_theme_browser_body_class($classes) { 
    global $is_iphone, $is_chrome, $is_safari, $is_NS4, $is_opera, $is_macIE, 
		   $is_winIE, $is_gecko, $is_lynx, $is_IE, $is_edge;
  
	if ($is_iphone)     $classes[] ='iphone-safari';
	elseif ($is_chrome) $classes[] ='google-chrome';
	elseif ($is_safari) $classes[] ='safari';
	elseif ($is_NS4)    $classes[] ='netscape';
	elseif ($is_opera)  $classes[] ='opera';
	elseif ($is_macIE)  $classes[] ='mac-ie';
	elseif ($is_winIE)  $classes[] ='windows-ie';
	elseif ($is_gecko)  $classes[] ='firefox';
	elseif ($is_lynx)   $classes[] ='lynx';
	elseif ($is_IE)     $classes[] ='internet-explorer';
	elseif ($is_edge)   $classes[] ='ms-edge';
	else $classes[] = 'unknown-browser';
		
	return $classes;
} 


/** #F6
 * Adding body class to the blog page flex option
 * 
 * @since 1.0
 */
function tinydancer_theme_bloglayout_class($classes){

	if ( !basename( get_page_template() ) === 'index.php' ) return $classes;
	
	if ( get_theme_mods() ) : 
		$dloop = get_theme_mod( 'tinydancer_blog_layout' );

		if ( 'row' == $dloop ) {
        	$classes[] = 'dancer-loop-horizontal';
		}

	endif;
	
	return $classes;
} 
