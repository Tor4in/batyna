<?php
/*
Template Name: Contacts Page
*/

get_header(); 
?>

<main class="page-contacts-layout">
    <?php 
    get_template_part('sections/contacts/breadcrumbs-contact');
    get_template_part('templates/contacts'); 
    get_template_part('templates/map'); 
    ?>
</main>

<?php get_footer(); ?>