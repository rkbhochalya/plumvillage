<?php

if( have_rows('books') ): ?>
    <div class="panel panel-books align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>
        <?php if(get_field('collapsable')) : echo 'panel-collapsable'; else : echo 'panel-open'; endif; ?> 
        <?php if(get_field('default_state') == 'open') : echo 'panel-open'; endif; ?> 
        <?php if(!get_field('title')) : echo 'no-title'; endif; ?>">
        <?php if(get_field('title')) : ?>
            <h5><span class="icon icon-caret-right"></span><span class="underline-me"><?= get_field('title'); ?></span></h5>
        <?php endif; ?>
        <div class="row row-collapsable">
            <div class="col-md-12">
                <div class="row <?php if(($block['align'] == 'wide') && (count(get_field('books')) > 1)) : ?>justify-content-center<?php endif; ?>">
                    <?php while ( have_rows('books') ) : the_row(); ?>
                        <?php $bookId = get_sub_field('book'); ?>
                        <div class="index-item index-book <?php if($block['align'] != 'wide') : ?>col <?php if(count(get_field('books')) == 1) : ?>single-book<?php endif; ?><?php else : ?>col-6 col-md-3 <?php endif; ?> mb-4">
                            <a class="link-zoom" data-fancybox="<?php echo $block['id']; ?>" data-type="ajax" data-touch="false" href="<?php echo get_permalink($bookId); ?>"><span class="book-cover"><span class="icon icon-bg icon-zoom"></span><?php echo get_the_post_thumbnail($bookId, 'medium'); ?></span>
                            <?php if(get_field('show_excerpt')) : ?>
                                <h5><span><?php echo get_the_title($bookId); ?><span></h5>
                                <?php if(get_field('subtitle', $bookId)) : ?>
                                    <div class="entry-meta">
                                        <?php the_field('subtitle', $bookId); ?>
                                    </div><!-- .entry-meta -->
                                <?php endif; ?>

                                <?php if(get_sub_field('excerpt')) : ?>
                                    <p><?php echo get_sub_field('excerpt'); ?></p>
                                <?php else : ?>
                                    <p><?php echo get_the_limited_excerpt($bookId, 30); ?></p>
                                <?php endif; ?>
                            <?php else : ?>
                                <figcaption><?php echo get_the_title($bookId); ?></figcaption>
                            <?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;