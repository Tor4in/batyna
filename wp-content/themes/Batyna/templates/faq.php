<?php
/**
 * Section: FAQ
 */

// Section visibility toggle
if (!get_field('faq_enabled')) {
    return;
}

// Page fields
$title_desktop = get_field('faq_title');
$title_mobile = get_field('faq_title_mobile');
$bg_image = get_field('faq_bg_image');
$btn_data = get_field('faq_btn');

// Fallback: if mobile title is empty, use desktop title
if (empty($title_mobile)) {
    $title_mobile = $title_desktop;
}

// Global Options
$phone_1 = get_field('phone_1', 'option');
$phone_2 = get_field('phone_2', 'option');
$map_link_data = get_field('contact_map_link', 'option');
$faq_list = get_field('faq_global_list', 'option');

// Icons assets
$btn_icon_svg = file_get_contents(get_template_directory() . '/assets/images/svg/user-white.svg');
$icon_phone_url = get_template_directory_uri() . '/assets/images/svg/phone-white.svg';
$icon_map_url = get_template_directory_uri() . '/assets/images/svg/location-white.svg';

// Triangle Icon for FAQ
$icon_arrow_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 12L2 6H14L8 12Z" fill="currentColor"/></svg>';

// Fallback background
if (!$bg_image) {
    $bg_image = get_template_directory_uri() . '/assets/images/consultation-bg.webp';
}
?>

<section class="faq-section" id="faq-section">
    <div class="faq-section__bg">
        <img src="<?php echo esc_url($bg_image); ?>" alt="" loading="lazy">
    </div>

    <div class="container">
        <div class="faq-section__layout">

            <div class="faq-section__left-col">

                <div class="faq-section__header-group">
                    <?php if ($title_desktop): ?>
                        <h2 class="faq-section__title faq-section__title--desktop">
                            <?php echo wp_kses_post($title_desktop); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($title_mobile): ?>
                        <h2 class="faq-section__title faq-section__title--mobile">
                            <?php echo wp_kses_post($title_mobile); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($btn_data): ?>
                        <div class="faq-section__action">
                            <?php
                            get_template_part(
                                'templates/button',
                                null,
                                [
                                    'text' => $btn_data['text'] ?? 'Задати питання',
                                    'link' => $btn_data['link'] ?? '#contact',
                                    'type' => 'secondary-gradient',
                                    'icon' => true,
                                    'svg' => $btn_icon_svg,
                                ]
                            );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="faq-section__contacts">
                    <?php if ($phone_1 || $phone_2): ?>
                        <div class="faq-contact-row faq-contact-row--phones">
                            <div class="faq-contact-row__circle">
                                <img src="<?php echo esc_url($icon_phone_url); ?>" alt="Phone" loading="lazy">
                            </div>
                            <div class="faq-contact-row__text">
                                <?php if ($phone_1): ?>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_1)); ?>">
                                        <?php echo esc_html($phone_1); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($phone_2): ?>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_2)); ?>">
                                        <?php echo esc_html($phone_2); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($map_link_data && !empty($map_link_data['text'])): ?>
                        <div class="faq-contact-row faq-contact-row--map">
                            <div class="faq-contact-row__circle">
                                <img src="<?php echo esc_url($icon_map_url); ?>" alt="Location" loading="lazy">
                            </div>
                            <div class="faq-contact-row__text">
                                <a href="<?php echo esc_url($map_link_data['url'] ?? '#'); ?>" target="_blank"
                                    rel="noopener">
                                    <?php echo esc_html($map_link_data['text']); ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="faq-section__right-col">
                <?php if ($faq_list): ?>
                    <div class="faq-list">
                        <?php foreach ($faq_list as $index => $item): ?>
                            <?php if (!empty($item['question'])): ?>
                                <div class="faq-item js-faq-item">
                                    <div class="faq-item__header js-faq-trigger">
                                        <h4 class="faq-item__title">
                                            <?php echo esc_html($item['question']); ?>
                                        </h4>
                                        <div class="faq-item__icon">
                                            <?php echo $icon_arrow_svg; ?>
                                        </div>
                                    </div>
                                    <div class="accordeon">
                                        <div class="content">
                                            <div class="faq-item__body">
                                                <?php echo wp_kses_post($item['answer']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>