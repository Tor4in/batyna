<?php
/**
 * Template Name: Single Service
 * Post Type: service
 */

get_header();
?>

<main id="single-service">
    <?php
    get_template_part('sections/service/hero');
    get_template_part('sections/service/info');
    get_template_part('templates/faq'); 
    get_template_part('templates/contacts'); 
    ?>
</main>

<?php get_footer(); ?>