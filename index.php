<?php get_header(); ?>
<div class="layoutSingleColumn layoutSingleColumn--wide u-paddingTop50">
    <?php if (have_posts()) : ?>
        <div class="jBlock--list">
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