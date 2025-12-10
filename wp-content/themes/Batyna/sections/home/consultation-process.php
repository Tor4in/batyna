<?php
/**
 * Section: Consultation Process
 */

// Section visibility toggle
if (!get_field('consultation_enabled')) {
    return;
}

// Main fields
$title = get_field('consultation_title');
$price_label = get_field('consultation_price_label');
$price_value = get_field('consultation_price_value');
$btn_data = get_field('consultation_btn');
$steps = get_field('consultation_steps');

// Media fields
$media_type = get_field('consultation_media_type') ?: 'video';
$static_image = get_field('consultation_image');
$video_poster = get_field('consultation_video_poster');
$video_file = get_field('consultation_video_file');

// Static assets
$bg_image_url = get_template_directory_uri() . '/assets/images/consultation-bg.webp';
$btn_icon_svg = file_get_contents(get_template_directory() . '/assets/images/svg/user-white.svg');
$play_icon_url = get_template_directory_uri() . '/assets/images/svg/play.svg';
$play_icon_html = '<img src="' . esc_url($play_icon_url) . '" alt="">';
?>

<section class="consultation-process" id="consultation-process">
    <div class="consultation-process__bg">
        <img src="<?php echo esc_url($bg_image_url); ?>" alt="" loading="lazy">
    </div>

    <div class="container">
        <div class="consultation-process__layout">

            <div class="consultation-process__left-col">
                <div class="consultation-process__info">
                    <?php if ($title): ?>
                        <h2 class="consultation-process__title">
                            <?php echo wp_kses_post($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($price_label || $price_value): ?>
                        <div class="consultation-process__price-box">
                            <?php if ($price_label): ?>
                                <span class="consultation-process__price-label">
                                    <?php echo esc_html($price_label); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ($price_value): ?>
                                <span class="consultation-process__price-value">
                                    <?php echo esc_html($price_value); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($btn_data): ?>
                    <div class="consultation-process__action desktop-only">
                        <?php
                        get_template_part(
                            'templates/button',
                            null,
                            [
                                'text' => $btn_data['text'] ?? 'Записатись на консультацію',
                                'link' => $btn_data['link'] ?? '#appointment',
                                'type' => 'secondary-gradient',
                                'icon' => true,
                                'svg' => $btn_icon_svg,
                            ]
                        );
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="consultation-process__right-col">

                <?php if ($steps): ?>
                    <div class="consultation-process__cards-list">
                        <?php foreach ($steps as $index => $step): ?>
                            <div class="consultation-card">
                                <?php if (!empty($step['icon'])): ?>
                                    <div class="consultation-card__icon-wrapper">
                                        <div class="consultation-card__icon-circle">
                                            <img src="<?php echo esc_url($step['icon']); ?>" alt="" loading="lazy">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($step['title'])): ?>
                                    <h4 class="consultation-card__title">
                                        <?php echo esc_html($step['title']); ?>
                                    </h4>
                                <?php endif; ?>

                                <div class="accordeon" id="consultation-step-<?php echo (int) $index; ?>">
                                    <div class="content">
                                        <div class="consultation-card__desc">
                                            <?php echo wp_kses_post($step['description']); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="consultation-card__footer mobile-only">
                                    <?php
                                    get_template_part(
                                        'templates/button',
                                        null,
                                        [
                                            'type' => 'read-more',
                                            'text' => 'Читати більше',
                                            'text_active' => 'Згорнути',
                                            'attr' => 'onclick="toggleConsultationCard(this)"'
                                        ]
                                    );
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="consultation-process__video-wrapper">
                    <div class="consultation-video js-video-wrapper">

                        <?php // Media: static image or video ?>

                        <?php if ($media_type === 'image' && $static_image): ?>

                            <img src="<?php echo esc_url($static_image); ?>"
                                alt="<?php echo esc_attr(strip_tags($title)); ?>" class="consultation-video__player"
                                loading="lazy">

                        <?php else: ?>

                            <?php if ($video_file): ?>
                                <div class="consultation-video__cover js-video-cover">
                                    <button type="button" class="consultation-video__btn js-video-play-btn"
                                        aria-label="Play video">
                                        <?php
                                        get_template_part(
                                            'templates/button',
                                            null,
                                            [
                                                'type' => 'play',
                                                'svg' => $play_icon_html,
                                            ]
                                        );
                                        ?>
                                    </button>

                                    <?php if ($video_poster): ?>
                                        <div class="consultation-video__poster">
                                            <img src="<?php echo esc_url($video_poster); ?>" alt="Consultation video preview"
                                                loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <video class="consultation-video__player js-video-element" playsinline preload="none">
                                    <source src="<?php echo esc_url($video_file); ?>" type="video/mp4">
                                </video>

                            <?php elseif ($video_poster): ?>
                                <img src="<?php echo esc_url($video_poster); ?>" alt="Video" class="consultation-video__player">
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    // Toggle accordion content on mobile
    function toggleConsultationCard(btn) {
        const card = btn.closest('.consultation-card');
        const content = card.querySelector('.accordeon');
        const textShow = btn.querySelector('.text-show');
        const textHide = btn.querySelector('.text-hide');

        if (content.hasAttribute('open')) {
            content.removeAttribute('open');
            if (textShow) textShow.style.display = 'inline';
            if (textHide) textHide.style.display = 'none';
        } else {
            content.setAttribute('open', '');
            if (textShow) textShow.style.display = 'none';
            if (textHide) textHide.style.display = 'inline';
        }
    }
</script>