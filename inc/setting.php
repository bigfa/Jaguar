<?php

class  jaguarSetting
{
    public $config;

    function __construct($config = [])
    {
        $this->config = $config;
        add_action('admin_menu', [$this, 'setting_menu']);
        add_action('admin_enqueue_scripts', [$this, 'setting_scripts']);
        add_action('wp_ajax_jaguar_setting', array($this, 'setting_callback'));
        //add_action('wp_ajax_nopriv_Jaguar_setting', array($this, 'setting_callback'));
    }

    function clean_options(&$value)
    {
        $value = stripslashes($value);
    }

    function setting_callback()
    {
        $data = $_POST[JAGUAR_SETTING_KEY];
        array_walk_recursive($data,  array($this, 'clean_options'));
        $this->update_setting($data);
        return wp_send_json([
            'code' => 200,
            'message' => __('Success', 'Jaguar'),
            'data' => $this->get_setting()
        ]);
    }

    function setting_scripts()
    {
        if (isset($_GET['page']) && $_GET['page'] == 'jaguar') {
            wp_enqueue_style('jaguar-setting', get_template_directory_uri() . '/build/css/setting.min.css', array(), JAGUAR_VERSION, 'all');
            wp_enqueue_script('jaguar-setting', get_template_directory_uri() . '/build/js/setting.min.js', ['jquery'], JAGUAR_VERSION, true);
            wp_localize_script(
                'jaguar-setting',
                'obvInit',
                [
                    'is_single' => is_singular(),
                    'post_id' => get_the_ID(),
                    'restfulBase' => esc_url_raw(rest_url()),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'success_message' => __('Setting saved success!', 'Jaguar'),
                    'upload_title' => __('Upload Image', 'Jaguar'),
                ]
            );
        }
    }

    function setting_menu()
    {
        add_menu_page(__('Theme Setting', 'Jaguar'), __('Theme Setting', 'Jaguar'), 'manage_options', 'jaguar', [$this, 'setting_page'], '', 59);
    }

