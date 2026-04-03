<?php
/**
 * CTA Contact Form Block
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package Loden_Consulting
 */

// Image panel fields.
$image         = get_field( 'ccf_image' );
$image_eyebrow = get_field( 'ccf_image_eyebrow' );
$image_title   = get_field( 'ccf_image_title' );

// Form fields.
$bg_color_key = get_field( 'ccf_bg_color' ) ?: 'sky-blue-30';
$bg_class     = ( 'white' === $bg_color_key ) ? 'bg-white' : 'bg-sky-blue-30';

// Handle Gravity Form field — plugin may return an object, array, or int.
$form_raw = get_field( 'ccf_form' );
if ( is_object( $form_raw ) ) {
	$form_id = intval( $form_raw->id ?? 0 );
} elseif ( is_array( $form_raw ) ) {
	$form_id = intval( $form_raw['id'] ?? 0 );
} else {
	$form_id = intval( $form_raw );
}

// Wrapper attributes.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes( $block );
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6 py-16 lg:py-24">

		<div class="grid grid-cols-1 lg:grid-cols-2 rounded-2xl overflow-hidden shadow-xl">

			<!-- ===================== LEFT: Image Panel ===================== -->
			<div class="relative min-h-[280px]">

				<?php if ( $image && ! empty( $image['url'] ) ) : ?>
				<img src="<?php echo esc_url( $image['url'] ); ?>"
				     alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
				     class="absolute inset-0 w-full h-full object-cover"
				     width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
				     height="<?php echo esc_attr( $image['height'] ?? '' ); ?>">
				<?php endif; ?>

				<div class="absolute inset-0 bg-dark-blue/60" aria-hidden="true"></div>

				<div class="relative z-10 p-8 lg:p-10 flex flex-col justify-end h-full min-h-[280px]">
					<?php if ( $image_eyebrow ) : ?>
					<p class="text-sm font-bold text-white/70 mb-2 uppercase tracking-widest">
						<?php echo esc_html( $image_eyebrow ); ?>
					</p>
					<?php endif; ?>
					<?php if ( $image_title ) : ?>
					<h3 class="h3 font-display font-bold text-white">
						<?php echo wp_kses_post( $image_title ); ?>
					</h3>
					<?php endif; ?>
				</div>

			</div>
			<!-- ===================== END LEFT ===================== -->

			<!-- ===================== RIGHT: Form Panel ===================== -->
			<div class="<?php echo esc_attr( $bg_class ); ?> p-8 lg:p-10">

				<?php if ( $form_id && function_exists( 'gravity_form' ) ) : ?>
					<?php if ( $is_preview ) : ?>
					<div class="bg-white/60 rounded-lg px-4 py-6 text-center text-sm text-gray-500">
						Gravity Form #<?php echo intval( $form_id ); ?> will render here on the front end.
					</div>
					<?php else : ?>
					<?php gravity_form( $form_id, false, false, false, null, true ); ?>
					<?php endif; ?>
				<?php elseif ( $is_preview ) : ?>
				<div class="bg-white/60 rounded-lg px-4 py-6 text-center text-sm text-gray-500">
					Select a Gravity Form in the block settings (Form tab).
				</div>
				<?php endif; ?>

			</div>
			<!-- ===================== END RIGHT ===================== -->

		</div>

	</div>
</section>
