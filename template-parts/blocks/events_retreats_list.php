
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

	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'practice_centre' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'ASC',
		'post_parent'						 => 0,
		'orderby'                => 'menu_order',
		'posts_per_page' 				 => 100,
		'meta_query'=>array(
			'compare' => 'AND',
			 array(
			    'key' => 'hide_in_overview',
			    'compare' => 'EXISTS',
			 ),
			 array(
			    'key' => 'hide_in_overview',
			    'value' => true,
			    'compare' => '!='
			 )
			)				
	);

	// The Query
	$query = new WP_Query( $args );
	$practice_centres = $query->posts;
	$event_locations = array(); 

	foreach ( $practice_centres as $practice_centre ) {
		$events = get_field('many2many_event_practice_centre', $practice_centre->ID);
		$hasEvents = false;
		if( $events ):
    	foreach( $events as $event):
    		if(date('d/m/Y') <= get_field('end_date', $event)) :
    			$hasEvents = true;
    		endif;
	   		endforeach;
	   		if($hasEvents){
					$event_locations[] = pv_object_to_array($practice_centre);
	   		}
		endif;  
	}


	// $practise_centres = get_terms( array( 
	// 	'taxonomy' => 'practise-centres',
	// 	'hide_empty' => false,
	// 	'parent' => 0,
	// ) );

	// if  ($practise_centres) {
	// 	foreach ($practise_centres  as $practise_centre ) { 

	// 		$args = array (
	// 			'post_type' => array( 'pv_event' ),
	// 			'tax_query' => array(
	// 	        array (
	// 	            'taxonomy' => 'practise-centres',
	// 	            'field' => 'slug',
	// 	            'terms' => $practise_centre->slug,
	// 	        )
	// 	    ),			
	// 			'post_status'            => array( 'publish' ),
	// 			'posts_per_page'				 => 1,
	// 			'fields' => 'ids',
	// 			'meta_query'=>array(
	// 				 array(
	// 				    'key' => 'end_date',
	// 				    'value' => date('Ymd'),
	// 				    'compare' => '>=',
	// 				    'type' => 'NUMERIC'
	// 				 ),
	// 				)				
	// 		);

	// 		$has_posts = new WP_Query( $args );

	// 		// The Loop
	// 		if ( $has_posts->have_posts() ) { 
	// 			$event_locations[] = pv_object_to_array($practise_centre);
	// 		} 

	// 		// Restore original Post Data
	// 		wp_reset_postdata();

	// 	}
	// }

	?>
	<?php if(!isset($posts)) : ?>
		<p><?php _e('No upcoming events', 'plumvillage'); ?></p>
	<?php else : ?>
		<?php if(count($event_locations) > 1) : ?>
			<?php $i = 0; ?>
	      <div class="filter-block">
	        <h5 class="filter-title"><?php echo __("Filter by location", "plumvillage"); ?></h5>
	        <div class="filter-list show-all" <?php if($max_items) : ?>data-filter-max="<?php echo $max_items; ?>" <?php endif; ?>><a href="#filter=*" class="reset-filter <?php if(!get_field('show_first')) : ?>selected<?php endif; ?>" data-filter="*"> <?php _e("Show Everything", "plumvillage"); ?></a>,
						<?php foreach ($event_locations as $location){
	            echo '<a href="#filter=practice-centres-'.$location['post_name'].'" class="'.((get_field('show_first') == $location['ID']) ? 'selected' : '').' filter-products trigger-'.$location['post_name'].'" data-filter=".practice-centres-'.$location['post_name'].'">'.$location['post_title'].'</a>';      
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
			<div class="row post-overview" data-isotope-layoutmode="masonry">
				<?php while ( $posts->have_posts() ) { ?>
					<?php $posts->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="index-event index-item col-md-<?php echo (12 / get_field('columns')); echo get_post_names(get_field('many2many_event_practice_centre', get_the_ID()));?>" <?php // post_class('index-event index-item col-md-'.(12 / get_field('columns'))); ?>>					
						<?php get_template_part( 'template-parts/index', get_post_type() ); ?>
					</article>
				<?php } ?>
			</div>
		</div>
	<?php endif; ?>
