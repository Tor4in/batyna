<footer class="footer">
    <div class="container">
        <div class="footer__inner">

            <?php
            $privacy_page_id = get_field('privacy_policy_page', 'option');
            $dev_credit = get_field('developer_credit', 'option');

            $socials = [
                'facebook' => get_field('social_facebook', 'option'),
                'instagram' => get_field('social_instagram', 'option'),
                'tiktok' => get_field('social_tiktok', 'option'),
                'telegram' => get_field('social_telegram', 'option'),
                'youtube' => get_field('social_youtube', 'option'),
            ];
            ?>

            <div class="footer__top">

                <div class="footer__nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-footer',
                        'container' => false,
                        'menu_class' => 'footer-menu',
                        'fallback_cb' => '__return_false',
                        'depth' => 1,
                    ));
                    ?>
                </div>

                <div class="footer__vertical-separator"></div>

                <div class="footer__socials">
                    <?php foreach ($socials as $network => $link): ?>
                        <?php if ($link): ?>
                            <?php
                            get_template_part('templates/button', null, [
                                'type' => 'social',
                                'text' => ucfirst($network),
                                'link' => $link,
                                'target' => '_blank',
                                'class' => 'btn-social--dark is-' . $network
                            ]);
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="footer__horizontal-separator"></div>

            </div>

            <div class="footer__logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                }
                ?>
            </div>

            <div class="footer__bottom">
                <?php if ($privacy_page_id): ?>
                    <a href="<?php echo esc_url(get_permalink($privacy_page_id)); ?>" class="footer__link">
                        <?php echo esc_html(get_the_title($privacy_page_id)); ?>
                    </a>
                <?php endif; ?>

                <?php if ($dev_credit && isset($dev_credit['text'], $dev_credit['link'])): ?>
                    <a href="<?php echo esc_url($dev_credit['link']); ?>" target="_blank" class="footer__link">
                        <?php echo esc_html($dev_credit['text']); ?>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</footer>

<button class="btn-scroll-top" aria-label="Scroll to top">
    <span class="btn-scroll-top__icon"></span>
</button>

<?php wp_footer(); ?>
</body>

</html>