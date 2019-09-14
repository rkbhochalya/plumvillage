
	<?php 

	$max_items = get_field('max_posts') ? get_field('max_posts') : -1;

	// get the first list
	if(get_field('show_first')){
		// add events 'On Tour'

		$args = array (
			'post_type'              => array( 'pv_event' ),
			'tax_query' => array(
	        array (
	            'taxonomy' => 'practise-centres',
	            'field' => 'slug',
	            'terms' => get_field('show_first')->slug,
	        )
	    ),			
			'post_status'            => array( 'publish' ),
			'meta_key'							 => 'start_date',
			'orderby'								 => 'meta_value',
			'order'									 => 'ASC',
			'posts_per_page'				 => $max_items,
			'meta_query'=>array(
				 array(
				    'key' => 'start_date',
				    'value' => date('Ymd'),
				    'compare' => '>=',
				    'type' => 'NUMERIC'
				 )
				)				
		);

		$posts = new WP_Query( $args );

		// The Loop
		if ( $posts->have_posts() ) { 
			$events[] = $posts;
			$event_locations[] = object_to_array(get_field('show_first'));
		} 		
	}



	$practise_centres = get_terms( array( 
		'taxonomy' => 'practise-centres',
		'hide_empty' => false,
		'parent' => 0,
		'exclude' => get_field('show_first')->term_id
	) );

	if  ($practise_centres) {
		foreach ($practise_centres  as $practise_centre ) { 

			$args = array (
				'post_type'              => array( 'pv_event' ),
				'tax_query' => array(
		        array (
		            'taxonomy' => 'practise-centres',
		            'field' => 'slug',
		            'terms' => $practise_centre->slug,
		        )
		    ),			
				'post_status'            => array( 'publish' ),
				'meta_key'							 => 'start_date',
				'orderby'								 => 'meta_value',
				'order'									 => 'ASC',
				'posts_per_page'				 => $max_items,
				'meta_query'=>array(
					 array(
					    'key' => 'start_date',
					    'value' => date('Ymd'),
					    'compare' => '>=',
					    'type' => 'NUMERIC'
					 ),
					)				
			);

			$posts = new WP_Query( $args );

			// The Loop
			if ( $posts->have_posts() ) { 
				$events[] = $posts;
				$event_locations[] = object_to_array($practise_centre);
			} 

			// Restore original Post Data
			wp_reset_postdata();

		}
	}

	// add events 'On Tour'
	$args = array (
		'post_type'              => array( 'pv_event' ),
		'post_status'            => array( 'publish' ),
		'meta_key'							 => 'start_date',
		'orderby'								 => 'meta_value',
		'order'									 => 'ASC',
		'posts_per_page'				 => $max_items,
		'meta_query'=>array(
			 array(
			    'key' => 'start_date',
			    'value' => date('Ymd'),
			    'compare' => '>=',
			    'type' => 'NUMERIC'
			 ),
			 array(
			 		'key' => 'location',
			 		'value' => 'on_tour',
			 )
			)				
	);

	$posts = new WP_Query( $args );

	// The Loop
	if ( $posts->have_posts() ) { 
		$events[] = $posts;
		$event_locations[] = array(
			'name' => 'On Tour',
			'slug' => 'on_tour'
		);
	} 

	// Restore original Post Data
	wp_reset_postdata();


	?>

	<div class="text-with-select"><p class="has-grey-color"><?php _e('Show upcoming retreats in', 'plumvillage'); ?></p>
		<div class="select-inline">
			<select class="toggle-events-locations" data-error="error">
				<?php foreach ($event_locations as $location){ ?>
					<option value="location-<?php echo $location['slug']; ?>"><?php echo $location['name']; ?></option> 
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="event-list">
		<?php 
		$i = 0;
		foreach ($events as $posts){ ?>
			<div class="row location-<?php echo $event_locations[$i]['slug']; if($i != 0) : echo ' hide'; endif; ?>">
					<?php while ( $posts->have_posts() ) { ?>
						<?php $posts->the_post(); ?>
						<div class="<?php if(get_field('style') == 'list') : ?>col-md-12<?php else : ?>col-md-4<?php endif; ?>">
							<?php get_template_part( 'template-parts/index', get_post_type() ); ?>
						</div>
					<?php } ?>
			</div>
			<?php $i++; ?>
		<?php } ?>
	</div>
