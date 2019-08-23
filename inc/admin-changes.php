<?php 

/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page() {
  add_menu_page(
		__( 'Practise Centres', 'plumvillage' ),
		'Practise Centres',
		'manage_options',
		'edit-tags.php?taxonomy=practise-centres',
		'',
		'dashicons-admin-site',
		6
  );
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
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );


// Delete not needed menu items
function edit_admin_menus() {
    global $menu;
    global $submenu;
        
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=practise-centres' );
}
add_action( 'admin_menu', 'edit_admin_menus' );


// Set active Practise Centres in menu
add_action( 'parent_file', 'prefix_highlight_taxonomy_parent_menu' );
function prefix_highlight_taxonomy_parent_menu( $parent_file ) {
	if ( get_current_screen()->taxonomy == 'practise-centres' ) {
		$parent_file = 'edit-tags.php?taxonomy=practise-centres';
	}
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
        'edit.php?post_type=pv_book',
        'edit.php?post_type=event',
        'edit.php', // Pages
        'edit-comments.php',
        'edit-tags.php?taxonomy=practise-centres',
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
