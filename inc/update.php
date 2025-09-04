<?php
global $jaguarSetting;
function jaguar_is_get_new()
{
    if (get_transient('jaguar_latest')) {
        $latest = get_transient('jaguar_latest');
    } else {
        delete_transient('jaguar_latest');
        $response = wp_remote_get('https://v.wpista.com/latest?theme=jaguar', array(
            'sslverify' => false
        ));
        if (is_wp_error($response)) {
            return false;
        }
        $res = $response['body'];
        $latest = json_decode($res, true)['version'];
        set_transient('jaguar_latest', $latest, 60 * 60 * 24);
    }
    return version_compare(JAGUAR_VERSION, $latest, '<');
}

function jaguar_update_notice()
{
    add_thickbox();
    echo '<div class="updated">
    <p>主题最新版为 ' . get_transient('jaguar_latest') . '，当前版本 ' . JAGUAR_VERSION . '。请备份好所有文件，主题升级过程中会删掉原有文件。<a class="thickbox" href="' . admin_url() . 'admin-ajax.php?action=jaguar_theme_update&TB_iframe=true&width=772&height=312">确认升级</a>
    </p></div>';
}
if ($jaguarSetting->get_setting('auto_update') && jaguar_is_get_new()) add_action('admin_notices', 'jaguar_update_notice');

add_action('wp_ajax_jaguar_theme_update', 'jaguar_theme_update_callback');
function jaguar_theme_update_callback()
{

    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

    $update_data = array(
        'theme_version' => get_transient('jaguar_latest'),
        'update_link' => 'https://github.com/bigfa/Jaguar/archive/refs/tags/v' . get_transient('jaguar_latest') . '.zip'
    );

    $name          = "Jaguar";
    $slug          = "Jaguar";
    $version       = $update_data['theme_version'];
    $download_link = $update_data['update_link'];

    delete_site_transient('update_themes');

    $themes = wp_get_themes();
    $current = (object) array(
        "last_checked" => time(),
        "checked" => array(),
        "response" => array(),
        "translations" => array()
    );

    foreach ($themes as $theme) {
        $current->checked[$theme->get('Slug')] = $theme->get('Version');
    }

    $current->response[$slug] = array(
        'theme' => $slug,
        'new_version' => $version,
        'url' => '',
        'package' => $download_link
    );

    set_site_transient('update_themes', $current);

    $title = __('Update Theme');
    $nonce = 'upgrade-theme_' . $slug;
    $url = 'update.php?action=upgrade-theme&theme=' . urlencode($slug);

    $upgrader = new Theme_Upgrader(new Theme_Upgrader_Skin(compact('title', 'nonce', 'url', 'theme')));
    $upgrader->upgrade($slug);

    exit;
}
