<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plum_Village
 */

get_header();
?>
	<div class="container">
		<?php
			while ( have_posts() ) :
				the_post(); ?>
			<div class="row">
				<div class="col-md-3 d-none d-md-block">
					<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'mega-menu',
							'menu_id' => 'side-menu',
							'sub_menu' => true,
							'show_parent' => true
						)
					);
				?>				
				</div>
				<div class="col-md-9">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<h2><?php _e('Join the converstation', 'plumvillage'); ?></h2>
						<?php comments_template(); ?>
					</div>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
<?php
get_sidebar();
get_footer();
