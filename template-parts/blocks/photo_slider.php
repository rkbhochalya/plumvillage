<?php 

$images = get_field('gallery'); 
if( $images ) : ?>
    <div class="slider <?php echo get_field('image_dimensions'); ?> <?php if($block['align']) : ?>align<?php echo $block['align']; endif; ?>">
        <?php foreach( $images as $image ): ?>
        	<?php if(get_field('popup')) : ?>
	        	<a class="slider-image link-zoom-cursor" data-fancybox="<?php echo $block['id']; ?>" href="<?php echo wp_get_attachment_image_src( $image, 'large' )[0]; ?>" style="background-image: url(<?php echo wp_get_attachment_image_url($image, 'large'); ?>);">
             </a>
        	<?php else : ?>
            <div class="slider-image" style="background-image: url(<?php echo wp_get_attachment_image_url($image, 'large'); ?>);"></div>
        	<?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
