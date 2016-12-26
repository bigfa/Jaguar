<?php get_header(); ?>
<div class="u-textAlignCenter author-page-avatar">
    <?php echo get_avatar(get_the_author_meta('user_email'),128);?>
    </div>
    <div class="content-area container">
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