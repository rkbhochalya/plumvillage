<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

	$design = get_field('design');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('index-post index-item index-small'); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<a class="float-right entry-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
	<?php endif; ?>
	<header class="entry-header"> 
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
			<?php if(isset($design) && $design['show_date']) : ?>
			<div class="entry-meta"> <?php plumvillage_posted_on(); ?></div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php if((get_comments_number() > 0) && isset($design) && $design['show_comment_count']) : ?>
		<footer class="index-footer">
			<a href="<?php the_permalink(); ?>#comments"><span class="icon icon-reply"></span><?php echo get_comments_number() . ' ' . __('responses', 'plumvillage'); ?></a>			
		</footer>
	<?php endif; ?>			
</article><!-- #post-<?php the_ID(); ?> -->
