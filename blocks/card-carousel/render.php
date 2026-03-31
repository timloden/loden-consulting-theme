<?php
/**
 * Card Carousel Block
 *
 * daisyUI carousel of icon cards with optional CTA buttons below.
 * The carousel track starts at the container's left edge and bleeds to the
 * right viewport edge. Prev/next buttons scroll the track. Prev is hidden
 * until the user has scrolled right.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$cards              = get_field( 'cc_cards' ) ?: [];
$primary_cta_text   = get_field( 'cc_primary_cta_text' );
$primary_cta_url    = get_field( 'cc_primary_cta_url' );
$secondary_cta_text = get_field( 'cc_secondary_cta_text' );
$secondary_cta_url  = get_field( 'cc_secondary_cta_url' );

if ( empty( $cards ) && $is_preview ) {
	echo '<div class="py-10 text-center text-gray-400 p3">Add cards in the block settings panel.</div>';
	return;
}

$block_id           = $block['id'] ?? uniqid( 'cc-' );
$has_ctas           = $primary_cta_text || $secondary_cta_text;
$is_phone_secondary = $secondary_cta_url && str_starts_with( $secondary_cta_url, 'tel:' );

// overflow-x-hidden clips the track at the viewport edge (creating the right-bleed
// visual) and forces the carousel track — not the page — to be the scroll container.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	[ 'py-12', 'lg:py-16', 'overflow-x-hidden' ]
);

// The carousel left padding mirrors the container's left offset so cards start
// at the same horizontal position as regular container content.
// Formula: max(px-6, (100vw − container-max-width) / 2 + px-6)
// 1280px = xl container max-width; 1.5rem = px-6.
// On narrow viewports use 2rem (px-8) so the left indent is clearly visible.
// On wide viewports the calc aligns the first card with the container's left edge.
$carousel_left_padding = 'max(2rem, calc((100vw - 1280px) / 2 + 2rem))';

// Phone SVG icon (matches hero block).
$phone_svg = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16.5 12.69C16.5 12.93 16.446 13.176 16.332 13.416C16.218 13.656 16.068 13.884 15.87 14.094C15.534 14.46 15.162 14.634 14.772 14.634C14.448 14.634 14.1 14.55 13.722 14.376C13.338 14.202 12.954 13.968 12.576 13.674C12.192 13.374 11.826 13.044 11.478 12.69L6.306 7.518C5.952 7.164 5.622 6.798 5.322 6.42C5.028 6.042 4.794 5.664 4.626 5.286C4.452 4.908 4.368 4.554 4.368 4.236C4.368 3.852 4.536 3.48 4.896 3.144C5.256 2.802 5.64 2.634 6.048 2.634C6.198 2.634 6.348 2.664 6.48 2.724C6.618 2.784 6.738 2.874 6.834 3.006L8.454 5.274C8.556 5.4 8.628 5.52 8.682 5.634C8.736 5.742 8.766 5.844 8.766 5.934C8.766 6.048 8.736 6.162 8.67 6.27C8.61 6.378 8.52 6.486 8.406 6.6L8.034 6.984C7.986 7.032 7.962 7.086 7.962 7.152C7.962 7.188 7.968 7.218 7.98 7.254C7.998 7.29 8.016 7.32 8.028 7.35C8.124 7.524 8.286 7.746 8.514 8.01C8.748 8.274 8.994 8.544 9.264 8.814C9.546 9.084 9.81 9.336 10.08 9.564C10.344 9.786 10.566 9.942 10.746 10.038C10.77 10.05 10.8 10.068 10.836 10.086C10.878 10.104 10.914 10.11 10.956 10.11C11.022 10.11 11.082 10.08 11.13 10.032L11.502 9.666C11.622 9.546 11.736 9.456 11.844 9.396C11.952 9.33 12.06 9.3 12.18 9.3C12.27 9.3 12.366 9.324 12.48 9.378C12.594 9.432 12.714 9.504 12.84 9.6L15.132 11.238C15.264 11.334 15.354 11.448 15.408 11.58C15.456 11.712 15.486 11.838 15.486 11.994L16.5 12.69Z" fill="currentColor"/></svg>';
?>

<section <?php echo $wrapper_attributes; ?>>

	<?php if ( ! empty( $cards ) ) : ?>

	<!-- ==================== CAROUSEL ==================== -->
	<!-- Wrapper is full-width/relative for nav button positioning -->
	<div class="relative">

		<!-- Track: left edge = container left, right edge = viewport edge -->
		<div class="carousel w-full gap-5 pb-4"
		     style="padding-left: <?php echo esc_attr( $carousel_left_padding ); ?>; padding-right: 2rem; scroll-padding-left: <?php echo esc_attr( $carousel_left_padding ); ?>;"
		     id="carousel-<?php echo esc_attr( $block_id ); ?>">

			<?php foreach ( $cards as $card ) :
				$image      = $card['cc_card_image'] ?? null;
				$card_title = $card['cc_card_title'] ?? '';
				$content    = $card['cc_card_content'] ?? '';
				$link_text  = ! empty( $card['cc_card_link_text'] ) ? $card['cc_card_link_text'] : 'Learn more';
				$link_url   = $card['cc_card_link_url'] ?? '';
			?>
			<div class="carousel-item w-[272px] shrink-0">
				<div class="flex flex-col h-full rounded-2xl border border-gray-200 p-6 w-full">

					<?php if ( $image && ! empty( $image['url'] ) ) : ?>
					<div class="w-20 h-20 rounded-full bg-sky-blue-30 flex items-center justify-center mb-6 shrink-0">
						<img src="<?php echo esc_url( $image['url'] ); ?>"
						     alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
						     class="w-12 h-12 object-contain">
					</div>
					<?php endif; ?>

					<div class="flex flex-col flex-1">

						<?php if ( $card_title ) : ?>
						<h3 class="h6 text-dark-blue mb-3"><?php echo esc_html( $card_title ); ?></h3>
						<?php endif; ?>

						<?php if ( $content ) : ?>
						<p class="p3 text-gray-500 mb-6 flex-1"><?php echo esc_html( $content ); ?></p>
						<?php endif; ?>

						<?php if ( $link_text && $link_url ) : ?>
						<a href="<?php echo esc_url( $link_url ); ?>" class="link-arrow">
							<?php echo esc_html( $link_text ); ?>
						</a>
						<?php endif; ?>

					</div>

				</div>
			</div>
			<?php endforeach; ?>

		</div>

		<!-- Prev button: hidden at start, appears once user scrolls -->
		<button class="hidden absolute left-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors"
		        id="carousel-prev-<?php echo esc_attr( $block_id ); ?>"
		        aria-label="<?php esc_attr_e( 'Previous', 'loden-consulting' ); ?>">
			<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
			</svg>
		</button>

		<!-- Next button: right viewport edge -->
		<button class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors"
		        id="carousel-next-<?php echo esc_attr( $block_id ); ?>"
		        aria-label="<?php esc_attr_e( 'Next', 'loden-consulting' ); ?>">
			<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
			</svg>
		</button>

	</div>
	<!-- ==================== END CAROUSEL ==================== -->

	<!-- Carousel JS: scroll buttons + prev visibility -->
	<script>
	(function () {
		var id    = <?php echo wp_json_encode( $block_id ); ?>;
		var track = document.getElementById( 'carousel-' + id );
		var prev  = document.getElementById( 'carousel-prev-' + id );
		var next  = document.getElementById( 'carousel-next-' + id );
		if ( ! track || ! prev || ! next ) { return; }

		var scrollAmount = 300;

		next.addEventListener( 'click', function () {
			track.scrollBy( { left: scrollAmount, behavior: 'smooth' } );
		} );

		prev.addEventListener( 'click', function () {
			track.scrollBy( { left: -scrollAmount, behavior: 'smooth' } );
		} );

		function updateButtons() {
			var atStart = track.scrollLeft <= 0;
			var atEnd   = track.scrollLeft + track.clientWidth >= track.scrollWidth - 1;
			prev.classList.toggle( 'hidden', atStart );
			next.classList.toggle( 'hidden', atEnd );
		}

		track.addEventListener( 'scroll', updateButtons, { passive: true } );
	}());
	</script>

	<?php endif; ?>

	<?php if ( $has_ctas ) : ?>
	<!-- CTAs remain inside the container -->
	<div class="container mx-auto px-6">
		<div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">

			<?php if ( $primary_cta_text && $primary_cta_url ) : ?>
			<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="btn-cta w-full sm:w-auto justify-center">
				<?php echo esc_html( $primary_cta_text ); ?>
			</a>
			<?php endif; ?>

			<?php if ( $secondary_cta_text && $secondary_cta_url ) : ?>
			<a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="btn-phone w-full sm:w-auto justify-center">
				<?php if ( $is_phone_secondary ) echo $phone_svg; ?>
				<?php echo esc_html( $secondary_cta_text ); ?>
			</a>
			<?php endif; ?>

		</div>
	</div>
	<?php endif; ?>

</section>
