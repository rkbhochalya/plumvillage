<?php

if( have_rows('books') ): ?>
    <div class="panel panel-books align<?php echo $block['align'] . ' ' . $block['className']; ?>
        <?php if(get_field('collapsable')) : echo 'panel-collapsable'; else : echo 'panel-open'; endif; ?> 
        <?php if(get_field('default_state') == 'open') : echo 'panel-open'; endif; ?> 
        <?php if(!get_field('title')) : echo 'no-title'; endif; ?> 
        <?php if(get_field('collapsable') || ($block['align'] != 'wide')) : echo 'center-with-border'; endif; ?>">
        <?php if(get_field('title')) : ?>
            <h5><span class="icon icon-caret-right"></span><?= get_field('title'); ?></h5>
        <?php endif; ?>
        <div class="row row-collapsable">
            <div class="col-md-12">
                <div class="row <?php if(($block['align'] == 'wide') && (count(get_field('books')) > 1)) : ?>justify-content-center<?php endif; ?>">
                    <?php while ( have_rows('books') ) : the_row(); ?>
                        <?php $bookId = get_sub_field('book'); ?>
                        <div class="<?php if($block['align'] != 'wide') : ?>col <?php if(count(get_field('books')) == 1) : ?>single-book<?php endif; ?><?php else : ?>col-6 col-md-3 <?php endif; ?> mb-4">
                            <a class="link-zoom" data-fancybox="<?php echo $block['id']; ?>" data-type="ajax" href="<?php echo get_permalink($bookId); ?>"><span class="icon icon-bg icon-zoom"></span><?php echo get_the_post_thumbnail($bookId); ?></a>
                            <?php if(get_field('show_excerpt')) : ?>
                                <h5><a href="<?php echo get_permalink($bookId); ?>"><?php echo get_the_title($bookId); ?></a></h5>
                                <?php if(get_sub_field('excerpt')) : ?>
                                    <p><?php echo get_sub_field('excerpt'); ?></p>
                                <?php else : ?>
                                    <p><?php echo get_the_limited_excerpt($bookId, 30); ?></p>
                                <?php endif; ?>
                                <p><a class="link-italic" href="<?php echo get_permalink($bookId); ?>"><?php _e('Read more', 'plumvillage'); ?></a></p>
                            <?php else : ?>
                                <figcaption><a href="<?php echo get_permalink($bookId); ?>"><?php echo get_the_title($bookId); ?></a></figcaption>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;