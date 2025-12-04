<?php
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action('after_setup_theme', 'theme_setup');
add_filter('upload_mimes', 'svg_upload_allow');
add_action('wpcf7_before_send_mail', 'send_message_to_telegram');
add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

// ============================================
// Include Custom Post Types
// ============================================
// Переконайся, що створив папку includes і поклав туди файл
require_once get_template_directory() . '/includes/post-types.php';

function enqueue_scripts_and_styles()
{

    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.bundle.css'); // R

    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/js/main.bundle.js', array(), null, true);
    wp_localize_script('main-js', 'params', array(
        'template_directory_url' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'page_template' => get_page_template_slug() ? get_page_template_slug() : ''
    ));
}

function theme_setup()
{
    show_admin_bar(false);
    register_nav_menu('menu-header', 'Main menu');

    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

// ============================================
// ACF Options Page (Global Settings)
// ============================================
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Налаштування сайту',
            'menu_title' => 'Налаштування',
            'menu_slug' => 'site-options',
            'capability' => 'manage_options',
            'redirect' => false,
            'position' => 65,
            'icon_url' => 'dashicons-admin-generic',
            'update_button' => __('Зберегти налаштування', 'maxi-dent'),
            'updated_message' => __('Налаштування оновлені', 'maxi-dent')
        ));
    }
});

function get_image($name)
{
    echo get_template_directory_uri() . "/assets/images/" . $name;
}

function getPhrase($string_key, $group = 'Main Page')
{
    global $strings_to_translate, $strings_to_translate_privacy;

    $strings = $group === 'Privacy Policy' ? $strings_to_translate_privacy : $strings_to_translate;

    if (function_exists('pll__')) {
        echo pll__($strings[$string_key], $group);
    } else {
        echo $strings[$string_key];
    }
}

$strings_to_translate = array(
    '' => '',
);

$strings_to_translate_privacy = array(
    '' => '',
);

if (function_exists('pll_register_string')) {
    foreach ($strings_to_translate as $string_key => $string_value) {
        pll_register_string($string_key, $string_value, 'Main Page');
    }

    foreach ($strings_to_translate_privacy as $string_key => $string_value) {
        pll_register_string($string_key, $string_value, 'Privacy Policy');
    }
}


function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    if ($dosvg) {

        if (current_user_can('manage_options')) {

            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        } else {
            $data['ext'] = false;
            $data['type'] = false;
        }
    }

    return $data;
}

function getHomePageID()
{

    // Отримуємо ID стандартної головної сторінки
    $default_home_id = get_option('page_on_front');

    // Перевіряємо, чи встановлений Polylang і чи існують необхідні функції
    if (function_exists('pll_current_language') && function_exists('pll_get_post')) {
        // Визначаємо поточну мову
        $current_lang = pll_current_language();

        // Отримуємо ID перекладеної сторінки
        $translated_home_id = pll_get_post($default_home_id, $current_lang);

        // Повертаємо перекладений ID, якщо він існує, інакше стандартний
        return $translated_home_id ? $translated_home_id : $default_home_id;
    }

    // Якщо Polylang не встановлений, повертаємо стандартний ID
    return $default_home_id;
}


/*
 * Вимкнення Gutenberg (блочного редактора)
 */
// Вимикає редактор блоків для постів та сторінок
add_filter('use_block_editor_for_post', '__return_false');

// Вимикає редактор блоків для віджетів (повертає старі віджети)
add_filter('use_widgets_block_editor', '__return_false');

// Опціонально: Вимкнути завантаження стилів Gutenberg на фронтенді (щоб сайт вантажився швидше)
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 100);