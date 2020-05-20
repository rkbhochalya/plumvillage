<?php
/**
 * Plum Village functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Plum_Village
 */

if ( ! function_exists( 'plumvillage_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function plumvillage_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Plum Village, use a find and replace
		 * to change 'plumvillage' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'plumvillage', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'plumvillage' ),
			'secondary-menu' => esc_html__( 'Secondary Menu', 'plumvillage' ),
      'publishing-menu' => esc_html__( 'Publishing', 'plumvillage' ),
      'initiatives-menu' => esc_html__( 'Initiatives', 'plumvillage' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'plumvillage' ),
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


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add custom image size
    add_image_size( 'landscape', 480, 290, true ); 
    add_image_size( 'landscape-large', 720, 435, true ); 
    add_image_size( 'square', 720, 720, true ); 

		// Add theme support for wide and full alignment.
 		add_theme_support( 'align-wide' );
 		add_theme_support( 'align-full' );

 		//disable custom font size
 		add_theme_support('disable-custom-font-sizes');

 		//add support for excerpts on pages
		add_post_type_support( 'page', 'excerpt' );

 		add_theme_support( 'editor-font-sizes', array(
	    array(
	        'name' => __( 'Small', 'themeLangDomain' ),
	        'size' => 14,
	        'slug' => 'small'
	    ),
	    array(
	        'name' => __( 'Normal', 'themeLangDomain' ),
	        'size' => 16,
	        'slug' => 'normal'
	    ),
	    array(
	        'name' => __( 'Large', 'themeLangDomain' ),
	        'size' => 30,
	        'slug' => 'large'
	    )
		) );

	}
endif;
add_action( 'after_setup_theme', 'plumvillage_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function plumvillage_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'plumvillage_content_width', 640 );
}
add_action( 'after_setup_theme', 'plumvillage_content_width', 0 );


add_filter( 'auto_update_plugin', '__return_true' );

/**
 * Enqueue scripts and styles.
 */
function plumvillage_scripts() {
	// load styles
	wp_enqueue_style( 'plumvillage-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

	//load fonts
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,600&display=swap');
  wp_enqueue_style('typkit-fonts', 'https://use.typekit.net/foc4drj.css');

	// load magic
  wp_enqueue_script( 'plumvillage-js-trint', get_template_directory_uri() . '/assets/js/trint-player.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/trint-player.js' ), true );
  wp_enqueue_script( 'plumvillage-js-scripts', get_template_directory_uri() . '/assets/js/scripts-dist.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/scripts-dist.js' ), true );
  wp_localize_script( 'plumvillage-js-scripts', 'pvAjax', array( 
    'ajaxurl' => admin_url( 'admin-ajax.php' ), 
    'maybetry' => __('Maybe try breathing', 'plumvillage'),
    'human' => trim(strtolower(get_field('newsletter_form_answer', 'options'))), 
    'gacode' => get_field('google_analytics_code', 'options')
  ) );
}
add_action( 'wp_enqueue_scripts', 'plumvillage_scripts', 100 );

/**
 * Dequeue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
  
    wp_dequeue_style( 'wp-editor-font' );
    wp_deregister_style( 'wp-editor-font' );


    wp_dequeue_style( 'jquery-ui-style' );
    wp_deregister_style( 'jquery-ui-style' );

    wp_dequeue_script( 'jquery-ui-core' );
    wp_deregister_script( 'jquery-ui-core' );

    // remove give styles
    wp_dequeue_style( 'give_recurring_css' );
    wp_deregister_style( 'give_recurring_css' );

    wp_dequeue_style( 'give-styles' );
    wp_deregister_style( 'give-styles' );

    // remove give scripts
    wp_dequeue_script('give-stripe-js');
    wp_dequeue_script('give-stripe-checkout-js');
    wp_dequeue_script('give-stripe-popup-js');
    wp_dequeue_script('give-stripe-onpage-js');
    wp_dequeue_script('give');
    wp_dequeue_script('give-stripe-payment-request-js');
    wp_dequeue_script('give_recurring_script');


    // remove seriously simple podcasting styles
    wp_dequeue_style( 'ssp-block-gizmo-fonts-style' );
    wp_deregister_style( 'ssp-block-gizmo-fonts-style' );
    wp_dequeue_style( 'ssp-block-style' );
    wp_deregister_style( 'ssp-block-style' );
    wp_dequeue_style( 'ssp-block-fonts-style' );
    wp_deregister_style( 'ssp-block-fonts-style' );
    wp_dequeue_style( 'ssp-frontend-player' );
    wp_deregister_style( 'ssp-frontend-player' );

    // remove elasticpress style
    wp_dequeue_style( 'elasticpress-related-posts-block' );
    wp_deregister_style( 'elasticpress-related-posts-block' );
    

}


// rewrite rules for attachment
function attachment_rewrite_rule() {
  $attachment_slug = 'attachment';

  // Add the rewrite rule.
  add_rewrite_rule('^' . $attachment_slug . '/([^/]*)/?', 'index.php?attachment=$matches[1]', 'top');
} 

add_action( 'init', 'attachment_rewrite_rule', 10, 0 );

// change the link of attachment
function custom_attachment_link( $link, $post_id ){

  $attachment_slug = 'attachment'; // Attachment base or custom base.

  $post = get_post( $post_id );
  $link = home_url( '/' . $attachment_slug . '/' . $post->post_name . '/' );

  return $link;
} 

add_filter( 'attachment_link', 'custom_attachment_link', 10, 2 );



// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'plumvillage_add_gutenberg_assets', 100 );

/**
 * Load Gutenberg stylesheet.
 */
function plumvillage_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'plumvillage-gutenberg', get_theme_file_uri( 'editor-gutenberg-style.css' ), array(), filemtime(get_stylesheet_directory( 'editor-gutenberg-style.css' )) );

  //load fonts
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,600&display=swap');
  wp_enqueue_style('typkit-fonts', 'https://use.typekit.net/foc4drj.css');

	wp_enqueue_script( 'plumvillage-gutenberg-js', get_template_directory_uri() . '/assets/js/gutenberg.js', array('wp-blocks') );

}


/**
 * All the Admin Code
 */
require get_template_directory() . '/inc/backend-functions.php';


/**
 * All the Frontend Code
 */
require get_template_directory() . '/inc/frontend-functions.php';


/**
 * All the ACF code
 */
require get_template_directory() . '/inc/acf.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
