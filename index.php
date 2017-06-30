<?php get_header('simple'); ?>
    <div class="content-area container is-homeList">
        <div class="site-content">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
                <?php the_posts_pagination( array(
                    'prev_text'          => 'Previous page',
                    'next_text'          => 'Next page',
                    'before_page_number' => '',
                ) );?>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>