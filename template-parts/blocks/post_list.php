
		<?php 

		$style = get_field('style') ? get_field('style') : 'list';

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
				'posts_per_page' 				 => $maxPosts,
				'exclude'								 => $sticky,
				'suppress_filters' 			 => 0,
			));


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
					'posts_per_page' 				 => $maxPosts,
					'exclude'								 => $sticky,
					'suppress_filters' 			 => 0,
				));

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
				}
				
				$post_ids = array_merge( $tnh_ids, $post_ids);
				$sticky_post_ids = $sticky ? array_merge( $sticky_tnh_ids, $sticky_post_ids) : [];

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
				)); 
			} else {
				$sticky_posts = new WP_Query(array('post__in' => array(0)));
			}

			$maxPosts = ($maxPosts - count($sticky_post_ids) > 0) ? $maxPosts - count($sticky_post_ids) : false;

			if($maxPosts && count($post_ids) > 0){
				// the main query
				$posts = new WP_Query(array(
				    'post_type' 						=> 'any',
				    'post__in'  						=> $post_ids, 
				    'orderby'   						=> 'date',
						'order'           			=> 'DESC',
						'ignore_sticky_posts' 	=> 1,					
						'posts_per_page' 				=> $maxPosts,
				));	
			} else {
				$posts = new WP_Query(array('post__in' => array(0)));
			}

		else :
			$args = array (
				'post_status'           => array( 'publish' ),
				'post__in'							=> get_field('posts_to_show'),
				'ignore_sticky_posts' 	=> 1,					
			);
			$posts = new WP_Query( $args );

		endif;


		// The Loop
		if ( $sticky_posts->have_posts() || $posts->have_posts() ) {  ?>

			<?php if($style == 'list') : ?><ul class="small post-list"><?php else : ?><div class="post-list"><?php endif; ?>
				<?php while ( $sticky_posts->have_posts() ) { ?>
					<?php $sticky_posts->the_post(); ?>
					<p>sticky</p>
					<?php get_template_part( 'template-parts/'.$style, get_post_type() ); ?>
				<?php } ?>
				<?php while ( $posts->have_posts() ) { ?>
					<?php $posts->the_post(); ?>
					<?php get_template_part( 'template-parts/'.$style, get_post_type() ); ?>
				<?php } ?>
			<?php if($style == 'list') : ?></ul><?php else : ?></div><?php endif; ?>
	<?php } 

	// Restore original Post Data
	wp_reset_postdata();



	?>  	
