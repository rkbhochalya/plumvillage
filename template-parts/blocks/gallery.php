<?php 

$images = get_field('gallery'); 
$cols = ($block['align'] == 'wide') ? 'col-6 col-md-4 col-lg-3 col-xxl-2' : 'col-md-6 col-lg-4 col-xxl-3';

if( $images ) :

?>

    <div class="<?php if($block['align'] == 'wide') : ?>back-to-baseline<?php endif; ?>">
        <div class="gallery block">
            <div class="gallery-inside">
                <div class="row gallery-images">
                    <div class="grid-sizer <?php echo $cols; ?>"></div>
                    <?php foreach( $images as $image ): ?>
                        <div class="gallery-image <?php echo $cols; ?>">
                        	<a data-is-press="<?php if(get_field('is_press') == true){echo 'true'; } else {echo 'false';} ?>" class="link-zoom" href="<?php echo get_attachment_link( $image ); ?>">
                                <span class="icon icon-bg icon-zoom"></span>
                                <?php echo wp_get_attachment_image($image, 'medium') ?>
                        	</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
