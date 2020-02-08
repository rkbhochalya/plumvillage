<?php 

$images = get_field('gallery'); 
if( $images ) : ?>
    <div class="slider <?php echo get_field('image_dimensions'); ?> align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>">
        <?php foreach( $images as $image ): ?>
        	<?php if(get_field('popup')) : ?>
	        	<a class="slider-image link-zoom-cursor" data-fancybox="<?php echo $block['id']; ?>" href="<?php echo wp_get_attachment_image_src( $image, 'large' )[0]; ?>"><img src="<?php echo wp_get_attachment_image_url($image, 'large'); ?>" alt="<?php echo wp_get_attachment_caption($image); ?>">
             </a>
        	<?php else : ?>
            <div class="slider-image">
                <img src="<?php echo wp_get_attachment_image_url($image, 'large'); ?>"  alt="<?php echo wp_get_attachment_caption($image); ?>">
            </div>
        	<?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
