<?php
/**
 * Section: Home - Advantages
 */

if (!get_field('advantages_enabled')) {
    return;
}

$title = get_field('advantages_title');
$advantages_list = get_field('advantages_list');

if ($advantages_list): ?>

    <section class="advantages">
        <div class="container">
            <?php if ($title): ?>
                <h2 class="advantages__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <div class="advantages__grid">
                <?php foreach ($advantages_list as $item):
                    $icon_url = $item['icon'];
                    $card_title = $item['title'];
                    $card_desc = $item['description'];
                    ?>
                    <div class="advantages__card">
                        <div class="advantages__icon-wrapper">
                            <?php if ($icon_url): ?>
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($card_title); ?>"
                                    class="advantages__icon" loading="lazy">
                            <?php endif; ?>
                        </div>

                        <div class="advantages__content">
                            <?php if ($card_title): ?>
                                <h4 class="advantages__card-title"><?php echo esc_html($card_title); ?></h4>
                            <?php endif; ?>

                            <?php if ($card_desc): ?>
                                <div class="advantages__card-desc">
                                    <?php echo wp_kses_post($card_desc); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="advantages__slider-wrapper">
                <div class="swiper advantages-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($advantages_list as $item):
                            $icon_url = $item['icon'];
                            $card_title = $item['title'];
                            $card_desc = $item['description'];
                            ?>
                            <div class="swiper-slide advantages__slide">
                                <div class="advantages__card">
                                    <div class="advantages__icon-wrapper">
                                        <?php if ($icon_url): ?>
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($card_title); ?>"
                                                class="advantages__icon" loading="lazy">
                                        <?php endif; ?>
                                    </div>

                                    <div class="advantages__content">
                                        <?php if ($card_title): ?>
                                            <h4 class="advantages__card-title"><?php echo esc_html($card_title); ?></h4>
                                        <?php endif; ?>

                                        <?php if ($card_desc): ?>
                                            <div class="advantages__card-desc">
                                                <?php echo wp_kses_post($card_desc); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="advantages__nav">
                    <?php get_template_part('templates/button', null, [
                        'type' => 'slider-nav'
                    ]); ?>
                </div>
            </div>

        </div>
    </section>

<?php endif; ?>