<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php if(get_field('source')) : ?>
				<span class="entry-source">
					<?php _e('Source:', 'plumvillage'); ?>
					<?php if(get_field('source_url')) : ?>						
						<a target="_blank" href="<?php the_field('source_url'); ?>">
							<?php the_field('source'); ?>, <?php the_time('jS F, Y'); ?>, <?php if(get_field('journalist')) : ?>by <?php the_field('journalist'); endif; ?><span class="icon icon-external-link"></span>
						</a>
					<?php else : ?>
						<?php the_field('source'); ?>, <?php the_time('jS F, Y'); ?>, <?php if(get_field('journalist')) : ?>by <?php the_field('journalist'); endif; ?>
					<?php endif; ?>
				</span>
				<?php else : ?>
					<?php the_time('jS F, Y'); ?>
				<?php endif; ?>
			</div>	
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plumvillage' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>

	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
