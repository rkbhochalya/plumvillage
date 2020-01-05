<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" class="index-item index-book col-6 col-lg-4 col-xxl-3 <?php echo implode(' ', get_all_term_classes(get_the_id(), 'topics')); ?> <?php echo implode(' ', get_all_term_classes(get_the_id(), 'genre')); ?>">
	
    <a class="link-zoom" data-fancybox="books" data-hash="<?php global $post; echo $post->post_name; ?>" data-type="ajax" data-touch="false" href="<?php the_permalink(); ?>"><span class="book-cover"><span class="icon icon-bg icon-zoom"></span><?php the_post_thumbnail('medium') ?></span>
			<header class="entry-header">
				<h5 class="entry-title"><span><?php the_title(); ?></span></h5>
				<?php if(get_field('subtitle')) : ?>
					<div class="entry-meta">
						<?php the_field('subtitle'); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php echo get_the_limited_excerpt(get_the_ID(), 35); ?></p>
			</div><!-- .entry-content -->
			<?php if(get_comments_number() > 0) : ?>
				<footer class="entry-footer">
					<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
				</footer>
			<?php endif; ?>	
		</a>	
	
</article><!-- #post-<?php the_ID(); ?> -->
