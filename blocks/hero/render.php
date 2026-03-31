<?php
/**
 * Hero Block
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package Loden_Consulting
 */

// Content fields.
$title              = get_field( 'hero_title' );
$subtitle           = get_field( 'hero_subtitle' );
$text_color         = get_field( 'hero_text_color' ) ?: 'light';
$value_props        = get_field( 'hero_value_props' ) ?: [];

// Background fields.
$bg_image           = get_field( 'hero_background_image' );
$bg_image_mobile    = get_field( 'hero_background_image_mobile' );
$bg_color           = get_field( 'hero_background_color' ) ?: '#12242B';
$top_padding        = get_field( 'hero_top_padding' );

// CTA fields.
$primary_cta_text   = get_field( 'hero_primary_cta_text' );
$primary_cta_link   = get_field( 'hero_primary_cta_link' );
$secondary_cta_text = get_field( 'hero_secondary_cta_text' );
$secondary_cta_link = get_field( 'hero_secondary_cta_link' );

// Form card fields.
$form_eyebrow       = get_field( 'hero_form_eyebrow' );
$form_title_text    = get_field( 'hero_form_title' );
$form_response_time = get_field( 'hero_form_response_time' );
$form_tooltip       = get_field( 'hero_form_tooltip' );

// Handle Gravity Form field — plugin may return an object, array, or int.
$form_raw = get_field( 'hero_form' );
if ( is_object( $form_raw ) ) {
	$form_id = intval( $form_raw->id ?? 0 );
} elseif ( is_array( $form_raw ) ) {
	$form_id = intval( $form_raw['id'] ?? 0 );
} else {
	$form_id = intval( $form_raw );
}

// Text colour classes.
$is_dark_text  = ( 'dark' === $text_color );
$heading_class = $is_dark_text ? 'text-dark-blue' : 'text-white';
$body_class    = $is_dark_text ? 'text-dark-blue/80' : 'text-white/80';

// Determine if a form card should be shown.
$show_form_card = $form_eyebrow || $form_title_text || $form_response_time || $form_id;

// Top padding classes — pushes content below the fixed header.
$pt_class = $top_padding ? 'pt-[250px] lg:pt-36' : 'pt-20 lg:pt-24';

// Wrapper attributes.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes( $block, [ 'relative', 'overflow-hidden' ] );

// Grid layout: 2-col on desktop when form card is present, else left-aligned single col.
$grid_classes = $show_form_card
	? 'grid grid-cols-1 lg:grid-cols-[1fr_440px] gap-10 xl:gap-16 items-center'
	: 'flex flex-col items-start max-w-2xl';
?>

