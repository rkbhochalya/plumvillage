<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-event index-item index-event-repeat'); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('landscape'); ?></a>
	<?php endif; ?>
	<header class="entry-header">
	<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
	</div><!-- .entry-content -->			
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
						 		<div class="load-more"><a href="#"><?php _e('Load More', 'plumvillage'); ?></a></div>
						 		<div class="load-hide">
					<?php endif; ?>
					<div class="entry-meta">
						<b>
							<?php echo $date->format('M j, Y') . ', '; ?>
							<?php 
									$practise_centres = get_sub_field('practise_centre');
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
							 		</div> <!-- load-hide -->
							 	</div>
					<?php endif; ?>
					<?php $di++; ?>
				<?php endif; ?>								
			<?php endif; ?>
	<?php endwhile; ?>
</article><!-- #post-<?php the_ID(); ?> -->
