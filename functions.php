<?php

define('JAGUAR_VERSION', wp_get_theme()->get('Version'));
define('JAGUAR_SETTING_KEY', 'jaguar_settings');
define('JAGUAR_ARCHIVE_VIEW_KEY', 'jaguar_archive_view');
define('JAGUAR_POST_VIEW_KEY', 'jaguar_post_view');
define('JAGUAR_POST_LIKE_KEY', 'jaguar_post_like');

function jaguar_setup()
{
    load_theme_textdomain('Jaguar', get_template_directory() . '/languages');
}


add_action('after_setup_theme', 'jaguar_setup');

require('inc/setting.php');
require('inc/base.php');
require('inc/comment.php');

function jaguar_get_background_image($post_id = null, $width = null, $height = null)
{
    global $jaguarSetting;
    if (has_post_thumbnail($post_id)) {
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        $output = $timthumb_src[0];
    } else {
        $content = get_post_field('post_content', $post_id);
        $defaltthubmnail = get_template_directory_uri() . '/build/images/default.jpg';
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            $output = $strResult[1][0];
        } else {
            $output = $defaltthubmnail;
            return $output;
        }
    }

    if ($jaguarSetting->get_setting('upyun')) {
        $output = $output . '?x-oss-process=image/resize,m_fill,h_' . $height . ',w_' . $width;
    }

    return $output;
}

function jaguar_is_has_image($post_id)
{
    static $has_image;

    if (has_post_thumbnail($post_id)) {
        $has_image = true;
    } else {
        $content = get_post_field('post_content', $post_id);
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            $has_image = true;
        } else {
            $has_image = false;
        }
    }
    return $has_image;
}

function jaguar_get_post_image_count($post_id)
{
    $content = get_post_field('post_content', $post_id);
    $content =  apply_filters('the_content', $content);
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    return count($strResult[1]);
}
