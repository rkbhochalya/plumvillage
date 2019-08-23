<div class="block-outside">
    <div class="gallery-embed block <?php if(get_field('narrow')) : ?>col-lg-4 block-narrow <?php else : ?>col-xs-8 col-sm-7 col-lg-6 col-xl-5<?php endif; ?> align-<?php echo $block['align']; ?>" data-is-press="<?php if(get_field('is_press') == true){echo 'true'; } else {echo 'false';} ?>">
        <div class="gallery-embed-inside">
            <div class="row">
                <div class="col">
                    <div class="gallery-embed-content">
                        <h5><?php the_field('title'); ?></h5>
                        <p class="gallery-embed-link"><span class="icon icon-zoom"></span> <a href="#"><?php _e('Start Watching', 'plumvillage'); ?></a></p>
                    </div>
                </div>
                <div class="col gallery-embed-img">
                <?php 

                $images = get_field('gallery');
                $featured_image = get_field('featured_image'); 

                if($featured_image){
                    echo wp_get_attachment_image( $featured_image, 'medium' );
                }
                ?>
                </div>
            </div>
            <?php
            if( $images ): ?>
                <ul class="gallery-images">
                    <?php foreach( $images as $image ): ?>
                        <li>
                        	<a class="gallery" href="<?php echo get_attachment_link( $image ); ?>">
        						<?php 
        							$caption = wp_get_attachment_caption($image);
        							if($caption) { 
        								echo $caption; 
        							} else {
        								echo get_the_title($image );
        							} 
                                ?>            		
                        	</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>