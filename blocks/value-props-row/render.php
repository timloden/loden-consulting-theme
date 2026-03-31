<?php

/**
 * Value Props Row Block
 *
 * Renders a trust/social-proof bar with an optional title + subtitle on the
 * left and up to 4 value proposition items on the right. Each item supports
 * two styles:
 *   - review  : icon, numeric rating, star rating, and a label
 *   - stat    : icon, value text, and a label
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for this block).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering against.
 *
 * @package Loden_Consulting
 */

// Header fields (all optional).
$title           = get_field('vpr_title');
$title_highlight = get_field('vpr_title_highlight');
$subtitle        = get_field('vpr_subtitle');

// Repeater.
$props      = get_field('vpr_value_props') ?: [];
$total      = count($props);
$has_header = $title || $title_highlight || $subtitle;

// Show editor placeholder when the block has no content yet.
if (empty($props) && $is_preview) {
	echo '<div class="py-10 text-center text-gray-400 bg-sky-blue-30 p3">Add value prop items in the block settings panel.</div>';
	return;
}

// Wrapper attributes.
// rounded-tl-[2rem] rounded-tr-[2rem] : both top corners rounded on mobile
// lg:rounded-tr-none                  : remove right corner on desktop (top-left only)
// -mt-8                               : negative margin matching the 2rem radius so the
//                                       section overlaps the block above it
$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	['bg-sky-blue-30', 'py-10', 'lg:py-12', 'rounded-tl-[1rem]', 'rounded-tr-[1rem]', 'lg:rounded-tr-none', '-mt-8', 'relative', 'z-10']
);

// Grid column classes for the props grid (full strings so Tailwind's scanner
// picks up every variant at build time).
$grid_col_classes = [
	1 => 'grid-cols-1 lg:grid-cols-1',
	2 => 'grid-cols-2 lg:grid-cols-2',
	3 => 'grid-cols-2 lg:grid-cols-3',
	4 => 'grid-cols-2 lg:grid-cols-4',
];
$grid_class = $grid_col_classes[min($total, 4)] ?? 'grid-cols-2 lg:grid-cols-4';

// Precompute border divider classes for each grid cell.
//
// Mobile layout  : 2 columns  →  left column gets border-r, top row gets border-b.
// Desktop layout : 1 row      →  all cells except the last get border-r; no border-b.
$border_class = [];
for ($i = 0; $i < $total; $i++) {
	$col     = $i % 2;
	$row     = intdiv($i, 2);
	$is_last = ($i === $total - 1);
	$b       = [];

	// Desktop: right border on every cell except the last.
	if (! $is_last) {
		$b[] = 'lg:border-r';
	}

	// Mobile left column: right border when a right sibling exists.
	if (0 === $col && $i + 1 < $total) {
		$b[] = 'border-r';
	}

	// Mobile first row: bottom border when there is a second row.
	if (0 === $row && $total > 2) {
		$b[] = 'border-b lg:border-b-0';
	}

	if (! empty($b)) {
		$b[] = 'border-gray-200';
	}

	$border_class[$i] = implode(' ', $b);
}

// Filled star SVG used for review-type items.
$star = '<svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true">'
	. '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>'
	. '</svg>';

/**
 * Render a single value prop cell.
 * Extracted to avoid duplicating the markup for the with-header and no-header paths.
 */
$render_prop = function ($prop, $border, $star) {
	$type       = $prop['vpr_prop_type'] ?? 'stat';
	$icon       = $prop['vpr_prop_icon'] ?? null;
	$prop_value = $prop['vpr_prop_value'] ?? '';
	$prop_label = $prop['vpr_prop_label'] ?? '';
	$star_count = intval($prop['vpr_prop_star_count'] ?? 5);
?>
	<div class="flex items-center justify-center gap-3 px-4 py-4 lg:px-6 lg:py-0 <?php echo esc_attr($border); ?>">

		<?php if ($icon && ! empty($icon['url'])) : ?>
			<img src="<?php echo esc_url($icon['url']); ?>"
				alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>"
				class="w-9 h-9 object-contain shrink-0"
				width="36" height="36">
		<?php endif; ?>

		<div>
			<?php if ($prop_value) : ?>
				<p class="text-2xl font-bold text-dark-blue leading-none"><?php echo esc_html($prop_value); ?></p>
			<?php endif; ?>

			<?php if ('review' === $type && $star_count > 0) : ?>
				<div class="flex gap-0.5 text-gold-star mt-1.5 mb-1" aria-label="<?php echo esc_attr($star_count . ' out of 5 stars'); ?>">
					<?php for ($s = 0; $s < $star_count; $s++) echo $star; ?>
				</div>
			<?php endif; ?>

			<?php if ($prop_label) : ?>
				<p class="text-sm text-dark-blue/60 mt-1"><?php echo esc_html($prop_label); ?></p>
			<?php endif; ?>
		</div>

	</div>
<?php
};
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6">

		<?php if ($has_header) : ?>

			<!-- Two-column grid: title/subtitle left (~330px), props right (flex-1) -->
			<div class="grid grid-cols-1 lg:grid-cols-[330px_1fr] gap-8 lg:gap-12 lg:items-center">

				<!-- ==================== LEFT: Title + Subtitle ==================== -->
				<div>

					<?php if ($title || $title_highlight) : ?>
						<h2 class="h4 text-dark-blue leading-tight">
							<?php if ($title) echo wp_kses_post($title); ?>
							<?php if ($title_highlight) : ?>
								<span class="text-simple-blue"><?php echo esc_html($title_highlight); ?></span>
							<?php endif; ?>
						</h2>
					<?php endif; ?>

					<?php if ($subtitle) : ?>
						<p class="p2 text-dark-blue/70 mt-3"><?php echo esc_html($subtitle); ?></p>
					<?php endif; ?>

				</div>
				<!-- ==================== END LEFT ==================== -->

				<!-- ==================== RIGHT: Props Grid ==================== -->
				<div class="grid <?php echo esc_attr($grid_class); ?>">
					<?php foreach ($props as $i => $prop) :
						$render_prop($prop, $border_class[$i] ?? '', $star);
					endforeach; ?>
				</div>
				<!-- ==================== END RIGHT ==================== -->

			</div>

		<?php else : ?>

			<!-- No header: value props span the full container width -->
			<div class="grid <?php echo esc_attr($grid_class); ?>">
				<?php foreach ($props as $i => $prop) :
					$render_prop($prop, $border_class[$i] ?? '', $star);
				endforeach; ?>
			</div>

		<?php endif; ?>

	</div>
</section>