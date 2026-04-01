<?php

/**
 * Container with Background Block
 *
 * Full-width wrapper with a configurable solid colour or gradient background.
 * Inner blocks are rendered inside a centred container with configurable
 * vertical padding.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Rendered inner blocks HTML.
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$bg_type     = get_field('cbg_bg_type')     ?: 'color';
$color_preset = get_field('cbg_color_preset') ?: 'white';
$gradient    = get_field('cbg_gradient')     ?: 'none';
$padding_y   = get_field('cbg_padding_y')   ?: 'md';
$rounded     = get_field('cbg_rounded')      ?: 'none';

// Solid colour options.
$color_classes = [
	'white'        => 'bg-white',
	'light-blue'   => 'bg-sky-blue-30',
	'dark-blue'    => 'bg-dark-blue',
	'simple-blue'  => 'bg-simple-blue',
	'gray-50'      => 'bg-gray-50',
	'gray-100'     => 'bg-gray-100',
];

// Gradient options (inline style required for Tailwind arbitrary gradients).
$gradient_styles = [
	'none'               => '',
	'sky-to-white'       => 'background: linear-gradient(to bottom, var(--color-sky-blue-30, #dbeafe), #ffffff);',
	'white-to-sky'       => 'background: linear-gradient(to bottom, #ffffff, var(--color-sky-blue-30, #dbeafe));',
	'blue-diagonal'      => 'background: linear-gradient(135deg, var(--color-simple-blue, #2563eb) 0%, var(--color-dark-blue, #1e3a5f) 100%);',
	'light-blue-radial'  => 'background: radial-gradient(ellipse at 50% 0%, var(--color-sky-blue-30, #dbeafe) 0%, #ffffff 70%);',
];

// Vertical padding.
$padding_classes = [
	'none' => '',
	'sm'   => 'py-8 lg:py-10',
	'md'   => 'py-16 lg:py-20',
	'lg'   => 'py-20 lg:py-28',
	'xl'   => 'py-28 lg:py-36',
];

// Rounded corners.
$rounded_classes = [
	'none' => '',
	'lg'   => 'rounded-lg',
	'2xl'  => 'rounded-2xl',
	'3xl'  => 'rounded-3xl',
];

$bg_class       = ('color' === $bg_type) ? ($color_classes[$color_preset] ?? 'bg-white') : '';
$bg_style       = ('gradient' === $bg_type) ? ($gradient_styles[$gradient] ?? '') : '';
$padding_class  = $padding_classes[$padding_y] ?? $padding_classes['md'];
$rounded_class  = $rounded_classes[$rounded] ?? '';

$extra_classes = array_filter([$bg_class, $padding_class, $rounded_class]);

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	$extra_classes
);

$inner_blocks_template = array();

// Merge inline gradient style into wrapper attributes string.
if ($bg_style) {
	// Add style attribute safely.
	$wrapper_attributes = rtrim($wrapper_attributes, '>');
	if (str_contains($wrapper_attributes, 'style="')) {
		$wrapper_attributes = str_replace('style="', 'style="' . esc_attr($bg_style) . ' ', $wrapper_attributes);
	} else {
		$wrapper_attributes .= ' style="' . esc_attr($bg_style) . '"';
	}
}
?>

<div <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6">
		<InnerBlocks class="container-background-block-acf__innerblocks"
			template="<?php echo esc_attr(wp_json_encode($inner_blocks_template)); ?>" />
	</div>
</div>