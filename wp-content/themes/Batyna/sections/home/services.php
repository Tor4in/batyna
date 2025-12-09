<?php
/**
 * Section: Home Services
 */

// Header fields
$title = get_field('services_title');
$description = get_field('services_desc');
$header_btn = get_field('services_btn');
$header_btn_text = $header_btn['text'] ?? "Зв'язатись з нами";
$header_btn_link = $header_btn['url'] ?? '#';

// CTA card fields
$cta_text = get_field('services_cta_text');
$cta_btn = get_field('services_cta_btn');
$cta_btn_text = $cta_btn['text'] ?? "Зв'язатись з нами";
$cta_btn_link = $cta_btn['url'] ?? '#';
$cta_bg = get_template_directory_uri() . '/assets/images/service-cta-bg.webp';

// Services query
$services_query = new WP_Query([
    'post_type' => 'services',
    'posts_per_page' => 7,
    'orderby' => 'date',
    'order' => 'ASC',
]);
?>


<section class="services">
    <div class="container">

        <div class="services__header">
            <?php if ($title): ?>
                <h2 class="services__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <div class="services__header-row">
                <?php if ($description): ?>
                    <p class="services__desc"><?php echo nl2br(esc_html($description)); ?></p>
                <?php endif; ?>

                <div class="services__action">
                    <?php
                    get_template_part(
                        'templates/button',
                        null,
                        [
                            'text' => $header_btn_text,
                            'link' => $header_btn_link,
                            'type' => 'primary',
                            'icon' => true,
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>

        <div class="services__grid">
            <?php
            // Dynamic service cards
            if ($services_query->have_posts()):
                while ($services_query->have_posts()):
                    $services_query->the_post();
                    get_template_part('templates/services-card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

            <div class="services-card services-card--cta">
                <img src="<?php echo esc_url($cta_bg); ?>" alt="" class="services-card__bg" loading="lazy">

                <div class="services-card__content">
                    <?php if ($cta_text): ?>
                        <p class="services-card__cta-text">
                            <?php echo nl2br(esc_html($cta_text)); ?>
                        </p>
                    <?php endif; ?>

                    <div class="services-card__cta-btn">
                        <?php
                        get_template_part(
                            'templates/button',
                            null,
                            [
                                'text' => $cta_btn_text,
                                'link' => $cta_btn_link,
                                'type' => 'tertiary',
                                'icon' => true,
                                'class' => 'btn-in-card'
                            ]
                        );
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>