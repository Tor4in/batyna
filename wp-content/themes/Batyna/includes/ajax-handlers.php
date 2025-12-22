<?php
/**
 * AJAX Handlers
 */

// Blog posts
add_action('wp_ajax_load_blog_posts', 'load_blog_posts_ajax');
add_action('wp_ajax_nopriv_load_blog_posts', 'load_blog_posts_ajax');

function load_blog_posts_ajax()
{
    check_ajax_referer('blog_archive_nonce', 'nonce');

    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $posts_per_page = get_option('posts_per_page');

    $args = [
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('templates/blog-card');
        }
        $content = ob_get_clean();

        wp_send_json_success([
            'html' => $content,
            'max_pages' => $query->max_num_pages,
        ]);
    } else {
        wp_send_json_error(['message' => 'No more posts']);
    }

    wp_reset_postdata();
    wp_die();
}

// Doctor tabs
add_action('wp_ajax_load_doctor_tab', 'load_doctor_tab_ajax');
add_action('wp_ajax_nopriv_load_doctor_tab', 'load_doctor_tab_ajax');

function load_doctor_tab_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $index = isset($_POST['index']) ? intval($_POST['index']) : 0;

    if (!$post_id) {
        wp_send_json_error(['message' => 'Invalid Post ID']);
    }

    $tabs = get_field('doctor_tabs', $post_id);

    if ($tabs && isset($tabs[$index])) {
        $content_text = wp_kses_post($tabs[$index]['tab_content'] ?? '');

        ob_start();
        ?>
        <div class="doctor-tabs__content">
            <div class="doctor-tabs__content-text">
                <?php echo $content_text; ?>
            </div>
        </div>
        <?php
        $html = ob_get_clean();

        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_error(['message' => 'Tab content not found']);
    }

    wp_die();
}

// Privacy policy
add_action('wp_ajax_load_privacy_policy', 'load_privacy_policy_ajax');
add_action('wp_ajax_nopriv_load_privacy_policy', 'load_privacy_policy_ajax');

function load_privacy_policy_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    if (!$post_id) {
        wp_send_json_error(['message' => 'Invalid Post ID']);
    }

    $post = get_post($post_id);

    if ($post) {
        $content = apply_filters('the_content', $post->post_content);
        wp_send_json_success(['html' => $content]);
    } else {
        wp_send_json_error(['message' => 'Post not found']);
    }

    wp_die();
}
