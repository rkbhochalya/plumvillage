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
		add_image_size( 'landscape', 480, 290, true ); // 220 pixels wide by 180 pixels tall, hard crop mode

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
	        'size' => 22,
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
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Cormorant+Infant:300i,500,500i,600|Merriweather+Sans:300,300i,400,700|Merriweather:300,300i&display=swap');

	// load magic
	wp_enqueue_script( 'plumvillage-js-scripts', get_template_directory_uri() . '/assets/js/scripts-dist.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/scripts-dist.js' ), true );


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

}


/**
 * Enqueue gutenberg script
 */
function gutenberg_enqueue() {
    wp_enqueue_script(
        'myguten-script',
        get_template_directory_uri() . '/assets/js/gutenberg.js', // For Parent Themes
        array('wp-blocks') // Include wp.blocks Package             
    );
}

add_action('enqueue_block_editor_assets', 'gutenberg_enqueue');

function create_post_types() {



  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                       => _x( 'Practice Centers', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Practice Center', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Practice Centers', 'plumvillage' ),
    'popular_items'              => __( 'Popular Practice Centers', 'plumvillage' ),
    'all_items'                  => __( 'All Practice Centers', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Practice Center', 'plumvillage' ),
    'update_item'                => __( 'Edit Practice Center', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Practice Center', 'plumvillage' ),
    'new_item_name'              => __( 'New Practice Center name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Practice Centers.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Practice Centers', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Practice Centers', 'plumvillage' ),
    'not_found'                  => __( 'No Practice Centers found.', 'plumvillage' ),
    'menu_name'                  => __( 'Practice Centers', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'					=> true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'practise-centres' ),
  );

  register_taxonomy( 'practise-centres', array('post', 'pv_event'), $args );

  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Topics', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Topic', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Topics', 'plumvillage' ),
    'popular_items'              => __( 'Popular Topics', 'plumvillage' ),
    'all_items'                  => __( 'All Topics', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Topic', 'plumvillage' ),
    'update_item'                => __( 'Edit Topic', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Topic', 'plumvillage' ),
    'new_item_name'              => __( 'New Topic name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Topics.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Topics', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Topics', 'plumvillage' ),
    'not_found'                  => __( 'No Topics found.', 'plumvillage' ),
    'menu_name'                  => __( 'Topics', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'					=> 'post.php?post=7703&action=edit',
    'show_in_rest'					=> true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'topic' ),
  );

  register_taxonomy( 'topics', array('letter', 'pv_book', 'interviews'), $args );


  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Types', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Type', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Types', 'plumvillage' ),
    'popular_items'              => __( 'Popular Types', 'plumvillage' ),
    'all_items'                  => __( 'All Types', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Type', 'plumvillage' ),
    'update_item'                => __( 'Edit Type', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Type', 'plumvillage' ),
    'new_item_name'              => __( 'New Type name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Types.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Types', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Types', 'plumvillage' ),
    'not_found'                  => __( 'No Types found.', 'plumvillage' ),
    'menu_name'                  => __( 'Types', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'          => 'post.php?post=7703&action=edit',
    'show_in_rest'          => false,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'type' ),
  );

  register_taxonomy( 'types', array('interviews'), $args );


  // Add new post type
	register_post_type( 'letter',
    array(
      'labels' => array(
        'name'               => _x( 'Letters', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Letter', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Letters', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Letters', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit Letter', 'plumvillage' ),
        'view_item'          => __( 'View Letter', 'plumvillage' ),
        'all_items'          => __( 'Letters', 'plumvillage' ),
        'search_items'       => __( 'Search Letters', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No letters found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('topics'), 
      'show_in_menu' => 'post.php?post=7703&action=edit',
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-media-text',      
      'rewrite' => array('slug' => 'about/thich-nhat-hanh/letters'),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments')
    )
  );

	register_post_type( 'interview',
    array(
      'labels' => array(
        'name'               => _x( 'Interviews', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Interview', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Interviews', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Interviews', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit Interview', 'plumvillage' ),
        'view_item'          => __( 'View Interview', 'plumvillage' ),
        'all_items'          => __( 'Interviews', 'plumvillage' ),
        'search_items'       => __( 'Search Interviews', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Interviews found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('topics', 'types'), 
      'show_in_menu' => 'post.php?post=7703&action=edit',
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-format-chat',      
      'rewrite' => array('slug' => 'about/thich-nhat-hanh/interviews-with-thich-nhat-hanh'),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail')
    )
  );	

  register_post_type( 'tnh_update',
    array(
      'labels' => array(
        'name'               => _x( 'Thich Nhat Hanh Updates', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Thich Nhat Hanh Update', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'TNH Update', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'TNH Update', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit TNH Update', 'plumvillage' ),
        'view_item'          => __( 'View TNH Update', 'plumvillage' ),
        'all_items'          => __( 'Updates', 'plumvillage' ),
        'search_items'       => __( 'Search TNH Update', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No TNH Update found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('topics'), 
      'show_in_menu' => 'post.php?post=7703&action=edit',
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-megaphone',      
      'rewrite' => array('slug' => 'about/thich-nhat-hanh/thich-nhat-hanhs-health'),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail')
    )
  );  

  register_post_type( 'tnh_press_release',
    array(
      'labels' => array(
        'name'               => _x( 'Thich Nhat Hanh Press Releases', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Thich Nhat Hanh Press Release', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'TNH Press Release', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'TNH Press Release', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit TNH Press Release', 'plumvillage' ),
        'view_item'          => __( 'View TNH Press Release', 'plumvillage' ),
        'all_items'          => __( 'Press Releases', 'plumvillage' ),
        'search_items'       => __( 'Search TNH Press Release', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No TNH Press Release found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('topics'), 
      'show_in_menu' => 'post.php?post=7703&action=edit',
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'about/thich-nhat-hanh/press'),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes')
    )
  );


  register_post_type( 'pv_event',
    array(
      'labels' => array(
        'name'               => _x( 'Events', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Event', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Events', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Events', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'Add Event', 'plumvillage' ),
        'add_new_item'       => __( 'Add New Event', 'plumvillage' ),
        'new_item'           => __( 'New Event', 'plumvillage' ),
        'edit_item'          => __( 'Edit Event', 'plumvillage' ),
        'view_item'          => __( 'View Event', 'plumvillage' ),
        'all_items'          => __( 'All Events', 'plumvillage' ),
        'search_items'       => __( 'Search Events', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Event found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('practise-centres', 'language'), 
      'show_in_menu' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-calendar-alt',      
      'rewrite' => array('slug' => 'retreats/info'),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail')
    )
  );

  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Retreat Languages', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Language', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Languages', 'plumvillage' ),
    'popular_items'              => __( 'Popular Languages', 'plumvillage' ),
    'all_items'                  => __( 'All Languages', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Language', 'plumvillage' ),
    'update_item'                => __( 'Edit Language', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Language', 'plumvillage' ),
    'new_item_name'              => __( 'New Language name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Languages.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Languages', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Languages', 'plumvillage' ),
    'not_found'                  => __( 'No Languages found.', 'plumvillage' ),
    'menu_name'                  => __( 'Retreat Languages', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => false,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'language' ),
  );

  register_taxonomy( 'language', array('pv_event'), $args );




}
add_action( 'init', 'create_post_types' );


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

	wp_enqueue_script( 'plumvillage-gutenberg-js', get_template_directory_uri() . '/assets/js/gutenberg-acf.js' );

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
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
