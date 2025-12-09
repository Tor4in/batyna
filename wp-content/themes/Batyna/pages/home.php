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


</main>

<?php get_footer(); ?>