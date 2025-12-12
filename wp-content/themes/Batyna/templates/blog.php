<?php
/**
 * Section: Blog
 */

if (!get_field('blog_enabled')) {
    return;
}

$title = get_field('blog_title') ?: 'Блог';
$instagram_link = get_field('social_instagram', 'option');
$instagram_icon = file_get_contents(get_template_directory() . '/assets/images/svg/instagram.svg');

$args = [
    'post_type'      => 'blog',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
];
$blog_query = new WP_Query($args);
?>

<section class="blog-section" id="blog">
    <div class="container">
       
        <div class="blog-section__header">
            <h2 class="blog-section__title">
                <?php echo esc_html($title); ?>
            </h2>

            <?php if ($instagram_link): ?>
                <a href="<?php echo esc_url($instagram_link); ?>" class="blog-section__social" target="_blank" rel="noopener">
                    <span class="blog-section__social-icon">
                        <?php echo $instagram_icon; ?>
                    </span>
                    <span class="blog-section__social-text">Instagram</span>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($blog_query->have_posts()): ?>
           
            <!-- Desktop grid -->
            <div class="blog-section__desktop">
                <div class="blog-section__grid">
                    <?php
                    while ($blog_query->have_posts()) {
                        $blog_query->the_post();
                        get_template_part('templates/blog-card');
                    }
                    ?>
                </div>
            </div>

            <!-- Mobile swiper -->
            <div class="blog-section__mobile">
                <div class="blog-section__swiper swiper">
                    <div class="swiper-wrapper">
                        <?php
                        $blog_query->rewind_posts();
                       
                        while ($blog_query->have_posts()) {
                            $blog_query->the_post();
                            echo '<div class="swiper-slide">';
                            get_template_part('templates/blog-card');
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

        <div class="blog-section__footer">
            <?php
            $blog_archive_link = get_post_type_archive_link('blog');
           
            get_template_part(
                'templates/button',
                null,
                [
                    'type' => 'transparent-blog',
                    'text' => 'Читати більше',
                    'link' => $blog_archive_link ?: '#',
                    'icon' => false
                ]
            );
            ?>
        </div>

    </div>
</section>
