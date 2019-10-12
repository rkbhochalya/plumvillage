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
				<div class="col-md-9 col-lg-7 col-xxl-6 centered-content">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</main><!-- #main -->
					</div><!-- #primary -->
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div id="comments" class="comments-section">
							<h2><?php _e('Join the conversation', 'plumvillage'); ?></h2>
							<?php comments_template(); ?>
						</div>
						<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>

		<?php 
		// WP_Query arguments
			$args = array (
				'post_type'              => array( 'tnh_update' ),
				'post_status'            => array( 'publish' ),
				'nopaging'               => true,
				'order'                  => 'DESC',
				'orderby'                => 'date',
				'posts_per_page' 				 => 100
			);

			// The Query
			$posts = new WP_Query( $args );

			// The Loop
			if ( $posts->have_posts() ) {  ?>
					


			<div class="row">
				<div class="offset-md-3 col-md-9 col-lg-7 col-xxl-6 centered-content">
					<?php $year = 0; ?>
					<?php while ( $posts->have_posts() ) { ?>
						<?php $posts->the_post(); ?>
						<?php 
							if($year != get_the_date('Y')) :
								$year = get_the_date('Y'); ?>
								<div class="in-betweener">
									<hr>
									<h2 class="center-with-border"><?php echo $year; ?></h2>
								</div>		
							<?php endif; ?>
						<?php get_template_part( 'template-parts/index', 'update' ); ?>
					<?php } ?>
				</div>
			</div>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>
	</div>
<?php
get_sidebar();
get_footer();
