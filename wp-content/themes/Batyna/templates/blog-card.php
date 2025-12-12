<?php
/**
 * Template Part: Blog Card
 */

$post_id = get_the_ID();

// Image priority: ACF field, featured image, placeholder
$image_url = get_field('blog_card_image', $post_id);
if (!$image_url) {
    $image_url = get_the_post_thumbnail_url($post_id, 'medium_large');
}
if (!$image_url) {
    $image_url = get_template_directory_uri() . '/assets/images/placeholder.webp';
}

$title = get_the_title();
$excerpt = get_the_excerpt();
$date = get_the_date('F j, Y');
$permalink = get_permalink();
?>

<article class="blog-card">
    <a href="<?php echo esc_url($permalink); ?>" class="blog-card__image-link"
        aria-label="<?php echo esc_attr($title); ?>">
        <div class="blog-card__image-wrapper">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
        </div>
    </a>

    <div class="blog-card__content">
        <h3 class="blog-card__title">
            <a href="<?php echo esc_url($permalink); ?>">
                <?php echo esc_html($title); ?>
            </a>
        </h3>

        <div class="blog-card__excerpt">
            <?php echo wp_trim_words($excerpt, 15); ?>
        </div>

        <div class="blog-card__meta">
            <span class="blog-card__date"><?php echo esc_html($date); ?></span>
        </div>

        <div class="blog-card__action">
            <?php
            get_template_part(
                'templates/button',
                null,
                [
                    'type' => 'card-read',
                    'text' => 'Читати більше',
                    'link' => $permalink
                ]
            );
            ?>
        </div>
    </div>
</article>
