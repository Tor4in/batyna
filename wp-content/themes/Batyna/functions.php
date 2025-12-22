<?php
// ВИПРАВЛЕННЯ ПОМИЛКИ ob_end_flush
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action('after_setup_theme', 'theme_setup');
add_filter('upload_mimes', 'svg_upload_allow');
add_action('wpcf7_before_send_mail', 'send_message_to_telegram');
add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

// ============================================
// Include Custom Post Types
// ============================================
require_once get_template_directory() . '/includes/post-types.php';
require_once get_template_directory() . '/includes/ajax-handlers.php';


function enqueue_scripts_and_styles()
{
    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.bundle.css');

    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/js/main.bundle.js', array(), null, true);
    wp_localize_script('main-js', 'params', array(
        'template_directory_url' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'page_template' => get_page_template_slug() ? get_page_template_slug() : ''
    ));
}

function theme_setup()
{
    show_admin_bar(true);
    
    register_nav_menus( array(
        'menu-header' => 'Header',
        'menu-footer' => 'Footer',
    ) );
    
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

/**
 * Helper: Get Picture (WebP + Lazy Load)
 * Required by hero.php
 */
function get_picture($filename, $class = '', $alt = '', $lazy = true)
{
    $path = get_template_directory_uri() . '/assets/images/';
    
    // Separate name and extension
    $parts = pathinfo($filename);
    $name = $parts['filename'];
    $ext  = isset($parts['extension']) ? $parts['extension'] : 'jpg';

    $is_svg = strtolower($ext) === 'svg';
    $loading = $lazy ? 'loading="lazy"' : 'loading="eager"';
    
    // Build classes
    $class_attr = $class ? 'class="' . esc_attr($class) . '"' : '';
    
    // Return SVG immediately if that's the type
    if ($is_svg) {
        return "<img src='{$path}{$filename}' {$class_attr} alt='" . esc_attr($alt) . "' {$loading}>";
    }

    // Output picture tag
    $html = "<picture {$class_attr}>";
    $html .= "<source srcset='{$path}{$name}.webp' type='image/webp'>";
    $html .= "<img src='{$path}{$filename}' alt='" . esc_attr($alt) . "' {$loading}>";
    $html .= "</picture>";

    return $html;
}

function get_image($name)
{
    echo get_template_directory_uri() . "/assets/images/" . $name;
}

function getPhrase($string_key, $group = 'Main Page')
{
    global $strings_to_translate, $strings_to_translate_privacy;

    // Safety check to ensure arrays exist
    if (!isset($strings_to_translate)) $strings_to_translate = [];
    if (!isset($strings_to_translate_privacy)) $strings_to_translate_privacy = [];

    $strings = $group === 'Privacy Policy' ? $strings_to_translate_privacy : $strings_to_translate;

    if (isset($strings[$string_key])) {
        if (function_exists('pll__')) {
            echo pll__($strings[$string_key]); // Simplified call
        } else {
            echo $strings[$string_key];
        }
    }
}

// Translations Data
$strings_to_translate = array(
    '' => '',
);

$strings_to_translate_privacy = array(
    '' => '',
);

// Register Strings (Wrapped in 'init' to fix Textdomain Warning)
add_action('init', function() use ($strings_to_translate, $strings_to_translate_privacy) {
    if (function_exists('pll_register_string')) {
        foreach ($strings_to_translate as $string_key => $string_value) {
            if(!empty($string_key)) pll_register_string($string_key, $string_value, 'Main Page');
        }

        foreach ($strings_to_translate_privacy as $string_key => $string_value) {
            if(!empty($string_key)) pll_register_string($string_key, $string_value, 'Privacy Policy');
        }
    }
});

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
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 100);


// Вимкнути стандартні стилі галереї WordPress, щоб прибрати текст #gallery-1...
add_filter( 'use_default_gallery_style', '__return_false' );

function remove_active_class_from_anchors($classes, $item) {
    // Якщо URL містить #, видаляємо класи активності
    if (strpos($item->url, '#') !== false) {
        $classes = array_diff($classes, array('current-menu-item', 'current_page_item', 'current_page_parent'));
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'remove_active_class_from_anchors', 10, 2);