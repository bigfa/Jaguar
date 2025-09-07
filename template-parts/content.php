<?php global $jaguarSetting; ?>
<article class="jBlock--item" itemscope="http://schema.org/Article">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="jBlock--imageLink">
        <img src="<?php echo jaguar_get_background_image(get_the_ID(), 800, 400); ?>" alt="<?php the_title(); ?>" class="jBlock--image" itemprop="image" />
        <?php do_action('marker_pro_flag', get_the_ID()); ?>
    </a>
    <div class="jBlock--content">
        <h2 class="jBlock--title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>
        <?php if ($jaguarSetting->get_setting('show_excerpt')) : ?>
            <div class="jBlock--excerpt" itemprop="description">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
        <div class="jBlock--info">
            <time class="jBlock--time" itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Jaguar'); ?></time>
            <?php if ($jaguarSetting->get_setting('home_cat')) : ?>
                <span class="middotDivider"></span>
                <span class="jBlock--tags" itemprop="articleSection"><?php the_category(','); ?></span>
            <?php endif; ?>
            <?php if ($jaguarSetting->get_setting('home_views')) : ?>
                <span class="middotDivider"></span>
                <?php echo jaguar_get_post_views_text(false, false, false, get_the_ID()); ?>
            <?php endif; ?>
            <?php if ($jaguarSetting->get_setting('home_image_count')) : ?>
                <?php echo jaguar_get_post_image_count(get_the_ID()) > 0 ? '<span class="middotDivider"></span>
            <span class="jBlock--image-count">' . jaguar_get_post_image_count(get_the_ID()) . ' ' . __('shots', 'Jaguar') . ' </span>' : ''; ?>
            <?php endif; ?>
        </div>
    </div>
</article>