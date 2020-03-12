<?php 
// WP_Query arguments
	$args = array (
		'post_type'              => array( 'tnh_update' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'posts_per_page' 				 => 100
	);

	// The Query
	$updates = new WP_Query( $args );

	// The Loop
	if ( $updates->have_posts() ) {  ?>
	
			<?php $year = 0; ?>
			<?php while ( $updates->have_posts() ) { ?>
				<?php $updates->the_post(); ?>
				<?php 
					if($year != get_the_date('Y')) :
						$year = get_the_date('Y'); ?>
						<div class="in-betweener">
							<hr>
							<h2 class="center-with-border"><?php echo $year; ?></h2>
						</div>		
					<?php endif; ?>
				<?php get_template_part( 'template-parts/index', 'update' ); ?>
			<?php } ?>
	<?php } ?>

<?php wp_reset_postdata(); ?>