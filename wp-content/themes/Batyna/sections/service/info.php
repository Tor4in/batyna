<?php
/**
 * Service info section
 * Location: sections/service/info.php
 */

// Info Fields
$title = get_field('service_info_title');
$desc_1 = get_field('service_info_desc_1');
$desc_2 = get_field('service_info_desc_2');
$list_title = get_field('service_info_list_title');
$list_items = get_field('service_info_list');
$bottom_text = get_field('service_info_bottom_text');

// Navigation Fields
$btn_link = get_field('service_nav_btn_link') ?: '#contact';
$btn_text = get_field('service_nav_btn_text') ?: 'Зв’язатись з нами';

// Indications Fields
$ind_title = get_field('service_indications_title');
$ind_subtitle = get_field('service_indications_subtitle');
$ind_text_1 = get_field('service_indications_text_1');
$ind_text_2 = get_field('service_indications_text_2');
$ind_gallery = get_field('service_indications_gallery');
$ind_has_slider = $ind_gallery && count($ind_gallery) > 1;

// Advantages Fields
$adv_title = get_field('service_advantages_title');
$adv_list = get_field('service_advantages_list');

// Conditions Fields (New)
$cond_title = get_field('service_conditions_title');
$cond_gallery = get_field('service_conditions_gallery');

// Icons
$play_icon_url = get_template_directory_uri() . '/assets/images/svg/play.svg';
$play_icon_html = '<img src="' . esc_url($play_icon_url) . '" alt="">';

$menu_items = [
    [
        'id' => 'service-info',
        'label' => 'Інформація про послугу',
    ],
    [
        'id' => 'indications',
        'label' => 'Показання',
    ],
    [
        'id' => 'advantages',
        'label' => 'Переваги',
    ],
];
?>

