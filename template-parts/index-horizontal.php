<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

	$image_large = get_query_var('image_large') ? '-large' : '';
	$design = get_field('design');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-post index-item index-horizontal'.$image_large); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<a class="entry-image" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('landscape'.$image_large); ?>
		</a>
	<?php endif; ?>
	<header class="index-header">
			<?php if(isset($design) && $design['show_date']) : ?>
				<div class="entry-meta">
					<?php plumvillage_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		<h2>
			<a href="<?php echo get_permalink(); ?>">
				<?php 
					$topics = get_the_terms(get_the_ID(), 'topics');
					if($topics){ ?>
						<span class="top-title">
							<?php foreach ($topics as $topic) {
								echo $topic->name;
							} ?>
						</span>
				<?php } ?>
				<span class="index-title"><?php the_title(); ?></span>
			</a>
		</h2>
	</header><!-- .entry-header -->

	<?php if(isset($design) && $design['show_excerpt']) : ?>
		<div class="index-content">
			<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
		</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php if((get_comments_number() > 0) && isset($design) && $design['show_comment_count']) : ?>
		<footer class="index-footer">
			<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
		</footer>
	<?php endif; ?>			
</article><!-- #post-<?php the_ID(); ?> -->
