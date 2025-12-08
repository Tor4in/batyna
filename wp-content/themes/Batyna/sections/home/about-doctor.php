<?php
/**
 * Section: Home About-Doctor
 */

// Section fields
$title = get_field('about_doc_title');
$name = get_field('about_doc_name');
$intro = get_field('about_doc_intro');
$list = get_field('about_doc_list');
$photo = get_field('about_doc_photo');
$acf_link = get_field('about_doc_btn_link');
$btn_link = $acf_link ?: '#contact';

// Bottom block fields
$bottom_desc = get_field('about_doc_bottom_desc');
$stats = get_field('about_doc_stats');

// Social links
$socials = [
    'facebook' => get_field('social_facebook', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'tiktok' => get_field('social_tiktok', 'option'),
    'telegram' => get_field('social_telegram', 'option'),
    'youtube' => get_field('social_youtube', 'option'),
];

// Defaults
if (!$title) {
    $title = 'Про лікаря';
}
?>

<section class="about-doctor">
    <div class="container">
        <div class="doctor-card">
            <div class="doctor-card__content">
                <?php if ($title): ?>
                    <h2 class="doctor-card__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($name): ?>
                    <h3 class="doctor-card__name"><?php echo esc_html($name); ?></h3>
                <?php endif; ?>

                <?php if ($intro): ?>
                    <div class="doctor-card__intro">
                        <?php echo wp_kses_post($intro); ?>
                    </div>
                <?php endif; ?>

                <?php if ($list): ?>
                    <ul class="doctor-card__list">
                        <?php foreach ($list as $item): ?>
                            <li><?php echo esc_html($item['item_text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="doctor-card__action">
                    <?php
                    get_template_part(
                        'templates/button',
                        null,
                        [
                            'text' => "Зв'язатись з нами",
                            'link' => $btn_link,
                            'type' => 'primary',
                            'icon' => true,
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="doctor-card__divider"></div>

            <div class="doctor-card__image-wrapper">
                <?php if ($photo): ?>
                    <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"
                        width="<?php echo esc_attr($photo['width']); ?>" height="<?php echo esc_attr($photo['height']); ?>">
                <?php else: ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/doctor-placeholder.jpg'); ?>"
                        alt="Doctor">
                <?php endif; ?>
            </div>
        </div>

        <div class="doctor-bottom">
            <div class="doctor-bottom__socials">
                <?php foreach ($socials as $network => $link): ?>
                    <?php if ($link): ?>
                        <?php
                        get_template_part(
                            'templates/button',
                            null,
                            [
                                'type' => 'social',
                                'link' => $link,
                                'target' => '_blank',
                                'class' => 'btn-social--dark is-' . $network,
                            ]
                        );
                        ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if ($bottom_desc): ?>
                <div class="doctor-bottom__desc">
                    <?php echo wp_kses_post($bottom_desc); ?>
                </div>
            <?php endif; ?>

            <?php if ($stats): ?>
                <div class="doctor-stats">
                    <?php foreach ($stats as $stat): ?>
                        <div class="stats-card">
                            <div class="stats-card__number">
                                <?php echo esc_html($stat['number']); ?>
                            </div>
                            <div class="stats-card__label">
                                <?php echo esc_html($stat['label']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>