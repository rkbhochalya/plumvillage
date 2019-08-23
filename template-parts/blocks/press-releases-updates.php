<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="press-tab" data-toggle="tab" href="#press" role="tab" aria-controls="press" aria-selected="true"><?php _e('Press Releases', 'plumvillage'); ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="updates-tab" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="false"><?php _e('Recent Updates', 'plumvillage'); ?></a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane show active" id="press" role="tabpanel" aria-labelledby="press-tab">
		<?php $maxItems = 5; ?>
		<?php 
		// WP_Query arguments
			$args = array (
				'post_type'              => array( 'tnh_press_release' ),
				'post_status'            => array( 'publish' ),
				'nopaging'               => true,
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'posts_per_page' 				 => 100
			);

			// The Query
			$posts = new WP_Query( $args );

			// The Loop
			if ( $posts->have_posts() ) {  ?>
					


					<?php $i = 1; ?>
					<?php while ( $posts->have_posts() ) { ?>
						<?php $posts->the_post(); ?>
						<?php if($maxItems == ($i - 1)) : ?>
								 <div class="load-more-container">
								 		<div class="center-without-border load-more"><a href="#"><?php _e('Load More', 'plumvillage'); ?></a></div>
								 		<div class="load-hide">
						<?php endif; ?>
							<?php get_template_part( 'template-parts/index', 'press' ); ?>
						<?php if(($posts->post_count == $i) && ($maxItems < ($i))) : ?>
								 		</div>
								 	</div>
						<?php endif; ?>
						<?php $i++; ?>
				<?php } ?>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>  	
  </div>
  <div class="tab-pane" id="updates" role="tabpanel" aria-labelledby="updates-tab">
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
			$posts = new WP_Query( $args );

			// The Loop
			if ( $posts->have_posts() ) {  ?>
					


					<?php $i = $year = 1; ?>					
					<?php while ( $posts->have_posts() ) { ?>
						<?php $posts->the_post(); ?>
						<?php if($maxItems == ($i - 1)) : ?>
								 <div class="load-more-container">
								 		<div class="center-without-border load-more"><a href="#"><?php _e('Load More', 'plumvillage'); ?></a></div>
								 		<div class="load-hide">
						<?php endif; ?>
						<?php get_template_part( 'template-parts/index', 'update-small' ); ?>
						<?php if(($posts->post_count == $i) && ($maxItems < ($i))) : ?>
								 		</div>
								 	</div>
						<?php endif; ?>
						<?php $i++; ?>
					<?php } ?>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>  	
  </div>
</div>