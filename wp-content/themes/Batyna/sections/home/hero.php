<?php
/**
 * Section: Home Hero
 */

// --- Local Fields ---
$title = get_field('hero_title');
$description = get_field('hero_description');
$banner_image = get_field('hero_banner_image');

$cta = get_field('hero_cta');
$cta_text = $cta['text'] ?? 'ЗВ’ЯЗАТИСЬ З НАМИ';
$cta_link = $cta['link'] ?? '#contact-us';

// --- Global Options (Socials) ---
$fb_link = get_field('social_facebook', 'option');
$inst_link = get_field('social_instagram', 'option');
$tt_link = get_field('social_tiktok', 'option');
$tg_link = get_field('social_telegram', 'option');
?>

<section id="hero" class="hero">
	<div class="container">

		<div class="hero__card">

			<div class="hero__socials">
				<?php if ($fb_link): ?>
					<?php get_template_part('templates/button', null, [
						'text' => 'Facebook',
						'link' => $fb_link,
						'type' => 'social',
						'class' => 'is-facebook',
						'icon' => true,
						'target' => '_blank'
					]); ?>
				<?php endif; ?>

				<?php if ($inst_link): ?>
					<?php get_template_part('templates/button', null, [
						'text' => 'Instagram',
						'link' => $inst_link,
						'type' => 'social',
						'class' => 'is-instagram',
						'icon' => true,
						'target' => '_blank'
					]); ?>
				<?php endif; ?>

				<?php if ($tt_link): ?>
					<?php get_template_part('templates/button', null, [
						'text' => 'TikTok',
						'link' => $tt_link,
						'type' => 'social',
						'class' => 'is-tiktok',
						'icon' => true,
						'target' => '_blank'
					]); ?>
				<?php endif; ?>

				<?php if ($tg_link): ?>
					<?php get_template_part('templates/button', null, [
						'text' => 'Telegram',
						'link' => $tg_link,
						'type' => 'social',
						'class' => 'is-telegram',
						'icon' => true,
						'target' => '_blank'
					]); ?>
				<?php endif; ?>
			</div>

			<div class="hero__main">
				<div class="hero__left">
					<?php if ($title): ?>
						<h1 class="hero__title"><?php echo $title; ?></h1>
					<?php endif; ?>

					<?php
					get_template_part('templates/button', null, [
						'text' => $cta_text,
						'link' => $cta_link,
						'type' => 'secondary',
						'icon' => false
					]);
					?>
				</div>

				<div class="hero__right">
					<?php if ($description): ?>
						<div class="hero__description">
							<?php echo $description; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if ($banner_image): ?>
				<div class="hero__banner">
					<img src="<?php echo esc_url($banner_image); ?>" alt="Banner">
				</div>
			<?php endif; ?>

		</div>

	</div>
</section>