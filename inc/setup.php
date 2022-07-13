<?php
function jaguar_ajax_comment_callback()
{
    $comment = wp_handle_comment_submission(wp_unslash($_POST));
    if (is_wp_error($comment)) {
        $data = $comment->get_error_data();
        if (!empty($data)) {
            exit;
        } else {
            exit;
        }
    }
    $user = wp_get_current_user();
    do_action('set_comment_cookies', $comment, $user);
    $GLOBALS['comment'] = $comment;
?>
    <li <?php comment_class(); ?>>
        <article class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, $size = '48') ?>
                    <b class="fn">
                        <?php echo get_comment_author_link(); ?>
                    </b>
                </div>
                <div class="comment-metadata">
                    <?php echo get_comment_date(); ?>
                </div>
            </footer>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
        </article>
    </li>
<?php die();
}

add_action('wp_ajax_nopriv_ajax_comment', 'jaguar_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'jaguar_ajax_comment_callback');

function jaguar_send_analystic()
{
    $current_version = get_option('_jaguar_version');
    $api_url = "https://dev.fatesinger.com/_/api/";
    $theme_data = jaguar_get_theme();
    if ($current_version == $theme_data['theme_version'] || $theme_data['site_url'] == 'localhost') return;
    $send_body = array_merge(array('action' => 'jaguar_send_analystic'), $theme_data);
    $send_for_check = array(
        'body' => $send_body,
        'sslverify' => false,
        'timeout' => 300,
    );
    $response = wp_remote_post($api_url, $send_for_check);
    if (!is_wp_error($response)) update_option('_jaguar_version', $theme_data['theme_version']);
}
add_action('after_switch_theme', 'jaguar_send_analystic');

function jaguar_get_theme()
{
    global $wp_version;
    $theme_name = get_option('template');

    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme($theme_name);
        $theme_version = $theme_data->Version;
    } else {
        $theme_data = wp_get_theme();
        $theme_version = $theme_data['Version'];
    }

    $site_url = home_url();

    return compact('wp_version', 'theme_name', 'theme_version', 'site_url');
}
