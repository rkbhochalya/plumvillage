
		<?php 

		$classes = isset($block['className']) ? $block['className'] : false;
		$style = 'list';

	  $image_large = false;

		if($classes){
			if ( strstr( $classes, 'is-style-small-list-thumbnails' ) ) {
			  $style = 'index-small';
			} else if(strstr( $classes, 'is-style-small-list' ) ){
			  $style = 'list';
			} else if(strstr( $classes, 'is-style-medium-list' ) ){
			  $style = 'index';
			} else if(strstr( $classes, 'is-style-horizontal-list-large' ) ){
			  $style = 'index-horizontal';
			  $image_large = true;
			} else if(strstr( $classes, 'is-style-horizontal-list' ) ){
			  $style = 'index-horizontal';
 			}
		}

		// use the large image for the horizontal template
		set_query_var('image_large', $image_large);

		$offset = get_field( 'offset' ) ? get_field('offset') : 0;

		$postsToGet = (get_field('max_posts') ? get_field('max_posts') : 3) + $offset;
		$maxPosts = get_field('max_posts') ? get_field('max_posts') : 3;
		$category = get_field('category') ? get_field('category') : 0;

		$sticky = get_option( 'sticky_posts' );

		if(get_field('show') == 'latest') : 

			// Get all posts
			$post_ids = get_posts( array(
				'fields'								 => 'ids',
				'post_type'              => 'post',
				'post_status'            => array( 'publish' ),
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'category__in'					 => $category,
				'posts_per_page' 				 => $postsToGet,
				'exclude'								 => $sticky,
				'suppress_filters' 			 => 0,
			));

			$sticky_post_ids = [];
			if($sticky){
				$sticky_post_ids = get_posts( array(
					'fields'								 => 'ids',
					'post_type'              => 'post',
					'post_status'            => array( 'publish' ),
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'category__in'					 => $category,
					'post__in'							 => $sticky,
					'suppress_filters' 			 => 0,
				));			
			}

			if(get_field('include_tnh_news')) :

				$tnh_ids = get_posts( array(
					'fields' 								 => 'ids',
					'post_type'              => 'tnh_update',
					'post_status'            => array( 'publish' ),
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'posts_per_page' 				 => $postsToGet,
					'exclude'								 => $sticky,
					'suppress_filters' 			 => 0,
				));
				$post_ids = array_merge( $tnh_ids, $post_ids);

				if($sticky){
					$sticky_tnh_ids = get_posts( array(
						'fields'								 => 'ids',
						'post_type'              => 'tnh_update',
						'post_status'            => array( 'publish' ),
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'post__in'							 => $sticky,
						'suppress_filters' 			 => 0,
					));
					$sticky_post_ids = array_merge( $sticky_tnh_ids, $sticky_post_ids);
				}				

			endif;

			// sticky posts query
			if(count($sticky_post_ids) > 0){
				$sticky_posts = new WP_Query(array(
				    'post_type' 						=> 'any',
				    'post__in'  						=> $sticky_post_ids, 
				    'orderby'   						=> 'date',
						'order'           			=> 'DESC',
						'ignore_sticky_posts' 	=> 1,					
						'posts_per_page' 				=> $maxPosts,
						'offset' 								=> $offset
				)); 
			} else {
				$sticky_posts = new WP_Query(array('post__in' => array(0)));
			}

			$maxPosts = ($maxPosts - $sticky_posts->found_posts > 0) ? $maxPosts - $sticky_posts->found_posts : false;
			$offset = ($offset - count($sticky_post_ids) >= 0) ? $offset - count($sticky_post_ids) : $offset;

			if($maxPosts && count($post_ids) > 0){
				// the main query

				$posts = new WP_Query(array(
				    'post_type' 						=> 'any',
				    'post__in'  						=> $post_ids, 
				    'orderby'   						=> 'date',
						'order'           			=> 'DESC',
						'ignore_sticky_posts' 	=> 1,					
						'posts_per_page' 				=> $maxPosts,
						'offset'								=> $offset
				));	
			} else {
				$posts = new WP_Query(array('post__in' => array(0)));
			}

		elseif(get_field('show') == 'popular') :

				$posts = new WP_Query(array(
					'post_type' 					=> 'any',
					'orderby'							=> 'comment_count',
					'posts_per_page'			=> $maxPosts,
					'ignore_sticky_posts' => 1,
					'date_query' 					=> array(
					  'after' 						=> date('Y-m-d', strtotime('-30 days')) 
					),
				));

		else :

			// get the posts that were chosen
			$args = array (
				'post_status'           => array( 'publish' ),
				'post__in'							=> get_field('posts_to_show'),
				'ignore_sticky_posts' 	=> 1,					
			);
			$posts = new WP_Query( $args );

		endif;


		// The Loop
		if ( (isset($sticky_posts) && $sticky_posts->have_posts()) || $posts->have_posts() ) {  ?>

			<?php if($style == 'list') : ?><ul class="small post-list"><?php else : ?><div class="post-list"><?php endif; ?>
				<?php 
					if(isset($sticky_posts)) : 
						while ( $sticky_posts->have_posts() ) { 
						 	$sticky_posts->the_post(); 
						 	get_template_part( 'template-parts/'.$style, get_post_type() ); 
					 	} 
				 	endif;
				 	while ( $posts->have_posts() ) { 
					 	$posts->the_post(); 
					 	get_template_part( 'template-parts/'.$style, get_post_type() ); 
				 	} 
				?>
			<?php if($style == 'list') : ?></ul><?php else : ?></div><?php endif; ?>
	<?php } 

	// Restore original Post Data
	wp_reset_postdata();



	?>  	
