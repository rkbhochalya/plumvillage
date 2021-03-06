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
    'show_in_menu'					=> 'tnh',
    'show_in_rest'					=> true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'topic' ),
  );

  register_taxonomy( 'topics', array('post', 'letter', 'pv_book', 'interviews', 'pv_video', 'pv_audio'), $args );


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
    'show_in_menu'          => 'tnh',
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

  // Add taxonomies for books
  register_taxonomy( 'genre', 'pv_book', array(
	  'labels' => array(
			'name' => __( 'Genres'),
	        'singular_name' => __( 'Genre', 'plumvillage' ),
	        'menu_name' => __( 'Genres', 'plumvillage' ),
			'all_items' => __( 'All genres' ),
			'edit_item' => __( 'Edit genre' ),
			'view_item' => __( 'View genre' ),
			'update_item' => __( 'Update genre' ),
			'add_new_item' => __( 'Add new genre' ),
			'new_item_name' => __( 'New genre name' ),
			'search_items' => __( 'Search genres' ),
			'popular_items' => __( 'Popular genres' ),
			'separate_items_with_commas' => __( 'Separate genres with commas' ),
			'add_or_remove_items' => __( 'Add or remove genres' ),
			'choose_from_most_used' => __( 'Choose from the most used genres' ),
			'not_found' => __( 'No genres found' ),
	  )
  ) );
  register_taxonomy( 'subject', 'pv_book', array(
	  'labels' => array(
			'name' => __( 'Subjects'),
	        'singular_name' => __( 'Subject', 'plumvillage' ),
	        'menu_name' => __( 'Subjects', 'plumvillage' ),
			'all_items' => __( 'All subjects' ),
			'edit_item' => __( 'Edit subject' ),
			'view_item' => __( 'View subject' ),
			'update_item' => __( 'Update subject' ),
			'add_new_item' => __( 'Add new subject' ),
			'new_item_name' => __( 'New subject name' ),
			'search_items' => __( 'Search subjects' ),
			'popular_items' => __( 'Popular subjects' ),
			'separate_items_with_commas' => __( 'Separate subjects with commas' ),
			'add_or_remove_items' => __( 'Add or remove subjects' ),
			'choose_from_most_used' => __( 'Choose from the most used subjects' ),
			'not_found' => __( 'No subjects found' ),
	  )
  ) );
  register_taxonomy( 'book_author', 'pv_book', array(
	  'labels' => array(
			'name' => __( 'Author'),
	        'singular_name' => __( 'Author', 'plumvillage' ),
	        'menu_name' => __( 'Authors', 'plumvillage' ),
			'all_items' => __( 'All authors' ),
			'edit_item' => __( 'Edit author' ),
			'view_item' => __( 'View author' ),
			'update_item' => __( 'Update author' ),
			'add_new_item' => __( 'Add new author' ),
			'new_item_name' => __( 'New author name' ),
			'search_items' => __( 'Search authors' ),
			'popular_items' => __( 'Popular authors' ),
			'separate_items_with_commas' => __( 'Separate authors with commas' ),
			'add_or_remove_items' => __( 'Add or remove authors' ),
			'choose_from_most_used' => __( 'Choose from the most used authors' ),
			'not_found' => __( 'No authors found' ),
	  )
  ) );

  // Add books post type
  register_post_type( 'pv_book',
    array(
      'labels' => array(
        'name' => __( 'Books', 'plumvillage' ),
        'singular_name' => __( 'Book', 'plumvillage' ),
        'menu_name' => __( 'Books', 'plumvillage' ),
        'not_found' => __( 'No books found' ),
        'not_found_in_trash' => __( 'No books found in the trash'),
        'view_item' => __( 'View book' ),
        'new_item' => __( 'New book' ),
        'add_new_item' => __( 'Add new book' ),
        'edit_item' => __( 'Edit book' ),
        'search_items' => __ ( 'Search books' ),
      ),
      'public' => true,
      'has_archive' => false,
      'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
      'taxonomies' => array('genre', 'subject'),
      'show_in_menu' => 'library',
      'show_in_rest' => true,      
      'rewrite' => array(
	      'slug' => _x( 'books', 'Book slug', 'plumvillage' ),
      ),
      'query_var' => 'pv_books',
    )
  );

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
      'show_in_menu' => 'tnh',
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
      'show_in_menu' => 'tnh',
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
      'show_in_menu' => 'tnh',
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
      'show_in_menu' => 'tnh',
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
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
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
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
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
      'show_in_menu' => 'events',      
      'show_in_rest' => true,
      'rewrite' => array('slug' => _x( 'retreats/info', 'URL Retreats slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
    )
  );

  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Languages', 'taxonomy general name', 'plumvillage' ),
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

  register_taxonomy( 'language', array('pv_event', 'pv_online_event'), $args );
 
  register_post_type( 'pv_online_event',
    array(
      'labels' => array(
        'name'               => _x( 'Online Events', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Online Event', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Online Events', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Online Events', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'Add Online Event', 'plumvillage' ),
        'add_new_item'       => __( 'Add New Online Event', 'plumvillage' ),
        'new_item'           => __( 'New Online Event', 'plumvillage' ),
        'edit_item'          => __( 'Edit Online Event', 'plumvillage' ),
        'view_item'          => __( 'View Online Event', 'plumvillage' ),
        'all_items'          => __( 'All Online Events', 'plumvillage' ),
        'search_items'       => __( 'Search Online Events', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Online Event found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'taxonomies' => array('language', 'event_type'), 
      'show_in_menu' => 'events',      
      'show_in_rest' => true,
      'rewrite' => array('slug' => _x( 'online-events', 'URL Retreats slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
    )
  );

  // Add new taxonomy
  $labels = array(
    'name'                       => _x( 'Event Type', 'taxonomy general name', 'plumvillage' ),
    'singular_name'              => _x( 'Event Type', 'taxonomy singular name', 'plumvillage' ),
    'search_items'               => __( 'Search Event Types', 'plumvillage' ),
    'popular_items'              => __( 'Popular Event Types', 'plumvillage' ),
    'all_items'                  => __( 'All Event Types', 'plumvillage' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Event Type', 'plumvillage' ),
    'update_item'                => __( 'Edit Event Type', 'plumvillage' ),
    'add_new_item'               => __( 'Add new Event Type', 'plumvillage' ),
    'new_item_name'              => __( 'New Event Type name', 'plumvillage' ),
    'separate_items_with_commas' => __( 'Use commas when adding multiple Event Types.', 'plumvillage' ),
    'add_or_remove_items'        => __( 'Add or remove Event Types', 'plumvillage' ),
    'choose_from_most_used'      => __( 'Choose from most used Event Types', 'plumvillage' ),
    'not_found'                  => __( 'No Event Types found.', 'plumvillage' ),
    'menu_name'                  => __( 'Retreat Event Types', 'plumvillage' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'show_in_rest'          => false,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'event-type' ),
  );

  register_taxonomy( 'event_type', array('pv_online_event'), $args );


  register_post_type( 'pv_video',
    array(
      'labels' => array(
        'name'               => _x( 'Video', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Video Item', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Video', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'Add Video Item', 'plumvillage' ),
        'add_new_item'       => __( 'Add New Video Item', 'plumvillage' ),
        'new_item'           => __( 'New Video Item', 'plumvillage' ),
        'edit_item'          => __( 'Edit Video Item', 'plumvillage' ),
        'view_item'          => __( 'View Video Item', 'plumvillage' ),
        'all_items'          => __( 'Videos', 'plumvillage' ),
        'search_items'       => __( 'Search Video', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Video Item found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'show_in_menu' => 'library',
      'show_in_rest' => true,
      'rewrite' => array('slug' => _x( 'video', 'URL video slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
    )
  );

  register_post_type( 'pv_audio',
    array(
      'labels' => array(
        'name'               => _x( 'Audio', 'post type general name', 'plumvillage' ),
        'singular_name'      => _x( 'Audio Item', 'post type singular name', 'plumvillage' ),
        'menu_name'          => _x( 'Audio', 'admin menu', 'plumvillage'),
        'name_admin_bar'     => _x( 'Audio', 'add new on admin bar', 'plumvillage' ),
        'add_new'            => __( 'Add Audio Item', 'plumvillage' ),
        'add_new_item'       => __( 'Add New Audio Item', 'plumvillage' ),
        'new_item'           => __( 'New Audio Item', 'plumvillage' ),
        'edit_item'          => __( 'Edit Audio Item', 'plumvillage' ),
        'view_item'          => __( 'View Audio Item', 'plumvillage' ),
        'all_items'          => __( 'Audio', 'plumvillage' ),
        'search_items'       => __( 'Search Audio', 'plumvillage' ),
        'parent_item_colon'  => __( 'Parent:', 'plumvillage' ),
        'not_found'          => __( 'Nothing found.', 'plumvillage' ),
        'not_found_in_trash' => __( 'No Audio Item found in the trash.', 'plumvillage' )
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'show_in_menu' => 'library',
      'show_in_rest' => true,
      'rewrite' => array('slug' => _x( 'audio', 'URL audio slug', 'plumvillage' )),
      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'author')
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

  add_menu_page('Thich Nhat Hanh', 'Thich Nhat Hanh', 'edit_posts',  'tnh', '', 'dashicons-admin-users');

  add_menu_page('Library', 'Library', 'edit_posts',  'library', '', 'dashicons-portfolio');
  add_menu_page('Events', 'Events', 'edit_posts',  'events', '', 'dashicons-calendar-alt');

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
        'name'  => esc_html__( 'Stamp', 'plumvillage' ),
        'slug' => 'stamp',
        'color' => '#EA4334',
      ),
      array(
        'name'  => esc_html__( 'Fresh Stamp', 'plumvillage' ),
        'slug' => 'fresh-stamp',
        'color' => '#fdecea',
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
        'tnh',
        'library',
        'events',
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

/////////////////////////////////////////////
// PODCASTS

// replace 'podcast' with 'audio' in the rss feed
// add_filter( 'ssp_archive_slug', 'ssp_modify_podcast_archive_slug' );
// function ssp_modify_podcast_archive_slug ( $slug ) {
//   return 'audio-feed';
// }

add_filter( 'ssp_feed_slug', 'ssp_modify_podcast_feed_slug' );
function ssp_modify_podcast_feed_slug ( $slug ) {
  return 'audio';
}

add_filter( 'ssp_feed_item_image', 'ssp_modify_feed_item_image', 10, 5 );
function ssp_modify_feed_item_image ( $image, $id ) {
	if($image){
		$image_id = get_post_thumbnail_id( $id );
		if ( $image_id ) {
			$image_att = wp_get_attachment_image_src( $image_id, 'square' );
			if ( $image_att ) {
				$image = $image_att[0];
			}
		}
	}
	return $image;
}



// Filter the rss feed title
function filter_the_title_rss( $post_post_title ) { 
    // make filter magic happen here... 
    global $post;
    $monastics = get_field('many2many_video_monastics', $post->ID);
    if($monastics){
      $i = 0;
      foreach( $monastics as $monastic) :
        $post_post_title .= ($i == 0) ? ' — ' : ', ';        
        $post_post_title .= shorten_monastic_name(get_the_title($monastic));
        $i++;
      endforeach;
    }
    $practice_centres = get_field('many2many_video_practice_centre', $post->ID);
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
add_filter( 'manage_pv_video_posts_columns', 'pv_video_filter_posts_columns' );
function pv_video_filter_posts_columns( $columns ) {
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


add_action( 'manage_pv_video_posts_custom_column', 'pv_video_column', 10, 2);
function pv_video_column( $column, $post_id ) {
  // Dharma Teachers column
  if ( $column == 'dharma-teachers' ) {
    $monastics = get_field('many2many_video_monastics', $post_id);
    $title = '';
    if($monastics){
      $i = 0;
      foreach( $monastics as $monastic) :
        $title .= ($i == 0) ? '' : ', ';        
        $title .= shorten_monastic_name(get_the_title($monastic));
        $i++;
      endforeach;
    }
    echo $title;
  }  

  if ( $column == 'location' ) {
    $practice_centres = get_field('many2many_video_practice_centre', $post_id);
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
    'date' => $columns['date']
  );

  var_export($columns);

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

  if($column == 'startdate'){
    echo get_field('start_date', $post_id);
  }

  if($column == 'enddate'){
    echo get_field('end_date', $post_id);
  }

}

//////////////////////////////////////////////////////
// Order the books without articles (the, a, an, etc...) in front

function wpcf_create_temp_column($fields) {
  global $wpdb;
  $matches = 'A|An|The|La|Les|Le';
  $has_the = " CASE
      WHEN $wpdb->posts.post_title regexp( '^($matches)[[:space:]]' )
        THEN trim(substr($wpdb->posts.post_title from 4))
      ELSE $wpdb->posts.post_title
        END AS title2";
  if ($has_the) {
    $fields .= ( preg_match( '/^(\s+)?,/', $has_the ) ) ? $has_the : ", $has_the";
  }
  return $fields;
}

function wpcf_sort_by_temp_column ($orderby) {
  $custom_orderby = " UPPER(title2) ASC";
  if ($custom_orderby) {
    $orderby = $custom_orderby;
  }
  return $orderby;
}

add_action( 'pre_get_posts', 'my_change_sort_order');
function my_change_sort_order($query){
    if(is_post_type_archive( 'pv_book' )){
     //If you wanted it for the archive of a custom post type use:
       //Set the order ASC or DESC
		add_filter('posts_fields', 'wpcf_create_temp_column');
		add_filter('posts_orderby', 'wpcf_sort_by_temp_column');

       $query->set( 'order', 'ASC' );
       //Set the orderby
       $query->set( 'orderby', 'title' );

       $query->set( 'posts_per_page', '-1' );
    }
};

//////////////////////////////////////////////////////
// Compare the dates of the online events

function date_compare($a, $b)
{
  $t1 = strtotime($a['start_date_time']);
  $t2 = strtotime($b['start_date_time']);
  return $t1 - $t2;
}
