<?php

/**
 * How It Works - Steps Block
 *
 * Renders a contained panel with a rounded, light-blue background.
 * Includes an optional eyebrow badge, title, header image, numbered steps,
 * two CTA buttons, and an optional footer note.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner HTML (unused).
 * @param bool   $is_preview True during editor preview render.
 * @param int    $post_id    Post ID.
 *
 * @package Loden_Consulting
 */

$eyebrow             = get_field('hiw_eyebrow');
$title               = get_field('hiw_title');
$title_highlight     = get_field('hiw_title_highlight');
$header_image        = get_field('hiw_header_image');
$steps               = get_field('hiw_steps') ?: [];
$primary_cta_text    = get_field('hiw_primary_cta_text');
$primary_cta_url     = get_field('hiw_primary_cta_url');
$secondary_cta_text  = get_field('hiw_secondary_cta_text');
$secondary_cta_url   = get_field('hiw_secondary_cta_url');
$footer_note         = get_field('hiw_footer_note');
$has_ctas            = $primary_cta_text || $secondary_cta_text;

if (empty($steps) && $is_preview) {
	echo '<div class="py-10 text-center text-gray-400 p3">Add steps in the block settings panel.</div>';
	return;
}

$wrapper_attributes = loden_consulting_get_block_wrapper_attributes(
	$block,
	['py-16', 'lg:py-20']
);

// Step number circle colours — cycles if there are more than 3 steps.
$step_colors = [
	'bg-simple-blue text-white',
	'bg-green-500 text-white',
	'bg-orange-500 text-white',
	'bg-purple-500 text-white',
];

// Actual CSS color values matching the bg classes above (for gradient connector lines).
$step_color_values = [
	'var(--color-simple-blue)',
	'#22c55e',
	'#f97316',
	'#a855f7',
];

$is_phone_secondary = $secondary_cta_url && str_starts_with($secondary_cta_url, 'tel:');
$phone_svg = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16.5 12.69C16.5 12.93 16.446 13.176 16.332 13.416C16.218 13.656 16.068 13.884 15.87 14.094C15.534 14.46 15.162 14.634 14.772 14.634C14.448 14.634 14.1 14.55 13.722 14.376C13.338 14.202 12.954 13.968 12.576 13.674C12.192 13.374 11.826 13.044 11.478 12.69L6.306 7.518C5.952 7.164 5.622 6.798 5.322 6.42C5.028 6.042 4.794 5.664 4.626 5.286C4.452 4.908 4.368 4.554 4.368 4.236C4.368 3.852 4.536 3.48 4.896 3.144C5.256 2.802 5.64 2.634 6.048 2.634C6.198 2.634 6.348 2.664 6.48 2.724C6.618 2.784 6.738 2.874 6.834 3.006L8.454 5.274C8.556 5.4 8.628 5.52 8.682 5.634C8.736 5.742 8.766 5.844 8.766 5.934C8.766 6.048 8.736 6.162 8.67 6.27C8.61 6.378 8.52 6.486 8.406 6.6L8.034 6.984C7.986 7.032 7.962 7.086 7.962 7.152C7.962 7.188 7.968 7.218 7.98 7.254C7.998 7.29 8.016 7.32 8.028 7.35C8.124 7.524 8.286 7.746 8.514 8.01C8.748 8.274 8.994 8.544 9.264 8.814C9.546 9.084 9.81 9.336 10.08 9.564C10.344 9.786 10.566 9.942 10.746 10.038C10.77 10.05 10.8 10.068 10.836 10.086C10.878 10.104 10.914 10.11 10.956 10.11C11.022 10.11 11.082 10.08 11.13 10.032L11.502 9.666C11.622 9.546 11.736 9.456 11.844 9.396C11.952 9.33 12.06 9.3 12.18 9.3C12.27 9.3 12.366 9.324 12.48 9.378C12.594 9.432 12.714 9.504 12.84 9.6L15.132 11.238C15.264 11.334 15.354 11.448 15.408 11.58C15.456 11.712 15.486 11.838 15.486 11.994L16.5 12.69Z" fill="currentColor"/></svg>';
?>

