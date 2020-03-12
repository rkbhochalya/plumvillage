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
				<div class="col-md-9 col-lg-7 col-xxl-6 centered-content">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
							<?php if ( have_posts() ) : ?>
								<header class="entry-header">
									<h1 class="entry-title"><?php echo post_type_archive_title( '', false ); ?></h1>
								</header><!-- .entry-header -->

								<div class="entry-content">
									<div class="introduction"><?php the_archive_description(); ?></div>
								</div><!-- .entry-content -->
							<?php endif; ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			</div>
	</div>
<?php
get_sidebar();
get_footer();
