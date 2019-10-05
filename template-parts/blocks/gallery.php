<?php 

$images = get_field('gallery'); 
$cols = ($block['align'] == 'wide') ? 'col-6 col-md-4 col-lg-3 col-xxl-2' : 'col-md-6 col-lg-4 col-xxl-3';

if( $images ) :

?>

    <div class="<?php if($block['align'] == 'wide') : ?>to-container-width<?php endif; ?> <?php echo $block['className']; ?>">
        <div class="gallery block">
            <div class="gallery-inside">
                <div class="row gallery-images">
                    <div class="grid-sizer <?php echo $cols; ?>"></div>
                    <?php foreach( $images as $image ): ?>
                        <div class="gallery-image <?php echo $cols; ?>">
                            <figure>
                                <a data-fancybox="<?php echo $block['id']; ?>" data-is-press="<?php if(get_field('is_press') == true){echo 'true'; } else {echo 'false';} ?>" class="gallery link-zoom-cursor" href="<?php echo wp_get_attachment_image_src( $image, 'large' )[0]; ?>">
                                    
                                    <?php echo wp_get_attachment_image($image, 'medium'); ?>
                                </a>
                                <?php set_query_var( 'image_id', $image ); ?>
                                <?php get_template_part( 'template-parts/figcaption' ); ?>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
