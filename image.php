<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plum_Village
 */
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {} else {
	get_header();
}
?>
	<div class="container">
		<div class="row">
			<?php	
				// fix for duplicate images
				$i = 1;
				while ( have_posts() ) :
				the_post(); 
				if($i == 1){
			?>
				<div class="col-md-9">
					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
	        	<div class="attachment"><img src="<?php echo $att_image[0];?>" class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></div>
					<?php else : ?>
	        	<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
					<?php endif; ?>				
				</div>
				<div class="col-md-3">
					<div class="image-content">
						<?php 
							$caption = wp_get_attachment_caption($post->ID);
							if($caption) { ?>
								<h1 class="entry-title title-image"><?php echo $caption; ?></h1>
							<?php } else {
								the_title( '<h1 class="entry-title title-image">', '</h1>' );
							} ?>
						<?php the_content(); ?>
					</div>
					<?php 
						$credits = get_field('credits'); 
						$credits_url = get_field('credits_url');
						$available = get_field('available_in');
						$contact = get_field('contact_instructions');

						if($credits || $available || $contact) : 
					?>
						<div class="image-credits">
								<?php if($credits) : 
									if($credits_url) : ?>
										<p><?php _e('Credits', 'plumvillage'); ?>: <a href="<?php echo $credits_url; ?>"><?php echo $credits; ?></a></p>
									<?php else : ?>
										<p><?php _e('Credits', 'plumvillage'); ?>: <?php echo $credits; ?></p>
									<?php endif;
								endif; ?>
								<div class="for-press">
									<?php if($available) : ?>
											<p><?php _e('Available in', 'plumvillage'); ?>: <?php echo $available; ?></p>
									<?php endif; 
									if($contact) : ?>
										<div class="contact-options"> <?php echo $contact; ?></div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="next-prev"></div>
					<?php 
						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;
					?>
				</div> 
				<?php } $i++; ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {} else {
	get_footer();
}
