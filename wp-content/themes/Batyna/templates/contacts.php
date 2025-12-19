<?php
/**
 * Section: Contacts
 */

// Global fields
$phone_1 = get_field('phone_1', 'option');
$phone_2 = get_field('phone_2', 'option');
$email = get_field('email_main', 'option');
$address = get_field('address_main', 'option');
$schedule = get_field('schedule_list', 'option');

// Section specific fields
$bg_image = get_field('contact_bg', 'option');
$left_title = get_field('contact_left_title', 'option');
$left_desc = get_field('contact_left_desc', 'option');

// Right block fields
$form_content = get_field('contact_form_content', 'option');
$form_success = get_field('contact_form_success', 'option');
$form_shortcode = get_field('contact_form_shortcode', 'option');

// Icons
$icon_phone_url = get_template_directory_uri() . '/assets/images/svg/phone-white.svg';
$icon_email_url = get_template_directory_uri() . '/assets/images/svg/email.svg';
$icon_loc_url = get_template_directory_uri() . '/assets/images/svg/location-white.svg';
$icon_clock_url = get_template_directory_uri() . '/assets/images/svg/clock.svg';
?>

<section class="contacts" id="contact">
    <div class="container">
        <div class="contacts__wrapper">

            <div class="contacts__layout">

                <div class="contacts__left">
                    <?php if ($bg_image): ?>
                        <div class="contacts__bg">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="Background" loading="lazy">
                        </div>
                    <?php endif; ?>

                    <div class="contacts__left-content">
                        <div class="contacts__header">
                            <?php if ($left_title): ?>
                                <h2 class="contacts__title"><?php echo esc_html($left_title); ?></h2>
                            <?php endif; ?>

                            <?php if ($left_desc): ?>
                                <p class="contacts__desc"><?php echo esc_html($left_desc); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="contacts__info-area">
                            <div class="contacts__list">
                                <?php if ($phone_1): ?>
                                    <div class="contacts__item">
                                        <div class="contacts__icon-circle">
                                            <div class="contacts__icon is-phone"
                                                style="--icon-url: url('<?php echo esc_url($icon_phone_url); ?>')"></div>
                                        </div>
                                        <div class="contacts__text-col">
                                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_1)); ?>"
                                                class="contacts__link is-centered">
                                                <?php echo esc_html($phone_1); ?>
                                            </a>
                                            <?php if ($phone_2): ?>
                                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_2)); ?>"
                                                    class="contacts__link contacts__link--second">
                                                    <?php echo esc_html($phone_2); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($email): ?>
                                    <div class="contacts__item">
                                        <div class="contacts__icon-circle">
                                            <div class="contacts__icon is-email"
                                                style="--icon-url: url('<?php echo esc_url($icon_email_url); ?>')"></div>
                                        </div>
                                        <div class="contacts__text-col">
                                            <a href="mailto:<?php echo esc_attr($email); ?>"
                                                class="contacts__link is-centered">
                                                <?php echo esc_html($email); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($address): ?>
                                    <div class="contacts__item">
                                        <div class="contacts__icon-circle">
                                            <div class="contacts__icon is-location"
                                                style="--icon-url: url('<?php echo esc_url($icon_loc_url); ?>')"></div>
                                        </div>
                                        <div class="contacts__text-col">
                                            <div class="contacts__link is-centered">
                                                <?php echo wp_kses_post($address); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($schedule): ?>
                                <div class="contacts__schedule">
                                    <div class="contacts__schedule-layout">
                                        <div class="contacts__icon-simple"
                                            style="--icon-url: url('<?php echo esc_url($icon_clock_url); ?>')"></div>
                                        <ul class="contacts__schedule-list">
                                            <?php foreach ($schedule as $row):
                                                $full_text = $row['text'];
                                                $parts = explode(' - ', $full_text, 2);
                                                $day = $parts[0] ?? $full_text;
                                                $time = isset($parts[1]) ? ' - ' . $parts[1] : '';
                                                ?>
                                                <li class="contacts__schedule-item">
                                                    <span class="contacts__schedule-day"><?php echo esc_html($day); ?></span>
                                                    <span class="contacts__schedule-time"><?php echo esc_html($time); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="contacts__right" id="contacts-right-block">

                    <div class="contacts__form-view js-form-view">
                        <?php if ($form_content): ?>
                            <div class="contacts__form-header-content">
                                <?php echo wp_kses_post($form_content); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($form_shortcode): ?>
                            <div class="contacts__form-shortcode-wrapper">
                                <?php echo do_shortcode($form_shortcode); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="contacts__success-view js-success-view" style="display: none;">
                        <?php if ($form_success): ?>
                            <div class="contacts__success-content">
                                <?php echo wp_kses_post($form_success); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>