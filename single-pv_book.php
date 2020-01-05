<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plum_Village
 */

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {} else {
	get_header();
}
?>
	
	<div class="container book-content">
		<div class="row">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
				<div class="col-md-5">
					<?php the_post_thumbnail( 'large' ); ?> 					
				</div>
				<div class="col-md-7">
					<header class="entry-header">
						<h1 class="entry-title post-title pb-0"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
					<p class="has-large-font-size"><?php the_field('subtitle'); ?></p>
					<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
					<?php if ( function_exists( "get_yuzo_related_posts" ) ) { get_yuzo_related_posts(); } ?>
					
					<dl>
					<?php if(get_field('publication_date')){ ?>
						<dt>Publication Date:</dt>
						<dd>
							<?php $date = DateTime::createFromFormat('Ymd', get_field('publication_date'));
							echo $date->format('F j, Y'); ?>
						</dd>
					<?php }?>
					<?php if(get_field('publisher')){ ?>
						<dt>Publisher:</dt>
						<dd>
						<?php if(get_field('publisher_url')){
							echo '<a href="'.get_field('publisher_url').'">'.get_field('publisher').'</a>';
						} else {
							the_field('publisher');
						} ?>
						</dd>
					<?php }?>
					<?php if(get_field('isbn')){ ?>
						<dt>ISBN:</dt>
						<dd><?php the_field('isbn'); ?></dd>
					<?php }?>
					</dl>
					</div>		
				</div>
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {} else {
	get_footer();
}