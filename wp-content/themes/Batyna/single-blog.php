<?php
/**
 * Template Name: Single Blog Post
 * Post Type: blog
 */

get_header();
?>

<main>
    <?php
    get_template_part('sections/blog/hero');
    get_template_part('sections/blog/content');
    get_template_part('templates/faq');
    get_template_part('templates/contacts');
    ?>
</main>

<?php
get_footer();