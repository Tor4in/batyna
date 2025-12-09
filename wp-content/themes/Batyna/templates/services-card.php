<?php
/**
 * Template part for displaying service card
 */

$title = get_the_title();
$link = get_permalink();
$bg_image = get_template_directory_uri() . '/assets/images/service-bg-wave.webp';
?>

<div class="services-card">

    <img src="<?php echo esc_url($bg_image); ?>" alt="" class="services-card__bg" loading="lazy" width="274"
        height="242">

    <div class="services-card__overlay"></div>

    <div class="services-card__content">

        <div class="services-card__info">
            <div class="services-card__number"></div>

            <h3 class="services-card__title">
                <?php echo esc_html($title); ?>
            </h3>
        </div>

        <a href="<?php echo esc_url($link); ?>" class="services-card__link">
            <?php _e('Дізнатись більше', 'maxi-dent'); ?>
        </a>
    </div>

</div>