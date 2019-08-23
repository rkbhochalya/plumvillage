<?php

if( have_rows('videos') ): ?>
    <div class="panel panel-videos <?php if(($block['align'] == 'wide') || (count(get_field('videos')) > 3)) : echo 'panel-goes-wide'; endif;?> <?php if(get_field('collapsable')) : echo 'panel-collapsable'; endif; ?> <?php if(get_field('default_state') == 'open') : echo 'panel-open'; else : echo 'center-with-border'; endif; ?>">
        <?php if(get_field('title')) : ?>
            <h5><span class="icon icon-caret-right"></span><?= get_field('title'); ?></h5>
        <?php endif; ?>
        <div class="row row-collapsable">
            <div class="col-md-12">
                <div class="iframe-target video-above iframe-target-<?=$block['id']; ?>">
                    <div class="alignwide remove-margin-top-bottom"><span class="icon icon-close"></span></div>                    
                    <div class="alignwide remove-margin-top-bottom"><div class="iframe-container embed-responsive embed-responsive-16by9 dropzone"></div></div>
                </div>            
                <div class="row <?php if(($block['align'] == 'wide') && (count(get_field('videos')) > 3)) : echo 'back-to-baseline'; endif;?>">
                    <?php $i = 0; ?>
                    <?php while ( have_rows('videos') ) : the_row(); ?>
                        <div class="col">                        
                            <?php $videoId = $block['id'] . $i; ?>
                            <?php beautifulVideoEmbed(get_sub_field('video'), $videoId, false, false, $block['id']); ?>
                            <?php if(get_sub_field('caption')) : ?>
                                <figcaption><?php echo get_sub_field('caption'); ?></figcaption>
                            <?php endif; ?>
                        </div>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;
