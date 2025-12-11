<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<main id="home">
    <?php get_template_part('sections/home/hero'); ?>
    <?php get_template_part('sections/home/about-doctor'); ?>
    <?php get_template_part('sections/home/advantages'); ?>
    <?php get_template_part('sections/home/consultation-process'); ?>
    <?php get_template_part('sections/home/services'); ?>
    <?php get_template_part('sections/home/doctors'); ?>
    <?php get_template_part('templates/faq'); ?>

</main>

<?php get_footer(); ?>