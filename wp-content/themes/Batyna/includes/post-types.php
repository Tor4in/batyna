<?php
/**
 * Custom Post Types Registration
 *
 * Registered CPTs:
 * 1. Services (Послуги)
 * 2. Doctors (Лікарі)
 * 3. Blog (Блог - замість стандартних post)
 */

// 1. Services Post Type
add_action('init', function () {

    $labels = array(
        'name' => _x('Послуги', 'Post Type General Name', 'maxi-dent'),
        'singular_name' => _x('Послуга', 'Post Type Singular Name', 'maxi-dent'),
        'menu_name' => __('Послуги', 'maxi-dent'),
        'name_admin_bar' => __('Послуга', 'maxi-dent'),
        'add_new' => __('Додати', 'maxi-dent'),
        'add_new_item' => __('Додати нову послугу', 'maxi-dent'),
        'new_item' => __('Нова послуга', 'maxi-dent'),
        'edit_item' => __('Редагувати послугу', 'maxi-dent'),
        'view_item' => __('Переглянути послугу', 'maxi-dent'),
        'all_items' => __('Всі послуги', 'maxi-dent'),
        'search_items' => __('Пошук послуг', 'maxi-dent'),
        'not_found' => __('Послуги не знайдені', 'maxi-dent'),
        'not_found_in_trash' => __('Послуги не знайдені у кошику', 'maxi-dent'),
        'featured_image' => __('Зображення послуги', 'maxi-dent'),
        'set_featured_image' => __('Встановити зображення', 'maxi-dent'),
        'remove_featured_image' => __('Видалити зображення', 'maxi-dent'),
    );

    $args = array(
        'label' => __('Послуги', 'maxi-dent'),
        'description' => __('Стоматологічні послуги', 'maxi-dent'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies' => array('category'), // Можна вимкнути, якщо категорії не потрібні для послуг
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-heart', // Іконка серця
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'services', 'with_front' => true),
        'capability_type' => 'post',
        'show_in_rest' => true, // Важливо для роботи Gutenberg (якщо увімкнено) та REST API
    );

    register_post_type('services', $args);
});

// 2. Doctors Post Type (Team)
add_action('init', function () {

    $labels = array(
        'name' => _x('Лікарі', 'Post Type General Name', 'maxi-dent'),
        'singular_name' => _x('Лікар', 'Post Type Singular Name', 'maxi-dent'),
        'menu_name' => __('Лікарі', 'maxi-dent'),
        'name_admin_bar' => __('Лікар', 'maxi-dent'),
        'add_new' => __('Додати', 'maxi-dent'),
        'add_new_item' => __('Додати лікаря', 'maxi-dent'),
        'new_item' => __('Новий лікар', 'maxi-dent'),
        'edit_item' => __('Редагувати лікаря', 'maxi-dent'),
        'view_item' => __('Переглянути лікаря', 'maxi-dent'),
        'all_items' => __('Всі лікарі', 'maxi-dent'),
        'search_items' => __('Пошук лікаря', 'maxi-dent'),
        'not_found' => __('Лікарів не знайдено', 'maxi-dent'),
        'not_found_in_trash' => __('Лікарів не знайдено у кошику', 'maxi-dent'),
        'featured_image' => __('Фото лікаря', 'maxi-dent'),
        'set_featured_image' => __('Встановити фото', 'maxi-dent'),
        'remove_featured_image' => __('Видалити фото', 'maxi-dent'),
    );

    $args = array(
        'label' => __('Лікарі', 'maxi-dent'),
        'description' => __('Наші спеціалісти', 'maxi-dent'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies' => array('category'), // Наприклад, категорія "Хірурги", "Ортодонти"
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups', // Іконка групи людей
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'doctors', 'with_front' => true),
        'capability_type' => 'post',
        'show_in_rest' => true,
    );

    register_post_type('doctors', $args);
});

// 3. Blog Post Type
add_action('init', function () {

    $labels = array(
        'name' => _x('Блог', 'Post Type General Name', 'maxi-dent'),
        'singular_name' => _x('Стаття', 'Post Type Singular Name', 'maxi-dent'),
        'menu_name' => __('Блог', 'maxi-dent'),
        'name_admin_bar' => __('Стаття', 'maxi-dent'),
        'add_new' => __('Додати', 'maxi-dent'),
        'add_new_item' => __('Додати статтю', 'maxi-dent'),
        'new_item' => __('Нова стаття', 'maxi-dent'),
        'edit_item' => __('Редагувати статтю', 'maxi-dent'),
        'view_item' => __('Переглянути статтю', 'maxi-dent'),
        'all_items' => __('Всі статті', 'maxi-dent'),
        'search_items' => __('Пошук статей', 'maxi-dent'),
        'not_found' => __('Статей не знайдено', 'maxi-dent'),
        'not_found_in_trash' => __('Статей не знайдено у кошику', 'maxi-dent'),
        'featured_image' => __('Обкладинка', 'maxi-dent'),
        'set_featured_image' => __('Встановити обкладинку', 'maxi-dent'),
        'remove_featured_image' => __('Видалити обкладинку', 'maxi-dent'),
    );

    $args = array(
        'label' => __('Блог', 'maxi-dent'),
        'description' => __('Новини та статті', 'maxi-dent'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'comments', 'author'),
        'taxonomies' => array('category', 'post_tag'), // Стандартні категорії та теги
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-edit-large', // Іконка олівця
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'blog', 'with_front' => true),
        'capability_type' => 'post',
        'show_in_rest' => true,
    );

    register_post_type('blog', $args);
});

/**
 * Clean up Admin Menu
 * Remove default "Posts" (Записи) since we have a custom "Blog" CPT.
 */
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
});

/**
 * Prevent creating default "Posts"
 * Just an extra security step so no one creates content in the wrong place.
 */
add_action('init', function () {
    global $wp_post_types;
    if (isset($wp_post_types['post'])) {
        $wp_post_types['post']->cap->create_posts = 'do_not_allow';
    }
});

/**
 * Flush rewrite rules automatically when theme is switched/activated.
 * Helps prevent 404 errors on new CPTs without manual saving.
 */
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});