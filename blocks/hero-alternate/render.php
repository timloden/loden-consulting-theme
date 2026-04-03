<?php
/**
 * Hero (Alternate) Block
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
$eyebrow     = get_field( 'ha_eyebrow' );
$title       = get_field( 'ha_title' );
$text        = get_field( 'ha_text' );
$text_color  = get_field( 'ha_text_color' ) ?: 'dark';
$image       = get_field( 'ha_image' );
$top_padding = get_field( 'ha_top_padding' );

// Text colour classes.
$is_light_text = ( 'light' === $text_color );
$heading_class = $is_light_text ? 'text-white' : 'text-dark-blue';
$body_class    = $is_light_text ? 'text-white/80' : 'text-dark-blue/70';
$eyebrow_bg    = $is_light_text ? 'bg-white/20 border-white/30 text-white/80' : 'bg-white border-gray-300 text-gray-500';

// Background fields.
$bg_image        = get_field( 'ha_bg_image' );
$bg_image_mobile = get_field( 'ha_bg_image_mobile' );
$bg_color        = get_field( 'ha_bg_color' ) ?: '#EBF7FD';

// Form card fields.
$form_eyebrow       = get_field( 'ha_form_eyebrow' );
$form_title_text    = get_field( 'ha_form_title' );
$form_response_time = get_field( 'ha_form_response_time' );
$form_tooltip       = get_field( 'ha_form_tooltip' );

// Handle Gravity Form field — plugin may return an object, array, or int.
$form_raw = get_field( 'ha_form' );
if ( is_object( $form_raw ) ) {
	$form_id = intval( $form_raw->id ?? 0 );
} elseif ( is_array( $form_raw ) ) {
	$form_id = intval( $form_raw['id'] ?? 0 );
} else {
	$form_id = intval( $form_raw );
}

// Determine if a form card should be shown.
$show_form_card = $form_eyebrow || $form_title_text || $form_response_time || $form_id;

// Top padding classes — pushes content below the fixed header.
$pt_class = $top_padding ? 'pt-[250px] lg:pt-36' : 'pt-20 lg:pt-24';

// Wrapper attributes.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes( $block, [ 'relative', 'overflow-visible' ] );
?>

<section <?php echo $wrapper_attributes; ?> style="background-color: <?php echo esc_attr( $bg_color ); ?>;">

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

	<div class="relative container mx-auto px-6 pb-0 <?php echo esc_attr( $pt_class ); ?> grid grid-cols-1 lg:grid-cols-[1fr_440px] gap-10 xl:gap-16 items-end">

		<!-- ===================== LEFT: Content + Image ===================== -->
		<div>

			<?php if ( $eyebrow ) : ?>
			<span class="inline-flex items-center px-4 py-1.5 mb-5 rounded-full <?php echo esc_attr( $eyebrow_bg ); ?> text-xs font-semibold uppercase tracking-[0.15em]">
				<?php echo esc_html( $eyebrow ); ?>
			</span>
			<?php endif; ?>

			<?php if ( $title ) : ?>
			<h1 class="h1 font-display font-bold leading-tight mb-5 <?php echo esc_attr( $heading_class ); ?>">
				<?php echo wp_kses_post( $title ); ?>
			</h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
			<div class="p1 <?php echo esc_attr( $body_class ); ?> mb-8 max-w-prose">
				<?php echo wp_kses_post( $text ); ?>
			</div>
			<?php endif; ?>

			<?php if ( $image && ! empty( $image['url'] ) ) : ?>
			<div class="relative z-10 mb-[-4rem]">
				<img src="<?php echo esc_url( $image['url'] ); ?>"
				     alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
				     class="max-w-full h-auto"
				     width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
				     height="<?php echo esc_attr( $image['height'] ?? '' ); ?>">
			</div>
			<?php endif; ?>

		</div>
		<!-- ===================== END LEFT ===================== -->

		<?php if ( $show_form_card ) : ?>
		<!-- ===================== RIGHT: Form Card ===================== -->
		<div class="bg-white rounded-2xl shadow-2xl p-8 w-full mb-16">

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
				?>
				<div class="tooltip tooltip-left" data-tip="<?php echo esc_attr( $tooltip_text ); ?>">
					<button type="button" class="flex-shrink-0 leading-none cursor-help" aria-label="More information">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<circle cx="8" cy="8" r="7.5" stroke="#2D9B7F"/>
							<path d="M8 7v5M8 5v.5" stroke="#2D9B7F" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
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