<section <?php echo $wrapper_attributes; ?> style="background-color: <?php echo esc_attr( $bg_color ); ?>;">

	<?php /* --- Background images (layered over the colour) --- */ ?>

	<?php if ( $bg_image && ! empty( $bg_image['url'] ) ) : ?>
	<div class="absolute inset-0 bg-cover bg-top <?php echo ( $bg_image_mobile && ! empty( $bg_image_mobile['url'] ) ) ? 'hidden lg:block' : ''; ?>"
	     style="background-image: url(<?php echo esc_url( $bg_image['url'] ); ?>);"
	     aria-hidden="true"></div>
	<?php endif; ?>

	<?php if ( $bg_image_mobile && ! empty( $bg_image_mobile['url'] ) ) : ?>
	<div class="absolute inset-0 bg-cover bg-top lg:hidden"
	     style="background-image: url(<?php echo esc_url( $bg_image_mobile['url'] ); ?>);"
	     aria-hidden="true"></div>
	<?php endif; ?>

	<?php /* --- Content --- */ ?>
	<div class="relative container mx-auto px-6 pb-24 lg:pb-28 <?php echo esc_attr( $pt_class ); ?> <?php echo esc_attr( $grid_classes ); ?>">

		<!-- ===================== LEFT: Content ===================== -->
		<div>

			<?php if ( $title ) : ?>
			<h1 class="h1 font-display font-bold leading-tight mb-4 <?php echo esc_attr( $heading_class ); ?>">
				<?php echo wp_kses_post( $title ); ?>
			</h1>
			<?php endif; ?>

			<?php if ( $subtitle ) : ?>
			<p class="p1 mb-6 <?php echo esc_attr( $body_class ); ?>"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $value_props ) ) : ?>
			<ul class="space-y-3 mb-8">
				<?php foreach ( $value_props as $prop ) :
					$text = esc_html( $prop['value_prop_text'] ?? '' );
					if ( ! $text ) { continue; }
				?>
				<li class="flex items-center gap-3 p2 font-semibold <?php echo esc_attr( $heading_class ); ?>">
					<svg class="flex-shrink-0 text-accent" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M4 10.5L8.5 15L16 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php echo $text; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>

			<?php if ( $primary_cta_text || $secondary_cta_text ) : ?>
			<div class="flex flex-col sm:flex-row gap-4">

				<?php if ( $primary_cta_text && $primary_cta_link ) : ?>
				<a href="<?php echo esc_url( $primary_cta_link ); ?>" class="btn-cta w-full sm:w-auto justify-center">
					<?php echo esc_html( $primary_cta_text ); ?>
				</a>
				<?php endif; ?>

				<?php if ( $secondary_cta_text && $secondary_cta_link ) : ?>
				<a href="<?php echo esc_url( $secondary_cta_link ); ?>" class="btn-phone-dark w-full sm:w-auto justify-center">
					<?php if ( str_starts_with( $secondary_cta_link, 'tel:' ) ) : ?>
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M16.5 12.69C16.5 12.93 16.446 13.176 16.332 13.416C16.218 13.656 16.068 13.884 15.87 14.094C15.534 14.46 15.162 14.634 14.772 14.634C14.448 14.634 14.1 14.55 13.722 14.376C13.338 14.202 12.954 13.968 12.576 13.674C12.192 13.374 11.826 13.044 11.478 12.69L6.306 7.518C5.952 7.164 5.622 6.798 5.322 6.42C5.028 6.042 4.794 5.664 4.626 5.286C4.452 4.908 4.368 4.554 4.368 4.236C4.368 3.852 4.536 3.48 4.896 3.144C5.256 2.802 5.64 2.634 6.048 2.634C6.198 2.634 6.348 2.664 6.48 2.724C6.618 2.784 6.738 2.874 6.834 3.006L8.454 5.274C8.556 5.4 8.628 5.52 8.682 5.634C8.736 5.742 8.766 5.844 8.766 5.934C8.766 6.048 8.736 6.162 8.67 6.27C8.61 6.378 8.52 6.486 8.406 6.6L8.034 6.984C7.986 7.032 7.962 7.086 7.962 7.152C7.962 7.188 7.968 7.218 7.98 7.254C7.998 7.29 8.016 7.32 8.028 7.35C8.124 7.524 8.286 7.746 8.514 8.01C8.748 8.274 8.994 8.544 9.264 8.814C9.546 9.084 9.81 9.336 10.08 9.564C10.344 9.786 10.566 9.942 10.746 10.038C10.77 10.05 10.8 10.068 10.836 10.086C10.878 10.104 10.914 10.11 10.956 10.11C11.022 10.11 11.082 10.08 11.13 10.032L11.502 9.666C11.622 9.546 11.736 9.456 11.844 9.396C11.952 9.33 12.06 9.3 12.18 9.3C12.27 9.3 12.366 9.324 12.48 9.378C12.594 9.432 12.714 9.504 12.84 9.6L15.132 11.238C15.264 11.334 15.354 11.448 15.408 11.58C15.456 11.712 15.486 11.838 15.486 11.994L16.5 12.69Z" fill="currentColor"/>
					</svg>
					<?php endif; ?>
					<?php echo esc_html( $secondary_cta_text ); ?>
				</a>
				<?php endif; ?>

			</div>
			<?php endif; ?>

		</div>
		<!-- ===================== END LEFT ===================== -->

		<?php if ( $show_form_card ) : ?>
		<!-- ===================== RIGHT: Form Card ===================== -->
		<div class="bg-white rounded-2xl shadow-2xl p-8 w-full">

			<?php if ( $form_eyebrow || $form_title_text ) : ?>
			<div class="text-center mb-5">
				<?php if ( $form_eyebrow ) : ?>
				<p class="text-sm font-bold text-simple-blue mb-1"><?php echo esc_html( $form_eyebrow ); ?></p>
				<?php endif; ?>
				<?php if ( $form_title_text ) : ?>
				<p class="text-xl font-bold text-dark-blue"><?php echo esc_html( $form_title_text ); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( $form_response_time ) : ?>
			<div class="flex items-center gap-2.5 bg-[#E8F8F5] rounded-lg px-4 py-2.5 mb-6">
				<span class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-[#2D9B7F]" aria-hidden="true"></span>
				<span class="flex-1 text-sm text-[#1A6B55] font-medium"><?php echo esc_html( $form_response_time ); ?></span>
				<?php if ( $form_tooltip ) :
					$tooltip_text = wp_strip_all_tags( $form_tooltip );
					$icon_svg     = file_get_contents( __DIR__ . '/icon-info.svg' );
				?>
				<div class="tooltip tooltip-left" data-tip="<?php echo esc_attr( $tooltip_text ); ?>">
					<button type="button" class="flex-shrink-0 leading-none cursor-help" aria-label="More information">
						<?php echo $icon_svg; ?>
					</button>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( $form_id && function_exists( 'gravity_form' ) ) : ?>
				<?php if ( $is_preview ) : ?>
				<div class="bg-gray-100 rounded-lg px-4 py-6 text-center text-sm text-gray-500">
					Gravity Form #<?php echo intval( $form_id ); ?> will render here on the front end.
				</div>
				<?php else : ?>
				<?php gravity_form( $form_id, false, false, false, null, true ); ?>
				<?php endif; ?>
			<?php elseif ( $is_preview ) : ?>
			<div class="bg-gray-100 rounded-lg px-4 py-6 text-center text-sm text-gray-500">
				Select a Gravity Form in the block settings (Form Card tab).
			</div>
			<?php endif; ?>

		</div>
		<!-- ===================== END RIGHT ===================== -->
		<?php endif; ?>

	</div>
</section>
