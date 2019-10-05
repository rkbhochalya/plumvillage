<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */


$filterType = (has_term('', 'types') ?  get_all_term_classes(get_the_id(), 'types')[0] : '');
$filterTopic = (has_term('', 'topics') ?  get_all_term_classes(get_the_id(), 'topics')[0] : '');

?>


<article id="post-<?php the_ID(); ?>" class="index-item index-interview <?php echo implode(' ', get_all_term_classes(get_the_id(), 'topics')); ?> <?php echo implode(' ', get_all_term_classes(get_the_id(), 'types')); ?>">
	<?php if(get_field('featured_video')) : ?>
		<?php beautifulVideoEmbed(get_field('featured_video'), get_the_id(), false, true); ?>
	<?php endif; ?>
	<?php if(has_term('pdf', 'types') && has_post_thumbnail()) : ?>
		<a class="image-wrapper pdf-wrapper" href="<?php the_permalink(); ?>#filter=<?php if($filterType) { echo '.'.$filterType;} if($filterTopic){echo '.'.$filterTopic;} ?>"><span class="pdf-label">PDF</span><?php the_post_thumbnail('thumbnail'); ?></a>
	<?php endif; ?>
	<header class="entry-header">
		<h4><a href="<?php the_permalink(); ?>#filter=<?php if($filterType) { echo '.'.$filterType;} if($filterTopic){echo '.'.$filterTopic;} ?>"><?php the_title(); ?></a></h4>
		<div class="entry-meta">
			<?php if(get_field('source')) : ?>
				<span class="entry-source">
					<?php if(get_field('source_url')) : ?>
						<a target="_blank" href="<?php the_field('source_url'); ?>"><?php the_field('source'); ?>, <?php the_time('jS F, Y'); ?><span class="icon icon-external-link"></span></a>
					<?php else : ?>
						<?php the_field('source'); ?>, <?php the_time('jS F, Y'); ?>
					<?php endif; ?>					
				</span>
				<?php else : ?>
					<span class="entry-source"><?php the_time('jS F, Y'); ?></span>
				<?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
	</div><!-- .entry-content -->
	<?php if(get_comments_number() > 0) : ?>
		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
		</footer>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
