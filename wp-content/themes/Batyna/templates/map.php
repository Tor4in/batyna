<?php
/**
 * Template Part: Google Map Section
 */

$map_group = get_field('contact_map_link', 'option');
$map_url   = $map_group['url'] ?? '';

if ( ! $map_url ) {
    return;
}
?>

<section class="map-section">
    <div class="container">
        <div class="map-section__wrapper">
            <iframe 
                src="<?php echo esc_url($map_url); ?>" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="map-section__iframe">
            </iframe>
        </div>
    </div>
</section>