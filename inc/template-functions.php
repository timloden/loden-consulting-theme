<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function loden_consulting_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add class for single posts.
	if ( is_single() ) {
		$classes[] = 'single-post-view';
	}

	// Add class for pages.
	if ( is_page() ) {
		$classes[] = 'page-view';
	}

	return $classes;
}
add_filter( 'body_class', 'loden_consulting_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function loden_consulting_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'loden_consulting_pingback_header' );

/**
 * Add custom classes to navigation menu items
 *
 * @param array    $classes The CSS classes applied to the menu item's <li> element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    Menu arguments.
 * @param int      $depth   Depth of menu item.
 * @return array
 */
function loden_consulting_nav_menu_css_class( $classes, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		$classes[] = 'menu-item-primary';

		if ( 0 === $depth ) {
			$classes[] = 'menu-item-top-level';
		}
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'loden_consulting_nav_menu_css_class', 10, 4 );

/**
 * Add custom classes to navigation menu links
 *
 * @param array    $atts Menu link attributes.
 * @param WP_Post  $item Menu item object.
 * @param stdClass $args Menu arguments.
 * @param int      $depth Depth of menu item.
 * @return array
 */
function loden_consulting_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		$existing_classes = isset( $atts['class'] ) ? $atts['class'] : '';
		$new_classes      = 'text-gray-700 hover:text-primary transition-colors';
		$atts['class']    = trim( $existing_classes . ' ' . $new_classes );
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'loden_consulting_nav_menu_link_attributes', 10, 4 );

/**
 * Modify the excerpt length
 *
 * @param int $length Excerpt length.
 * @return int
 */
function loden_consulting_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 25;
}
add_filter( 'excerpt_length', 'loden_consulting_excerpt_length' );

/**
 * Modify the excerpt more string
 *
 * @param string $more The string shown within the more link.
 * @return string
 */
function loden_consulting_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return '&hellip;';
}
add_filter( 'excerpt_more', 'loden_consulting_excerpt_more' );

/**
 * Get a trimmed excerpt with custom length
 *
 * @param int    $length Number of words.
 * @param int    $post_id Post ID.
 * @param string $more More string.
 * @return string
 */
function loden_consulting_get_excerpt( $length = 25, $post_id = null, $more = '&hellip;' ) {
	$post = get_post( $post_id );

	if ( ! $post ) {
		return '';
	}

	if ( $post->post_excerpt ) {
		$excerpt = $post->post_excerpt;
	} else {
		$excerpt = $post->post_content;
	}

	$excerpt = strip_shortcodes( $excerpt );
	$excerpt = excerpt_remove_blocks( $excerpt );
	$excerpt = wp_strip_all_tags( $excerpt );
	$excerpt = wp_trim_words( $excerpt, $length, $more );

	return $excerpt;
}

/**
 * Get post reading time
 *
 * @param int $post_id Post ID.
 * @return int Reading time in minutes.
 */
function loden_consulting_get_reading_time( $post_id = null ) {
	$post = get_post( $post_id );

	if ( ! $post ) {
		return 0;
	}

	$content    = $post->post_content;
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 ); // Average reading speed.

	return max( 1, $reading_time );
}

/**
 * Display reading time
 *
 * @param int $post_id Post ID.
 */
function loden_consulting_reading_time( $post_id = null ) {
	$reading_time = loden_consulting_get_reading_time( $post_id );

	printf(
		'<span class="reading-time text-gray-500 text-sm">%s</span>',
		sprintf(
			/* translators: %d: reading time in minutes */
			_n( '%d min read', '%d min read', $reading_time, 'loden-consulting' ),
			$reading_time
		)
	);
}

/**
 * Check if post has blocks
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function loden_consulting_has_blocks( $post_id = null ) {
	$post = get_post( $post_id );

	if ( ! $post ) {
		return false;
	}

	return has_blocks( $post->post_content );
}
