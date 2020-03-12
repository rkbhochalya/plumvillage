<?php 
// WP_Query arguments
	$args = array (
		'post_type'              => array( 'interview' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'posts_per_page' 				 => 100
	);

	// The Query
	$interviews = new WP_Query( $args );

	// The Loop
	if ($interviews->have_posts() ) { ?>
		<div class="filters">
			<?php 
				echo get_filter_menu($interviews, 'topics'); 
				echo get_filter_menu($interviews, 'types'); 
			?>
		</div>
		<div class="post-overview" data-isotope-layoutmode='vertical'>
			<?php $year = 0; ?>
			<?php $i = 0; ?>
			<?php while ( $interviews->have_posts() ) { ?>
				<?php $interviews->the_post(); ?>
				<?php 
					if($year != get_the_date('Y')) :
						$year = get_the_date('Y'); ?>
						<div class="in-betweener <?php if($i == 0) : ?>first<?php endif; ?>">
							<hr>
							<h2><?php echo $year; ?></h2>
						</div>		
					<?php endif; ?>
					<?php $i++; ?>
				<?php get_template_part( 'template-parts/index', 'interview' ); ?>
			<?php } ?>
		</div>
	<?php } ?>

<?php wp_reset_postdata(); ?>