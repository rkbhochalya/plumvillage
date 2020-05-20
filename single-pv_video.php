<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plum_Village
 */

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if(!$isAjax) {
	get_header();
} 
?>
	
	<div class="container book-content">
		<?php if($isAjax) : ?>
			<button data-fancybox-close="" class="d-none d-lg-block d-xl-block d-xxl-block fancybox-button fancybox-close-small" title="Close"><span class="icon-close"></span></button>
		<?php endif; ?>
		<div class="row">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php var_export(get_post_meta($post->ID)); ?>
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
if(!$isAjax){
	get_footer();
}