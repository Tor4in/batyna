<?php
/**
 * Section: Doctors (Swiper/Grid)
 */

$is_enabled = get_field('home_doctors_enabled');
if (!$is_enabled)
    return;

$bg_image = get_field('home_doctors_bg');
$title = get_field('home_doctors_title') ?: 'Наші лікарі';
$doctors_list = get_field('home_doctors_list');
$btn_book_text = get_field('home_doctors_btn_booking') ?: 'Записатись';
$btn_more_text = get_field('home_doctors_btn_more') ?: 'Познайомитись ближче';

if (!$doctors_list)
    return;

$count = count($doctors_list);
$is_slider = $count > 2;
?>

<section class="doctors-section">
    <?php if ($bg_image): ?>
        <div class="doctors-section__bg">
            <img src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php echo esc_attr($bg_image['alt']); ?>"
                width="<?php echo esc_attr($bg_image['width']); ?>" height="<?php echo esc_attr($bg_image['height']); ?>"
                loading="lazy">
        </div>
    <?php endif; ?>

    <div class="container">

        <div class="doctors-section__header">
            <h2 class="doctors-section__title">
                <?php echo esc_html($title); ?>
            </h2>

            <?php if ($is_slider): ?>
                <?php
                get_template_part('templates/button', null, [
                    'type' => 'slider-nav',
                    'class' => 'doctors-slider-nav'
                ]);
                ?>
            <?php endif; ?>
        </div>

        <div class="doctors-section__wrapper">
            <?php if ($is_slider): ?>
                <div class="swiper doctors-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($doctors_list as $post_item): ?>
                            <div class="swiper-slide">
                                <?php
                                get_template_part('templates/doctor-card', null, [
                                    'post' => $post_item,
                                    'btn_book_text' => $btn_book_text,
                                    'btn_more_text' => $btn_more_text
                                ]);
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="doctors-grid">
                    <?php foreach ($doctors_list as $post_item): ?>
                        <?php
                        get_template_part('templates/doctor-card', null, [
                            'post' => $post_item,
                            'btn_book_text' => $btn_book_text,
                            'btn_more_text' => $btn_more_text
                        ]);
                        ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>