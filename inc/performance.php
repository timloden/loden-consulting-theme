<?php
/**
 * Performance optimizations
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Disable emoji scripts
 */
function loden_consulting_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE.
	add_filter( 'tiny_mce_plugins', 'loden_consulting_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'loden_consulting_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'loden_consulting_disable_emojis' );

/**
 * Filter function used to remove the TinyMCE emoji plugin.
 *
 * @param array $plugins Array of TinyMCE plugins.
 * @return array
 */
function loden_consulting_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
	return array();
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array  $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function loden_consulting_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/**
 * Remove jQuery migrate on frontend (keep for admin compatibility)
 *
 * @param WP_Scripts $scripts The WP_Scripts object.
 */
function loden_consulting_remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'loden_consulting_remove_jquery_migrate' );

/**
 * Remove unnecessary meta tags from head
 */
function loden_consulting_remove_head_junk() {
	// Remove RSD link.
	remove_action( 'wp_head', 'rsd_link' );

	// Remove Windows Live Writer manifest.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove WordPress generator tag.
	remove_action( 'wp_head', 'wp_generator' );

	// Remove REST API link.
	remove_action( 'wp_head', 'rest_output_link_wp_head' );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	// Remove adjacent posts links.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
}
add_action( 'init', 'loden_consulting_remove_head_junk' );

/**
 * Add native lazy loading to images
 *
 * @param array $attr Image attributes.
 * @return array
 */
function loden_consulting_lazy_loading_attribute( $attr ) {
	if ( ! isset( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}

	// Add decoding attribute for better performance.
	if ( ! isset( $attr['decoding'] ) ) {
		$attr['decoding'] = 'async';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'loden_consulting_lazy_loading_attribute' );

/**
 * Add fetchpriority="high" to featured images above the fold
 *
 * @param array        $attr       Attributes array.
 * @param WP_Post      $attachment Image attachment post.
 * @param string|int[] $size       Requested image size.
 * @return array
 */
function loden_consulting_featured_image_priority( $attr, $attachment, $size ) {
	// Add high priority for featured images on single posts/pages.
	if ( is_singular() && has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id();
		if ( $thumbnail_id === $attachment->ID ) {
			$attr['fetchpriority'] = 'high';
			$attr['loading']       = 'eager';
		}
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'loden_consulting_featured_image_priority', 10, 3 );

/**
 * Disable self-pingbacks
 *
 * @param array $links Array of links.
 */
function loden_consulting_disable_self_pingback( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link ) {
		if ( 0 === strpos( $link, $home ) ) {
			unset( $links[ $l ] );
		}
	}
}
add_action( 'pre_ping', 'loden_consulting_disable_self_pingback' );

/**
 * Limit post revisions to reduce database bloat
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 5 );
}

/**
 * Disable XML-RPC for security (unless you need it)
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove Dashicons on frontend for non-logged-in users
 */
function loden_consulting_dequeue_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'loden_consulting_dequeue_dashicons' );

/**
 * Remove WordPress global styles and SVG filters
 *
 * This prevents theme.json-generated styles from conflicting with Tailwind CSS.
 * Design tokens are managed in src/css/config.css instead.
 */
function loden_consulting_remove_global_styles() {
	// Remove global styles from frontend.
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

	// Remove SVG filters that are added to the page.
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

	// Remove block library styles if not using core blocks.
	// Uncomment if you only use ACF blocks:
	// wp_dequeue_style( 'wp-block-library' );
	// wp_dequeue_style( 'wp-block-library-theme' );

	// Remove classic theme styles.
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'loden_consulting_remove_global_styles', 20 );

/**
 * Remove global styles from block editor
 */
function loden_consulting_remove_editor_global_styles() {
	remove_action( 'admin_init', 'wp_add_global_styles_for_blocks' );
}
add_action( 'after_setup_theme', 'loden_consulting_remove_editor_global_styles' );

/**
 * Optimize heartbeat API
 */
function loden_consulting_heartbeat_settings( $settings ) {
	// Reduce heartbeat frequency on post edit screens.
	$settings['interval'] = 60; // Default is 15 seconds.
	return $settings;
}
add_filter( 'heartbeat_settings', 'loden_consulting_heartbeat_settings' );

/**
 * Disable heartbeat on frontend (where it's rarely needed)
 */
function loden_consulting_disable_frontend_heartbeat() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'heartbeat' );
	}
}
add_action( 'init', 'loden_consulting_disable_frontend_heartbeat', 1 );
