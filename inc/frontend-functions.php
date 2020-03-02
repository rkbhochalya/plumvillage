<?php

/**
 * Check if this is a request at the backend.
 *
 * @return bool true if is admin request, otherwise false.
 */
 
function is_admin_request() {
  /**
   * Get current URL.
   *
   * @link https://wordpress.stackexchange.com/a/126534
   */
  $current_url = home_url( add_query_arg( null, null ) );

  /**
   * Get admin URL and referrer.
   *
   * @link https://core.trac.wordpress.org/browser/tags/4.8/src/wp-includes/pluggable.php#L1076
   */
  $admin_url = strtolower( admin_url() );
  $referrer  = strtolower( wp_get_referer() );

  /**
   * Check if this is a admin request. If true, it
   * could also be a AJAX request from the frontend.
   */
  if ( 0 === strpos( $current_url, $admin_url ) ) {
    /**
     * Check if the user comes from a admin page.
     */
    if ( 0 === strpos( $referrer, $admin_url ) ) {
      return true;
    } else {
      /**
       * Check for AJAX requests.
       *
       * @link https://gist.github.com/zitrusblau/58124d4b2c56d06b070573a99f33b9ed#file-lazy-load-responsive-images-php-L193
       */
      if ( function_exists( 'wp_doing_ajax' ) ) {
        return ! wp_doing_ajax();
      } else {
        return ! ( defined( 'DOING_AJAX' ) && DOING_AJAX );
      }
    }
  } else {
    return false;
  }
}


