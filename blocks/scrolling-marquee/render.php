<?php
/**
 * Scrolling Marquee Block
 *
 * An infinitely scrolling ticker strip. Items are duplicated in the DOM so the
 * animation loops seamlessly — the track moves left by exactly 50% of its own
 * width (= the width of one copy of the item list), then snaps back to 0.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$items          = get_field( 'sm_items' )     ?: [];
$speed          = absint( get_field( 'sm_speed' ) ?: 30 );
$direction      = get_field( 'sm_direction' ) ?: 'left';
$bg_color       = get_field( 'sm_bg_color' )  ?: 'white';
$separator_icon = get_field( 'sm_separator_icon' );

if ( empty( $items ) && $is_preview ) {
	echo '<div class="py-6 text-center text-gray-400 p3">Add marquee items in the block settings panel.</div>';
	return;
}

$block_id = $block['id'] ?? uniqid( 'marquee-' );

// Background options.
$bg_classes = [
	'white'      => 'bg-white',
	'light-blue' => 'bg-sky-blue-30',
	'dark-blue'  => 'bg-dark-blue',
];
$text_classes = [
	'white'      => 'text-sky-blue-100',
	'light-blue' => 'text-sky-blue-100',
	'dark-blue'  => 'text-white/30',
];

$bg_class   = $bg_classes[ $bg_color ]   ?? 'bg-white';
$text_class = $text_classes[ $bg_color ] ?? 'text-sky-blue-100';

// Animation direction: left = normal, right = reverse.
$animation_direction = ( 'right' === $direction ) ? 'reverse' : 'normal';

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	[ $bg_class, 'overflow-x-hidden', 'py-4' ]
);
?>

<div <?php echo $wrapper_attributes; ?>>

	<style>
	@keyframes lc-marquee-<?php echo esc_attr( $block_id ); ?> {
		0%   { transform: translateX(0); }
		100% { transform: translateX(-50%); }
	}
	#lc-marquee-<?php echo esc_attr( $block_id ); ?> .lc-marquee-track {
		animation: lc-marquee-<?php echo esc_attr( $block_id ); ?> <?php echo $speed; ?>s linear infinite <?php echo esc_attr( $animation_direction ); ?>;
	}
	@media (prefers-reduced-motion: reduce) {
		#lc-marquee-<?php echo esc_attr( $block_id ); ?> .lc-marquee-track {
			animation: none;
		}
	}
	</style>

	<div id="lc-marquee-<?php echo esc_attr( $block_id ); ?>">
		<!-- The track contains items duplicated twice for seamless looping -->
		<div class="lc-marquee-track flex w-max items-center gap-0">
			<?php
			// Render items twice (original + clone) so the animation loops without a gap.
			for ( $pass = 0; $pass < 2; $pass++ ) :
				foreach ( $items as $item ) :
					$text      = $item['sm_item_text']  ?? '';
					$item_icon = $item['sm_item_icon']  ?? null;
			?>
			<div class="flex items-center gap-6 px-6 shrink-0">

				<?php if ( $item_icon && ! empty( $item_icon['url'] ) ) : ?>
				<img src="<?php echo esc_url( $item_icon['url'] ); ?>"
				     alt="<?php echo esc_attr( $item_icon['alt'] ?? '' ); ?>"
				     class="w-16 h-16 object-contain shrink-0">
				<?php endif; ?>

				<?php if ( $text ) : ?>
				<span class="font-extrabold uppercase tracking-widest whitespace-nowrap <?php echo esc_attr( $text_class ); ?>" style="font-size: 80px; line-height: 1;">
					<?php echo esc_html( $text ); ?>
				</span>
				<?php endif; ?>

				<!-- Separator icon between items -->
				<?php if ( $separator_icon && ! empty( $separator_icon['url'] ) ) : ?>
				<img src="<?php echo esc_url( $separator_icon['url'] ); ?>"
				     alt=""
				     aria-hidden="true"
				     class="w-12 h-12 object-contain shrink-0 opacity-60">
				<?php endif; ?>

			</div>
			<?php
				endforeach;
			endfor;
			?>
		</div>
	</div>

</div>
