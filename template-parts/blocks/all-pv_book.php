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
	$books = new WP_Query( $args );

	// The Loop
	if ($books->have_posts() ) { ?>
		<div class="filters">
			<?php
				echo get_filter_menu($books, 'genre');
				echo get_filter_menu($books, 'topics'); 
			?>
		</div>
		<div class="to-left-edge to-right-edge">
			<div class="row post-overview">
				<?php while ( $books->have_posts() ) { ?>
					<?php $books->the_post(); ?>
					<?php get_template_part( 'template-parts/index', 'book' ); ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	
<?php wp_reset_postdata();?>