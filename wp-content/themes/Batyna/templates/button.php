<?php
/**
 * Button component
 */

$text = $args['text'] ?? '';
$href = $args['link'] ?? ($args['href'] ?? '#');
$type = $args['type'] ?? 'primary';
$class_extra = $args['class'] ?? '';
$icon = $args['icon'] ?? true;
$target = $args['target'] ?? '_self';
$custom_svg = $args['svg'] ?? null;
$attr_raw = $args['attr'] ?? '';

// Slider nav variant
if ($type === 'slider-nav') {
    ?>
    <div class="slider-nav <?php echo esc_attr($class_extra); ?>">
        <div class="slider-nav__prev">
            <span class="slider-nav__icon slider-nav__icon--prev"></span>
        </div>

        <div class="slider-nav__next">
            <span class="slider-nav__icon slider-nav__icon--next"></span>
        </div>
    </div>
    <?php
    return;
}

// Read More (Toggle) variant
if ($type === 'read-more') {
    $text_active = $args['text_active'] ?? 'Згорнути';
    ?>
    <button type="button" class="btn btn-read-more <?php echo esc_attr($class_extra); ?>" <?php echo $attr_raw; ?>>
        <span class="text-show"><?php echo esc_html($text); ?></span>
        <span class="text-hide" style="display: none;"><?php echo esc_html($text_active); ?></span>
    </button>
    <?php
    return;
}

// Base classes
$classes = 'btn btn-' . $type;

if (!$icon && $type !== 'social' && $type !== 'icon' && $type !== 'play') {
    $classes .= ' btn--no-icon';
}

if (!empty($class_extra)) {
    $classes .= ' ' . $class_extra;
}

// Determine tag and main attributes
$tag = 'a';
$attrs_str = '';

if ($type === 'submit' || $type === 'button' || $type === 'play') {
    $tag = 'button';
    $attrs_str = 'type="button"';
    if ($type === 'submit') {
        $attrs_str = 'type="submit"';
    }
} else {
    $attrs_str = 'href="' . esc_url($href) . '" target="' . esc_attr($target) . '"';
}

// Append custom attributes if any
if (!empty($attr_raw)) {
    $attrs_str .= ' ' . $attr_raw;
}
?>

<<?php echo $tag; ?> class="<?php echo esc_attr($classes); ?>" <?php echo $attrs_str; ?>>
    <?php if ($text): ?>
        <span class="btn__text"><?php echo esc_html($text); ?></span>
    <?php endif; ?>

    <?php if ($icon || $type === 'play'): ?>
        <span class="btn__circle">
            <?php if ($custom_svg): ?>
                <?php echo $custom_svg; ?>
            <?php endif; ?>
        </span>
    <?php endif; ?>
</<?php echo $tag; ?>>