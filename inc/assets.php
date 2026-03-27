<?php
/**
 * Script and style enqueuing
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles
 */
function loden_consulting_scripts() {
	$theme_version = LODEN_CONSULTING_VERSION;
	$theme_uri     = get_template_directory_uri();
	$theme_path    = get_template_directory();

	// Google Fonts - Nunito Sans (primary font).
	wp_enqueue_style(
		'loden-consulting-google-fonts',
		'https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,400;0,6..12,700;0,6..12,800;1,6..12,400&display=swap',
		array(),
		null
	);

	// Main stylesheet with cache busting.
	$style_path = $theme_path . '/style.css';
	$style_ver  = file_exists( $style_path ) ? filemtime( $style_path ) : $theme_version;
	wp_enqueue_style( 'loden-consulting-style', $theme_uri . '/style.css', array(), $style_ver );

	// Main frontend script.
	$script_path = $theme_path . '/js/frontend.js';
	$script_ver  = file_exists( $script_path ) ? filemtime( $script_path ) : $theme_version;
	wp_enqueue_script(
		'loden-consulting-frontend',
		$theme_uri . '/js/frontend.js',
		array(),
		$script_ver,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'loden_consulting_scripts' );

/**
 * Enqueue block editor assets
 */
function loden_consulting_block_editor_assets() {
	$theme_version = LODEN_CONSULTING_VERSION;
	$theme_uri     = get_template_directory_uri();
	$theme_path    = get_template_directory();

	// Block editor script.
	$script_path = $theme_path . '/js/block-editor.js';
	$script_ver  = file_exists( $script_path ) ? filemtime( $script_path ) : $theme_version;

	$asset_file = $theme_path . '/js/block-editor.asset.php';
	$asset      = file_exists( $asset_file ) ? require $asset_file : array(
		'dependencies' => array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		'version'      => $script_ver,
	);

	wp_enqueue_script(
		'loden-consulting-block-editor',
		$theme_uri . '/js/block-editor.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'loden_consulting_block_editor_assets' );

/**
 * Add preconnect for external resources
 */
function loden_consulting_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => true,
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => true,
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'loden_consulting_resource_hints', 10, 2 );

/**
 * Add custom attributes to stylesheet link tags
 */
function loden_consulting_style_loader_tag( $html, $handle ) {
	// Add media print and onload for non-critical styles if needed.
	// if ( 'some-non-critical-style' === $handle ) {
	//     $html = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $html );
	// }

	return $html;
}
add_filter( 'style_loader_tag', 'loden_consulting_style_loader_tag', 10, 2 );
