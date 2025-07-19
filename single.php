<?php
get_header();
?>
<div class="layoutSingleColumn u-paddingTop50">
    <article>
        <?php while (have_posts()) : the_post(); ?>
            <header class="article--header">
                <h2 class="article--headline"><?php the_title(); ?></h2>
                <?php if (get_post_meta(get_the_ID(), '_subtitle', true)) : ?>
                    <div class="article--subline"><?php echo get_post_meta(get_the_ID(), '_subtitle', true); ?></div>
                <?php endif; ?>
                <div class="poppyMeta">
                    <?php do_action('marker_pro_flag', get_the_ID()); ?>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="dt-published"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Jaguar'); ?></time>
                    <span class="middotDivider"></span>
                    <span><?php the_category(', '); ?></span>
                </div>
            </header>
            <div class="poppy">
                <?php the_content(); ?>
            </div>
            <footer class="article--footer">
                <div class="footerMeta">
                    <time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>"><?php echo human_time_diff(get_the_modified_time('U'), current_time('timestamp')) .  __('ago', 'Jaguar'); ?></time>
                    <span class="article--tags"><?php the_tags('', '', ''); ?></span>
                </div>
                <?php get_template_part('template-parts/category', 'card'); ?>
                <?php get_template_part('template-parts/author', 'card'); ?>
                <?php get_template_part('template-parts/post', 'navigation'); ?>
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                get_template_part('template-parts/single', 'related');
                ?>
            <?php endwhile; ?>
    </article>
</div>
<?php get_footer(); ?>