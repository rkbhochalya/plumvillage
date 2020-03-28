<?php 
// WP_Query arguments
	$args = array (
		'post_type'              => array( 'pv_online_event' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'posts_per_page' 				 => 100
	);

	// The Query
	$events = new WP_Query( $args );

	$allevents = array();

	$currentTime = strtotime(current_time('mysql')); 

	// The Loop
	if ($events->have_posts() ) {
		while ( $events->have_posts() ) {
			$events->the_post(); 
			$dates = get_field('dates', get_the_ID());



			foreach($dates as $row){
				$row['id'] = get_the_ID();
				$row['youtube_livestream_url'] = get_field('youtube_livestream_url', $row['id']);
				$row['content'] = get_the_content();
				$row['startTime'] = strtotime($row['start_date_time']);
				$row['endTime'] = strtotime(date('d-m-Y ', $row['startTime']) . $row['end_time']);
				$row['practice_centres'] = get_field('many2many_event_practice_centre', $row['id']);
				if($row['endTime'] > $currentTime){
					$allevents[] = $row;
				}
			}
		}
	}

	// sort all events
	usort($allevents, 'date_compare');
	
	if(count($allevents) > 0) : ?>

		<h4><?php _e('Upcoming Online Events', 'plumvillage'); ?> <small><?php echo count($allevents) . ' ' . __('items', 'plumvillage'); ?></small></h4>
		<div class="online-events-list">
			<?php foreach($allevents as $i => $event){
				// get next event
				$nextEvent = $allevents[$i + 1];

				// check if this or next event are on the same day
				$nextSameDay = date('d-m-Y', strtotime($nextEvent['start_date_time'])) == date('d-m-Y', strtotime($event['start_date_time']));
				$prevsameDay = (isset($startTime) && date('d-m-Y', $startTime) == date('d-m-Y', strtotime($event['start_date_time'])));

				// get start and end time
				$startTime = strtotime($event['start_date_time']);
				$endTime = strtotime(date('d-m-Y ', $startTime) . $event['end_time']);

				// is it happening now?
				$now = (($startTime < $currentTime) && ($endTime > $currentTime)); 

				?>



				<div class="index-online-event <?php if($prevsameDay): ?>prev-same-day<?php endif; ?> <?php if($nextSameDay): ?>next-same-day<?php endif; ?> <?php if($now) : ?>is-live-now<?php endif; ?>" data-embed-link="$liveVideo<?php echo $i; ?>" data-start-time="<?php echo $startTime; ?>" data-end-time="<?php echo $endTime; ?>">
					<button class="btn btn-link btn-close"><i class="icon icon-close"></i></button>
					<div class="index-online-date">
						<div class="date-month"><?php echo date('M', $startTime); ?></div>
						<div class="date-date"><?php echo date('j', $startTime); ?></div>
					</div>
					<div class="index-online-header">
						<div class="index-online-time">
							<?php if($now) : ?><span class="live-now"><?php _e('live now', 'plumvillage'); ?></span><?php endif; ?>
							<span class="day-name"><?php echo date('l', $startTime); ?> </span> 
							<span class="start-time"><?php echo date('H:i', $startTime); ?></span> - <span class="end-time"><?php echo date('H:i', $endTime); ?></span>
						</div>
						<h4 class="entry-title">
							<?php echo get_the_title($event['id']); ?>
							<?php if( $event['practice_centres'] ): 
								$pi = 0; ?>
								<small class="index-online-location"><?php _e('at', 'plumvillage'); ?> 
									<?php foreach( $event['practice_centres'] as $practice_centre):
										if($pi != 0){
											echo ', ';
										} 
										$pi++; ?>
								  	<?php echo get_the_title($practice_centre); ?>
									<?php endforeach; ?>
								</small>
							<?php endif; ?>								
						</h4>
					</div>
					<div class="index-online-content">
						<?php if($event['youtube_livestream_url']) : ?>
							<script>var $liveVideo<?php echo $i; ?> = '<iframe src="<?php echo $event['youtube_livestream_url']; ?>&amp;autoplay=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="560" height="315" frameborder="0"></iframe>';</script>
							<figure class="hide wp-block-embed alignwide is-type-video is-provider-youtube">
								<div class="wp-block-embed__wrapper dropzone">
								</div>
							</figure>
							<p class="not-ready"><?php echo sprintf(__('We are not yet ready for %s, please refresh this page 10 minutes before the event starts.', 'plumvillage'), get_the_title($event['id'])); ?></p>	
						<?php endif; ?>
						<?php echo $event['content']; ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php endif;

wp_reset_postdata(); ?>



