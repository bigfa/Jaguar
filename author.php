<?php get_header(); ?>
<div class="layoutSingleColumn layoutSingleColumn--wide u-paddingTop50">
    <?php if (have_posts()) : ?>
        <?php the_post(); ?>
        <header class="archive--header">
            <h1 class="archive--headline"><?php printf(__('Author Archives: %s', 'Jaguar'), '<span class="vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">' . get_the_author() . '</a></span>'); ?></h1>
            <div class="archive--description">
                <?php if (get_the_author_meta('description')) : ?>
                    <p><?php the_author_meta('description'); ?></p>
                <?php endif; ?>
            </div>
        </header>
        <?php rewind_posts(); ?>
        <div class="post--list">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_format()); ?>
            <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(array(
            'prev_text'          =>  __('Previous page', 'Jaguar'),
            'screen_reader_text' =>  __('Posts navigation', 'Jaguar'),
            'next_text'          =>  __('Next page', 'Jaguar'),
            'before_page_number' => '',
        )); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>