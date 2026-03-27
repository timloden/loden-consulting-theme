<?php

/**
 * Loden Consulting Theme functions and definitions
 *
 * @package Loden_Consulting
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Theme version
 */
define('LODEN_CONSULTING_VERSION', '1.0.0');

/**
 * Theme setup
 */
function loden_consulting_setup()
{
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title.
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary Menu', 'loden-consulting'),
			'footer'  => esc_html__('Footer Menu', 'loden-consulting'),
			'mobile'  => esc_html__('Mobile Menu', 'loden-consulting'),
		)
	);

	// Switch default core markup to valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for editor styles.
	add_theme_support('editor-styles');
	add_editor_style('style-editor.css');

	// Add support for responsive embeds.
	add_theme_support('responsive-embeds');

	// Add support for wide and full width alignments.
	add_theme_support('align-wide');

	// Add support for custom spacing.
	add_theme_support('custom-spacing');

	// Add support for custom line height.
	add_theme_support('custom-line-height');

	// Disable custom colors in block editor (use theme colors).
	// add_theme_support( 'disable-custom-colors' );

	// Disable custom font sizes (use theme sizes).
	// add_theme_support( 'disable-custom-font-sizes' );
}
add_action('after_setup_theme', 'loden_consulting_setup');

/**
 * Set the content width in pixels.
 */
function loden_consulting_content_width()
{
	$GLOBALS['content_width'] = apply_filters('loden_consulting_content_width', 1280);
}
add_action('after_setup_theme', 'loden_consulting_content_width', 0);

/**
 * Register widget areas.
 */
function loden_consulting_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'loden-consulting'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'loden-consulting'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer 1', 'loden-consulting'),
			'id'            => 'footer-1',
			'description'   => esc_html__('First footer widget area.', 'loden-consulting'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer 2', 'loden-consulting'),
			'id'            => 'footer-2',
			'description'   => esc_html__('Second footer widget area.', 'loden-consulting'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer 3', 'loden-consulting'),
			'id'            => 'footer-3',
			'description'   => esc_html__('Third footer widget area.', 'loden-consulting'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'loden_consulting_widgets_init');

/**
 * Include files
 */
require get_template_directory() . '/inc/class-mobile-nav-walker.php';
require get_template_directory() . '/inc/class-desktop-nav-walker.php';
require get_template_directory() . '/inc/assets.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/performance.php';
require get_template_directory() . '/inc/svg-support.php';
require get_template_directory() . '/inc/acf-blocks.php';

/**
 * WooCommerce support
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}
