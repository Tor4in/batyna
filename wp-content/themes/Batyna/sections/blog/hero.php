<?php
/**
 * Section: Blog Single Hero
 */

$post_id = get_the_ID();
$title = get_the_title();
$date = get_the_date('d M Y');

// Reading time logic
$content = get_post_field('post_content', $post_id);
$word_count = str_word_count(strip_tags($content));
$reading_time = ceil($word_count / 120);
if ($reading_time < 1) $reading_time = 1;

$bg_image_id = get_post_thumbnail_id($post_id);

// Socials Data
$socials = [
    'facebook'  => get_field('social_facebook', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'tiktok'    => get_field('social_tiktok', 'option'),
    'telegram'  => get_field('social_telegram', 'option'),
    'youtube'   => get_field('social_youtube', 'option'),
];
?>

<section class="single-hero">
    
    <div class="single-hero__card">
        <div class="single-hero__bg">
            <?php 
            if ($bg_image_id) {
                echo wp_get_attachment_image($bg_image_id, 'full', false, ['class' => 'single-hero__img']);
            } else {
                echo '<div class="single-hero__fallback"></div>';
            }
            ?>
            <div class="single-hero__overlay"></div>
        </div>

        <div class="container">
            <div class="single-hero__content">
                
                <div class="single-hero__breadcrumbs">
                    <?php get_template_part('templates/breadcrumbs'); ?>
                </div>

                <div class="single-hero__inner">
                    <span class="single-hero__label">Блог</span>
                    
                    <h1 class="single-hero__title">
                        <?php echo esc_html($title); ?>
                    </h1>

                    <div class="single-hero__meta">
                        <span class="single-hero__date"><?php echo esc_html($date); ?></span>
                        <span class="single-hero__divider">•</span>
                        <span class="single-hero__read"><?php echo $reading_time; ?> хв читання</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="single-hero-mobile-socials">
        <div class="footer__socials">
            <?php foreach ($socials as $network => $link): ?>
                <?php if ($link): ?>
                    <?php 
                    get_template_part('templates/button', null, [
                        'type'   => 'social',
                        'text'   => ucfirst($network),
                        'link'   => $link,
                        'target' => '_blank',
                        'class'  => 'btn-social--dark is-' . $network
                    ]); 
                    ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

</section>