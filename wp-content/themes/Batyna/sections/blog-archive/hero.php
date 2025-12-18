<?php
/**
 * Blog Archive Hero Section
 * Location: sections/blog-archive/hero.php
 */

// ACF Fields from Options Page
$bg_image = get_field('blog_archive_bg', 'option');
$content  = get_field('blog_archive_content', 'option');
$btn_link = get_field('blog_archive_link', 'option') ?: '#contact';

?>

<section class="blog-hero">
    <div class="container">
        <div class="blog-hero__card">

            <?php if ($bg_image): ?>
                <div class="blog-hero__bg-wrapper">
                    <img src="<?php echo esc_url($bg_image); ?>" alt="Blog Hero" loading="lazy">
                </div>
            <?php endif; ?>

            <div class="blog-hero__glass">

                <div class="blog-hero__breadcrumbs">
                    <?php get_template_part('templates/breadcrumbs'); ?>
                </div>

                <div class="blog-hero__content">
                    <?php
                    if ($content) {
                        echo $content;
                    } else {
                        echo '<h1>' . post_type_archive_title('', false) . '</h1>';
                    }
                    ?>
                </div>

                <div class="blog-hero__action">
                    <?php
                    get_template_part('templates/button', null, [
                        'text'  => 'Зв’язатись з нами',
                        'link'  => $btn_link,
                        'type'  => 'primary',
                        'icon'  => true,
                        'class' => 'blog-hero__btn'
                    ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>