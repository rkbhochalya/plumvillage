<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>
	<?php if(get_field('external_event_link', get_the_ID(), false)) : ?>
		<a class="external-link" href="<?php the_field('external_event_link', get_the_ID(), false); ?>" target="_blank">
	<?php else : ?>
		<a href="<?php the_permalink(); ?>">
	<?php endif; ?>
		<?php if(has_post_thumbnail()) : ?>
		<div class="index-thumbnail"><?php the_post_thumbnail('landscape'); ?></div>
		<?php endif; ?>
		<div class="index-content">
			<?php if(get_field('external_event_link', get_the_ID(), false)) : ?>
				<i class="icon-external-link"></i>
			<?php endif; ?>
			<header class="entry-header"> 
					<div class="entry-meta">
						<span class="entry-date">
							<?php $startDate = new DateTime(get_field('start_date', get_the_ID(), false));?>
							<?php $endDate = new DateTime(get_field('end_date', get_the_ID(), false));?>
							<?php echo $startDate->format('M j') . ' <span class="has-normal-weight">until</span> ' . $endDate->format('M j, Y'); ?> 
						</span>
					</div><!-- .entry-meta -->
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				<?php 
					$terms = wp_get_post_terms(get_the_ID(), 'practise-centres', array('orderby' => 'parent', 'order' => 'ASC'));
					if(!empty($terms)){ ?>
						<p class="location"><i class="icon-location"></i>
							<?php $i = 0; ?>
							<?php foreach($terms as $term) {
								if($i > 0){
									echo ', ';
								}
								echo $term->name;
								$i++;
							} ?>
						</p>
					<?php }
				?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php echo get_the_limited_excerpt(get_the_ID(), 35); ?></p>
			</div><!-- .entry-content -->			

		</div>
		</a>