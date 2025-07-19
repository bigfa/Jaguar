<?php
if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">
    <h2 class="comments-title">
        <?php printf(
            _nx('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'Jaguar'),
            number_format_i18n(get_comments_number()),
            '<span>' . get_the_title() . '</span>'
        ); ?>
    </h2>
    <?php if (have_comments()) : ?>
        <ol class="comment--list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 42,
                'format'      => 'html5',
                'callback'    => 'jaguar_comment',
            ));
            ?>
        </ol>
        <?php the_comments_pagination(array(
            'prev_text' => __('Previous page', 'Jaguar'),
            'next_text' => __('Next page', 'Jaguar'),
            'prev_next' => false,
        )); ?>
    <?php else : ?>
        <ol class="comment--list">
            <li><?php _e('No comments yet.', 'Jaguar'); ?></li>
        </ol>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>