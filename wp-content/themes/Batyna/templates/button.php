<?php
/**
 * Button component
 */

$text        = $args['text'] ?? '';
$href        = $args['link'] ?? ($args['href'] ?? '#');
$type        = $args['type'] ?? 'primary';
$class_extra = $args['class'] ?? '';
$icon        = $args['icon'] ?? true;
$target      = $args['target'] ?? '_self';
$custom_svg  = $args['svg'] ?? null;

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

// Base classes
$classes = 'btn btn-' . $type;

if (!$icon && $type !== 'social' && $type !== 'icon') {
    $classes .= ' btn--no-icon';
}

if (!empty($class_extra)) {
    $classes .= ' ' . $class_extra;
}

// Tag and attributes
$tag   = ($type === 'submit' || $type === 'button') ? 'button' : 'a';
$attrs = ($tag === 'button')
    ? 'type="' . esc_attr($type) . '"'
    : 'href="' . esc_url($href) . '" target="' . esc_attr($target) . '"';
?>

<<?php echo $tag; ?> class="<?php echo esc_attr($classes); ?>" <?php echo $attrs; ?>>
    <?php if ($text): ?>
        <span class="btn__text"><?php echo esc_html($text); ?></span>
    <?php endif; ?>

    <?php if ($icon): ?>
        <span class="btn__circle">
            <?php if ($custom_svg): ?>
                <?php echo $custom_svg; ?>
            <?php endif; ?>
        </span>
    <?php endif; ?>
</<?php echo $tag; ?>>
