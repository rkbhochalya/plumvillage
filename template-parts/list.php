<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>
<li id="post-<?php the_ID(); ?>" class="list-item">
		<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>

		<div class="entry-meta">
			<?php if(get_field('source', $post->ID)) : ?>
				<span class="entry-source">
					<?php if(get_field('source_url', $post->ID)) : ?>
						<a target="_blank" href="<?php the_field('source_url', $post->ID); ?>"><?php the_field('source', $post->ID); ?>, <?php the_time('jS F, Y'); ?><span class="icon icon-external-link"></span></a>
					<?php else : ?>
						<?php the_field('source', $post->ID); ?>, <?php the_time('jS F, Y'); ?>
					<?php endif; ?>					
				</span>
				<?php else : ?>
					<?php the_time('jS F, Y'); ?>
				<?php endif; ?>
		</div><!-- .entry-meta -->

</li><!-- #post-<?php the_ID(); ?> -->
