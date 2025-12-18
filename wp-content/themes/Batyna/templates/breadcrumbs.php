<?php
/**
 * Breadcrumbs Template
 */

// Skip on front page
if (is_front_page()) {
    return;
}

global $post;
$crumbs = [];

// Home link
$crumbs[] = [
    'title' => 'Головна',
    'url' => home_url('/'),
];

// Page ancestors
if (is_page() && $post->post_parent) {
    $ancestors = get_post_ancestors($post->ID);
    $ancestors = array_reverse($ancestors);

    foreach ($ancestors as $ancestor_id) {
        $crumbs[] = [
            'title' => get_the_title($ancestor_id),
            'url' => get_permalink($ancestor_id),
        ];
    }
}

// Category archive
if (is_category()) {
    $category = get_queried_object();
    $crumbs[] = [
        'title' => $category->name,
        'url' => get_category_link($category->term_id),
    ];
}

// Blog archive
if (is_post_type_archive('blog')) {
    $crumbs[] = [
        'title' => 'Блог',
        'url' => get_post_type_archive_link('blog'),
    ];
}
// Standard archive
elseif (is_archive()) {
    $current_title = get_the_archive_title();
    $current_title = preg_replace('/^[\w\s]+:\s/', '', $current_title);
    
    $crumbs[] = [
        'title' => $current_title,
        'url' => null,
    ];
}

// Single post
if (is_single() && !is_attachment()) {
    if (get_post_type() === 'blog') {
        $crumbs[] = [
            'title' => 'Блог',
            'url' => get_post_type_archive_link('blog'),
        ];
    }
}

// Search results
if (is_search()) {
    $crumbs[] = [
        'title' => 'Результати пошуку: ' . get_search_query(),
        'url' => null,
    ];
}

// 404 page
if (is_404()) {
    $crumbs[] = [
        'title' => 'Сторінка не знайдена',
        'url' => null,
    ];
}

// Current page
if (is_page() || (is_single() && !is_attachment())) {
    $crumbs[] = [
        'title' => get_the_title(),
        'url' => null,
    ];
}
?>

<nav class="breadcrumbs" aria-label="Breadcrumb">
    <ol class="breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($crumbs as $index => $crumb): ?>
            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <?php if (!empty($crumb['url']) && $index !== count($crumbs) - 1): ?>
                    <a href="<?php echo esc_url($crumb['url']); ?>" class="breadcrumbs__link" itemprop="item">
                        <span itemprop="name"><?php echo esc_html($crumb['title']); ?></span>
                    </a>
                <?php else: ?>
                    <span class="breadcrumbs__current" itemprop="name">
                        <?php echo esc_html($crumb['title']); ?>
                    </span>
                    <meta itemprop="item" content="<?php echo esc_url(get_permalink()); ?>">
                <?php endif; ?>
                <meta itemprop="position" content="<?php echo $index + 1; ?>">
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
