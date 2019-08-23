
<div class="row tnh-top">
	<?php if( have_rows('quotes') ): ?>
	    <?php while ( have_rows('quotes') ) : the_row(); ?>
	        <div class="col-sm-6 col-md-5 tnh-top-blockquote order-3 order-sm-1">
	            <blockquote>
	                <p><?php the_sub_field('quote'); ?></p>
	            </blockquote>
			      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sign.png" alt="">
	        </div>
	    <?php endwhile; ?>
	<?php endif; ?>	
	<?php $images = get_field('gallery'); 
	if( $images ) : ?>
		<div class="col-sm-6 col-md-7 order-2 order-sm-11 mb-5">
			<div class="slider">
		    <?php foreach( $images as $image ): ?>
		        <div class="slide-image">        
		          <?php echo wp_get_attachment_image($image, 'full') ?>
		        </div>
		    <?php endforeach; ?>
	    </div>
	  </div>
	<?php endif; ?>
</div>