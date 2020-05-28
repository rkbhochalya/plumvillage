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

 	$filters['language'] = $filters['practice_centres'] = $filters['event_type'] = array();

 	$showFilters = get_field('show_filters');
 	$maxDays = get_field('max_days');
	$days = 0;

	$allevents = array();

	$currentTime = strtotime(current_time('mysql')); 

	// The Loop
	if ($events->have_posts() ) {
		while ( $events->have_posts() ) {
			$events->the_post(); 
			$dates = get_field('dates', get_the_ID());

			if($dates){

				$id = get_the_ID();
				$youtube_livestream_url = get_field('youtube_livestream_url', $id);
				$content = get_the_content();
				$practice_centres = get_field('many2many_event_practice_centre', $id);
				$event_type = get_field('type', $id);
				$language = get_field('language', $id);

				foreach($dates as $row){
					
					$row['startTime'] = strtotime($row['start_date_time']);
					
					// check this event is today or later
					if(date('Ymd') <= date('Ymd', $row['startTime'])){

						$row['id'] = $id;
						$row['youtube_livestream_url'] = $youtube_livestream_url;
						$row['content'] = $content;
						$row['endTime'] = strtotime(date('d-m-Y ', $row['startTime']) . $row['end_time']);
						$row['filters']['practice_centres'] = $practice_centres;
						$row['filters']['event_type'] = $event_type;
						$row['filters']['language'] = $language;

						// add practice centres to filters and count how many iterms per filter

						if($showFilters){
							foreach($practice_centres as $practice_centre){
								if(isset($filters['practice_centres'][$practice_centre])){
									$filters['practice_centres'][$practice_centre] += 1;
								} else {
									$filters['practice_centres'] += array($practice_centre => 1);
								}
							}

							foreach($event_type as $type){
								if(isset($filters['event_type'][$type])){
									$filters['event_type'][$type] += 1;
								} else {
									$filters['event_type'] += array($type => 1);
								}
							}

							foreach($language as $lang){
								if(isset($filters['language'][$lang])){
									$filters['language'][$lang] += 1;
								} else {
									$filters['language'] += array($lang => 1);
								}
							}
						}
						// add row to events
						$allevents[] = $row;
					}
				}
			}
		}
	}

	// sort filters on most popular
	arsort($filters['event_type']);
	arsort($filters['language']);
	arsort($filters['practice_centres']);


	// for the practice centres, replace count with the post array, so we can use it later to check for parent/child
	foreach ($filters['practice_centres'] as $key => $value) {
		$filters['practice_centres'][$key] = get_post($key);
	}

	// sort all events
	usort($allevents, 'date_compare');
	
	if(count($allevents) > 0) : ?>

		<?php if($showFilters) : ?>
			<div class="toggle-show-filters">
				<button class="btn btn-link">
					<i class="icon icon-filters"></i>
					<span class="label-show"><?php _e('Show', 'plumvillage'); ?></span>
					<span class="label-hide"><?php _e('Hide', 'plumvillage'); ?></span>
					<?php _e('Filters', 'plumvillage'); ?>
				</button>
			</div>
		<?php endif; ?>
		<h4><?php _e('Upcoming Online Events', 'plumvillage'); ?> <small><?php echo count($allevents) . ' ' . __('items', 'plumvillage'); ?></small></h4>

		<div class="online-events-list <?php if($showFilters) : ?>post-overview post-overview-with-filters<?php endif; ?>" data-isotope-layoutmode="masonry">
			<?php if($showFilters) : ?>
				<div class="filter-block filter-block-horizontal">
					<?php foreach ($filters as $key => $filter) { ?>
						<b>
							<?php if($key == 'practice_centres'){
								_e('Practice Centers');
							} else if($key == 'language'){
								_e('Language');
							} else if ($key == 'event_type'){
								_e('Event Type');
							} ?>
						</b>	
						<div class="filter-list">
							<a href="#filter=*" class="reset-filter selected" data-filter="*"> Show Everything</a>
							<?php if($key != 'practice_centres'){
								foreach ($filter as $term_id => $count) {
									$term = get_term_by('id', $term_id, $key); 
									$class = $key . '-' . $term->slug; ?>
									<a href="#filter=<?php echo $class; ?>" class="filter-products trigger-<?php echo $class; ?>" data-filter=".<?php echo $class; ?>"><?php echo $term->name; ?></a>
					 			<?php }
							} else {
								foreach ($filter as $post_id => $post) {
									if(!$post->post_parent){
										$class = $key . '-' . $post->post_name; ?>
										<a href="#filter=<?php echo $class; ?>" class="filter-products trigger-<?php echo $class; ?>" data-filter=".<?php echo $class; ?>"><?php echo $post->post_title; ?></a>
										<?php // check if this page has children
										foreach ($filter as $child_post_id => $child_post) {
											if($post_id == $child_post->post_parent){
												$class = $key . '-' . $child_post->post_name; ?>
												<a href="#filter=<?php echo $class; ?>" class="filter-products child-filter trigger-<?php echo $class; ?>" data-filter=".<?php echo $class; ?>"><?php echo $child_post->post_title; ?></a>
											<?php 
											}
										}
									}
					 			}
							} ?>
						</div>
					<?php } ?>
				</div>
			<?php endif; 


			foreach($allevents as $i => $event){
				// get next event
				$nextEvent = (isset($allevents[$i + 1])) ? $allevents[$i + 1] : false;

				// check if this or next event are on the same day
				$nextSameDay = ($nextEvent) ? date('d-m-Y', strtotime($nextEvent['start_date_time'])) == date('d-m-Y', strtotime($event['start_date_time'])) : false;
				$prevsameDay = (isset($startTime) && date('d-m-Y', $startTime) == date('d-m-Y', strtotime($event['start_date_time'])));

				if(!$prevsameDay){
					$days++;
				}

				if(($maxDays == 0) || ($maxDays >=  $days)){

					// get start and end time
					$startTime = strtotime($event['start_date_time']);
					$endTime = strtotime(date('d-m-Y ', $startTime) . $event['end_time']);

					// is it happening now?
					$now = (($startTime < $currentTime) && ($endTime > $currentTime)); 
					$today = date('Ymd') == date('Ymd', $event['startTime']);
					$past = $endTime < $currentTime;

					$classes = '';
					foreach ($event['filters'] as $key => $filters) {
						if($key != 'practice_centres'){
							foreach ($filters as $term_id) {
								$term = get_term_by('id', $term_id, $key);
								$classes .= $key . '-' . $term->slug . ' ';
							}
						} else {
							foreach ($filters as $post_id) {
								$post = get_post($post_id);
								$classes .= $key . '-' . $post->post_name . ' ';
							}
						}
					}

					?>

					<article class="index-online-event <?php echo $classes; ?><?php if($prevsameDay): ?>prev-same-day<?php endif; ?> <?php if($nextSameDay): ?>next-same-day<?php endif; ?> <?php if($now) : ?>is-live-now<?php endif; ?> <?php if($past): ?>past<?php endif; ?>" data-load-livestream="<?php if($today && $event['youtube_livestream_url']){echo 'true'; }; ?>" data-embed-link="$liveVideo<?php echo $i; ?>" data-start-time="<?php echo $startTime; ?>" data-end-time="<?php echo $endTime; ?>">
						<button class="btn btn-link btn-close"><i class="icon icon-close"></i></button>
						<div class="index-online-date">
							<div class="date-month"><?php echo date_i18n('M', $startTime); ?></div>
							<div class="date-date"><?php echo date_i18n('j', $startTime); ?></div>
						</div>
						<div class="index-online-header">
							<div class="index-online-time">
								<?php if($now) : ?><span class="live-now"><?php _e('live now', 'plumvillage'); ?></span><?php endif; ?>
								<span class="day-name"><?php echo date_i18n('l', $startTime); ?> </span> 
								<span class="start-time"><?php echo date_i18n('H:i', $startTime); ?></span> - <span class="end-time"><?php echo date_i18n('H:i', $endTime); ?></span>
								<span class="gmt-offset"><?php 	echo 'GMT+' . get_option('gmt_offset'); ?></span>
							</div>
							<h4 class="entry-title">
								<?php echo get_the_title($event['id']); ?>
								<small class="index-online-location">
									<?php if($event['filters']['language']) : 
										$li = 0;
										_e('in', 'plumvillage'); ?> 
										<?php foreach( $event['filters']['language'] as $term_id):
											if($li != 0){
												echo ', ';
											} 
											$li++;
											$term = get_term_by('id', $term_id, 'language'); 
											echo $term->name;
										endforeach;
									endif;
									if( $event['filters']['practice_centres'] ): 
										$pi = 0;
										echo ', ' . __('at', 'plumvillage'); ?> 
										<?php foreach( $event['filters']['practice_centres'] as $practice_centre):
											if($pi != 0){
												echo ', ';
											} 
											$pi++;
									  	echo get_the_title($practice_centre);
										endforeach;
									endif; ?>
								</small>
							</h4>
						</div>
						<div class="index-online-content">
							<?php if($event['youtube_livestream_url']) : ?>
								<script>var $liveVideo<?php echo $i; ?> = '<iframe src="<?php echo $event['youtube_livestream_url']; ?>&amp;autoplay=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="560" height="315" frameborder="0"></iframe>';</script>
								<figure class="hide wp-block-embed alignwide is-type-video is-provider-youtube">
									<div class="wp-block-embed__wrapper dropzone">
									</div>
								</figure>
								<p class="not-ready"><?php echo sprintf(__('We are not yet ready for the %s, please refresh this page 10 minutes before the event starts.', 'plumvillage'), get_the_title($event['id'])); ?></p>	
							<?php endif; ?>
							<?php echo $event['content']; ?>
						</div>
					</article>
				<?php } ?>
			<?php } ?>
		</div>

		<?php if(($maxDays != 0) && ($days > $maxDays)){ ?>
			<div class="text-center online-events-list-footer">
				<a class="btn btn-outline-light btn-sm" href="<?php echo esc_url( home_url( '/live' ) ); ?>"><?php _e('View all online events', 'plumvillage'); ?></a>
			</div>
		<?php } ?>
	<?php endif;

wp_reset_postdata(); ?>



