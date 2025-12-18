<?php
/**
 * Blog Archive Template
 */

get_header();
?>

<main>
    <?php
    get_template_part('sections/blog-archive/hero');
    get_template_part('sections/blog-archive/list');
    get_template_part('templates/faq');
    get_template_part('templates/contacts');
    ?>
</main>

<?php
get_footer();