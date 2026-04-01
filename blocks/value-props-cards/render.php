<?php
/**
 * Value Props - Cards Block
 *
 * 3-column card grid. Each card supports: eyebrow badge, icon, title,
 * subtitle, body text, background colour, and a CTA link.
 * Cards are centre-justified and stack on mobile.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$cards = get_field( 'vpc_cards' ) ?: [];

if ( empty( $cards ) && $is_preview ) {
	echo '<div class="py-10 text-center text-gray-400 p3">Add cards in the block settings panel.</div>';
	return;
}

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	[ 'py-16', 'lg:py-20' ]
);

// Map background-colour choice → Tailwind classes for the card shell.
$bg_map = [
	'white'      => [ 'card' => 'bg-white border border-gray-200',          'title' => 'text-dark-blue', 'body' => 'text-gray-500',    'cta' => '' ],
	'light-blue' => [ 'card' => 'bg-sky-blue-30 border border-sky-blue-30', 'title' => 'text-dark-blue', 'body' => 'text-gray-500',    'cta' => '' ],
	'dark-blue'  => [ 'card' => 'bg-dark-blue border border-dark-blue',     'title' => 'text-white',     'body' => 'text-white/70',    'cta' => 'text-white' ],
];
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6">

		<?php if ( ! empty( $cards ) ) : ?>
		<div class="flex flex-wrap justify-center gap-6 lg:gap-8">
			<?php foreach ( $cards as $card ) :
				$eyebrow  = $card['vpc_card_eyebrow']  ?? '';
				$icon     = $card['vpc_card_icon']     ?? null;
				$title    = $card['vpc_card_title']    ?? '';
				$subtitle = $card['vpc_card_subtitle'] ?? '';
				$bg_key   = $card['vpc_card_bg_color'] ?? 'white';
				$text     = $card['vpc_card_text']     ?? '';
				$cta_text = $card['vpc_card_cta_text'] ?? '';
				$cta_url  = $card['vpc_card_cta_url']  ?? '';

				$styles = $bg_map[ $bg_key ] ?? $bg_map['white'];
			?>
			<div class="flex flex-col rounded-2xl p-8 w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1.5rem)] <?php echo esc_attr( $styles['card'] ); ?>">

				<?php if ( $eyebrow ) : ?>
				<span class="inline-flex items-center self-start px-3 py-1 mb-4 rounded-full bg-white/60 border border-gray-200 text-xs font-semibold uppercase tracking-[0.12em] text-gray-500">
					<?php echo esc_html( $eyebrow ); ?>
				</span>
				<?php endif; ?>

				<?php if ( $icon && ! empty( $icon['url'] ) ) : ?>
				<div class="mb-5">
					<img src="<?php echo esc_url( $icon['url'] ); ?>"
					     alt="<?php echo esc_attr( $icon['alt'] ?? '' ); ?>"
					     class="w-12 h-12 object-contain"
					     width="48" height="48">
				</div>
				<?php endif; ?>

				<?php if ( $title ) : ?>
				<h3 class="h5 mb-2 <?php echo esc_attr( $styles['title'] ); ?>"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
				<p class="p3 text-simple-blue font-semibold mb-3"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $text ) : ?>
				<p class="p3 flex-1 mb-5 <?php echo esc_attr( $styles['body'] ); ?>"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>

				<?php if ( $cta_text && $cta_url ) : ?>
				<a href="<?php echo esc_url( $cta_url ); ?>" class="link-arrow mt-auto <?php echo esc_attr( $styles['cta'] ); ?>">
					<?php echo esc_html( $cta_text ); ?>
				</a>
				<?php endif; ?>

			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

	</div>
</section>
