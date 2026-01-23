<?php
/**
 * Example Block
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package Loden_Consulting
 */

// Get block fields.
$heading = get_field( 'heading' ) ?: 'Example Block';
$content = get_field( 'content' ) ?: 'Add your content here.';
$button_text = get_field( 'button_text' );
$button_link = get_field( 'button_link' );

// Build wrapper attributes.
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes( $block, array( 'bg-gray-100', 'py-12' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-4 text-center">
		<?php if ( $heading ) : ?>
			<h2 class="text-3xl font-bold mb-4"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $content ) : ?>
			<div class="prose prose-lg mx-auto mb-6">
				<?php echo wp_kses_post( $content ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $button_text && $button_link ) : ?>
			<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary">
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif; ?>

		<?php
		// Support for inner blocks (optional).
		$allowed_blocks = array( 'core/paragraph', 'core/heading', 'core/image', 'core/list' );
		$template = array(
			array( 'core/paragraph', array( 'placeholder' => 'Add additional content here...' ) ),
		);
		?>
		<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" />
	</div>
</section>
