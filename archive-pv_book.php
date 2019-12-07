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
				<div class="col-md-9">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
						</main><!-- #main -->
					</div><!-- #primary -->
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div id="comments" class="comments-section">
							<h2><?php _e('Join the conversation', 'plumvillage'); ?></h2>
							<?php comments_template(); ?>
						</div>
					<?php endif; ?>

					<?php 
					// WP_Query arguments
						$args = array (
							'post_type'              => array( 'pv_book' ),
							'post_status'            => array( 'publish' ),
							'nopaging'               => true,
							'order'                  => 'ASC',
							'orderby'                => 'title',
							'posts_per_page' 				 => 100,
							'meta_query'						 => array(
								'relation' => 'OR',
								array(
									'key' => 'exclude_from_index',
									'compare' => 'NOT EXISTS'
								),
								array(
									'key' => 'exclude_from_index',
									'value' => '1',
									'compare' => '!='
								)
							)
						);

						// The Query
						$posts = new WP_Query( $args );

						// The Loop
						if ($posts->have_posts() ) { ?>
						<div class="filters">
							<?php
								echo get_filter_menu($posts, 'genre');
								echo get_filter_menu($posts, 'topics'); 
							?>
						</div>
						<div class="row post-overview">
							<?php while ( $posts->have_posts() ) { ?>
								<?php $posts->the_post(); ?>
								<?php get_template_part( 'template-parts/index', 'book' ); ?>
							<?php } ?>
						</div>
		<?php } 

		// Restore original Post Data
		wp_reset_postdata();

		?>
				</div>
			</div>
	</div>
<?php
get_sidebar();
get_footer();