<section <?php echo $wrapper_attributes; ?>>
	<div class="container mx-auto px-6 bg-sky-blue-30 rounded-3xl">

		<!-- Panel -->
		<div class=" px-8 py-10 lg:px-12 lg:py-12 max-w-[860px] mx-auto text-center">

			<?php if ($eyebrow) : ?>
				<span class="inline-flex items-center px-4 py-1.5 mb-6 rounded-full bg-white border border-gray-200 text-xs font-semibold uppercase tracking-[0.15em] text-gray-500">
					<?php echo esc_html($eyebrow); ?>
				</span>
			<?php endif; ?>

			<?php if ($title || $title_highlight) : ?>
				<h2 class="h3 text-dark-blue mb-4">
					<?php if ($title) echo wp_kses_post($title); ?>
					<?php if ($title_highlight) : ?>
						<span class="text-simple-blue"><?php echo esc_html($title_highlight); ?></span>
					<?php endif; ?>
				</h2>
			<?php endif; ?>

			<?php if ($header_image && ! empty($header_image['url'])) : ?>
				<div class="relative mt-6 mb-8 rounded-xl overflow-hidden">
					<img src="<?php echo esc_url($header_image['url']); ?>"
						alt="<?php echo esc_attr($header_image['alt'] ?? ''); ?>"
						class="w-full h-auto object-cover rounded-xl">
				</div>
			<?php endif; ?>

			<?php if (! empty($steps)) : ?>
				<!-- Steps -->
				<div class="text-left mt-8 space-y-0">
					<?php foreach ($steps as $i => $step) :
						$step_title    = $step['hiw_step_title']    ?? '';
						$step_text     = $step['hiw_step_text']     ?? '';
						$step_note     = $step['hiw_step_note']     ?? '';
						$step_num        = $i + 1;
						$color_class     = $step_colors[$i % count($step_colors)];
						$is_last_step    = ($i === count($steps) - 1);
						$current_color   = $step_color_values[$i % count($step_color_values)];
						$next_color      = $is_last_step ? 'transparent' : $step_color_values[($i + 1) % count($step_color_values)];
						$line_style      = 'background: linear-gradient(to bottom, ' . $current_color . ', ' . $next_color . ');';
					?>
						<div class="flex gap-4 <?php echo $is_last_step ? '' : ''; ?> relative">

							<!-- Number circle + connector line -->
							<div class="flex flex-col items-center shrink-0">
								<div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-h6 <?php echo esc_attr($color_class); ?> shrink-0 z-10">
									<?php echo $step_num; ?>
								</div>
								<div class="w-[6px] flex-1" style="<?php echo esc_attr($line_style); ?>"></div>
							</div>

							<!-- Step content -->
							<div class="pt-1 pb-8">
								<?php if ($step_title) : ?>
									<h3 class="h6 text-dark-blue mb-1"><?php echo esc_html($step_title); ?></h3>
								<?php endif; ?>

								<?php if ($step_text) : ?>
									<p class="p3 text-gray-600"><?php echo nl2br(esc_html($step_text)); ?></p>
								<?php endif; ?>

								<?php if ($step_note) : ?>
									<p class="p4 text-simple-blue italic mt-1"><?php echo esc_html($step_note); ?></p>
								<?php endif; ?>
							</div>

						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ($has_ctas) : ?>
				<div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
					<?php if ($primary_cta_text && $primary_cta_url) : ?>
						<a href="<?php echo esc_url($primary_cta_url); ?>" class="btn-cta w-full sm:w-auto justify-center">
							<?php echo esc_html($primary_cta_text); ?>
						</a>
					<?php endif; ?>

					<?php if ($secondary_cta_text && $secondary_cta_url) : ?>
						<a href="<?php echo esc_url($secondary_cta_url); ?>" class="btn-phone w-full sm:w-auto justify-center">
							<?php if ($is_phone_secondary) echo $phone_svg; ?>
							<?php echo esc_html($secondary_cta_text); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($footer_note) : ?>
				<p class="p4 text-gray-400 mt-6"><?php echo esc_html($footer_note); ?></p>
			<?php endif; ?>

		</div>
	</div>
</section>