<?php
/**
 * The template for displaying 404 pages (not found)
 */

$bg_image = get_field('404_bg', 'option');
$content  = get_field('404_content', 'option');
$btn_text = get_field('404_btn_text', 'option');

if ( empty($content) ) {
    $content = '<h1>404</h1><p>' . esc_html__('Сторінку не знайдено', 'batyna') . '</p>';
}
if ( empty($btn_text) ) {
    $btn_text = esc_html__('Повернутись на головну', 'batyna');
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>404 - <?php esc_html_e('Сторінку не знайдено', 'batyna'); ?></title>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <main class="error-404-page">
        <?php if ( !empty($bg_image) ): ?>
            <div class="error-404-page__bg">
                <img src="<?php echo esc_url($bg_image); ?>" alt="404 Background" loading="lazy">
            </div>
        <?php endif; ?>

        <div class="container">
            <div class="error-404-page__content">
                
                <div class="error-404-page__text-wrapper">
                    <?php echo wp_kses_post($content); ?>
                </div>

                <div class="error-404-page__action">
                    <?php 
                    // Button Include
                    get_template_part('templates/button', null, [
                        'type'   => 'secondary',
                        'text'   => esc_html($btn_text),
                        'link'   => home_url('/'),
                        'class'  => 'btn-404', 
                        'icon'   => false, 
                        'target' => '_self'
                    ]); 
                    ?>
                </div>

            </div>
        </div>
    </main>

    <?php wp_footer(); ?>
</body>
</html>