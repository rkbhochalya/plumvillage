<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plum_Village
 */

get_header();
?>

	<div class="container">
		<?php while ( have_posts() ) :
			the_post(); ?>
			<div class="row mb-5">
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
						<?php 
							get_template_part( 'template-parts/content', get_post_type() );
							the_post_navigation();
						?>
				</div>
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<h2><?php _e('Join the conversation', 'plumvillage'); ?></h2>
						<?php comments_template(); ?>									
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
