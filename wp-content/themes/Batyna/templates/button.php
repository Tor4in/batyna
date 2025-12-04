<?php
/**
 * Button Template Component
 */

$text = $args['text'] ?? 'Button';
$href = $args['link'] ?? ($args['href'] ?? '#');
$type = $args['type'] ?? 'primary';
$class_extra = $args['class'] ?? '';
$icon = $args['icon'] ?? true;
$target = $args['target'] ?? '_self';

$classes = 'btn btn-' . $type;

// Add 'btn--no-icon' if icon is disabled (used for Secondary btn padding)
if (!$icon) {
    $classes .= ' btn--no-icon';
}

if (!empty($class_extra)) {
    $classes .= ' ' . $class_extra;
}

$tag = ($type === 'submit' || $type === 'button') ? 'button' : 'a';
$attrs = ($tag === 'button') ? 'type="' . esc_attr($type) . '"' : 'href="' . esc_url($href) . '" target="' . esc_attr($target) . '"';
?>

<<?php echo $tag; ?> class="<?php echo esc_attr($classes); ?>" <?php echo $attrs; ?>>
    <span class="btn__text"><?php echo esc_html($text); ?></span>

    <?php if ($icon): ?>
        <span class="btn__circle"></span>
    <?php endif; ?>
</<?php echo $tag; ?>>