// Show submenu on default pages
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  $post = get_queried_object();   
  $parent = false;
  foreach ( $sorted_menu_items as $menu_item ) {
    // var_export($menu_item);
    // var_export($menu_item->current);
    // var_export($menu_item->current_item_ancestor);
    // var_export($menu_item->current_item_parent);
    // echo '<br />';
    // echo '<br />';
 
    $uri_segments = explode('/', $menu_item->url);

    $i = 2;
    $about = $tnh = $letters = $last_tnh = $interviews = $tnh_updates = $news = $chanting = $practice = $sutra = $songs = $retreats = $articles = $press = $books = false;
    foreach ($uri_segments as $slug) {
      if($slug == 'about') : 
        $about = true;
      endif;
      if($slug == 'thich-nhat-hanh') : 
        $tnh = true;
        $last_tnh = ($i == count($uri_segments));
      endif;
      if($slug == 'letters') : 
        $letters = true;
      endif;
      if($slug == 'interviews-with-thich-nhat-hanh') : 
        $interviews = true;
      endif;
      if($slug == 'thich-nhat-hanhs-health') : 
        $tnh_updates = true;
      endif;
      if($slug == 'news') : 
        $news = true;
      endif;
      if($slug == 'books') : 
        $books = true;
      endif;
      if($slug == 'key-practice-texts') : 
        $practice = true;
      endif;
      if($slug == 'chanting') : 
        $chanting = true;
      endif;
      if($slug == 'sutra') : 
        $sutra = true;
      endif;
      if($slug == 'songs') : 
        $songs = true;
      endif;
      if($slug == 'when-can-you-visit-us') : 
        $retreats = true;
      endif;
      if($slug == 'register') : 
        $register = true;
      endif;
      if($slug == 'articles-and-news') : 
        $articles = true;
      endif;
      if($slug == 'press') : 
        $press = true;
      endif;
      $i++;
    }

    // remove 'about' active class when on tnh page or subpage
    if($about && $tnh){
      $menu_item->classes[4] = '';
      $menu_item->classes[5] = '';
    }

    // add active class when on a single letter
    if( is_singular( 'letter' ) && $letters){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }    
    if( is_singular( 'letter' ) && $last_tnh){
      $menu_item->classes[] = 'current-menu-item';
    }    

    // add active class when on an interview 
    if( is_singular( 'interview' ) && $interviews){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }    
    if( is_singular( 'interview' ) && $last_tnh){
      $menu_item->classes[] = 'current-menu-item';
    }    

    // add active class when on a interview 
    if( is_singular( 'tnh_update' ) && $tnh_updates){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }    
    if( is_singular( 'tnh_update' ) && $last_tnh){
      $menu_item->classes[] = 'current-menu-item';
    }

    // if in the news category
    if( in_category( array('news', 'articles') ) && $articles && (get_post_type() == 'post')){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if($practice &! $parent && in_category(array('chanting', 'sutra', 'key-practice-texts', 'songs'))){
      $menu_item->classes[] = 'current-menu-ancestor';
      $menu_item->current = true;
      $parent = true;
    }

    if( in_category( 'chanting' ) && $chanting && (get_post_type() == 'post')){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if(is_post_type_archive('pv_book') && $books){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if( in_category( 'key-practice-texts' ) && $practice && (get_post_type() == 'post')){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if( in_category( 'sutra' ) && $sutra && (get_post_type() == 'post')){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if( in_category( 'songs' ) && $songs && (get_post_type() == 'post')){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if( is_singular( 'pv_event' ) && $retreats){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }

    if( is_singular( 'tnh_press_release' ) && $press){
      $menu_item->classes[] = 'current-menu-item';
      $menu_item->current = true;
    }
    if( is_singular( 'tnh_press_release' ) && $last_tnh){
      $menu_item->classes[] = 'current-menu-item';
    }


  }

  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
      $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
      break;
    }
  }
  // find the top level parent
  if ( ! isset( $args->direct_parent ) ) {
    $prev_root_id = $root_id;
    while ( $prev_root_id != 0 ) {
      foreach ( $sorted_menu_items as $menu_item ) {
        if ( $menu_item->ID == $prev_root_id ) {
          $prev_root_id = $menu_item->menu_item_parent;
          // don't set the root_id to 0 if we've reached the top of the menu
          if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          }
        }
      }
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
      // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
      // not part of sub-tree: away with it!
      unset( $sorted_menu_items[$key] );
    }
  }
  return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}



//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

function url_exists( $url ) {
  $headers = get_headers($url);
  return stripos( $headers[0], "200 OK" ) ? true : false;
}
function get_youtube_thumb( $id ) {
  if ( url_exists( 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg' ) ) {
    $image = 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg';
  }
  elseif ( url_exists( 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg' ) ) {
    $image = 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg';
  }
  else {
    $image = false;
  }
  return $image;
}

function get_video_thumb_from_iframe($iframe){
  preg_match('/src="(.+?)"/', $iframe, $matches);

  $videoImage = false;

  if($matches) :

      $src = $matches[1];

      $uri_path = parse_url($src, PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);

      $videoId = $uri_segments[2];


      if (strpos($src, 'youtube') > 0) {
        if(get_youtube_thumb($videoId)){
            return '<img src="'.get_youtube_thumb($videoId).'">';
        }
      } elseif (strpos($src, 'vimeo') > 0) {
          $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".$uri_segments[2].".php"));
          return '<img src="'.$hash[0]['thumbnail_large'].'">';  
      } else {
          return false;
      }
  endif;

}


function beautifulVideoEmbed($iframe, $videoId = 1, $featured_image = false, $inline = false, $target = false){
  // use preg_match to find iframe src
  preg_match('/src="(.+?)"/', $iframe, $matches);

  $videoImage = false;

  if($matches) :

      $src = $matches[1];

      $uri_path = parse_url($src, PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);

      $videoId = $uri_segments[2];


      if (strpos($src, 'youtube') > 0) {
        if(get_youtube_thumb($videoId)){
            $videoImage = '<img src="'.get_youtube_thumb($videoId).'">';
        }
      } elseif (strpos($src, 'vimeo') > 0) {
          $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".$uri_segments[2].".php"));
          $videoImage = '<img src="'.$hash[0]['thumbnail_large'].'">';  
      } else {
          $videoImage = '';
      }


      // add extra params to iframe src
      $params = array(
          'autoplay'    => 1,
          'modestbranding'  => 1,
          'rel' => 0
      );

      $new_src = add_query_arg($params, $src);

      $iframe = str_replace($src, $new_src, $iframe);
      $cleanVideoId = str_replace(str_split('\\/:*?"<>-|'), '', $videoId);

      // echo $iframe
      echo "<script>var $".$cleanVideoId." = '".$iframe."';</script>";

      if(!$target){
        $target = $cleanVideoId;
      }
 
  endif; 

  ?>

  <div class="video-wrapper">
      <?php if(isset($cleanVideoId)) : ?>
        <a class="play" aria-label="<?php _e('Play Video', 'plumvillage'); ?>" href="#" data-embed-link="$<?php echo $cleanVideoId; ?>" data-target="<?= $target; ?>">
        <?php 
            if($featured_image){
                echo wp_get_attachment_image( $featured_image, 'large' );
            } elseif($videoImage) {
                echo $videoImage;
            } else{
              echo $iframe;
            }
        ?>
        <span class="icon icon-bg icon-play"></span></a>
      <?php endif; ?>
      <?php if($inline) : ?>
        <div class="iframe-target iframe-target-<?= $target; ?>"><span class="icon icon-close"></span><div class="iframe-container embed-responsive embed-responsive-16by9 dropzone"></div></div>
      <?php endif; ?>
  </div>  
  <?php 
}


function pv_get_excerpt($id, $length = 20){
  if(get_field('excerpt', $id)) {
      return get_field('excerpt', $id); 
  } else {
      return wp_trim_words( strip_shortcodes( get_the_content('', '', $id) ), $length );
  }
}

// get all the terms on the blocks
function get_all_term_classes($id, $taxonomy){

  $classes = array();
  $term_types = array($taxonomy);

  foreach ( $term_types as $type ) {
    $terms = get_the_terms($id, $type);
    if ( $terms && ! is_wp_error( $terms ) ) {
      foreach ( $terms as $term ) {
          $classes[] = $type.'-'.$term->slug;
      }
    }
  }

  return $classes;
}

function add_tags($id) {

  $classes = '';
  $term_types = array('topics', 'types');

  foreach ( $term_types as $type ) {
    $terms = get_the_terms($id, $type);
    if ( $terms && ! is_wp_error( $terms ) ) {
      foreach ( $terms as $term ) {
          $classes .= '<span class="trigger" data-trigger="trigger-'.$type.'-'.$term->slug.'">' . $term->name . '</span>';
      }
    }
  }

  echo $classes;

}

function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_the_limited_excerpt($id = false, $limit) {
  if(!$id){
    $id = get_the_id();
  }
  $excerpt = explode(' ', get_the_excerpt($id), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// Comparison function
function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    echo ($a);
    return ($a < $b) ? -1 : 1;
}


function get_filter_menu($posts, $taxonomy){
  $all_terms = array($taxonomy => array());

  $count = array();
  while ( $posts->have_posts() ) {
    $posts->the_post();
    foreach ( $all_terms as $key => $cat ) {
      $terms = get_the_terms(get_the_id(), $key);
      if ( $terms && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
          if(array_key_exists($term->term_id, $all_terms[$key])){
            $count[$term->term_id] = $count[$term->term_id] + 1;
          } else {
            $count[$term->term_id] = 1;
          }
          $all_terms[$key][$term->term_id] = array($term->slug, $term->name, $count[$term->term_id]);
        }
      }
    }
  } 

  // sort the topics on most popular first
  uasort($all_terms[$taxonomy], function($a, $b){
    if ($a[2] == $b[2]) {
        return 0;
    }
    return ($a[2] > $b[2]) ? -1 : 1;
  });

  foreach ( $all_terms as $key => $value ) {
    if($value){
      $tax = get_taxonomy($key);
      $i = 0;
      ?>
      <div class="filter-block center-without-border">
        <h5 class="filter-title"><?php echo __("Filter by ", "plumvillage") . $tax->labels->singular_name; ?></h5>
        <div class="filter-list"><a href="#filter=*" class="reset-filter selected" data-filter="*"> <?php _e("Show Everything", "plumvillage"); ?></a>,
          <?php foreach ($value as $term_id => $term) {
            echo '<a href="#filter='.$key.'-'.$term[0].'" class="filter-products trigger-'.$key.'-'.$term[0].'" data-filter=".'.$key.'-'.$term[0].'">'.$term[1].'</a>';      
            $i++;
            if(count($value) != $i){
              echo ', ';
            }
          } ?>
            <span class="toggle-filter-list icon-circle-caret-down"></span>
        </div>
        <hr>
      </div>
    <?php }
  }
}

//Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;

    if ( get_field('header_white', $post->ID) ) {
      $classes[] = 'has-white-header';
    }
  }



  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Object to array
function pv_object_to_array($obj) {
if(is_object($obj)) $obj = (array) $obj;
    if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
            $new[$key] = pv_object_to_array($val);
        }
    }
    else $new = $obj;
    return $new;       
}


// Add google schema data to event pages

function add_schema_data_to_events(){
  global $post;
  if(get_post_type($post) == 'pv_event') {
    $schema = array(
      // Tell search engines that this is structured data
      '@context'  => "http://schema.org",
      // Tell search engines the content type it is looking at 
      '@type'     => 'Event',
      // Provide search engines with the site name and address 
      'name'      => get_the_title($post),
      'url'       => get_the_permalink($post),
      // Provide the company address
    );

    if (has_post_thumbnail($post)) {
      $schema['image'] = get_the_post_thumbnail_url($post);
    }

    $startDate = get_field('start_date', get_the_ID($post), false);
    if ($startDate){
      $startDate = new DateTime($startDate);
      $schema['startDate'] = $startDate->format('Y-m-d');
    }

    $endDate = get_field('end_date', get_the_ID($post), false);
    if ($endDate){
      $endDate = new DateTime($endDate);
      $schema['endDate'] = $endDate->format('Y-m-d');
    }

    $schema['description'] = get_the_limited_excerpt(get_the_ID(), 35);

    $terms = wp_get_post_terms(get_the_ID($post), 'practise-centres', array('orderby' => 'parent', 'order' => 'DESC'));
    if(!empty($terms)){
      foreach($terms as $term) {
        if($term->parent == 0){ 

          $schema['location'] = array();

          $place = array(
            '@type'   => "Place",
            'name'    => $term->name,
            'address' => array()
          );

          $address = array(
            "@type"   => "PostalAddress"
          );

          if(get_field('address_street', $term)){
            $address["streetAddress"] = get_field('address_street', $term) . get_field('address_street_2', $term);
          }
          if(get_field('address_postcode', $term)){
            $address["postalCode"] = get_field('address_postcode', $term);
          }
          if(get_field('address_city', $term)){
            $address["addressLocality"] = get_field('address_city', $term);
          }
          if(get_field('address_state', $term)){
            $address["addressRegion"] = get_field('address_state', $term);
          }
          if(get_field('address_country', $term)){
            $address["addressCountry"] = get_field('address_country', $term);
          }

          array_push($place['address'], $address);
          array_push($schema['location'], $place);
        }
      }
    }

    if(isset($schema['location']) && isset($schema['startDate'])){
      echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
  }
}
add_action('wp_head', 'add_schema_data_to_events');



/**
 * Elastic Search
 */

/**
 * Make sure all languages are indexed
 * https://github.com/10up/ElasticPress/issues/477
 */
 
// add_filter('ep_index_posts_args', function($args) {
//     return array_merge($args, [
//         'suppress_filters' => true
//     ]);
// });


// normalise vietnamese characters with icu_folding
function elasticpress_config_mapping( $mapping ) {
  $mapping['settings']['analysis']['analyzer']['default']['filter'] = array( 'lowercase', 'stop', 'ewp_snowball', 'icu_folding' );
  
  $mapping['settings']['analysis']['filter']['pv_synonym_filter'] = array(
      'type' => 'synonym',
      'synonyms' => array(
          '4, four, quatre',
          '5, five, cinq',
          '8, eight, huit',
          '10, ten, dix',
          '14, fourteen, quatorze',
          '16, sixteen, seize',
      ),
  );

  $mapping['settings']['analysis']['analyzer']['default']['filter'][] = 'pv_synonym_filter';

  return $mapping;
}

add_filter( 'ep_config_mapping', 'elasticpress_config_mapping', 10, 1 );

// filter search results
function my_search_filter($query) {
  if ( (!is_admin() && $query->is_main_query()) || !is_admin_request() ) {
    if ($query->is_search() ) {
      $query->set( 'post_type', array('post', 'page', 'pv_event', 'pv_book', 'letter', 'interview', 'tnh_update', 'tnh_press_release', 'monastics') );
      $query->set('search_fields', array(
        'post_title',
        'post_content',
        'post_excerpt',        
        'meta' => array( 'isbn'),
        'taxonomies' => array( 'category', 'topics', 'practise-centres', 'ep_custom_result' ),
      ));
      $query->set('post_status', array('publish'));
      $query->set('meta_query', array(
        'relation' => 'OR',
        array(
          'key' => 'end_date',
          'compare' => 'NOT EXISTS',
          'value' => ''
        ),
        array(
              'key' => 'end_date',
              'value' => date('Ymd'),
              'compare' => '>=',
              'type' => 'NUMERIC'
           )
      ));      
    }
  }
}
add_action('pre_get_posts','my_search_filter',1);

// Ajax search
add_action( 'wp_ajax_get_search_results', 'get_search_results' );
add_action( 'wp_ajax_nopriv_get_search_results', 'get_search_results' );

function get_search_results() {
    $s = $_POST['s'];
    $offset = ($_POST['offset']) ? $_POST['offset'] : 0;

    $args = array(
        'ep_integrate' => true,
        's' => $s,
        'offset' => $offset
    );
    $search = new WP_Query( $args );
    
    ob_start();
    
    if ( $search->have_posts() ) : ?>
      
    <?php if($offset == 0) : ?>
      <p class="result-amount"><?php echo $search->found_posts; printf( __( ' Results for: %s', 'plumvillage' ), '<span>' . $s . '</span>' ); ?></p>
    <?php endif; ?>

    <?php 
      while ( $search->have_posts() ) : $search->the_post();

        get_template_part( 'template-parts/index-search', get_post_type() );

      endwhile;

      if($search->found_posts > ($search->post_count + $offset)){
        echo '<a class="load-more-search" href="#" data-offset="'.($search->post_count + $offset).'"><span class="load-more-text">'. __('Load More', 'plumvillage') . '</span>';
      };

  else : ?>
    <p class="result-amount"><?php printf( __('Hhmm... we can\'t find %s. Is nothing something?', 'plumvillage'), '<span>' . $s . '</span>'); ?></p>
  <?php endif;
  
  $content = ob_get_clean();
  
  echo $content;
  die();
      
}


function get_post_names($ids){
  if($ids){
    $postnames = '';
    foreach ($ids as $id) {
      $post = get_post($id);
      $postnames .= ' practice-centres-' . $post->post_name;
    }
    return $postnames;    
  }
}


// Are you human? Captcha for the newsletter form

add_action( 'wp_ajax_are_you_human', 'are_you_human' );
add_action( 'wp_ajax_nopriv_are_you_human', 'are_you_human' );

function are_you_human() {
  $answer = preg_replace('/[^a-z0-9]+/i', '', strtolower($_GET['answer']));
  $needs_to_be = preg_replace('/[^a-z0-9]+/i', '', strtolower(get_field('newsletter_form_answer', 'options')));

  if($answer != $needs_to_be){
    status_header(404);
    die();
  } 
}