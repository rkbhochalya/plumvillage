<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" class="index-item index-letter col-sm-6 col-md-4 col-lg-3 <?php echo implode(' ', get_all_term_classes(get_the_id(), 'topics')); ?>">
	<header class="entry-header">
		<div class="entry-meta">
			<?php plumvillage_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php echo get_the_limited_excerpt(get_the_ID(), 35); ?></p>
	</div><!-- .entry-content -->
	<?php if(get_comments_number() > 0) : ?>
		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
		</footer>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
