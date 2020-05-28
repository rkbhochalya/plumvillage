<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

	$design = get_field('design');

	if(!isset($design)){
		$design = array('show_date' => true, 'show_excerpt' => true, 'show_comment_count' => true);
	}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('index-post index-item'); ?>>
	<div class="row">
		<?php if(has_post_thumbnail()) : ?>
		<div class="col-2 col-md-3"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
		<div class="col-10 col-md-9">
		<?php else : ?>
		<div class="col-md-12">
		<?php endif; ?>
			<header class="entry-header"> 
				<?php if(isset($design) && $design['show_date']) : ?>
						<div class="entry-meta">
							<?php plumvillage_posted_on(); ?>
						</div><!-- .entry-meta -->
				<?php endif; ?>
				<h2>
					<a href="<?php echo get_permalink(); ?>">
						<?php add_topics_to_title(get_the_terms(get_the_ID(), 'topics')); ?>
						<span class="index-title"><?php the_title(); ?></span>
					</a>
				</h2>
			</header><!-- .entry-header -->

			<?php if(isset($design) && $design['show_excerpt']) : ?>
				<div class="entry-content">
					<p><?php echo get_the_limited_excerpt(get_the_ID(), 50); ?></p>
				</div><!-- .entry-content -->
			<?php endif; ?>

			<?php if((get_comments_number() > 0) && isset($design) && $design['show_comment_count']) : ?>
				<footer class="index-footer">
					<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
				</footer>
			<?php endif; ?>			
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
