<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plum_Village
 */

?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row mb-5 pb-5">
				<div class="col-md-6">
					<?php if(get_field('top_left', 'options')) :
						the_field('top_left', 'options');
					endif; ?>
					<?php include( locate_template( 'template-parts/blocks/newsletter-signup.php', false, false ) ); ?>
				</div>
				<div class="col-md-5 offset-md-1 mt-5 mt-md-0">
					<?php if(get_field('top_right', 'options')) :
						the_field('top_right', 'options');
					endif; ?>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<h6>— <?php _e( 'Plum Village Practice Centers', 'plumvillage' ); ?></h6>
					<div class="row">
						<?php $col = 'col-6 col-lg-4 col-xl-3'; ?>
						<?php include( locate_template( 'template-parts/practise-centres.php', false, false ) ); ?>
					</div>
				</div>
				<div class="col-md-4">
					<h6>— <?php _e( 'Follow Plum Village', 'plumvillage' ); ?></h6>
					<?php include( locate_template( 'template-parts/social-links.php', false, false ) ); ?>
					<div class="row">
						<div class="col-6 col-md-12">
							<h6>— <?php _e( 'Initiatives', 'plumvillage' ); ?></h6>
							<?php
								wp_nav_menu( array(
										'theme_location' => 'initiatives-menu',
								    'menu' => 'Initiatives'
								) );
							?>							
						</div>
						<div class="col-6 col-md-12">
							<h6>— <?php _e( 'Publishing', 'plumvillage' ); ?></h6>
							<?php
								wp_nav_menu( array(
										'theme_location' => 'publishing-menu',
								    'menu' => 'Publishing'
								) );
							?>							
						</div>
					</div>
				</div>
			</div>						
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_class'		 => 'footer-menu',
					'depth'					 => 1,
				) );
			?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div id="cookie-notice">
	<p><?php the_field('cookie_notice_text', 'options'); ?></p>
	<a href="<?php echo get_field('cookie_read_more_link', 'options')['url']; ?>" class="btn btn-light btn-super-light"><?php _e('Read More', 'plumvillage'); ?></a> <button class="btn btn-light cookies-ok"><?php _e('OK', 'plumvillage'); ?></button>
</div>

<?php wp_footer(); ?>

</body>
</html>
