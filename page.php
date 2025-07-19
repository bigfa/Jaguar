<?php get_header(); ?>
<div class="layoutSingleColumn layoutSingleColumn--article  u-paddingTop50">
    <?php while (have_posts()) : the_post(); ?>
        <section class="post-content">
            <header class="article--header">
                <h2 class="article--headline p-name"><?php the_title(); ?></h2>
                <?php if (get_post_meta(get_the_ID(), '_subtitle', true)) : ?>
                    <div class="article--subline p-summary"><?php echo get_post_meta(get_the_ID(), '_subtitle', true); ?></div>
                <?php endif; ?>
            </header>
            <div class="single-post-inner poppy">
                <?php the_content(); ?>
            </div>
        </section>
        <?php comments_template(); ?>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>