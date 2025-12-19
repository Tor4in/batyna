<?php
/**
 * Section: Blog Single Content
 */

// Socials Data
$socials = [
    'facebook'  => get_field('social_facebook', 'option'),
    'instagram' => get_field('social_instagram', 'option'),
    'tiktok'    => get_field('social_tiktok', 'option'),
    'telegram'  => get_field('social_telegram', 'option'),
    'youtube'   => get_field('social_youtube', 'option'),
];
?>

<section class="blog-content">
    <div class="container">
        
        <div class="blog-content__top">
            <div class="blog-content__breadcrumbs">
                <?php get_template_part('templates/breadcrumbs'); ?>
            </div>

            <div class="blog-content__share">
                <div class="footer__socials"> <?php foreach ($socials as $network => $link): ?>
                        <?php if ($link): ?>
                            <?php 
                            get_template_part('templates/button', null, [
                                'type'   => 'social',
                                'text'   => ucfirst($network),
                                'link'   => $link,
                                'target' => '_blank',
                                'class'  => 'btn-social--dark is-' . $network
                            ]); 
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="blog-content__wrapper">
            <article class="blog-content__text">
                <?php the_content(); ?>
            </article>
        </div>

    </div>
</section>