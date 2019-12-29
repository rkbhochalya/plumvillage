<?php

if( have_rows('monastics') ): ?>
    <div class="align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>">
        <div class="row row-collapsable">
            <?php while ( have_rows('monastics') ) : the_row(); ?>
                <?php $pageId = get_sub_field('monastic'); ?>
                <div class="index-item index-monastic <?php if(count(get_field('monastics')) == 2) : ?>col-md-6<?php elseif(count(get_field('monastics')) >= 3) : ?>col-md-4<?php else : ?>col-md-12<?php endif; ?> ">
                    <a href="<?php echo get_permalink($pageId); ?>"><?php echo get_the_post_thumbnail($pageId, 'landscape'); ?></a>
                    <figcaption><a href="<?php echo get_permalink($pageId); ?>"><?php echo get_the_title($pageId); ?></a></figcaption>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;