<?php
/**
 * Main Navigation Template Component
 * Outputs menu based on the provided location.
 */

// Set default location
$location = $args['location'] ?? 'menu-header';

$nav_args = array(
    'theme_location' => $location,
    'container' => false,
    'menu_class' => 'nav-list',
    'depth' => 1,
    'fallback_cb' => false,
);

// Check if menu exists before output
if (has_nav_menu($location)) {
    wp_nav_menu($nav_args);
}
?>