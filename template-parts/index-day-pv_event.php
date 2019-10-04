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
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-12"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('landscape'); ?></a></div>
		<div class="col-12">
		<?php else : ?>
		<div class="col-md-12">
		<?php endif; ?>
			<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
			</div><!-- .entry-content -->			

				<h4>Upcoming dates</h4>
				<?php $di = 1; ?>
				<?php $maxItems = 3; ?>
				<?php while( have_rows('dates', get_the_ID()) ): the_row(); ?>
					<?php if(get_sub_field('date')) : ?>
						<?php if($maxItems == ($di - 1)) : ?>
								 <div class="load-more-container">
								 		<div class="center-without-border load-more"><a href="#"><?php _e('Load More', 'plumvillage'); ?></a></div>
								 		<div class="load-hide">
						<?php endif; ?>
							<div class="entry-meta">
								<b>
									<?php
										$date = new DateTime(get_sub_field('date', false));
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
					<?php endif; ?>
						<?php if((count(get_field('dates', get_the_ID())) == $di) && ($maxItems < $di)) : ?>
								 		</div>
								 	</div>
						<?php endif; ?>
						<?php $di++; ?>
				<?php endwhile; ?>

			<?php if(get_comments_number() > 0) : ?>
				<footer class="entry-footer">
					<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
				</footer>
			<?php endif; ?>			
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
