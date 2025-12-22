<?php
/**
 * Template Name: Single Doctor
 * Post Type: doctors
 */

get_header('overlay');
?>

<main>
    <?php
    // Hero Section (Photo, Info, Stats)
    get_template_part('sections/doctor/hero');
    get_template_part('sections/doctor/info-tabs');
    get_template_part('templates/faq');
    get_template_part('templates/contacts');
    ?>
</main>

<?php
get_footer();