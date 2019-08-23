
		<?php 

		if(get_field('show') == 'latest') : 

			$maxPosts = get_field('max_posts') ? get_field('max_posts') : 3;
			$postType = get_field('post_type') ? get_field('post_type') : 'post';
			$category = get_field('category') ? get_field('category') : 0;

		// WP_Query arguments
			$args = array (
				'post_type'              => array( $postType ),
				'post_status'            => array( 'publish' ),
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'category__in'					 => $category,
				'posts_per_page' 				 => $maxPosts,
			);

			// The Query
		else :
			$args = array (
				'post_status'            => array( 'publish' ),
				'post__in'							=> get_field('posts_to_show')
			);

		endif;
			$posts = new WP_Query( $args );

			// The Loop
			if ( $posts->have_posts() ) {  ?>
				<ul class="small post-list">
					<?php while ( $posts->have_posts() ) { ?>
						<?php $posts->the_post(); ?>
						<?php get_template_part( 'template-parts/list', get_post_type() ); ?>
					<?php } ?>
				</ul>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>  	
