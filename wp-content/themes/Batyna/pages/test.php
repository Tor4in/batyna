<?php
/*
Template Name: Test
*/
?>

<?php get_header(); ?>

<main id="test-page">

    <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); min-height: 60vh;">

        <div
            style="background-color: var(--color-background); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 30px; padding: 40px;">
            <h3 style="margin-bottom: 20px;">Light Background</h3>

            <?php
            // 1. Primary (Blue + Shine)
            get_template_part('templates/button', null, [
                'text' => 'Зв’язатись з нами',
                'link' => '#contact',
                'type' => 'primary',
                'icon' => true
            ]);

            // 3. Tertiary (Black outline -> Blue Hover)
            get_template_part('templates/button', null, [
                'text' => 'Детальніше про нас',
                'link' => '#about',
                'type' => 'tertiary',
                'icon' => true
            ]);

            // 4. Quaternary (Header style)
            get_template_part('templates/button', null, [
                'text' => 'Зв’язатись з нами (header)',
                'link' => '#header-cta',
                'type' => 'quaternary',
                'icon' => false
            ]);
            ?>

            <div style="display: flex; flex-direction: column; align-items: center; gap: 15px; margin-top: 20px;">
                <h4 style="color: var(--color-primary); opacity: 0.8;">Social Buttons (Dark)</h4>
                <div style="display: flex; gap: 15px;">
                    <?php
                    // Facebook Dark
                    get_template_part('templates/button', null, [
                        'text' => 'Facebook',
                        'link' => '#',
                        'type' => 'social',
                        'class' => 'is-facebook btn-social--dark', // modifier class
                        'icon' => true
                    ]);

                    // Instagram Dark
                    get_template_part('templates/button', null, [
                        'text' => 'Instagram',
                        'link' => '#',
                        'type' => 'social',
                        'class' => 'is-instagram btn-social--dark', // modifier class
                        'icon' => true
                    ]);
                    ?>
                </div>
            </div>

        </div>

        <div
            style="background-color: var(--color-primary); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 30px; padding: 40px;">
            <h3 style="color: #fff; margin-bottom: 20px;">Dark Background</h3>

            <?php
            // 2. Secondary (White outline + Icon)
            get_template_part('templates/button', null, [
                'text' => 'Записатись на консультацію',
                'link' => '#appointment',
                'type' => 'secondary',
                'icon' => true
            ]);

            // 2.1 Secondary (White outline NO Icon - Wide)
            get_template_part('templates/button', null, [
                'text' => 'ЗВ’ЯЗАТИСЬ З НАМИ',
                'link' => '#contact-us',
                'type' => 'secondary',
                'icon' => false
            ]);
            ?>

            <div style="display: flex; flex-direction: column; align-items: center; gap: 15px; margin-top: 20px;">
                <h4 style="color: #fff; opacity: 0.8;">Social Buttons (Light)</h4>

                <div style="display: flex; gap: 15px;">
                    <?php
                    // Facebook
                    get_template_part('templates/button', null, [
                        'text' => 'Facebook',
                        'link' => '#',
                        'type' => 'social',
                        'class' => 'is-facebook',
                        'icon' => true
                    ]);

                    // Instagram
                    get_template_part('templates/button', null, [
                        'text' => 'Instagram',
                        'link' => '#',
                        'type' => 'social',
                        'class' => 'is-instagram',
                        'icon' => true
                    ]);
                    ?>
                </div>
            </div>

        </div>

    </section>

    <section style="padding: 100px 0; background-color: #fff;">
        <div class="container">
            <h2 style="margin-bottom: 60px; text-align: center; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                Typography System</h2>

            <div style="display: grid; gap: 60px;">

                <div style="display: grid; gap: 30px;">
                    <div
                        style="border-bottom: 1px solid #eee; padding-bottom: 10px; color: #999; font-size: 14px; font-weight: 700; letter-spacing: 1px;">
                        HEADINGS (Mulish)</div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">h1 / .h1 (52px /
                            32px)</span>
                        <h1>Заголовок H1: Лікування лазером</h1>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">h2 / .h2 (42px /
                            24px)</span>
                        <h2>Заголовок H2: Наші переваги</h2>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">h2.bold / .h2.bold</span>
                        <h2 class="bold">Заголовок H2 Bold: Акцентна увага</h2>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">h3 / .h3 (22px /
                            18px)</span>
                        <h3>Заголовок H3: Картка лікаря або послуги</h3>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">h4 / .h4 (18px Bold)</span>
                        <h4>Заголовок H4: Маленький заголовок</h4>
                    </div>
                </div>

                <div style="display: grid; gap: 30px;">
                    <div
                        style="border-bottom: 1px solid #eee; padding-bottom: 10px; color: #999; font-size: 14px; font-weight: 700; letter-spacing: 1px;">
                        BODY TEXT (Open Sans & Mulish)</div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-xl (20px SemiBold Open
                            Sans)</span>
                        <p class="text-xl">Це великий текст (p1 semi bold), який використовується для вступу або
                            важливих акцентів.</p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-lg (18px Regular Open
                            Sans)</span>
                        <p class="text-lg">Це збільшений основний текст. Він добре читається у великих блоках статті або
                            опису послуг.</p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-lg.semibold (18px
                            SemiBold Open Sans)</span>
                        <p class="text-lg semibold">Той самий розмір 18px, але жирніший (SemiBold). Для виділення суті.
                        </p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-md-accent (16px Medium
                            Mulish)</span>
                        <p class="text-md-accent">Це акцентний текст шрифтом Mulish (16px). Використовується в картках
                            або специфічних елементах UI.</p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">p / .text-md (15px Regular
                            Open Sans)</span>
                        <p>Це стандартний параграф (15px). Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-sm-accent (14px Medium
                            Mulish)</span>
                        <p class="text-sm-accent">Дрібний акцентний шрифт (14px Mulish). Використовується для дат, тегів
                            або мета-інформації.</p>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <span style="color: #ccc; font-size: 12px; font-family: monospace;">.text-xs (12px Regular Open
                            Sans)</span>
                        <p class="text-xs">Найменший текст (12px). Для підписів, копірайту або дисклеймерів.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>