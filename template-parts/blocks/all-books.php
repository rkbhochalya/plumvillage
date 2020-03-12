					<?php 
					// WP_Query arguments
						$args = array (
							'post_type'              => array( 'pv_book' ),
							'post_status'            => array( 'publish' ),
							'nopaging'               => true,
							'order'                  => 'ASC',
							'orderby'                => 'title',
							'posts_per_page' 				 => 100,
							'meta_query'						 => array(
								'relation' => 'OR',
								array(
									'key' => 'exclude_from_index',
									'compare' => 'NOT EXISTS'
								),
								array(
									'key' => 'exclude_from_index',
									'value' => '1',
									'compare' => '!='
								)
							)
						);

						// The Query
						$posts = new WP_Query( $args );

						// The Loop
						if ($posts->have_posts() ) { ?>
						<div class="filters">
							<?php
								echo get_filter_menu($posts, 'genre');
								echo get_filter_menu($posts, 'topics'); 
							?>
						</div>
						<div class="to-left-edge to-right-edge">
						<div class="row post-overview">
							<?php while ( $posts->have_posts() ) { ?>
								<?php $posts->the_post(); ?>
								<?php get_template_part( 'template-parts/index', 'book' ); ?>
							<?php } ?>
						</div>
						</div>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>