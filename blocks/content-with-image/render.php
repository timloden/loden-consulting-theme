<?php
/**
 * Content with Image Block
 *
 * Two-column layout with an image on either the left or right side.
 * The content column holds a fixed set of fields: eyebrow, title, subtitle
 * (optional accent-font variant), body text, bullet points, and two CTAs.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$image          = get_field( 'cwi_image' );
$image_position = get_field( 'cwi_image_position' ) ?: 'right';
$eyebrow        = get_field( 'cwi_eyebrow' );
$title          = get_field( 'cwi_title' );
$subtitle       = get_field( 'cwi_subtitle' );
$subtitle_font  = get_field( 'cwi_subtitle_font' ) ?: 'accent';
$text           = get_field( 'cwi_text' );
$bullets        = get_field( 'cwi_bullet_points' ) ?: [];
$primary_text   = get_field( 'cwi_primary_cta_text' );
$primary_url    = get_field( 'cwi_primary_cta_url' );
$secondary_text = get_field( 'cwi_secondary_cta_text' );
$secondary_url  = get_field( 'cwi_secondary_cta_url' );

$has_ctas = $primary_text || $secondary_text;
$is_phone = $secondary_url && str_starts_with( $secondary_url, 'tel:' );

$phone_svg = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16.5 12.69C16.5 12.93 16.446 13.176 16.332 13.416C16.218 13.656 16.068 13.884 15.87 14.094C15.534 14.46 15.162 14.634 14.772 14.634C14.448 14.634 14.1 14.55 13.722 14.376C13.338 14.202 12.954 13.968 12.576 13.674C12.192 13.374 11.826 13.044 11.478 12.69L6.306 7.518C5.952 7.164 5.622 6.798 5.322 6.42C5.028 6.042 4.794 5.664 4.626 5.286C4.452 4.908 4.368 4.554 4.368 4.236C4.368 3.852 4.536 3.48 4.896 3.144C5.256 2.802 5.64 2.634 6.048 2.634C6.198 2.634 6.348 2.664 6.48 2.724C6.618 2.784 6.738 2.874 6.834 3.006L8.454 5.274C8.556 5.4 8.628 5.52 8.682 5.634C8.736 5.742 8.766 5.844 8.766 5.934C8.766 6.048 8.736 6.162 8.67 6.27C8.61 6.378 8.52 6.486 8.406 6.6L8.034 6.984C7.986 7.032 7.962 7.086 7.962 7.152C7.962 7.188 7.968 7.218 7.98 7.254C7.998 7.29 8.016 7.32 8.028 7.35C8.124 7.524 8.286 7.746 8.514 8.01C8.748 8.274 8.994 8.544 9.264 8.814C9.546 9.084 9.81 9.336 10.08 9.564C10.344 9.786 10.566 9.942 10.746 10.038C10.77 10.05 10.8 10.068 10.836 10.086C10.878 10.104 10.914 10.11 10.956 10.11C11.022 10.11 11.082 10.08 11.13 10.032L11.502 9.666C11.622 9.546 11.736 9.456 11.844 9.396C11.952 9.33 12.06 9.3 12.18 9.3C12.27 9.3 12.366 9.324 12.48 9.378C12.594 9.432 12.714 9.504 12.84 9.6L15.132 11.238C15.264 11.334 15.354 11.448 15.408 11.58C15.456 11.712 15.486 11.838 15.486 11.994L16.5 12.69Z" fill="currentColor"/></svg>';

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	[ 'py-16', 'lg:py-20' ]
);

// flex-row-reverse puts image on the right; flex-row puts image on the left.
$row_class = ( 'left' === $image_position ) ? 'lg:flex-row' : 'lg:flex-row-reverse';

// Subtitle font: 'accent' uses the h7 Swister italic class; 'primary' uses a standard h4.
$subtitle_class = ( 'accent' === $subtitle_font ) ? 'h7 text-simple-blue' : 'h4 text-simple-blue';

// Checkmark SVG for bullet points.
$check_svg = '<svg class="w-5 h-5 shrink-0 text-simple-blue mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6">
		<div class="flex flex-col <?php echo esc_attr( $row_class ); ?> gap-12 lg:gap-16 items-center">

			<!-- ==================== IMAGE ==================== -->
			<?php if ( $image && ! empty( $image['url'] ) ) : ?>
			<div class="w-full lg:w-1/2 shrink-0">
				<img src="<?php echo esc_url( $image['url'] ); ?>"
				     alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
				     class="w-full h-auto rounded-2xl object-cover">
			</div>
			<?php elseif ( $is_preview ) : ?>
			<div class="w-full lg:w-1/2 shrink-0 rounded-2xl bg-gray-100 flex items-center justify-center h-64 text-gray-400 p3">
				Select an image in the block settings panel.
			</div>
			<?php endif; ?>
			<!-- ==================== END IMAGE ==================== -->

			<!-- ==================== CONTENT ==================== -->
			<div class="w-full lg:w-1/2">

				<?php if ( $eyebrow ) : ?>
				<span class="inline-flex items-center px-4 py-1.5 mb-5 rounded-full bg-sky-blue-30 border border-gray-300 text-xs font-semibold uppercase tracking-[0.15em] text-gray-500">
					<?php echo esc_html( $eyebrow ); ?>
				</span>
				<?php endif; ?>

				<?php if ( $title ) : ?>
				<h2 class="h2 text-dark-blue mb-4"><?php echo wp_kses_post( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
				<p class="<?php echo esc_attr( $subtitle_class ); ?> mb-5"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $text ) : ?>
				<p class="p2 text-gray-600 mb-6"><?php echo nl2br( esc_html( $text ) ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $bullets ) ) : ?>
				<ul class="space-y-3 mb-8">
					<?php foreach ( $bullets as $bullet ) :
						$bullet_text = $bullet['cwi_bullet_text'] ?? '';
					?>
					<?php if ( $bullet_text ) : ?>
					<li class="flex items-start gap-3">
						<?php echo $check_svg; ?>
						<span class="p2 text-gray-700"><?php echo esc_html( $bullet_text ); ?></span>
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( $has_ctas ) : ?>
				<div class="flex flex-col sm:flex-row items-start gap-4">
					<?php if ( $primary_text && $primary_url ) : ?>
					<a href="<?php echo esc_url( $primary_url ); ?>" class="btn-cta w-full sm:w-auto justify-center">
						<?php echo esc_html( $primary_text ); ?>
					</a>
					<?php endif; ?>

					<?php if ( $secondary_text && $secondary_url ) : ?>
					<a href="<?php echo esc_url( $secondary_url ); ?>" class="btn-phone w-full sm:w-auto justify-center">
						<?php if ( $is_phone ) echo $phone_svg; ?>
						<?php echo esc_html( $secondary_text ); ?>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>

			</div>
			<!-- ==================== END CONTENT ==================== -->

		</div>
	</div>
</section>
