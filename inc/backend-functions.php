<?php 

function create_post_types() {

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

  register_taxonomy( 'topics', array('letter', 'pv_book', 'interviews', 'pv_library'), $args );


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


  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Path', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Path', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Paths', 'plumvillage' ),
    'popular_items'              => __( 'Popular Paths', 'plumvillage' ),
    'all_items'                  => __( 'All Paths', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Path', 'plumvillage' ),
    'update_item'                => __( 'Edit Path', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Path', 'plumvillage' ),
    'new_item_name'              => __( 'New Path name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Paths.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Paths', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Paths', 'plumvillage' ),
    'not_found'                  => __( 'No Paths found.', 'plumvillage' ),
    'menu_name'                  => __( 'Path', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
  );

  register_taxonomy( 'monastic_path', array('monastics'), $args );


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
      'rewrite' => array('slug' => _x( 'about/thich-nhat-hanh/letters', 'TNH letters slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'author')
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
      'rewrite' => array('slug' => _x( 'about/thich-nhat-hanh/interviews-with-thich-nhat-hanh', 'TNH interviews slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail', 'author')
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
      'rewrite' => array('slug' => _x( 'about/thich-nhat-hanh/thich-nhat-hanhs-health', 'TNH health slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail', 'author')
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
      'rewrite' => array('slug' => _x( 'about/thich-nhat-hanh/press', 'TNH Press slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'author')
    )
  );

  register_post_type( 'monastics',
    array(
      'labels' => array(
        'name'               => _x( 'Monastics', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Monastic', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Monastics', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Monastics', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit Monastics', 'plumvillage' ),
        'view_item'          => __( 'View Page', 'plumvillage' ),
        'all_items'          => __( 'All Monastics', 'plumvillage' ),
        'search_items'       => __( 'Search Monastics', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Monastics found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,      
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-groups',
      'rewrite' => array('slug' => _x( 'monastics', 'Monastic slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail')
    )
  );

  register_post_type( 'practice_centre',
    array(
      'labels' => array(
        'name'               => _x( 'Practice Centres', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Practice Centre', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Practice Centres', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Practice Centres', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'New', 'plumvillage' ),
        'add_new_item'       => __( 'Add New', 'plumvillage' ),
        'new_item'           => __( 'New', 'plumvillage' ),
        'edit_item'          => __( 'Edit Practice Centres', 'plumvillage' ),
        'view_item'          => __( 'View Practice Centre', 'plumvillage' ),
        'all_items'          => __( 'All Practice Centres', 'plumvillage' ),
        'search_items'       => __( 'Search Practice Centres', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Practice Centres found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-admin-site',
      'rewrite' => array('slug' => _x( 'practice-centre', 'Practice Centre slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail')
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
      'taxonomies' => array('language'), 
      'show_in_menu' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-calendar-alt',      
      'rewrite' => array('slug' => _x( 'retreats/info', 'URL Retreats slug', 'plumvillage' )),
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


  register_post_type( 'pv_library',
    array(
      'labels' => array(
        'name'               => _x( 'Library', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Library Item', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Library', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Library', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'Add Library Item', 'plumvillage' ),
        'add_new_item'       => __( 'Add New Library Item', 'plumvillage' ),
        'new_item'           => __( 'New Library Item', 'plumvillage' ),
        'edit_item'          => __( 'Edit Library Item', 'plumvillage' ),
        'view_item'          => __( 'View Library Item', 'plumvillage' ),
        'all_items'          => __( 'All Library', 'plumvillage' ),
        'search_items'       => __( 'Search Library', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Library Item found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-portfolio',      
      'rewrite' => array('slug' => _x( 'library', 'URL library slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail')
    )
  );


}
add_action( 'init', 'create_post_types' );


/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page() {
  add_menu_page(
		__( 'Topics', 'plumvillage' ),
		'Topics',
		'manage_options',
		'edit-tags.php?taxonomy=topics',
		'',
		'dashicons-tag',
		6
  );
  add_menu_page('Thich Nhat Hanh', 'Thich Nhat Hanh', 'manage_options',  'post.php?post=7703&action=edit', '', 'dashicons-admin-users');


  // Show donations in all languages by default
	global $menu, $submenu;
	$parent = 'edit.php?post_type=give_forms';
	if(isset($submenu[$parent]) ){
		foreach( $submenu[$parent] as $k => $d ){
			// var_export($d['2']);
    	if( $d['2'] == 'give-payment-history' ) {
      	$submenu[$parent][$k]['2'] = 'edit.php?post_type=give_forms&page=give-payment-history&lang=all';
      	break;
    	}
		}
	}

}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );


// select submenu for donations when selected
add_filter('parent_file', 'my_plugin_select_submenu');
function my_plugin_select_submenu($file) {
	global $plugin_page;
	if ('give-payment-history' == $plugin_page) {
	    $plugin_page = 'edit.php?post_type=give_forms&page=give-payment-history&lang=all';
	}
	return $file;
}


// Delete not needed menu items
function edit_admin_menus() {
    // global $menu;
    // global $submenu;
        
    // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=practise-centres' );
}
add_action( 'admin_menu', 'edit_admin_menus' );


// Set active Topics in menu
add_action( 'parent_file', 'prefix_highlight_taxonomy_parent_menu' );
function prefix_highlight_taxonomy_parent_menu( $parent_file ) {
	if ( get_current_screen()->taxonomy == 'topics' ) {
		$parent_file = 'edit-tags.php?taxonomy=topics';
	}
	return $parent_file;
}


// Tinymce changes
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => '.special-link',  
			'inline' => 'span',  
			'classes' => 'special-link',			
		),  
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = wp_json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

// add the editor style for tinymce in ACF options
add_editor_style();

/**
 * Add support for custom color palettes in Gutenberg.
 */
function tabor_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Sun', 'plumvillage' ),
				'slug' => 'sun',
				'color' => '#FFD22A',
			),
			array(
				'name'  => esc_html__( 'Earth', 'plumvillage' ),
				'slug' => 'earth',
				'color' => '#8B572A',
			),
			array(
				'name'  => esc_html__( 'Ink', 'plumvillage' ),
				'slug' => 'ink',
				'color' => '#000',
			),
			array(
				'name'  => esc_html__( 'Grey', 'plumvillage' ),
				'slug' => 'grey',
				'color' => '#9A9A9A',
			),
			array(
				'name'  => esc_html__( 'Medium Grey', 'plumvillage' ),
				'slug' => 'medium-grey',
				'color' => '#C7C7C7',
			),
			array(
				'name'  => esc_html__( 'Fresh Grey', 'plumvillage' ),
				'slug' => 'fresh-grey',
				'color' => '#F3F3F3',
			),
			array(
				'name'  => esc_html__( 'Fresh Sun', 'plumvillage' ),
				'slug' => 'fresh-sun',
				'color' => '#FEFBF3',
			),
			array(
				'name'  => esc_html__( 'Fresh Earth', 'plumvillage' ),
				'slug' => 'fresh-earth',
				'color' => '#FAF1EB',
			),
			array(
				'name'  => esc_html__( 'Fresh Tree', 'plumvillage' ),
				'slug' => 'fresh-tree',
				'color' => '#F5F5EF',
			),
			array(
				'name'  => esc_html__( 'Cloud', 'plumvillage' ),
				'slug' => 'cloud',
				'color' => '#fff',
			),
		)
	);
}
add_action( 'after_setup_theme', 'tabor_gutenberg_color_palette' );

// Reorder the admin menu
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
     
    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'edit.php?post_type=page', // Pages
        'post.php?post=7703&action=edit',
        'edit.php?post_type=pv_library',
        'edit.php?post_type=pv_book',
        'edit.php?post_type=pv_event',
        'edit.php', // Posts
        'edit.php?post_type=practice_centre',
        'edit.php?post_type=monastics',
        'edit-comments.php',
        'edit-tags.php?taxonomy=topics',
        'upload.php', // Media
        'acf-options',
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order'); // Activate custom_menu_order


/**
 * Remove "Multilingual Content Setup" meta box
 */

add_action( 'admin_head', 'pv_remove_wpml_meta_box' );
function pv_remove_wpml_meta_box() {
	$screen = get_current_screen();
	remove_meta_box( 'icl_div_config', $screen->post_type, 'normal' );
}


/**
* Define default terms for custom taxonomies in WordPress 3.0.1
*
*/

function pv_set_default_object_terms( $post_id, $post ) {
	if ( 'publish' === $post->post_status && $post->post_type === 'monastics' ) {
		$defaults = array(
			'monastic_path' => array( 'novices' )
		);
		$taxonomies = get_object_taxonomies( $post->post_type );

		foreach ( (array) $taxonomies as $taxonomy ) {
			$terms = wp_get_post_terms( $post_id, $taxonomy );
			if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
			}
		}
	}
}
add_action( 'save_post', 'pv_set_default_object_terms', 100, 2 );

// hide Seo Framework Column in overviews

add_action( 'current_screen', 'so_hide_seo_backend_output_cpt', 9 );

function so_hide_seo_backend_output_cpt( $current_screen ) {
	add_filter( 'the_seo_framework_show_seo_column', '__return_false' );
}

// replace 'podcast' with 'audio' in the rss feed
add_filter( 'ssp_archive_slug', 'ssp_modify_podcast_archive_slug' );
function ssp_modify_podcast_archive_slug ( $slug ) {
  return 'audio';
}

add_filter( 'ssp_feed_slug', 'ssp_modify_podcast_feed_slug' );
function ssp_modify_podcast_feed_slug ( $slug ) {
  return 'audio';
}

// Podcasts
function filter_the_title_rss( $post_post_title ) { 
    // make filter magic happen here... 
    global $post;
    $monastics = get_field('many2many_library_monastics', $post->ID);
    if($monastics){
      $i = 0;
      foreach( $monastics as $monastic) :
        $post_post_title .= ($i == 0) ? ' — ' : ', ';        
        $post_post_title .= process_monastic_name(get_the_title($monastic));
        $i++;
      endforeach;
    }
    $practice_centres = get_field('many2many_library_practice_centre', $post->ID);
    if($practice_centres){
      $i = 0;
      foreach( $practice_centres as $practice_centre) :
        if(!wp_get_post_parent_id($practice_centre)) :
          $post_post_title .= ($i == 0) ? ' — ' : ', ';        
          $post_post_title .= get_the_title($practice_centre);
          $i++;
        endif;
      endforeach;
    }

    return $post_post_title; 
}; 
         
add_filter( 'the_title_rss', 'filter_the_title_rss', 10, 1 ); 


// changing the admin columns for the library items
add_filter( 'manage_pv_library_posts_columns', 'pv_library_filter_posts_columns' );
function pv_library_filter_posts_columns( $columns ) {
	$columns = array(
    'cb' => $columns['cb'],
    'title' => __( 'Title' ),
    'dharma-teachers' => __( 'Dharma Teachers', 'plumvillage' ),
    'location' => __( 'Location', 'plumvillage' ),
    'taxonomy-series' => $columns['taxonomy-series'],
    'date' => $columns['date'],
  );

  return $columns;
}


add_action( 'manage_pv_library_posts_custom_column', 'pv_library_column', 10, 2);
function pv_library_column( $column, $post_id ) {
  // Dharma Teachers column
  if ( $column == 'dharma-teachers' ) {
    $monastics = get_field('many2many_library_monastics', $post_id);
    $title = '';
    if($monastics){
      $i = 0;
      foreach( $monastics as $monastic) :
        $title .= ($i == 0) ? '' : ', ';        
        $title .= process_monastic_name(get_the_title($monastic));
        $i++;
      endforeach;
    }
    echo $title;
  }  

  if ( $column == 'location' ) {
    $practice_centres = get_field('many2many_library_practice_centre', $post_id);
    $title = '';
    if($practice_centres){
      $i = 0;
      foreach( $practice_centres as $practice_centre) :
        $title .= ($i == 0) ? '' : ', ';        
        $title .= get_the_title($practice_centre);
        $i++;
      endforeach;
    }
    echo $title;
  }  
}

// changing the admin columns for the event items
add_filter( 'manage_pv_event_posts_columns', 'pv_event_filter_posts_columns' );
function pv_event_filter_posts_columns( $columns ) {
	$columns = array(
    'cb' => $columns['cb'],
    'title' => __( 'Title' ),
    'location' => __( 'Location', 'plumvillage' ),
    'date' => $columns['date'],
  );

  return $columns;
}


add_action( 'manage_pv_event_posts_custom_column', 'pv_event_column', 10, 2);
function pv_event_column( $column, $post_id ) {

  if ( $column == 'location' ) {
    $practice_centres = get_field('many2many_event_practice_centre', $post_id);
    $title = '';
    if($practice_centres){
      $i = 0;
      foreach( $practice_centres as $practice_centre) :
        $title .= ($i == 0) ? '' : ', ';        
        $title .= get_the_title($practice_centre);
        $i++;
      endforeach;
    }
    echo $title;
  }  
}

