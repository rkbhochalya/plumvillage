<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Plum_Village
 */

get_header();
?>
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title">404</h1>
					</header><!-- .page-header -->

					<div class="entry-content">
						<p class="has-large-font-size"><?php esc_html_e( 'Oooh, this is strange.', 'plumvillage' ); ?></p>
						<p>We can't find what you are looking for.</p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
<?php
get_footer();
