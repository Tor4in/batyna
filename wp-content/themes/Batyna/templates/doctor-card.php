<?php
/**
 * Template part: Doctor Card
 */

$post_item = $args['post'] ?? null;
if (!$post_item)
    return;
$id = $post_item->ID;

$lastname = get_field('doctor_lastname', $id);
$firstname = get_field('doctor_firstname', $id);
$specialization = get_field('doctor_specialization', $id);
$photo = get_field('doctor_card_image', $id);
$booking_link = get_field('doctor_booking_link', $id) ?: '#contact';
$card_desc = get_field('doctor_card_desc', $id);
$exp_years = get_field('doctor_exp', $id);

if (empty($card_desc)) {
    $card_desc = has_excerpt($id)
        ? get_the_excerpt($id)
        : wp_trim_words($post_item->post_content, 20);
}

$btn_book_text = $args['btn_book_text'] ?? 'Записатись';
$btn_more_text = $args['btn_more_text'] ?? 'Познайомитись ближче';
?>

<article class="doctor-card-wrapper">
    <div class="doctor-card-inner">

        <?php if ($exp_years): ?>
            <div class="doctor-card-badge">
                <span class="doctor-card-badge__number"><?php echo esc_html($exp_years); ?></span>
                <span class="doctor-card-badge__label">років досвіду</span>
            </div>
        <?php endif; ?>


        <div class="doctor-card-inner__grid">

            <div class="doctor-card-inner__image">
                <?php if ($photo): ?>
                    <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"
                        loading="lazy">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/doctor-placeholder.jpg" alt="Doctor"
                        loading="lazy">
                <?php endif; ?>
            </div>

            <div class="doctor-card-inner__content">

                <div class="doctor-card-inner__top">
                    <div class="doctor-card-inner__header">
                        <?php if ($lastname): ?>
                            <h3 class="doctor-card-inner__lastname">
                                <?php echo esc_html($lastname); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($firstname): ?>
                            <div class="doctor-card-inner__firstname">
                                <?php echo esc_html($firstname); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="doctor-card-inner__divider"></div>

                    <?php if ($specialization): ?>
                        <div class="doctor-card-inner__spec">
                            <div class="doctor-card-inner__spec-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/user-icon.svg"
                                    alt="Specialization icon" width="14" height="14" loading="lazy">
                            </div>
                            <span class="doctor-card-inner__spec-text">
                                <?php echo esc_html($specialization); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="doctor-card-inner__desc">
                    <?php echo wp_kses_post($card_desc); ?>
                </div>

                <div class="doctor-card-inner__actions">
                    <?php
                    // Button 1: Transparent
                    get_template_part('templates/button', null, [
                        'text' => $btn_book_text,
                        'link' => $booking_link,
                        'type' => 'transparent',
                        'icon' => false,
                        'class' => 'btn-doc-book',
                    ]);

                    // Button 2: Primary
                    get_template_part('templates/button', null, [
                        'text' => $btn_more_text,
                        'link' => get_permalink($id),
                        'type' => 'primary',
                        'icon' => false,
                        'class' => 'btn-doc-more',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>