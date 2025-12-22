<?php
/**
 * Doctor tabs section
 */

$post_id = get_the_ID();
$tabs = get_field('doctor_tabs');
$booking_link = get_field('doctor_booking_link') ?: '#contact';

if (!$tabs) {
    return;
}

// First tab content
$first_tab_content = isset($tabs[0]['tab_content']) ? $tabs[0]['tab_content'] : '';
?>

<section class="doctor-tabs">
    <div class="container">
        <div class="doctor-tabs__wrapper">

            <div class="doctor-tabs__header">
                <ul class="doctor-tabs__nav">
                    <?php foreach ($tabs as $index => $tab): ?>
                        <?php
                        $is_active = (0 === $index);
                        $title = $tab['tab_title'];
                        ?>
                        <li class="doctor-tabs__nav-item">
                            <button type="button"
                                class="doctor-tabs__trigger js-tab-trigger <?php echo $is_active ? 'is-active' : ''; ?>"
                                data-id="<?php echo esc_attr($post_id); ?>"
                                data-index="<?php echo esc_attr($index); ?>">
                                <span class="doctor-tabs__trigger-text">
                                    <?php echo esc_html($title); ?>
                                </span>

                                <svg class="icon-triangle" width="20" height="15" viewBox="0 0 20 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 15L0.473721 0.75L19.5263 0.75L10 15Z" fill="currentColor" />
                                </svg>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="doctor-tabs__action">
                    <?php
                    get_template_part(
                        'templates/button',
                        null,
                        [
                            'text' => 'Записатись на візит до лікаря',
                            'link' => $booking_link,
                            'type' => 'primary',
                            'icon' => false,
                            'class' => 'btn-shine',
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="doctor-tabs__body" id="doctor-tabs-content">
                <div class="doctor-tabs__content">
                    <div class="doctor-tabs__content-text">
                        <?php echo wp_kses_post($first_tab_content); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>