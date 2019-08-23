<?php

if( have_rows('pages') ): ?>
    <div class="panel panel-pages 
        <?php if($block['align'] == 'wide') : echo 'panel-goes-wide'; endif;?> 
        <?php if(get_field('collapsable')) : echo 'panel-collapsable'; else : echo 'panel-open'; endif; ?> 
        <?php if(get_field('default_state') == 'open') : echo 'panel-open'; endif; ?> 
        <?php if(!get_field('title')) : echo 'no-title'; endif; ?> 
        <?php if(get_field('collapsable') || ($block['align'] != 'wide')) : echo 'center-with-border'; endif; ?>">
        <?php if(get_field('title')) : ?>
            <h5><span class="icon icon-caret-right"></span><?= get_field('title'); ?></h5>
        <?php endif; ?>
        <div class="row row-collapsable <?php if(($block['align'] == 'wide') && (count(get_field('pages')) > 3)) : echo 'back-to-baseline'; endif;?>">
            <div class="col-md-12">
                <div class="row">
                    <?php while ( have_rows('pages') ) : the_row(); ?>
                        <?php $pageId = get_sub_field('page'); ?>
                        <div class="col-md-4 index-item index-page">
                            <a href="<?php echo get_permalink($pageId); ?>"><?php echo get_the_post_thumbnail($pageId, 'landscape'); ?></a>
                            <h5><a href="<?php echo get_permalink($pageId); ?>"><?php echo get_the_title($pageId); ?></a></h5>
                            <?php if(get_sub_field('excerpt')) : ?>
                                <p><?php echo get_sub_field('excerpt'); ?></p>
                            <?php else : ?>
                                <p><?php echo get_the_limited_excerpt($pageId, 30); ?></p>
                            <?php endif; ?>
                            <p><a class="link-italic" href="<?php echo get_permalink($pageId); ?>"><?php _e('Read more', 'plumvillage'); ?></a></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;