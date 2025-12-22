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
        'name' => _x('Послуги', 'Post Type General Name', 'batyna'),
        'singular_name' => _x('Послуга', 'Post Type Singular Name', 'batyna'),
        'menu_name' => __('Послуги', 'batyna'),
        'name_admin_bar' => __('Послуга', 'batyna'),
        'add_new' => __('Додати', 'batyna'),
        'add_new_item' => __('Додати нову послугу', 'batyna'),
        'new_item' => __('Нова послуга', 'batyna'),
        'edit_item' => __('Редагувати послугу', 'batyna'),
        'view_item' => __('Переглянути послугу', 'batyna'),
        'all_items' => __('Всі послуги', 'batyna'),
        'search_items' => __('Пошук послуг', 'batyna'),
        'not_found' => __('Послуги не знайдені', 'batyna'),
        'not_found_in_trash' => __('Послуги не знайдені у кошику', 'batyna'),
        'featured_image' => __('Зображення послуги', 'batyna'),
        'set_featured_image' => __('Встановити зображення', 'batyna'),
        'remove_featured_image' => __('Видалити зображення', 'batyna'),
    );

    $args = array(
        'label' => __('Послуги', 'batyna'),
        'description' => __('Стоматологічні послуги', 'batyna'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies' => array('category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-heart',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'services', 'with_front' => true),
        'capability_type' => 'post',
        'show_in_rest' => true,
    );

    register_post_type('services', $args);
});

// 2. Doctors Post Type (Team)
add_action('init', function () {

    $labels = array(
        'name' => _x('Лікарі', 'Post Type General Name', 'batyna'),
        'singular_name' => _x('Лікар', 'Post Type Singular Name', 'batyna'),
        'menu_name' => __('Лікарі', 'batyna'),
        'name_admin_bar' => __('Лікар', 'batyna'),
        'add_new' => __('Додати', 'batyna'),
        'add_new_item' => __('Додати лікаря', 'batyna'),
        'new_item' => __('Новий лікар', 'batyna'),
        'edit_item' => __('Редагувати лікаря', 'batyna'),
        'view_item' => __('Переглянути лікаря', 'batyna'),
        'all_items' => __('Всі лікарі', 'batyna'),
        'search_items' => __('Пошук лікаря', 'batyna'),
        'not_found' => __('Лікарів не знайдено', 'batyna'),
        'not_found_in_trash' => __('Лікарів не знайдено у кошику', 'batyna'),
        'featured_image' => __('Фото лікаря', 'batyna'),
        'set_featured_image' => __('Встановити фото', 'batyna'),
        'remove_featured_image' => __('Видалити фото', 'batyna'),
    );

    $args = array(
        'label' => __('Лікарі', 'batyna'),
        'description' => __('Наші спеціалісти', 'batyna'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies' => array('category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
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
        'name' => _x('Блог', 'Post Type General Name', 'batyna'),
        'singular_name' => _x('Стаття', 'Post Type Singular Name', 'batyna'),
        'menu_name' => __('Блог', 'batyna'),
        'name_admin_bar' => __('Стаття', 'batyna'),
        'add_new' => __('Додати', 'batyna'),
        'add_new_item' => __('Додати статтю', 'batyna'),
        'new_item' => __('Нова стаття', 'batyna'),
        'edit_item' => __('Редагувати статтю', 'batyna'),
        'view_item' => __('Переглянути статтю', 'batyna'),
        'all_items' => __('Всі статті', 'batyna'),
        'search_items' => __('Пошук статей', 'batyna'),
        'not_found' => __('Статей не знайдено', 'batyna'),
        'not_found_in_trash' => __('Статей не знайдено у кошику', 'batyna'),
        'featured_image' => __('Обкладинка', 'batyna'),
        'set_featured_image' => __('Встановити обкладинку', 'batyna'),
        'remove_featured_image' => __('Видалити обкладинку', 'batyna'),
    );

    $args = array(
        'label' => __('Блог', 'batyna'),
        'description' => __('Новини та статті', 'batyna'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'comments', 'author'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-edit-large',
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