    function setting_page()
    { ?>
        <div class="wrap">
            <h2><?php _e('Theme Setting', 'Jaguar') ?>
                <a href="https://docs.wpista.com/" target="_blank" class="page-title-action"><?php _e('Documentation', 'Jaguar') ?></a>
            </h2>
            <div class="pure-wrap">
                <div class="leftpanel">
                    <ul class="nav">
                        <?php foreach ($this->config['header'] as $val) {
                            $id = $val['id'];
                            $title = __($val['title'], 'Jaguar');
                            $icon = $val['icon'];
                            $class = ($id == "basic") ? "active" : "";
                            echo "<li class=\"$class\"><span id=\"tab-title-$id\"><i class=\"dashicons-before dashicons-$icon\"></i>$title</span></li>";
                        } ?>
                    </ul>
                </div>
                <form id="pure-form" method="POST" action="options.php">
                    <?php
                    foreach ($this->config['body'] as $val) {
                        $id = $val['id'];
                        $class = $id == "basic" ? "div-tab" : "div-tab hidden";
                    ?>
                        <div id="tab-<?php echo $id; ?>" class="<?php echo $class; ?>">
                            <?php if (isset($val['docs'])) : ?>
                                <div class="pure-docs">
                                    <a href="<?php echo $val['docs']; ?>" target="_blank"><?php _e('Documentation', 'Jaguar') ?></a>
                                </div>
                            <?php endif; ?>
                            <table class="form-table">
                                <tbody>
                                    <?php
                                    $content = $val['content'];
                                    foreach ($content as $k => $row) {
                                        switch ($row['type']) {
                                            case 'textarea':
                                                $this->setting_textarea($row);
                                                break;

                                            case 'switch':
                                                $this->setting_switch($row);
                                                break;

                                            case 'input':
                                                $this->setting_input($row);
                                                break;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <div class="pure-save"><span id="pure-save" class="button--save"><?php _e('Save', 'Jaguar') ?></span></div>
                </form>
            </div>
        </div>
    <?php }

    function get_setting($key = null)
    {
        $setting = get_option(JAGUAR_SETTING_KEY);

        if (!$setting) {
            return false;
        }

        if ($key) {
            if (array_key_exists($key, $setting)) {
                return $setting[$key];
            } else {
                return false;
            }
        } else {
            return $setting;
        }
    }

    function update_setting($setting)
    {
        update_option(JAGUAR_SETTING_KEY, $setting);
    }

    function empty_setting()
    {
        delete_option(JAGUAR_SETTING_KEY);
    }

    function setting_input($params)
    {
        $default = $this->get_setting($params['name']);
    ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo __($params['label'], 'Jaguar'); ?></label>
            </th>
            <td>
                <input type="text" id="pure-setting-<?php echo $params['name']; ?>" name="<?php printf('%s[%s]', JAGUAR_SETTING_KEY, $params['name']); ?>" value="<?php echo $default; ?>" class="regular-text">
                <?php printf('<br /><br />%s', __($params['description'], 'Jaguar')); ?>
            </td>
        </tr>
    <?php }

    function setting_textarea($params)
    { ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo __($params['label'], 'Jaguar'); ?></label>
            </th>
            <td>
                <textarea name="<?php printf('%s[%s]', JAGUAR_SETTING_KEY, $params['name']); ?>" id="pure-setting-<?php echo $params['name']; ?>" class="large-text code" rows="5" cols="50"><?php echo $this->get_setting($params['name']); ?></textarea>
                <?php printf('<br />%s', __($params['description'], 'Jaguar')); ?>
            </td>
        </tr>
    <?php }

    function setting_switch($params)
    {
        $val = $this->get_setting($params['name']);
        $val = $val ? 1 : 0;
    ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo __($params['label'], 'Jaguar'); ?></label>
            </th>
            <td>
                <a class="pure-setting-switch<?php if ($val) echo ' active'; ?>" href="javascript:;" data-id="pure-setting-<?php echo $params['name']; ?>">
                    <i></i>
                </a>
                <br />
                <input type="hidden" id="pure-setting-<?php echo $params['name']; ?>" name="<?php printf('%s[%s]', JAGUAR_SETTING_KEY, $params['name']); ?>" value="<?php echo $val; ?>" class="regular-text">
                <?php printf('<br />%s', __($params['description'], 'Jaguar')); ?>
            </td>
        </tr>
<?php }
}
global $jaguarSetting;
$jaguarSetting = new jaguarSetting(
    [
        "header" => [
            [
                'id' => 'basic',
                'title' => __('Basic Setting', 'Jaguar'),
                'icon' => 'basic'
            ],
            [
                'id' => 'feature',
                'title' => __('Feature Setting', 'Jaguar'),
                'icon' => 'slider'

            ],
            [
                'id' => 'singluar',
                'title' => __('Singluar Setting', 'Jaguar'),
                'icon' => 'feature'
            ],
            [
                'id' => 'meta',
                'title' => __('SNS Setting', 'Jaguar'),
                'icon' => 'social-contact'
            ],
            [
                'id' => 'custom',
                'title' => __('Custom Setting', 'Jaguar'),
                'icon' => 'interface'
            ]
        ],
        "body" => [
            [
                'id' => 'basic',
                'content' => [
                    [
                        'type' => 'textarea',
                        'name' => 'description',
                        'label' => __('Description', 'Jaguar'),
                        'description' => __('Site description', 'Jaguar'),
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'headcode',
                        'label' => __('Headcode', 'Jaguar'),
                        'description' => __('You can add content to the head tag, such as site verification tags, and so on.', 'Jaguar'),
                    ],
                    [
                        'type' => 'input',
                        'name' => 'logo',
                        'label' => __('Logo', 'Jaguar'),
                        'description' => __('Logo address.', 'Jaguar'),
                    ],
                    [
                        'type' => 'input',
                        'name' => 'og_default_thumb',
                        'label' => __('Og default thumb', 'Jaguar'),
                        'description' => __('Og meta default thumb address.', 'Jaguar'),
                    ],
                    [
                        'type' => 'input',
                        'name' => 'favicon',
                        'label' => __('Favicon', 'Jaguar'),
                        'description' => __('Favicon address', 'Jaguar'),
                    ],
                    [
                        'type' => 'input',
                        'name' => 'title_sep',
                        'label' => __('Title sep', 'Jaguar'),
                        'description' => __('Default is', 'Jaguar') . '<code>-</code>',
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'disable_block_css',
                        'label' => __('Disable block css', 'Jaguar'),
                        'description' => __('Do not load block-style files.', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'gravatar_proxy',
                        'label' => __('Gravatar proxy', 'Jaguar'),
                        'description' => __('Gravatar proxy domain,like <code>cravatar.cn</code>', 'Jaguar'),
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'rss_tag',
                        'label' => __('RSS Tag', 'Jaguar'),
                        'description' => __('You can add tag in rss to verify follow.', 'Jaguar'),
                    ],
                ]
            ],
            [
                'id' => 'feature',
                'docs' => 'https://docs.wpista.com/config/feature.html',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'auto_update',
                        'label' => __('Update notice', 'Jaguar'),
                        'description' => __('Get theme update notice.', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'upyun',
                        'label' => __('Upyun CDN', 'Jaguar'),
                        'description' => __('Make sure all images are uploaded to Upyun, otherwise thumbnails may not display properly.', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'oss',
                        'label' => __('Aliyun OSS CDN', 'Jaguar'),
                        'description' => __('Make sure all images are uploaded to Aliyun OSS, otherwise thumbnails may not display properly.', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'qiniu',
                        'label' => __('Qiniu OSS CDN', 'Jaguar'),
                        'description' => __('Make sure all images are uploaded to Qiniu OSS, otherwise thumbnails may not display properly.', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'darkmode',
                        'label' => __('Dark Mode', 'Jaguar'),
                        'description' => __('Enable dark mode', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'default_thumbnail',
                        'label' => __('Default thumbnail', 'Jaguar'),
                        'description' => __('Default thumbnail address', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'back2top',
                        'label' => __('Back to top', 'Jaguar'),
                        'description' => __('Enable back to top', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'cleanmode',
                        'label' => __('Clean mode', 'Jaguar'),
                        'description' => __('Enable clean mode', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'show_excerpt',
                        'label' => __('Excerpt info', 'Jaguar'),
                        'description' => __('Enable excerpt info in homepage', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'home_cat',
                        'label' => __('Category info', 'Jaguar'),
                        'description' => __('Enable category info in homepage', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'home_views',
                        'label' => __('Views info', 'Jaguar'),
                        'description' => __('Enable views info in homepage', 'Jaguar')
                    ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'home_image_count',
                    //     'label' => __('Image count', 'Jaguar'),
                    //     'description' => __('Show image count of the post', 'Jaguar')
                    // ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'hide_home_cover',
                    //     'label' => __('Hide home cover', 'Jaguar'),
                    //     'description' => __('Hide home cover', 'Jaguar')
                    // ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'exclude_status',
                    //     'label' => __('Exclude status', 'Jaguar'),
                    //     'description' => __('Exclude post type status in homepage', 'Jaguar')
                    // ],
                ]
            ],

            [
                'id' => 'singluar',
                'content' => [
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'bio',
                    //     'label' => __('Author bio', 'Jaguar'),
                    //     'description' => __('Enable author bio', 'Jaguar')
                    // ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'author_sns',
                    //     'label' => __('Author sns icons', 'Jaguar'),
                    //     'description' => __('Show author sns icons, will not show when author bio is off.', 'Jaguar')
                    // ],
                    [
                        'type' => 'switch',
                        'name' => 'related',
                        'label' => __('Related posts', 'Jaguar'),
                        'description' => __('Enable related posts', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'postlike',
                        'label' => __('Post like', 'Jaguar'),
                        'description' => __('Enable post like', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'post_navigation',
                        'label' => __('Post navigation', 'Jaguar'),
                        'description' => __('Enable post navigation', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'show_copylink',
                        'label' => __('Copy link', 'Jaguar'),
                        'description' => __('Enable copy link', 'Jaguar')
                    ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'category_card',
                    //     'label' => __('Category card', 'Jaguar'),
                    //     'description' => __('Show post category info after post.', 'Jaguar')
                    // ],
                    [
                        'type' => 'switch',
                        'name' => 'show_parent',
                        'label' => __('Show parent comment', 'Jaguar'),
                        'description' => __('Enable show parent comment', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'toc',
                        'label' => __('Table of content', 'Jaguar'),
                        'description' => __('Enable table of content', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'toc_start',
                        'label' => __('Start heading', 'Jaguar'),
                        'description' => __('Start heading,default h3', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'post_views',
                        'label' => __('Post views', 'Jaguar'),
                        'description' => __('Show post views in meta', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'post_reads',
                        'label' => __('Post reads', 'Jaguar'),
                        'description' => __('Show post reads in meta', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'read_time',
                        'label' => __('Post read time', 'Jaguar'),
                        'description' => __('Show post read time in meta', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'disable_comment_link',
                        'label' => __('Disable comment link', 'Jaguar'),
                        'description' => __('Disable comment author url', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'no_reply_text',
                        'label' => __('No reply text', 'Jaguar'),
                        'description' => __('Text display when no comment in current post.', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'friend_icon',
                        'label' => __('Friend icon', 'Jaguar'),
                        'description' => __('Show icon when comment author url is in blogroll.', 'Jaguar')
                    ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'image_zoom',
                    //     'label' => __('Post image zoom', 'Jaguar'),
                    //     'description' => __('Zoom image when a tag link to image url.', 'Jaguar')
                    // ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'update_time',
                    //     'label' => __('Post update time', 'Jaguar'),
                    //     'description' => __('Show the last update time of post.', 'Jaguar')
                    // ],
                ]
            ],
            [
                'id' => 'meta',
                'docs' => 'https://docs.wpista.com/config/sns.html',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'footer_sns',
                        'label' => __('SNS Icons', 'Jaguar'),
                        'description' => __('Show sns icons in footer, if this setting is on, the footer menu won\',t be displayed.', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'telegram',
                        'label' => __('Telegram', 'Jaguar'),
                        'description' => __('Telegram link', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'email',
                        'label' => __('Email', 'Jaguar'),
                        'description' => __('Your email address', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'instagram',
                        'label' => __('Instagram', 'Jaguar'),
                        'description' => __('Instagram link', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'twitter',
                        'label' => __('Twitter', 'Jaguar'),
                        'description' => __('Twitter link', 'Jaguar')
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'rss',
                        'label' => __('RSS', 'Jaguar'),
                        'description' => __('RSS link', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'github',
                        'label' => __('Github', 'Jaguar'),
                        'description' => __('Github link', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'discord',
                        'label' => __('Discord', 'Jaguar'),
                        'description' => __('Discord link', 'Jaguar')
                    ],
                    [
                        'type' => 'input',
                        'name' => 'mastodon',
                        'label' => __('Mastodon', 'Jaguar'),
                        'description' => __('Mastodon link', 'Jaguar')
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'custom_sns',
                        'label' => __('Custom', 'Jaguar'),
                        'description' => __('Custom sns link,use html.', 'Jaguar')
                    ],
                ]
            ],
            [
                'id' => 'custom',
                'content' => [
                    [
                        'type' => 'textarea',
                        'name' => 'css',
                        'label' => __('CSS', 'Jaguar'),
                        'description' => __('Custom CSS', 'Jaguar')
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'javascript',
                        'label' => __('Javascript', 'Jaguar'),
                        'description' => __('Custom Javascript', 'Jaguar')
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'copyright',
                        'label' => __('Copyright', 'Jaguar'),
                        'description' => __('Custom footer content', 'Jaguar')
                    ],
                ]
            ],
        ]
    ]
);
