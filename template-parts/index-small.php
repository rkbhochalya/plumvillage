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
				<?php if(get_field('top_title', get_the_ID())) : ?><span class="top-title"><?php the_field('top_title', get_the_ID()); ?></span> <?php endif; ?>
				<span class="index-title"><?php the_title(); ?></span>
			</a>
		</h2>
			<?php if(isset($design) && $design['show_date']) : ?>
			<div class="entry-meta"> <?php plumvillage_posted_on(); ?></div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
