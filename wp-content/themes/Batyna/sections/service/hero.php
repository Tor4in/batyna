<?php
/**
 * Service hero section
 * Location: sections/service/hero.php
 */

// ACF fields
$bg_image = get_field('service_hero_bg');
$btn_link = get_field('service_hero_link') ?: '#contact';

// Editor content
$content = apply_filters('the_content', get_the_content());
$content = str_replace(']]>', ']]&gt;', $content);
?>

<section class="service-hero">
    <div class="container">
        <div class="service-hero__card">

            <?php if ($bg_image): ?>
                <div class="service-hero__bg-wrapper">
                    <img src="<?php echo esc_url($bg_image); ?>" alt="<?php the_title(); ?>" loading="lazy">
                </div>
            <?php endif; ?>

            <div class="service-hero__glass">

                <div class="service-hero__breadcrumbs">
                    <?php get_template_part('templates/breadcrumbs'); ?>
                </div>

                <div class="service-hero__content">
                    <?php
                    // Render editor content (expects H1 + paragraph)
                    if ($content) {
                        echo $content;
                    } else {
                        // Fallback title
                        echo '<h1>' . get_the_title() . '</h1>';
                    }
                    ?>
                </div>

                <div class="service-hero__action">
                    <?php
                    get_template_part('templates/button', null, [
                        'text' => 'Зв’язатись з нами',
                        'link' => $btn_link,
                        'type' => 'primary',
                        'icon' => true,
                        'class' => 'service-hero__btn'
                    ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>