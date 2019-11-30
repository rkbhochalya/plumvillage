
		<?php 

		$style = get_field('style') ? get_field('style') : 'list';

		$maxPosts = get_field('max_posts') ? get_field('max_posts') : 3;
		$category = get_field('category') ? get_field('category') : 0;

		if(get_field('show') == 'latest') : 

			// Get Sticky posts
			$sticky_post_ids = get_posts(array(
				'fields'								 => 'ids',
				'posts_per_page'				 => $maxPosts,
				'post_type'							 => 'post',
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'meta_key'							 => 'sticky',
				'meta_value'						 => 1,
				'category__in'					 => $category,
			));

			$sticky_tnh_ids = get_posts(array(
				'fields'								 => 'ids',
				'posts_per_page'				 => $maxPosts,
				'post_type'							 => 'tnh_update',
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'meta_key'							 => 'sticky',
				'meta_value'						 => 1
			));


			// Get all posts
			$post_ids = get_posts( array(
				'fields'								 => 'ids',
				'post_type'              => 'post',
				'post_status'            => array( 'publish' ),
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'category__in'					 => $category,
				'posts_per_page' 				 => $maxPosts,
				'exclude'								 => $sticky_post_ids
			));


			if(get_field('include_tnh_news')) :
				
				$tnh_ids = get_posts( array(
					'fields' 								 => 'ids',
					'post_type'              => 'tnh_update',
					'post_status'            => array( 'publish' ),
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'posts_per_page' 				 => $maxPosts,
					'exclude'								 => $sticky_tnh_ids
				));

				$post_ids = array_merge( $sticky_tnh_ids, $sticky_post_ids, $post_ids, $tnh_ids);

			endif;

			// the main query
			$posts = new WP_Query(array(
			    'post_type' 			=> 'any',
			    'post__in'  			=> $post_ids, 
			    'meta_key'				=> 'sticky',
			    'orderby'   			=> array(
			    	'meta_value' => 'DESC',
			    	'date'  => 'DESC',
			    ), 
					'posts_per_page' 	=> $maxPosts,
			));

		else :
			$args = array (
				'post_status'            => array( 'publish' ),
				'post__in'							=> get_field('posts_to_show')
			);
			$posts = new WP_Query( $args );

		endif;


		// The Loop
		if ( $posts->have_posts() ) {  ?>

			<?php if($style == 'list') : ?><ul class="small post-list"><?php else : ?><div class="post-list"><?php endif; ?>
				<?php while ( $posts->have_posts() ) { ?>
					<?php $posts->the_post(); ?>
					<?php get_template_part( 'template-parts/'.$style, get_post_type() ); ?>
				<?php } ?>
			<?php if($style == 'list') : ?></ul><?php else : ?></div><?php endif; ?>
	<?php } 

	// Restore original Post Data
	wp_reset_postdata();



	?>  	
