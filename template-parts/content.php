<?php global $jaguarSetting; ?>
<article class="post-item" itemscope="http://schema.org/Article">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image-link">
        <img src="<?php echo jaguar_get_background_image(get_the_ID(), 800, 400); ?>" alt="<?php the_title(); ?>" class="post-image" itemprop="image" />
        <?php do_action('marker_pro_flag', get_the_ID()); ?>
    </a>
    <div class="post-item__content">
        <h2 class="post-title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>
        <?php if ($jaguarSetting->get_setting('show_excerpt')) : ?>
            <div class="post-excerpt" itemprop="description">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
        <div class="post-info">
            <time class="post-time" itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Jaguar'); ?></time>
            <span class="middotDivider"></span>
            <span class="post-tags" itemprop="articleSection"><?php the_category(','); ?></span>
            <?php echo jaguar_get_post_image_count(get_the_ID()) > 0 ? '<span class="middotDivider"></span>
            <span class="post-image-count">' . jaguar_get_post_image_count(get_the_ID()) . ' ' . __('shots', 'Jaguar') . ' </span>' : ''; ?>
        </div>
    </div>
</article>