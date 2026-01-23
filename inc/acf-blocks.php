<?php
/**
 * ACF Blocks registration and functionality
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF block category
 *
 * @param array $categories Block categories.
 * @return array
 */
function loden_consulting_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'loden-consulting',
				'title' => __( 'Loden Consulting', 'loden-consulting' ),
				'icon'  => 'star-filled',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'loden_consulting_block_categories', 10 );

/**
 * Auto-register ACF blocks from the blocks directory
 */
function loden_consulting_register_acf_blocks() {
	// Check if ACF is active.
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$blocks_dir = get_template_directory() . '/blocks';

	// Check if blocks directory exists.
	if ( ! is_dir( $blocks_dir ) ) {
		return;
	}

	// Get all block directories.
	$blocks = glob( $blocks_dir . '/*/block.json' );

	foreach ( $blocks as $block ) {
		$block_dir = dirname( $block );

		// Register the block using block.json.
		register_block_type( $block_dir );
	}
}
add_action( 'init', 'loden_consulting_register_acf_blocks' );

/**
 * Set ACF JSON save point
 *
 * @param string $path Path to save ACF JSON.
 * @return string
 */
function loden_consulting_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'loden_consulting_acf_json_save_point' );

/**
 * Set ACF JSON load point
 *
 * @param array $paths Paths to load ACF JSON from.
 * @return array
 */
function loden_consulting_acf_json_load_point( $paths ) {
	// Remove original path.
	unset( $paths[0] );

	// Add custom path.
	$paths[] = get_template_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'loden_consulting_acf_json_load_point' );

/**
 * Helper function to get block wrapper attributes
 *
 * @param array $block     Block data.
 * @param array $add_class Additional classes to add.
 * @return string
 */
function loden_consulting_get_block_wrapper_attributes( $block, $add_class = array() ) {
	$classes = array( 'acf-block' );

	// Add block name as class.
	if ( isset( $block['name'] ) ) {
		$classes[] = 'acf-block-' . str_replace( 'acf/', '', $block['name'] );
	}

	// Add alignment class.
	if ( isset( $block['align'] ) ) {
		$classes[] = 'align' . $block['align'];
	}

	// Add custom classes from block settings.
	if ( isset( $block['className'] ) ) {
		$classes[] = $block['className'];
	}

	// Add any additional classes.
	$classes = array_merge( $classes, (array) $add_class );

	// Build attributes array.
	$attributes = array(
		'class' => implode( ' ', array_filter( $classes ) ),
	);

	// Add block ID if set.
	if ( isset( $block['anchor'] ) && $block['anchor'] ) {
		$attributes['id'] = $block['anchor'];
	}

	// Build attribute string.
	$attr_string = '';
	foreach ( $attributes as $key => $value ) {
		$attr_string .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
	}

	return trim( $attr_string );
}

/**
 * Helper function to check if we're in block editor preview
 *
 * @return bool
 */
function loden_consulting_is_block_preview() {
	return isset( $_GET['context'] ) && 'edit' === $_GET['context'];
}

/**
 * Enqueue block-specific styles
 *
 * @param string $block_name Block name (without acf/ prefix).
 */
function loden_consulting_enqueue_block_style( $block_name ) {
	$style_path = get_template_directory() . '/blocks/' . $block_name . '/style.css';
	$style_url  = get_template_directory_uri() . '/blocks/' . $block_name . '/style.css';

	if ( file_exists( $style_path ) ) {
		wp_enqueue_style(
			'acf-block-' . $block_name,
			$style_url,
			array(),
			filemtime( $style_path )
		);
	}
}

/**
 * Enqueue block-specific scripts
 *
 * @param string $block_name Block name (without acf/ prefix).
 */
function loden_consulting_enqueue_block_script( $block_name ) {
	$script_path = get_template_directory() . '/blocks/' . $block_name . '/script.js';
	$script_url  = get_template_directory_uri() . '/blocks/' . $block_name . '/script.js';

	if ( file_exists( $script_path ) ) {
		wp_enqueue_script(
			'acf-block-' . $block_name,
			$script_url,
			array(),
			filemtime( $script_path ),
			true
		);
	}
}

/**
 * Add default inner blocks support
 *
 * @param array $block_settings Block settings.
 * @param array $block_content  Block content.
 * @return array
 */
function loden_consulting_block_inner_blocks_support( $block_settings, $block_content ) {
	// Allow inner blocks in ACF blocks.
	$block_settings['supports']['jsx'] = true;

	return $block_settings;
}
// add_filter( 'acf/register_block_type_args', 'loden_consulting_block_inner_blocks_support', 10, 2 );
