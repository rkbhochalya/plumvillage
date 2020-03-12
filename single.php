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
			<?php if (wp_nav_menu( array( 'theme_location' => 'mega-menu', 'sub_menu' => true, 'show_parent' => true, 'echo' => false )) !== false) : ?>
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
				<?php else : ?>
				<div class="row justify-content-center mb-5 center-logo">
				<?php endif; ?>
					<div class="col-md-9 col-lg-7 col-xxl-6 centered-content">
						<?php 
							get_template_part( 'template-parts/content', get_post_type() );
							the_post_navigation();
						?>
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div id="comments" class="comments-section">
								<h2><?php _e('Join the conversation', 'plumvillage'); ?></h2>
								<?php comments_template(); ?>
							</div>
						<?php endif; ?>
						<?php if(get_post_type() == 'letter' || get_post_type() == 'interview' || get_post_type() == 'tnh_update'){
							get_template_part( 'template-parts/blocks/all', get_post_type() );
						} ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
