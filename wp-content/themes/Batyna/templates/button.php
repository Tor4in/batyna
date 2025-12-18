<?php
/**
 * Button component
 */

$text = $args['text'] ?? '';
$text_collapse = $args['text_collapse'] ?? 'Згорнути';
$href = $args['link'] ?? ($args['href'] ?? '#');
$type = $args['type'] ?? 'primary';
$class_extra = $args['class'] ?? '';
$icon = isset($args['icon']) ? $args['icon'] : true;
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

// Read More (Toggle) variant - Keep for other uses
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
if (!$icon && !in_array($type, ['social', 'icon', 'play'])) {
    $classes .= ' btn--no-icon';
}
if (!empty($class_extra)) {
    $classes .= ' ' . $class_extra;
}

$tag = 'a';
$attrs_str = '';

if (in_array($type, ['submit', 'button', 'play', 'transparent-blog'])) {
    $tag = 'button';
    $attrs_str = 'type="button"';
} else {
    $attrs_str = 'href="' . esc_url($href) . '" target="' . esc_attr($target) . '"';
}

if (!empty($attr_raw)) {
    $attrs_str .= ' ' . $attr_raw;
}
?>

<<?php echo $tag; ?> class="<?php echo esc_attr($classes); ?>" <?php echo $attrs_str; ?> 
    data-text-load="<?php echo esc_attr($text); ?>" 
    data-text-collapse="<?php echo esc_attr($text_collapse); ?>">
    
    <span class="btn__text"><?php echo esc_html($text); ?></span>

    <?php if ($icon || $type === 'play'): ?>
        <span class="btn__circle">
            <?php if ($custom_svg): echo $custom_svg; endif; ?>
        </span>
    <?php endif; ?>
</<?php echo $tag; ?>>