<?php
/**
 * Privacy Policy content template
 */

$post_id = get_the_ID();
$full_content = apply_filters( 'the_content', get_the_content() );

$separator = '<h2';
$parts = explode( $separator, $full_content );

$show_button = false;
$initial_content = $full_content;

if ( count( $parts ) > 6 ) {
	$show_button = true;
	$preview_parts = array_slice( $parts, 0, 6 );
	
	$initial_content = $preview_parts[0];
	
	for ( $i = 1; $i < count( $preview_parts ); $i++ ) {
		$initial_content .= $separator . $preview_parts[ $i ];
	}
}
?>

<div class="privacy-policy">
	<section class="privacy-policy__hero">
		<div class="container">
			<h1 class="privacy-policy__title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="privacy-policy__body">
		<div class="container">
			<div class="privacy-policy__content" id="privacy-content">
				<?php echo $initial_content; ?>
			</div>

			<?php if ( $show_button ) : ?>
				<div class="privacy-policy__action">
                    <button
						type="button"
						class="btn-privacy-load js-privacy-load"
						data-id="<?php echo esc_attr( $post_id ); ?>"
					>
						<span class="btn-privacy-load__text">Читати більше</span>
						<span class="btn-privacy-load__icon"></span>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</section>
</div>