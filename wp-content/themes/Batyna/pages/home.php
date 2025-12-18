<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<main id="home">
    <?php
    get_template_part('sections/home/hero');
    get_template_part('sections/home/about-doctor');
    get_template_part('sections/home/advantages');
    get_template_part('sections/home/consultation-process');
    get_template_part('sections/home/services');
    get_template_part('sections/home/doctors');
    get_template_part('templates/faq');
    get_template_part('templates/blog');
    get_template_part('templates/contacts');
    ?>
</main>

<?php get_footer(); ?>