<figure class="video-embed align<?php echo $block['align']; ?>"">

    <?php beautifulVideoEmbed(get_field('video'), $block['id'], get_field('image'), true); ?>
    <?php if(get_field('caption')) : ?>
        <figcaption><?php the_field('caption'); ?></figcaption>
    <?php endif; ?>

</figure>
