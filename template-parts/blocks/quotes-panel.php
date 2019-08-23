<?php

if( have_rows('quotes') ): ?>
    <div class="panel panel-quotes 
        <?php if($block['align'] == 'wide') : echo 'panel-goes-wide'; endif;?> 
        <?php if(get_field('collapsable')) : echo 'panel-collapsable'; else : echo 'panel-open'; endif; ?> 
        <?php if(get_field('default_state') == 'open') : echo 'panel-open'; endif; ?> 
        <?php if(!get_field('title')) : echo 'no-title'; endif; ?> 
        <?php if(get_field('collapsable') || ($block['align'] != 'wide')) : echo 'center-with-border'; endif; ?>">
        <?php if(get_field('title')) : ?>
            <h5><span class="icon icon-caret-right"></span><?= get_field('title'); ?></h5>
        <?php endif; ?>
        <div class="row row-collapsable">
            <?php while ( have_rows('quotes') ) : the_row(); ?>
                <?php $pageId = get_sub_field('quote'); ?>
                <div class="col-md-4 index-item index-quote">
                    <blockquote>
                        <p><?php the_sub_field('quote'); ?></p>
                        <cite><?php the_sub_field('author'); ?></cite>
                    </blockquote>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;