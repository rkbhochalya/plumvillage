<?php 

// add theme options page
if( function_exists('acf_add_options_page') ) { 
    acf_add_options_page();
}


/**
 * Google maps API for ACF
 */

function my_acf_init() {  
    if(get_field('google_maps_api_key', 'options')){
        acf_update_setting('google_api_key', get_field('google_maps_api_key', 'options'));
    }
}

add_action('acf/init', 'my_acf_init');

/**
 * Create Plum Village block category
 */
function plumvillage_block_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'plumvillage',
                'title' => __( 'Plum Village Blocks', 'plumvillage' ),
            ),
            array(
                'slug' => 'plumvillage_press',
                'title' => __( 'Plum Village Press', 'plumvillage' ),
            ),
            array(
                'slug' => 'plumvillage_tnh',
                'title' => __( 'Thich Nhat Hanh', 'plumvillage' ),
            )
        )
    );
}
add_filter( 'block_categories', 'plumvillage_block_category', 10, 2);

/**
 * remove unneeded blocks
 */

// add_filter( 'allowed_block_types', 'plumvillage_allowed_block_types' );
 
// function plumvillage_allowed_block_types( $allowed_blocks ) {
 
//     // get widget blocks and registered by plugins blocks
//     $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
 
//     // in case we do not need widgets
//     unset( $registered_blocks[ 'core/latest-comments' ] );
//     unset( $registered_blocks[ 'core/archives' ] );
//     unset( $registered_blocks[ 'core/shortcode' ] );
//     unset( $registered_blocks[ 'core/categories' ] );
//     unset( $registered_blocks[ 'core/latest-posts' ] );
//     unset( $registered_blocks[ 'core/calendar' ] );
//     unset( $registered_blocks[ 'core/rss' ] );
//     unset( $registered_blocks[ 'core/search' ] );
//     unset( $registered_blocks[ 'core/tag-cloud' ] );
 
//     // now $registered_blocks contains only blocks registered by plugins, but we need keys only
//     $registered_blocks = array_keys( $registered_blocks );
 
//     // merge the whitelist with plugins blocks
//     return array_merge( array(
//         'core/image',
//         'core/paragraph',
//         'core/heading',
//         'core/list',
//         'core/pullquote',
//         'core/freeform',
//         'core/table',
//         'core/verse',
//         'core/spacer',
//         'core/separator',
//         'core/media-text',
//         'core/text-columns',
//         'core/button',
//         'core/table',
//         'core/code',
//         'core/html',
//         'core/preformatted',
//         'core/file'
//     ), $registered_blocks );
 
// }


