

	<?php 

	$max_items = get_field('max_posts') ? get_field('max_posts') : -1;

	$args = array (
		'post_type' => array( 'pv_event' ),
		'post_status'            => array( 'publish' ),
		'order'									 => 'ASC',
		'posts_per_page'				 => $max_items,
		'meta_query'=>array(
			 array(
			    'key' => 'event_type',
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

	<div class="block event-list align<?php echo $block['align']; ?>">
		<div class="block-inside">
		<?php if(!isset($events)) : ?>
			<p><?php _e('No upcoming events', 'plumvillage'); ?></p>
		<?php else : ?>
				<?php 
				$i = 0;
				foreach ($events as $posts){ ?>
					<div class="row">
							<?php while ( $posts->have_posts() ) { ?>
								<?php $posts->the_post(); ?>
								<?php if(have_rows('dates', get_the_ID())) : ?>
									<div class="<?php if(get_field('style') == 'columns') : ?>col-md-4<?php else : ?>col-md-12<?php endif; ?>">
										<?php get_template_part( 'template-parts/index-day', get_post_type() ); ?>
									</div>
								<?php endif; ?>
							<?php } ?>
					</div>
					<?php $i++; ?>
				<?php } ?>
		<?php endif; ?>
	</div>
</div>