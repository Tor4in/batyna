<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
	<meta name="description" content="Side made on Wordpress by Recipe team">

	<?php wp_head(); ?>

	<title><?php wp_title(); ?></title>
</head>

<body <?php body_class(); ?>>
	<?php
	// ACF Fields
	$header_cta = get_field('header_cta', 'option');
	$btn_text = $header_cta['text'] ?? 'Зв’язатись з нами';
	$btn_link = $header_cta['link'] ?? '#contact';
	?>

	<header class="header" id="header">
		<div class="container">
			<nav class="main-nav">

				<?php the_custom_logo(); ?>

				<div class="header__right">
					<?php get_template_part('templates/navigation', null, array('location' => 'menu-header')); ?>

					<?php if ($header_cta): ?>
						<?php get_template_part('templates/button', null, [
							'text' => $btn_text,
							'link' => $btn_link,
							'type' => 'quaternary',
							'icon' => false
						]); ?>
					<?php endif; ?>
				</div>

				<div class="header__mobile-controls">
					<a href="tel:+380000000000" class="btn btn-phone-outline">
						<span class="btn__circle"></span>
					</a>

					<button class="btn btn-burger js-toggle-mobile-menu" aria-label="Open menu">
						<span class="btn__circle"></span>
					</button>
				</div>

			</nav>
		</div>
	</header>

	<div class="backdrop" id="mobile-menu" style="--_open: 400ms; --_close: 400ms;">
		<div class="backdrop__body">

			<div class="backdrop__content">
				<?php
				// Mobile Navigation
				get_template_part('templates/navigation', null, array('location' => 'menu-header'));
				?>

				<div class="backdrop__actions">
					<a href="<?php echo esc_url($btn_link); ?>" class="btn btn-quaternary">
						<?php echo esc_html($btn_text); ?>
					</a>
				</div>
			</div>

		</div>
	</div>