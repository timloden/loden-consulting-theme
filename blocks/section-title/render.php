<?php

/**
 * Section Title Block
 *
 * Centered section heading with optional eyebrow badge, title (with optional
 * accent-coloured highlight suffix), and subtitle.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$eyebrow         = get_field('st_eyebrow');
$title           = get_field('st_title');
$title_highlight = get_field('st_title_highlight');
$subtitle        = get_field('st_subtitle');

// Nothing to render.
if (! $eyebrow && ! $title && ! $title_highlight && ! $subtitle) {
	if ($is_preview) {
		echo '<div class="py-10 text-center text-gray-400 p3">Add content in the block settings panel.</div>';
	}
	return;
}

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	['py-16']
);
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6 text-center">

		<?php if ($eyebrow) : ?>
			<div class="bg-sky-blue-30 inline-flex items-center px-4 py-1.5 mb-6 rounded-full border border-gray-300 text-xs font-semibold uppercase tracking-[0.15em] text-gray-500">
				<?php echo esc_html($eyebrow); ?>
			</div>
		<?php endif; ?>

		<?php if ($title || $title_highlight) : ?>
			<h2 class="h2 text-dark-blue mb-5">
				<?php if ($title) echo wp_kses_post($title); ?>
				<?php if ($title_highlight) : ?>
					<span class="text-simple-blue"><?php echo esc_html($title_highlight); ?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>

		<?php if ($subtitle) : ?>
			<p class="p1 text-gray-500 max-w-2xl mx-auto"><?php echo esc_html($subtitle); ?></p>
		<?php endif; ?>

	</div>
</section>