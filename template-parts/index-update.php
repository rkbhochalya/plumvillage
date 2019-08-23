<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" class="index-item index-update center-with-border<?php if(!get_field('live_blog')) : ?><?php endif; ?><?php echo implode(' ', get_all_term_classes(get_the_id(), 'topics')); ?>">
	<header class="entry-header">
		<div class="entry-meta">
			<div class="the-date"><?php the_time('jS M'); ?></div>
			<div class="the-time"><?php the_time('G:i'); ?></div>
		</div><!-- .entry-meta -->
		<?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if(get_field('live_blog')) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<p><?php echo get_the_limited_excerpt(get_the_ID(), 35); ?></p>
		<?php endif; ?>
	</div><!-- .entry-content -->
	<?php if(get_comments_number() > 0) : ?>
		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
		</footer>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
