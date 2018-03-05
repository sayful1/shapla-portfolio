<?php
/**
 * Shapla Portfolio functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Shapla Portfolio
 */

if ( ! function_exists( 'shapla_portfolio_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shapla_portfolio_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shapla Portfolio, use a find and replace
		 * to change 'shapla-portfolio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shapla-portfolio', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1170, 390, true );
		add_image_size( 'portfolio-thumbnails', 370, 370, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'    => esc_html__( 'Primary Menu', 'shapla-portfolio' ),
			'social-nav' => esc_html__( 'Social Link Menu', 'shapla-portfolio' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * ShaplaTools
		 */
		add_theme_support( 'shaplatools', array(
			'slider',
			'portfolio'
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shapla_portfolio_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif; // shapla_portfolio_setup
add_action( 'after_setup_theme', 'shapla_portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shapla_portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shapla_portfolio_content_width', 970 );
}

add_action( 'after_setup_theme', 'shapla_portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shapla_portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Sections', 'shapla-portfolio' ),
		'id'            => 'sidebar-homepage',
		'description'   => __( 'Here you can configure the layout of the Homepage.', 'shapla-portfolio' ),
		'before_widget' => '<section id="%1$s" class="section-homepage %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="section-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'shapla-portfolio' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets for first column of footer.', 'shapla-portfolio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'shapla-portfolio' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets for second column of footer.', 'shapla-portfolio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'shapla-portfolio' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets for third column of footer.', 'shapla-portfolio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'shapla-portfolio' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets for fourth column of footer.', 'shapla-portfolio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'shapla_portfolio_widgets_init' );

if ( ! function_exists( 'is_shaplatools_activated' ) ):
	/**
	 * Check ShaplaTools installed and activated
	 */
	function is_shaplatools_activated() {
		return ( class_exists( 'ShaplaTools' ) ) ? true : false;
	}
endif;


/**
 * Enqueue scripts and styles.
 */
function shapla_portfolio_scripts() {
	$assets = get_template_directory_uri() . '/assets';

	wp_enqueue_style( 'shapla-portfolio', get_stylesheet_uri() );

	wp_register_style( 'bootstrap', $assets . '/bootstrap/css/bootstrap.min.css',
		array( 'shapla-portfolio' ), '3.3.7', 'all' );

	wp_register_script( 'bootstrap', $assets . '/bootstrap/js/bootstrap.min.js',
		array( 'jquery' ), '3.3.7', true );


	wp_enqueue_script( 'plugins-js', $assets . '/js/plugins.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'shapla-portfolio', $assets . '/js/main.js', array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'shapla-portfolio', 'ShaplaPortfolio', array(
		'is_sticky_header' => true,
	) );

	// Load the html5 shiv.
	wp_enqueue_script( 'shapla-portfolio-html5', $assets . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'shapla-portfolio-html5', 'conditional', 'lt IE 9' );

	if ( ! is_shaplatools_activated() ) {

		wp_register_style( 'font-awesome', $assets . '/font-awesome/css/font-awesome.min.css',
			array(), '4.1.0', 'all' );

		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/shuffle/jquery.shuffle.modernizr.min.js', array(), '3.2', true );
		wp_register_script( 'shuffle', get_template_directory_uri() . '/assets/shuffle/jquery.shuffle.min.js', array(
			'jquery',
			'modernizr'
		), '3.2', true );

	}
	wp_register_script( 'shuffle-custom', get_template_directory_uri() . '/assets/shuffle/shuffle-custom.js', array(
		'jquery',
		'shuffle'
	), '3.2', true );

	// Enqueue Styles & Scripts
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_script( 'bootstrap' );

	if ( is_page_template( 'template-portfolio-filterable.php' ) ) {
		wp_enqueue_script( 'shuffle' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'shuffle-custom' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'shapla_portfolio_scripts' );

/**
 * Make the "read more" link to the post
 */
function shapla_portfolio_excerpt_more() {
	return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'shapla-portfolio' ) . '</a>';
}

add_filter( 'excerpt_more', 'shapla_portfolio_excerpt_more' );

/**
 * Custom template tags for this theme.
 */
require dirname( __FILE__ ) . '/inc/init.php';
