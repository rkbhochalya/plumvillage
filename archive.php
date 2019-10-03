<?php
/**
 * The template for displaying archive pages
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
	
		<?php if ( have_posts() ) : ?>

				<?php 
					$term = get_queried_object();
					$page = get_page_by_path( $term->slug );
										
					$title = ($page ? get_the_title($page) : single_term_title( '', false ));
					$content = ($page ? $page->post_content : get_the_archive_description());
				?>

			<header class="entry-header">
				<h1 class="entry-title"><?php echo $title; ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php echo $content; ?>
			</div><!-- .entry-content -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/index', get_post_type() );

			endwhile;

			?>
			<div class="center-with-border"><?php the_posts_navigation();?></div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</div><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_sidebar();
get_footer();
