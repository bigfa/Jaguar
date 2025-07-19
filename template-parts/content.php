<article class="post-item">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image-link">
        <img src="<?php echo jaguar_get_background_image(get_the_ID()); ?>" alt="<?php the_title(); ?>" class="post-image">
        <?php do_action('marker_pro_flag', get_the_ID()); ?>
    </a>
    <div class="post-item__content">
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="post-info">
            <span class="post-time"><time><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Jaguar'); ?></time></span>
            <span class="middotDivider"></span><span class="post-tags"><?php the_category(',');; ?></span>
            <?php echo jaguar_get_post_image_count(get_the_ID()) > 0 ? '<span class="middotDivider"></span><span class="post-image-count">' . jaguar_get_post_image_count(get_the_ID()) . ' shots</span>' : ''; ?>
        </div>
    </div>
</article>