<section class="service-info">
    <div class="container">
        <div class="service-info__grid">

            <aside class="service-info__sidebar">
                <div class="service-nav js-service-nav">
                    <div class="service-nav__wrapper">
                        <ul class="service-nav__list">
                            <div class="service-nav__indicator"></div>

                            <?php foreach ($menu_items as $index => $item): ?>
                                <li class="service-nav__item">
                                    <a href="#<?php echo esc_attr($item['id']); ?>"
                                        class="service-nav__link js-scroll-link <?php echo 0 === $index ? 'is-active' : ''; ?>">
                                        <span class="service-nav__text" title="<?php echo esc_attr($item['label']); ?>">
                                            <?php echo esc_html($item['label']); ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="service-nav__action">
                        <?php
                        get_template_part(
                            'templates/button',
                            null,
                            [
                                'text' => $btn_text,
                                'link' => $btn_link,
                                'type' => 'secondary-gradient',
                                'icon' => true,
                                'class' => 'service-nav__btn',
                            ]
                        );
                        ?>
                    </div>
                </div>
            </aside>

            <div class="service-info__content">

                <div id="service-info" class="service-info__block js-scroll-section">
                    <div class="service-info__header">
                        <h2 class="service-info__title"><?php echo esc_html($title); ?></h2>
                    </div>

                    <?php if ($desc_1): ?>
                        <div class="service-info__text service-info__text--mb30">
                            <?php echo $desc_1; ?>
                        </div>
                    <?php endif; ?>

                    <div class="service-info__divider"></div>

                    <?php if ($desc_2): ?>
                        <div class="service-info__text service-info__text--mt20">
                            <?php echo $desc_2; ?>
                        </div>
                    <?php endif; ?>

                    <div class="service-info__divider service-info__divider--mt20"></div>

                    <div class="service-list">
                        <?php if ($list_title): ?>
                            <h3 class="service-list__title"><?php echo esc_html($list_title); ?></h3>
                        <?php endif; ?>

                        <?php if ($list_items): ?>
                            <div class="service-list__grid">
                                <?php foreach ($list_items as $item): ?>
                                    <div class="service-list__item">
                                        <div class="service-list__counter"></div>
                                        <div class="service-list__desc">
                                            <?php echo $item['text']; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($bottom_text): ?>
                        <div class="service-info__bottom-box">
                            <?php echo $bottom_text; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div id="indications" class="service-indications js-scroll-section">

                    <?php if ($ind_title): ?>
                        <div class="service-info__header">
                            <h2 class="service-info__title"><?php echo esc_html($ind_title); ?></h2>
                        </div>
                    <?php endif; ?>

                    <div class="service-indications__card">

                        <div class="service-indications__block-top">
                            <?php if ($ind_subtitle): ?>
                                <h4 class="service-indications__subtitle">
                                    <?php echo esc_html($ind_subtitle); ?>
                                </h4>
                            <?php endif; ?>

                            <?php if ($ind_text_1): ?>
                                <div class="service-indications__text">
                                    <?php echo $ind_text_1; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="service-indications__mobile-divider"></div>

                        <div class="service-indications__block-bottom">
                            <?php if ($ind_text_2): ?>
                                <div class="service-indications__text">
                                    <?php echo $ind_text_2; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="service-indications__media">
                            <?php if ($ind_gallery): ?>
                                <div class="service-indications__slider-wrapper">
                                    <div
                                        class="swiper indications-swiper <?php echo !$ind_has_slider ? 'swiper-no-swiping' : ''; ?>">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($ind_gallery as $slide): ?>
                                                <div class="swiper-slide">
                                                    <div class="consultation-video js-video-wrapper swiper-no-swiping">

                                                        <?php if ('image' === $slide['type'] && $slide['image']): ?>
                                                            <img src="<?php echo esc_url($slide['image']); ?>" alt=""
                                                                class="consultation-video__player" loading="lazy">

                                                        <?php elseif ('video' === $slide['type'] && $slide['video_file']): ?>
                                                            <div class="consultation-video__cover js-video-cover">
                                                                <button type="button"
                                                                    class="consultation-video__btn js-video-play-btn"
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

                                                                <?php if ($slide['video_poster']): ?>
                                                                    <div class="consultation-video__poster">
                                                                        <img src="<?php echo esc_url($slide['video_poster']); ?>"
                                                                            alt="Video Preview" loading="lazy">
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>

                                                            <video class="consultation-video__player js-video-element" playsinline
                                                                preload="none">
                                                                <source src="<?php echo esc_url($slide['video_file']); ?>"
                                                                    type="video/mp4">
                                                            </video>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <?php if ($ind_has_slider): ?>
                                        <div class="indications-nav-wrapper">
                                            <?php
                                            get_template_part(
                                                'templates/button',
                                                null,
                                                [
                                                    'type' => 'slider-nav',
                                                    'class' => 'indications-nav-btns',
                                                ]
                                            );
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <div id="advantages" class="service-advantages js-scroll-section">
                    <?php if ($adv_title): ?>
                        <div class="service-advantages__header">
                            <h2 class="service-advantages__title"><?php echo esc_html($adv_title); ?></h2>
                        </div>
                    <?php endif; ?>

                    <?php if ($adv_list): ?>
                        <div class="service-advantages__grid">
                            <?php foreach ($adv_list as $item): ?>
                                <div class="service-advantages__item">
                                    <?php echo $item['text']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($cond_gallery): ?>
                    <div class="service-conditions">
                        <div class="service-conditions__header">
                            <h2 class="service-info__title">
                                <?php echo esc_html($cond_title ?: 'Умови перебування'); ?>
                            </h2>

                            <div class="conditions-nav-wrapper">
                                <?php
                                get_template_part(
                                    'templates/button',
                                    null,
                                    [
                                        'type' => 'slider-nav',
                                        'class' => 'conditions-nav-btns',
                                    ]
                                );
                                ?>
                            </div>
                        </div>

                        <div class="service-conditions__slider">
                            <div class="swiper conditions-swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($cond_gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <div class="service-conditions__image-wrapper">
                                                <img src="<?php echo esc_url($image['url']); ?>"
                                                    alt="<?php echo esc_attr($image['alt']); ?>"
                                                    width="<?php echo esc_attr($image['width']); ?>"
                                                    height="<?php echo esc_attr($image['height']); ?>"
                                                    class="service-conditions__image" loading="lazy">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>