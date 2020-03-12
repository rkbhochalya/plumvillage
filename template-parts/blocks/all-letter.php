<?php 
// WP_Query arguments
	$args = array (
		'post_type'              => array( 'letter' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'posts_per_page' 				 => 100
	);

	// The Query
	$letters = new WP_Query( $args );

	// The Loop
	if ($letters->have_posts() ) { ?>
		<?php echo get_filter_menu($letters, 'topics'); ?>
		<div class="to-left-edge to-right-edge">
			<div class="row post-overview">
				<?php while ( $letters->have_posts() ) { ?>
					<?php $letters->the_post(); ?>
					<?php get_template_part( 'template-parts/index', 'letter' ); ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

<?php wp_reset_postdata(); ?>