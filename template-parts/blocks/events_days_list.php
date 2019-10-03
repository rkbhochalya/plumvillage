
	<?php 

	$max_items = get_field('max_posts') ? get_field('max_posts') : -1;

	$args = array (
		'post_type' => array( 'pv_event' ),
		'post_status'            => array( 'publish' ),
		'order'									 => 'ASC',
		'posts_per_page'				 => $max_items,
		'meta_query'=>array(
			 array(
			    'key' => 'type_of_event',
			    'value' => 'day'
			 )
			)				
	);

	$posts = new WP_Query( $args );

	// The Loop
	if ( $posts->have_posts() ) { 
		$events[] = $posts;
	} 

	// Restore original Post Data
	wp_reset_postdata();


	?>
	<?php if(!isset($events)) : ?>
		<p><?php _e('No upcoming events', 'plumvillage'); ?></p>
	<?php else : ?>
		<div class="event-list">
			<?php 
			$i = 0;
			foreach ($events as $posts){ ?>
				<div class="row">
						<?php while ( $posts->have_posts() ) { ?>
							<?php $posts->the_post(); ?>
							<div class="<?php if(get_field('style') == 'list') : ?>col-md-12<?php else : ?>col-md-4<?php endif; ?>">
								<?php get_template_part( 'template-parts/index-day', get_post_type() ); ?>
							</div>
						<?php } ?>
				</div>
				<?php $i++; ?>
			<?php } ?>
		</div>
	<?php endif; ?>
