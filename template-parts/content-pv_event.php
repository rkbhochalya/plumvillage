<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"> 
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
		<?php $practice_centres = get_field('many2many_event_practice_centre'); ?>
		<?php if(!empty($practice_centres) || get_field('start_date', get_the_ID())) : ?>
			<div class="entry-meta">
					<?php if(get_field('start_date', get_the_ID())) : ?>
						<b class="entry-date">
							<?php $startDate = new DateTime(get_field('start_date', get_the_ID(), false));?>
							<?php $endDate = new DateTime(get_field('end_date', get_the_ID(), false));?>
							<?php echo $startDate->format('M j') . ' - ' . $endDate->format('M j, Y'); ?> 
						</b>
					<?php endif; ?>
						<?php 
							if( $practice_centres ): 
								echo __('at', 'plumvillage') . ' ';
								$i = 0;
								foreach( $practice_centres as $practice_centre):
									if($i != 0){
										echo ', ';
									} 
									$i++; ?>
							  	<a href="<?php echo get_permalink($practice_centre->ID); ?>"><?php echo get_the_title($practice_centre); ?></a>
								<?php endforeach; ?>
							<?php endif; ?>
						<?php 
							$terms = wp_get_post_terms(get_the_ID(), 'language');
							if(!empty($terms)){
								echo '<br />' . __('Languages', 'plumvillage') . ': ';
								$i = 0;
								foreach($terms as $term) {
									if($i != 0){
										echo ', ';
									}
									echo $term->name; 
									$i++;
								} 
							}
						?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php if(get_field('event_type') == 'day') : ?>
			<div class="block event-list alignright">
				<div class="block-inside">
			<article class='index-event index-item index-event-repeat'>
				<h4><?php _e('Upcoming dates', 'plumvillage'); ?></h4>
				<?php $di = 1; ?>
				<?php $maxItems = 3; ?>
				<?php while( have_rows('dates', get_the_ID()) ): the_row(); ?>
					<?php if(get_sub_field('date')) : ?>
						<?php
							$date = new DateTime(get_sub_field('date', false));
							$now = new DateTime();
							if($date > $now) : 
								if($maxItems == ($di - 1)) : ?>
									<div class="load-more-container">
									 		<div class="center-without-border load-more"><a href="#"><?php _e('Load More', 'plumvillage'); ?></a></div>
									 		<div class="load-hide">
									<?php endif; ?>
									<div class="entry-meta">
										<b>
											<?php
													$practise_centres = get_sub_field('practise_centre');
													echo $date->format('M j, Y') . ', ';
													$pi = 1;
											?>
										</b>
											<?php foreach($practise_centres as $practise_centre) { ?>
							    			<?php if (get_field('url', $practise_centre)) : ?><a href="<?php the_field('url', $practise_centre); ?>"><?php endif; ?>
							    				<?php echo $practise_centre->name; ?><?php if (get_field('url', $practise_centre)) : ?></a><?php endif; 
						    				if(count($practise_centres) > $pi) : echo ', '; endif; 
												$pi++;
											} ?>
									</div>
								<?php if((count(get_field('dates', get_the_ID())) == $di) && ($maxItems < $di)) : ?>
										 		</div>
										 	</div>
								<?php endif; ?>
								<?php $di++; ?>
							<?php endif; ?>								
						<?php endif; ?>
				<?php endwhile; ?>
					</div>
				</div>
			</article>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'plumvillage' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plumvillage' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

			
</article><!-- #post-<?php the_ID(); ?> -->
