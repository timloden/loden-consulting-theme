<?php
/**
 * Mobile Navigation Walker
 *
 * Custom Walker_Nav_Menu that outputs the full-screen mobile menu structure.
 *
 * Top-level items:
 *   - Simple links render as <a class="mobile-nav-link">
 *   - Items with children render as <button class="mobile-nav-link mobile-nav-toggle">
 *     with the brand down-arrow SVG; JS toggles .is-open / aria-expanded.
 *
 * Sub-menu items (depth 1) render as <a class="mobile-sub-link">.
 * Supports up to 2 levels (depth 0 = top, depth 1 = sub-menu).
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Loden_Mobile_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Stores the ID of the current top-level parent item so start_lvl()
	 * can add a matching id="" attribute for aria-controls.
	 *
	 * @var int
	 */
	private int $current_parent_id = 0;

	/**
	 * Down-arrow SVG — stroke="currentColor" so CSS controls colour.
	 */
	private function arrow_svg(): string {
		return '<span class="mobile-nav-arrow-wrap" aria-hidden="true">'
			. '<svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none" class="mobile-nav-arrow-icon">'
			. '<path d="M9.75 6.83333L5.375 11M5.375 11L1 6.83333M5.375 11L5.375 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
			. '</svg>'
			. '</span>';
	}

	// -------------------------------------------------------------------------
	// List item opening — <li>
	// -------------------------------------------------------------------------

	/**
	 * @param string   $output
	 * @param \WP_Post $data_object  Menu item post object.
	 * @param int      $depth
	 * @param object   $args
	 * @param int      $current_object_id
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item        = $data_object;
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true );
		$is_current   = in_array( 'current-menu-item', $classes, true )
		                || in_array( 'current-menu-ancestor', $classes, true );

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$url   = empty( $item->url ) ? '#' : esc_url( $item->url );

		if ( 0 === $depth ) {
			// ── Top-level item ────────────────────────────────────────────────

			$this->current_parent_id = $item->ID;

			$li_class = 'mobile-nav-item'
				. ( $has_children ? ' has-children' : '' )
				. ( $is_current   ? ' is-current'   : '' );

			$output .= '<li class="' . esc_attr( $li_class ) . '">';

			if ( $has_children ) {
				// Render as toggle button (no navigation on the parent itself).
				$output .= '<button'
					. ' class="mobile-nav-link mobile-nav-toggle"'
					. ' aria-expanded="false"'
					. ' aria-controls="mobile-sub-' . absint( $item->ID ) . '"'
					. '>'
					. esc_html( $title )
					. $this->arrow_svg()
					. '</button>';
			} else {
				// Render as a regular link.
				$attr_title  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
				$target      = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
				$rel         = ( '_blank' === $item->target ) ? ' rel="noopener noreferrer"' : '';

				$output .= '<a'
					. ' href="' . $url . '"'
					. ' class="mobile-nav-link"'
					. $attr_title
					. $target
					. $rel
					. '>'
					. esc_html( $title )
					. '</a>';
			}
		} else {
			// ── Sub-menu item (depth 1) ───────────────────────────────────────

			$attr_title = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$target     = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$rel        = ( '_blank' === $item->target ) ? ' rel="noopener noreferrer"' : '';

			$sub_class = 'mobile-sub-item' . ( $is_current ? ' is-current' : '' );

			$output .= '<li class="' . esc_attr( $sub_class ) . '">'
				. '<a'
				. ' href="' . $url . '"'
				. ' class="mobile-sub-link"'
				. $attr_title
				. $target
				. $rel
				. '>'
				. esc_html( $title )
				. '</a>';
		}
	}

	// -------------------------------------------------------------------------
	// List item closing — </li>
	// -------------------------------------------------------------------------

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}

	// -------------------------------------------------------------------------
	// Sub-menu opening — <ul>
	// -------------------------------------------------------------------------

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul'
			. ' id="mobile-sub-' . absint( $this->current_parent_id ) . '"'
			. ' class="mobile-sub-nav"'
			. ' role="list"'
			. '>';
	}

	// -------------------------------------------------------------------------
	// Sub-menu closing — </ul>
	// -------------------------------------------------------------------------

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}
}
