<?php
/**
 * Section: Doctor Hero
 */

$lastname     = get_field('doctor_lastname');
$firstname    = get_field('doctor_firstname');
$degree       = get_field('doctor_degree');
$description  = get_field('doctor_hero_desc');
$booking_link = get_field('doctor_booking_link') ?: '#contact';
$stats        = get_field('doctor_stats');

// Image: use post thumbnail
$thumbnail_id = get_post_thumbnail_id();
$image_alt    = $lastname . ' ' . $firstname;

// Socials
$socials = [
    'facebook'  => get_field('social_facebook', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'tiktok'    => get_field('social_tiktok', 'option'),
    'telegram'  => get_field('social_telegram', 'option'),
    'youtube'   => get_field('social_youtube', 'option'),
];
?>

<section class="doctor-hero">
    <div class="doctor-hero__bg">
        <?php echo get_picture('doctor-bg-wave.webp', 'presentation', 'Background Wave', true); ?>
    </div>

    <div class="container">
        <div class="doctor-hero__grid">
            
            <div class="doctor-hero__image-col">
                <div class="doctor-hero__photo">
                    <?php if ($thumbnail_id): ?>
                        <?php echo wp_get_attachment_image($thumbnail_id, 'full', false, ['alt' => $image_alt]); ?>
                    <?php endif; ?>

                    <?php if ($degree): ?>
                        <div class="doctor-hero__badge is-mobile">
                            <div class="doctor-hero__badge-icon">
                                <img class="object-contain" src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/icon-doctor-badge.svg" alt="Badge" loading="lazy">
                            </div>
                            <span class="doctor-hero__badge-text"><?php echo esc_html($degree); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="doctor-hero__content-col">
                
                <div class="doctor-hero__top">
                    <div class="doctor-hero__breadcrumbs">
                        <?php get_template_part('templates/breadcrumbs'); ?>
                    </div>

                    <?php if ($degree): ?>
                        <div class="doctor-hero__badge is-desktop">
                            <div class="doctor-hero__badge-icon">
                                <img class="object-contain" src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/icon-doctor-badge.svg" alt="Badge" loading="lazy">
                            </div>
                            <span class="doctor-hero__badge-text"><?php echo esc_html($degree); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="doctor-hero__info-group">
                        <h1 class="doctor-hero__name">
                            <span class="doctor-hero__lastname"><?php echo esc_html($lastname); ?></span>
                            <span class="doctor-hero__firstname"><?php echo esc_html($firstname); ?></span>
                        </h1>

                        <?php if ($description): ?>
                            <div class="doctor-hero__description">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                        <?php endif; ?>

                        <div class="doctor-hero__actions">
                            <?php 
                            get_template_part('templates/button', null, [
                                'text'  => "Зв'язатись з нами",
                                'link'  => $booking_link,
                                'type'  => 'tertiary',
                                'icon'  => true,
                            ]); 
                            ?>
                        </div>
                    </div>
                </div>

                <div class="doctor-hero__socials">
                    <?php foreach ($socials as $network => $link): ?>
                        <?php if ($link): ?>
                            <?php 
                            get_template_part('templates/button', null, [
                                'type'   => 'social',
                                'text'   => ucfirst($network),
                                'link'   => $link,
                                'target' => '_blank',
                                'class'  => 'btn-social--square is-' . $network
                            ]); 
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="doctor-hero__stats-col">
                <?php if ($stats): ?>
                    <?php foreach ($stats as $stat): ?>
                        <div class="doctor-stat-card">
                            <div class="doctor-stat-card__title">
                                <?php echo esc_html($stat['stat_title']); ?>
                            </div>
                            <div class="doctor-stat-card__subtitle">
                                <?php echo esc_html($stat['stat_subtitle']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
