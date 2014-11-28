<?php
/**
 * MyOOS functions and definitions
 *
 * @package MyOOS
 */

/*
 * Set Proper Parent/Child theme paths for inclusion
 */
define( 'MYOOS_THEME_NAME', 'MyOOS');
define( 'PARENT_DIR', get_template_directory() );
define( 'PARENT_URL', get_template_directory_uri() );
 

/**
 * Add Redux Framework & extras
 */
require PARENT_DIR . '/admin/admin-init.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

/**
 * Add Redux Framework & extras
 */
require PARENT_DIR . '/admin/admin-init.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'myoos_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function myoos_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MyOOS, use a find and replace
	 * to change 'myoos' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'myoos', PARENT_DIR . '/languages' );

	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'myoos' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'myoos_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // myoos_setup
add_action( 'after_setup_theme', 'myoos_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function myoos_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'myoos' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'myoos_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function myoos_scripts() {
	wp_enqueue_style( 'myoos-style', get_stylesheet_uri() );

	wp_enqueue_script( 'myoos-navigation', PARENT_URL . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'myoos-skip-link-focus-fix', PARENT_URL . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'myoos_scripts' );


// Register Theme Features
function custom_theme_features()  {

	// Add theme support for Translation
	load_theme_textdomain( 'redux-framework', PARENT_DIR . '/admin/redux-framework/ReduxCore/languages' );
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'custom_theme_features' );

/**
 * Implement the Custom Header feature.
 */
//require PARENT_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require PARENT_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require PARENT_DIR . '/inc/extras.php';

/**
 * Customizer additions.
 */
require PARENT_DIR . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require PARENT_DIR . '/inc/jetpack.php';
