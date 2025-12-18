<?php
/**
 * Blog Archive List Section
 */

$instagram_link = get_field('social_instagram', 'option');
$instagram_icon = file_get_contents(get_template_directory() . '/assets/images/svg/instagram.svg');

// Global query for pagination
global $wp_query;
$max_pages = $wp_query->max_num_pages;
?>

<section class="blog-section blog-section--archive">
    <div class="container">

        <div class="blog-section__header">
            <?php if ($instagram_link): ?>
                <a href="<?php echo esc_url($instagram_link); ?>" class="blog-section__social" target="_blank"
                    rel="noopener">
                    <span class="blog-section__social-icon">
                        <?php echo $instagram_icon; ?>
                    </span>
                    <span class="blog-section__social-text">Instagram</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="blog-section__desktop">
            <div class="blog-section__grid js-blog-grid">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        get_template_part('templates/blog-card');
                    endwhile;
                else:
                    echo '<p>No posts yet.</p>';
                endif;
                ?>
            </div>
        </div>

        <div class="blog-section__footer">
            <?php if ($max_pages > 1): ?>
                <?php
                $nonce = wp_create_nonce('blog_archive_nonce');

                get_template_part(
                    'templates/button',
                    null,
                    [
                        'type' => 'transparent-blog',
                        'text' => 'Читати більше',
                        'icon' => false,
                        'class' => 'js-load-more-blog',
                        'attr' => sprintf(
                            'data-paged="1" data-max="%d" data-nonce="%s"',
                            $max_pages,
                            $nonce
                        )
                    ]
                );
                ?>
            <?php endif; ?>
        </div>

    </div>
</section>
