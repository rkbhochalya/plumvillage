<?php

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
    $about = $tnh = $letters = $last_tnh = $interviews = $tnh_updates = $news = $chanting = $practice = $sutra = $songs = $retreats = false;
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
      $i++;
    }

    // remove 'about' active class when on tnh page or subpage
    if($about && !$tnh){
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
    if( in_category( 'news' ) && $news && (get_post_type() == 'post')){
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
          $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$uri_segments[2].".php"));
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
          $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$uri_segments[2].".php"));
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
        <div class="play" data-embed-link="$<?php echo $cleanVideoId; ?>" data-target="<?= $target; ?>">
        <?php 
            if($featured_image){
                echo wp_get_attachment_image( $featured_image, 'medium' );
            } elseif($videoImage) {
                echo $videoImage;
            } else{
              echo $iframe;
            }
        ?>
        <span class="icon icon-bg icon-play"></span></div>
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
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Object to array
function object_to_array($obj) {
if(is_object($obj)) $obj = (array) $obj;
    if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
            $new[$key] = object_to_array($val);
        }
    }
    else $new = $obj;
    return $new;       
}