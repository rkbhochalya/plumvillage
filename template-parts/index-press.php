<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" class="index-item index-press center-with-border<?php if(!get_field('live_blog')) : ?><?php endif; ?><?php echo implode(' ', get_all_term_classes(get_the_id(), 'topics')); ?>">
	<header class="entry-header">
		<?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
		<div class="entry-meta">
			<div class="the-date"><?php the_time('jS M, Y'); ?></div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
