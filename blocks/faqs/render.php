<?php
/**
 * FAQs Block
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package Loden_Consulting
 */

// Header fields.
$eyebrow  = get_field( 'faq_eyebrow' );
$title    = get_field( 'faq_title' );
$cta_text = get_field( 'faq_cta_text' );
$cta_url  = get_field( 'faq_cta_url' );

// FAQ items.
$items = get_field( 'faq_items' ) ?: [];

// Block ID — used to scope radio inputs so multiple FAQ blocks on a page don't interfere.
$block_id = $block['id'] ?? uniqid( 'faq-' );

// Wrapper attributes.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes( $block );
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6 py-16 lg:py-24">

		<?php if ( $eyebrow || $title || ( $cta_text && $cta_url ) ) : ?>
		<div class="text-center mb-10">

			<?php if ( $eyebrow ) : ?>
			<span class="inline-flex items-center px-4 py-1.5 mb-5 rounded-full bg-sky-blue-30 border border-gray-300 text-xs font-semibold uppercase tracking-[0.15em] text-gray-500">
				<?php echo esc_html( $eyebrow ); ?>
			</span>
			<?php endif; ?>

			<?php if ( $title ) : ?>
			<h2 class="h2 font-display font-bold text-dark-blue mb-6">
				<?php echo wp_kses_post( $title ); ?>
			</h2>
			<?php endif; ?>

			<?php if ( $cta_text && $cta_url ) : ?>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="btn-cta">
				<?php echo esc_html( $cta_text ); ?>
			</a>
			<?php endif; ?>

		</div>
		<?php endif; ?>

		<?php if ( ! empty( $items ) ) : ?>
		<div class="max-w-2xl mx-auto mt-10 space-y-3">

			<?php foreach ( $items as $i => $item ) :
				$question = esc_html( $item['faq_question'] ?? '' );
				$answer   = wp_kses_post( $item['faq_answer'] ?? '' );
				if ( ! $question ) { continue; }
			?>
			<div class="collapse collapse-plus bg-white border border-gray-200 rounded-xl">
				<input type="radio"
				       name="faq-<?php echo esc_attr( $block_id ); ?>"
				       <?php echo ( 0 === $i ) ? 'checked' : ''; ?> />
				<div class="collapse-title h5 font-bold text-dark-blue py-5 pr-12">
					<?php echo $question; ?>
				</div>
				<div class="collapse-content">
					<div class="p3 text-gray-600 pb-4">
						<?php echo $answer; ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>

		</div>
		<?php elseif ( $is_preview ) : ?>
		<div class="max-w-2xl mx-auto mt-10 bg-gray-100 rounded-xl px-6 py-8 text-center text-sm text-gray-500">
			Add FAQ items in the block settings (FAQs tab).
		</div>
		<?php endif; ?>

	</div>
</section>
