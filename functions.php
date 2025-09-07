<?php

define('JAGUAR_VERSION', wp_get_theme()->get('Version'));
define('JAGUAR_SETTING_KEY', 'jaguar_settings');
define('JAGUAR_ARCHIVE_VIEW_KEY', 'jaguar_archive_view');
define('JAGUAR_POST_VIEW_KEY', 'jaguar_post_view');
define('JAGUAR_POST_LIKE_KEY', 'jaguar_post_like');
define('JAGUAR_POST_READ_KEY', 'jaguar_post_read');

function jaguar_setup()
{
    load_theme_textdomain('Jaguar', get_template_directory() . '/languages');
}


add_action('after_setup_theme', 'jaguar_setup');

require('inc/setting.php');
require('inc/base.php');
require('inc/comment.php');
require('inc/update.php');

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

    if ($jaguarSetting->get_setting('upyun') && $width && $height) {
        $output = $output . '!/both/' . $width . 'x' . $height;
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

function jaguar_get_post_read_time($post_id)
{
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed is 200 wpm

    $image_count = jaguar_get_post_image_count($post_id);
    if ($image_count > 0) {
        $reading_time += ceil($image_count / 10); // Add extra time for images
    }

    return $reading_time;
}

function jaguar_get_post_read_time_text($post_id)
{
    $reading_time = jaguar_get_post_read_time($post_id);
    if ($reading_time <= 1) {
        return __('1 min read', 'Jaguar');
    } else {
        return sprintf(__('%d min read', 'Jaguar'), $reading_time);
    }
}


/**
 * Get link items by category id
 *
 * @since Jaguar 3.0.4
 *
 * @param term id
 * @return link item list
 */

function get_the_link_items($id = null)
{
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output = '';
    if (!empty($bookmarks)) {
        $output .= '<div class="jLink--list">';
        foreach ($bookmarks as $bookmark) {
            $image = $bookmark->link_image ? '<img src="' . $bookmark->link_image . '" alt="' . $bookmark->link_name . '" class="avatar">' : get_avatar($bookmark->link_notes, 64);
            $output .=  '<div class="jLink--item"><a class="link-item-inner" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><span class="sitename">
             ' . $image . '
             <strong>' . $bookmark->link_name . '</strong>' . $bookmark->link_description . '</span></a></div>';
        }
        $output .= '</div>';
    } else {
        $output = __('No links yet', 'Hera');
    }
    return $output;
}

/**
 * Get link items
 *
 * @since Jaguar 3.0.4
 *
 * @return link iterms
 */

function get_link_items()
{
    $linkcats = get_terms('link_category');
    $result = '';
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .=  '<h3 class="jLink--title">' . $linkcat->name . '</h3>';
            if ($linkcat->description) $result .= '<div class="jLink--description">' . $linkcat->description . '</div>';
            $result .=  get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}



function jaguar_get_post_views($post_id = 0)
{

    $views_number = (int)get_post_meta($post_id, JAGUAR_POST_VIEW_KEY, true);

    /**
     * Filters the returned views for a post.
     *
     * @since Jaguar 3.1.0
     */
    return apply_filters('jaguar_get_post_views', $views_number, $post_id);
}

/**
 * Get post views
 *
 * @since Jaguar 3.1.0
 *
 * @param post id
 * @return post views
 */

function jaguar_get_post_views_text($zero = false, $one = false, $more = false, $post = 0)
{
    $views = jaguar_get_post_views($post);
    if ($views == 0) {
        return $zero ? $zero : __('No views yet', 'Jaguar');
    } elseif ($views == 1) {
        return $one ? $one : __('1 view', 'Jaguar');
    } else {
        return $more ? str_replace('%d', $views, $more) : sprintf(__('%d views', 'Jaguar'), $views);
    }
}
