<?php

function jaguar_send_analystic(){
    $current_version = get_option('_jaguar_version');
    $api_url = "https://dev.fatesinger.com/_/api/";
    $theme_data = jaguar_get_theme();
    if ( $current_version == $theme_data['theme_version'] ) return;
    $send_body = array_merge(array('action' => 'jaguar_send_analystic'), $theme_data);
    $send_for_check = array(
        'body' => $send_body,
        'sslverify' => false,
        'timeout' => 300,
    );
    $response = wp_remote_post($api_url, $send_for_check);
    if ( !is_wp_error($response ) ) update_option( '_jaguar_version' , $theme_data['theme_version'] );
}
add_action('after_switch_theme','jaguar_send_analystic');

function jaguar_get_theme(){
    global $wp_version;
    $theme_name = get_option('template');

    if(function_exists('wp_get_theme')){
        $theme_data = wp_get_theme($theme_name);
        $theme_version = $theme_data->Version;
    } else {
        $theme_data = get_theme_data( PURE_THEME_URL . '/style.css');
        $theme_version = $theme_data['Version'];
    }

    $site_url = home_url();

    return compact('wp_version', 'theme_name', 'theme_version', 'site_url' );
    
}