function register_acf_block_types() {

    // register a Divider block.
    acf_register_block_type(array(
        'name'              => 'jump_to_divider',
        'title'             => __('Jump To Divider', 'plumvillage'),
        'description'       => __('A divider to jump to another section on the page', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/jump-to.php',
        'category'          => 'plumvillage',
        'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><G><path d="M2 9v2h19V9H2zm0 6h5v-2H2v2zm7 0h5v-2H9v2zm7 0h5v-2h-5v2z" /></G></svg>',
        'keywords'          => array( 'divider', 'jump to', 'jump' ),
        'align'				=> 'wide',
        'supports'		    => array(
        	'align' 	=> array('wide')
        )
    ));

    // register a Side block.
    acf_register_block_type(array(
        'name'              => 'text_inset',
        'title'             => __('Text Inset', 'plumvillage'),
        'description'       => __('A block for providing', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/text-inset.php',
        'category'          => 'plumvillage',
        'icon'              => 'text',
        'keywords'          => array( 'side', 'text' ),
        'align'				=> 'right',
        'supports'			=> array(
        	'align' 	=> array('right')
        )
    ));

    // register a Gallery
    acf_register_block_type(array(
        'name'              => 'gallery',
        'title'             => __('Gallery', 'plumvillage'),
        'description'       => __('Add gallery', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/gallery.php',
        'category'          => 'plumvillage',
        'icon'              => 'images-alt2',
        'keywords'          => array( 'gallery', 'photos', 'photo' ),
        'supports'          => array(
            'align'     => array('wide')
        )
    ));

    // register a Gallery Embed
    acf_register_block_type(array(
        'name'              => 'gallery_embed',
        'title'             => __('Gallery Popover', 'plumvillage'),
        'description'       => __('A block which opens a gallery in a popover', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/gallery-embed.php',
        'category'          => 'plumvillage',
        'icon'              => 'format-gallery',
        'keywords'          => array( 'gallery', 'photos', 'photo' ),
        'align'             => 'right',
        'supports'          => array(
            'align'     => array('left', 'right')
        )
    ));

    // register a Gallery Books Embed
    acf_register_block_type(array(
        'name'              => 'gallery_book_embed',
        'title'             => __('Gallery Books Popover', 'plumvillage'),
        'description'       => __('A block which opens a gallery of books in a popover', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/gallery-book-embed.php',
        'category'          => 'plumvillage',
        'icon'              => 'format-gallery',
        'keywords'          => array( 'gallery', 'book', 'books' ),
        'align'             => 'right',
        'supports'          => array(
            'align'     => array('left', 'right')
        )
    ));

    // register a Gallery Embed
    acf_register_block_type(array(
        'name'              => 'video_embed',
        'title'             => __('Video Embed', 'plumvillage'),
        'description'       => __('Embed a Video', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/video-embed.php',
        'category'          => 'plumvillage',
        'icon'              => 'video-alt3',
        'keywords'          => array( 'video', 'embed' ),
        'align'             => 'right',
        'supports'          => array(
            'align'     => array('right')
        )
    ));    

    // register a Audio Embed
    acf_register_block_type(array(
        'name'              => 'audio_embed',
        'title'             => __('Audio Embed', 'plumvillage'),
        'description'       => __('Embed Audio', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/audio-embed.php',
        'category'          => 'plumvillage',
        'icon'              => 'format-audio',
        'keywords'          => array( 'audio', 'embed' ),
        'align'             => 'right',
        'supports'          => array(
            'align'     => array('right')
        )
    ));    

    // register a Books Block
    acf_register_block_type(array(
        'name'              => 'books',
        'title'             => __('Books Panel', 'plumvillage'),
        'description'       => __('Add a books panel', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/panel-books.php',
        'category'          => 'plumvillage',
        'icon'              => 'book',
        'keywords'          => array( 'books', 'panel' ),
        'supports'          => array(
            'align'     => array('wide')
        )
    ));    

    // register a Videos Block
    acf_register_block_type(array(
        'name'              => 'videos',
        'title'             => __('Videos Panel', 'plumvillage'),
        'description'       => __('Add a videos panel', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/panel-videos.php',
        'category'          => 'plumvillage',
        'icon'              => 'video-alt3',
        'keywords'          => array( 'video', 'videos', 'panel' ),
        'supports'          => array(
            'align'     => array('wide')
        )
    ));    

    // register a Links Block
    acf_register_block_type(array(
        'name'              => 'links',
        'title'             => __('Links Panel', 'plumvillage'),
        'description'       => __('Add a links panel', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/panel-links.php',
        'category'          => 'plumvillage',
        'icon'              => 'editor-ul',
        'keywords'          => array( 'links', 'articles', 'panel' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register a Page Embed Block
    acf_register_block_type(array(
        'name'              => 'page_embed',
        'title'             => __('Pages Panel', 'plumvillage'),
        'description'       => __('Add a panel of pages', 'plumvillage'),
        'render_template'   => 'template-parts/blocks/panel-pages.php',
        'category'          => 'plumvillage',
        'icon'              => 'admin-page',
        'keywords'          => array( 'page', 'embed', 'panel' ),
        'supports'          => array(
            'align'     => array('wide')
        )
    ));    

    // register a Press Releases and Updates Block
    acf_register_block_type(array(
        'name'              => 'quotes_panel',
        'title'             => __('Quotes Panel'),
        'description'       => __('Add a quotes panel'),
        'render_template'   => 'template-parts/blocks/panel-quotes.php',
        'category'          => 'plumvillage_press',
        'icon'              => 'format-quote',
        'keywords'          => array( 'quotes', 'press', 'panel' ),
        'align'             => 'wide',
        'supports'          => array(
            'align'     => array('wide')
        )
    ));    
 
    // register a Press Releases and Updates Block
    acf_register_block_type(array(
        'name'              => 'press_releases',
        'title'             => __('Press Releases & Updates'),
        'description'       => __('Add press releases and updates'),
        'render_template'   => 'template-parts/blocks/press-releases-updates.php',
        'category'          => 'plumvillage_press',
        'icon'              => 'clipboard',
        'keywords'          => array( 'press', 'releases', 'updates' ),
        'supports'          => array(
            'align'     => false
        )
    ));

    // register a Press Releases and Updates Block
    acf_register_block_type(array(
        'name'              => 'media_coverage',
        'title'             => __('Media Coverage Section'),
        'description'       => __('A section for the press page'),
        'render_template'   => 'template-parts/blocks/press-media-coverage.php',
        'category'          => 'plumvillage_press',
        'icon'              => 'clipboard',
        'keywords'          => array( 'media', 'coverage', 'press' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register a Press Releases and Updates Block
    acf_register_block_type(array(
        'name'              => 'page_menu',
        'title'             => __('Page Menu'),
        'description'       => __('Menu for the landing pages'),
        'render_template'   => 'template-parts/blocks/menu.php',
        'category'          => 'plumvillage_tnh',
        'icon'              => 'clipboard',
        'keywords'          => array( 'thich nhat hanh', 'menu', 'landing' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register post list
    acf_register_block_type(array(
        'name'              => 'post_list',
        'title'             => __('Latest Posts'),
        'description'       => __('A list of latest posts'),
        'render_template'   => 'template-parts/blocks/post_list.php',
        'category'          => 'plumvillage',
        'icon'              => 'list-view',
        'keywords'          => array( 'post', 'list' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register custom post list
    acf_register_block_type(array(
        'name'              => 'post_list_tnh',
        'title'             => __('Latest TNH Posts'),
        'description'       => __('A list of latest TNH posts'),
        'render_template'   => 'template-parts/blocks/post_list_tnh.php',
        'category'          => 'plumvillage',
        'icon'              => 'list-view',
        'keywords'          => array( 'post', 'list' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register events list
    acf_register_block_type(array(
        'name'              => 'event_retreat_list',
        'title'             => __('Retreats List'),
        'description'       => __('A list of all the retreats'),
        'render_template'   => 'template-parts/blocks/events_retreats_list.php',
        'category'          => 'plumvillage',
        'icon'              => 'calendar-alt',
        'keywords'          => array( 'post', 'list' ),
        'supports'          => array(
            'align'     => false
        )
    ));    

    // register events list
    acf_register_block_type(array(
        'name'              => 'event_days_list',
        'title'             => __('Days of Mindfulness List'),
        'description'       => __('A list of the Days of Mindfulness'),
        'render_template'   => 'template-parts/blocks/events_days_list.php',
        'category'          => 'plumvillage',
        'icon'              => 'calendar-alt',
        'keywords'          => array( 'post', 'list' ),
        'supports'          => array(
            'align'     => array('right')
        )
    ));    


    // Photo Slider
    acf_register_block_type(array(
        'name'              => 'photo_slider',
        'title'             => __('Photo Slider'),
        'description'       => __('A slider of photos'),
        'render_template'   => 'template-parts/blocks/photo_slider.php',
        'category'          => 'plumvillage',
        'icon'              => 'slides',
        'keywords'          => array( 'slider', 'photo', 'gallery' ),
        'supports'          => array(
            'align'     => array('wide')
        )
    ));    

    // Latest Youtube Videos
    acf_register_block_type(array(
        'name'              => 'latest_youtube',
        'title'             => __('Latest Youtube Videos'),
        'description'       => __('A list with latest youtube videos'),
        'render_template'   => 'template-parts/blocks/latest_youtube.php',
        'category'          => 'plumvillage',
        'icon'              => 'video-alt3',
        'keywords'          => array( 'youtube', 'video' ),
        'supports'          => array(
            'align'     => false
        )
    ));

    // Important Update
    acf_register_block_type(array(
        'name'              => 'important_update',
        'title'             => __('Important Update'),
        'description'       => __('Show an important Update Bar'),
        'render_template'   => 'template-parts/blocks/important-update.php',
        'category'          => 'plumvillage',
        'icon'              => 'megaphone',
        'keywords'          => array( 'important', 'update' ),
        'supports'          => array(
            'align'     => array('full')
        )
    ));

    // Important Update
    acf_register_block_type(array(
        'name'              => 'overview_monastics',
        'title'             => __('Monastics'),
        'description'       => __('Show an overview of monastics'),
        'render_template'   => 'template-parts/blocks/overview-monastics.php',
        'category'          => 'plumvillage',
        'icon'              => 'groups',
        'keywords'          => array( 'monastics' )
    ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}