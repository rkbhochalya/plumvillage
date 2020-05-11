<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"> 
		<?php if ( get_post_type() === 'post' ) : ?>
			<div class="entry-meta">
				<?php plumvillage_posted_on(); ?>

				<?php show_posts_other_languages(); ?>

			</div><!-- .entry-meta -->
		<?php endif; ?>

		<h1 class="entry-title">
			<?php 
				$topics = get_the_terms(get_the_ID(), 'topics');
				if($topics){ ?>
					<span class="top-title">
						<?php foreach ($topics as $topic) {
							echo $topic->name;
						} ?>
					</span>
			<?php } ?>
			<?php the_title(); ?>
		</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'plumvillage' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plumvillage' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

			
</article><!-- #post-<?php the_ID(); ?> -->
