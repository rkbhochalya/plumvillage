<?php 

$images = get_field('gallery'); 
if( $images ) : ?>
    <div class="slider <?php echo get_field('image_dimensions'); ?> <?php if($block['align']) : ?>align<?php echo $block['align']; endif; ?>">
        <?php foreach( $images as $image ): ?>
            <div class="slider-image" style="background-image: url(<?php echo wp_get_attachment_image_url($image, 'large'); ?>);">
<!--             	<a class="link-zoom" href="<?php echo get_attachment_link( $image ); ?>"> -->  
                   <?php // echo wp_get_attachment_image($image, 'full') ?>
<!--             	</a> -->
             </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
