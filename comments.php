<?php
if (post_password_required())
    return;
?>

<div id="comments" class="jComment--area">
    <h3 class="jComment--heroTitle">
        <svg class="svgIcon-use" width="24" height="24" viewBox="0 0 29 29" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g fill-rule="evenodd">
                <path
                    d="M6.79 7.84a9.33 9.33 0 00-5.78 8.54 9 9 0 002.75 6.67 5.42 5.42 0 01-.15.75 8.08 8.08 0 01-1.28 2.58.63.63 0 00-.05.65.66.66 0 00.6.36 7.46 7.46 0 004.13-1.33 7.85 7.85 0 00.92-.7c.96.272 1.952.41 2.95.41a10.49 10.49 0 006.86-2.5 12.85 12.85 0 01-1.69-.15 9.49 9.49 0 01-5.21 1.53 9.72 9.72 0 01-2.83-.43l-.39-.09c-.385.36-.792.693-1.22 1a6.43 6.43 0 01-2.67 1.06 8.52 8.52 0 00.89-2.08c.089-.3.153-.609.19-.92a3.1 3.1 0 000-.37v-.32l-.24-.21a7.69 7.69 0 01-2.5-5.92A8.15 8.15 0 016.31 9.3c.125-.497.286-.985.48-1.46z">
                </path>
                <path
                    d="M20.95 19.22a9.72 9.72 0 01-2.85.42c-5 0-9-3.71-9-8.26s4-8.26 9-8.26a8.47 8.47 0 018.77 8.27 7.69 7.69 0 01-2.5 5.92l-.24.21v.32a3.1 3.1 0 000 .37c.037.311.101.62.19.92.203.73.502 1.43.89 2.08a6.43 6.43 0 01-2.67-1.06 12.22 12.22 0 01-1.22-1l-.37.07zm4.32-1.16a9 9 0 002.74-6.68A9.61 9.61 0 0018.1 2C12.53 2 8.01 6.21 8.01 11.38c0 5.17 4.53 9.38 10.1 9.38a10.79 10.79 0 002.9-.4 7.8 7.8 0 00.92.7 7.46 7.46 0 004.19 1.31.66.66 0 00.6-.36.63.63 0 00-.05-.65 8.08 8.08 0 01-1.28-2.58 5.42 5.42 0 01-.15-.75l.03.03z">
                </path>
            </g>
        </svg>
        <span class="count"><?php echo number_format_i18n(get_comments_number()); ?></span>
    </h3>
    <?php if (have_comments()) : ?>
        <ol class="jComment--list">
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