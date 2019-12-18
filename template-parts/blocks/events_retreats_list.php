
	<?php 

	$max_items = get_field('max_posts');
	$has_first = false;

	$args = array (
		'post_type'              => array( 'pv_event' ),
		'post_status'            => array( 'publish' ),
		'meta_key'							 => 'start_date',
		'orderby'								 => 'meta_value',
		'order'									 => 'ASC',
		'meta_query'=>array(
			 array(
			    'key' => 'end_date',
			    'value' => date('Ymd'),
			    'compare' => '>=',
			    'type' => 'NUMERIC'
			 )
			)				
	);

	$posts = new WP_Query( $args );

	$practise_centres = get_terms( array( 
		'taxonomy' => 'practise-centres',
		'hide_empty' => false,
		'parent' => 0,
	) );

	if  ($practise_centres) {
		foreach ($practise_centres  as $practise_centre ) { 

			$args = array (
				'post_type' => array( 'pv_event' ),
				'tax_query' => array(
		        array (
		            'taxonomy' => 'practise-centres',
		            'field' => 'slug',
		            'terms' => $practise_centre->slug,
		        )
		    ),			
				'post_status'            => array( 'publish' ),
				'posts_per_page'				 => 1,
				'fields' => 'ids',
				'meta_query'=>array(
					 array(
					    'key' => 'end_date',
					    'value' => date('Ymd'),
					    'compare' => '>=',
					    'type' => 'NUMERIC'
					 ),
					)				
			);

			$has_posts = new WP_Query( $args );

			// The Loop
			if ( $has_posts->have_posts() ) { 
				$event_locations[] = pv_object_to_array($practise_centre);
			} 

			// Restore original Post Data
			wp_reset_postdata();

		}
	}

	?>
	<?php if(!isset($posts)) : ?>
		<p><?php _e('No upcoming events', 'plumvillage'); ?></p>
	<?php else : ?>
		<?php if(count($event_locations) > 1) : ?>
			<?php $i = 0; ?>
	      <div class="filter-block">
	        <h5 class="filter-title"><?php echo __("Filter by location", "plumvillage"); ?></h5>
	        <div class="filter-list" <?php if($max_items) : ?>data-filter-max="<?php echo $max_items; ?>" <?php endif; ?>><a href="#filter=*" class="reset-filter <?php if(!get_field('show_first')) : ?>selected<?php endif; ?>" data-filter="*"> <?php _e("Show Everything", "plumvillage"); ?></a>,
						<?php foreach ($event_locations as $location){
	            echo '<a href="#filter=practise-centres-'.$location['slug'].'" class="'.((get_field('show_first')->slug == $location['slug']) ? 'selected' : '').' filter-products trigger-'.$location['slug'].'" data-filter=".practise-centres-'.$location['slug'].'">'.$location['name'].'</a>';      
	            $i++;
	            if(count($event_locations) != $i){
	              echo ', ';
	            }
	          } ?>
	            <span class="toggle-filter-list icon-circle-caret-down"></span>
	        </div>
	      </div>
		<?php endif; ?>

		<div class="event-list <?php if(isset($block['className'])){ echo ' ' . $block['className']; } ?>">
			<div class="row post-overview">
				<?php while ( $posts->have_posts() ) { ?>
					<?php $posts->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('index-event index-item col-md-'.(12 / get_field('columns'))); ?>>					
							<?php get_template_part( 'template-parts/index', get_post_type() ); ?>
						</article>
				<?php } ?>
			</div>
		</div>
	<?php endif; ?>
