<?php
/**
 * AJAX Handlers
 */

add_action('wp_ajax_load_blog_posts', 'load_blog_posts_ajax');
add_action('wp_ajax_nopriv_load_blog_posts', 'load_blog_posts_ajax');

function load_blog_posts_ajax()
{
    // Security check
    check_ajax_referer('blog_archive_nonce', 'nonce');

    // Get parameters
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    
    // Get posts per page from WP settings
    $posts_per_page = get_option('posts_per_page');

    // Query args
    $args = [
        'post_type'      => 'blog',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);

    // Build HTML response
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('templates/blog-card');
        }
        $content = ob_get_clean();

        wp_send_json_success([
            'html' => $content,
            'max_pages' => $query->max_num_pages
        ]);
    } else {
        wp_send_json_error(['message' => 'No more posts']);
    }

    wp_reset_postdata();
    wp_die();
}
