<?php

/**
 * Footer Navigation Walkers
 *
 * Loden_Footer_Nav_Walker  — used for Services and Company columns.
 * Loden_Copyright_Nav_Walker — used for the bottom-bar copyright menu.
 *
 * @package Loden_Consulting
 */

// ──────────────────────────────────────────────────────────────────────────────
// Footer column walker
// Outputs a flat <ul> of styled links; nested items are suppressed.
// ──────────────────────────────────────────────────────────────────────────────
class Loden_Footer_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Suppress nested <ul> wrappers — footer columns are depth-1 only.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Render each top-level menu item.
	 *
	 * @param string   $output         Accumulated HTML.
	 * @param WP_Post  $data_object    Menu item object.
	 * @param int      $depth          Depth of menu item.
	 * @param stdClass $args           Menu arguments.
	 * @param int      $current_object_id Current object ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		if ( $depth > 0 ) {
			return; // Top-level only.
		}

		$url    = esc_url( $data_object->url );
		$title  = esc_html( $data_object->title );
		$target = $data_object->target ? ' target="' . esc_attr( $data_object->target ) . '"' : '';
		$rel    = '_blank' === ( $data_object->target ?? '' ) ? ' rel="noopener noreferrer"' : '';

		$output .= '<li>';
		$output .= '<a href="' . $url . '"' . $target . $rel . ' class="text-sm text-white/60 hover:text-white transition-colors">';
		$output .= $title;
		$output .= '</a>';
		$output .= '</li>';
	}

	/** Already closed in start_el — nothing to do. */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
}

// ──────────────────────────────────────────────────────────────────────────────
// Copyright bar walker
// Outputs bare <a> tags with a pipe separator before each one,
// intended to sit directly inside the copyright flex container.
// ──────────────────────────────────────────────────────────────────────────────
class Loden_Copyright_Nav_Walker extends Walker_Nav_Menu {

	/** No list-level wrappers. */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Render each copyright link with a leading pipe separator.
	 *
	 * @param string   $output         Accumulated HTML.
	 * @param WP_Post  $data_object    Menu item object.
	 * @param int      $depth          Depth of menu item.
	 * @param stdClass $args           Menu arguments.
	 * @param int      $current_object_id Current object ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		if ( $depth > 0 ) {
			return;
		}

		$url    = esc_url( $data_object->url );
		$title  = esc_html( $data_object->title );
		$target = $data_object->target ? ' target="' . esc_attr( $data_object->target ) . '"' : '';
		$rel    = '_blank' === ( $data_object->target ?? '' ) ? ' rel="noopener noreferrer"' : '';

		// Pipe separator before every item (mirrors the static layout).
		$output .= '<span class="text-white/20" aria-hidden="true">|</span>';
		$output .= '<a href="' . $url . '"' . $target . $rel . ' class="hover:text-white/70 transition-colors">';
		$output .= $title;
		$output .= '</a>';
	}

	/** Nothing to close — items are self-contained. */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
}
