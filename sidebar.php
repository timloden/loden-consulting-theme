<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Loden_Consulting
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area bg-gray-50 border-l border-gray-200">
	<div class="p-6">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>
