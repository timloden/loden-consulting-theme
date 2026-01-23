<?php
/**
 * SVG upload support
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allow SVG uploads
 *
 * @param array $mimes Allowed mime types.
 * @return array
 */
function loden_consulting_allow_svg_upload( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

	return $mimes;
}
add_filter( 'upload_mimes', 'loden_consulting_allow_svg_upload' );

/**
 * Fix SVG file type detection
 *
 * @param array  $data     File data array.
 * @param string $file     Full path to the file.
 * @param string $filename The name of the file.
 * @param array  $mimes    Array of mime types keyed by extension.
 * @return array
 */
function loden_consulting_fix_svg_mime_type( $data, $file, $filename, $mimes ) {
	$ext = pathinfo( $filename, PATHINFO_EXTENSION );

	if ( 'svg' === strtolower( $ext ) ) {
		$data['type'] = 'image/svg+xml';
		$data['ext']  = 'svg';
	}

	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'loden_consulting_fix_svg_mime_type', 10, 4 );

/**
 * Sanitize SVG uploads for security
 *
 * @param string $file Path to the uploaded file.
 * @return string|WP_Error
 */
function loden_consulting_sanitize_svg( $file ) {
	// Only process SVG files.
	$file_ext = pathinfo( $file['name'], PATHINFO_EXTENSION );

	if ( 'svg' !== strtolower( $file_ext ) ) {
		return $file;
	}

	// Check if DOMDocument is available.
	if ( ! class_exists( 'DOMDocument' ) ) {
		return $file;
	}

	$svg_content = file_get_contents( $file['tmp_name'] );

	if ( false === $svg_content ) {
		$file['error'] = __( 'Unable to read SVG file.', 'loden-consulting' );
		return $file;
	}

	// Create DOMDocument and load SVG.
	$dom = new DOMDocument();
	$dom->formatOutput = false;
	$dom->preserveWhiteSpace = true;

	// Suppress errors for malformed SVG.
	libxml_use_internal_errors( true );

	$success = $dom->loadXML( $svg_content );

	libxml_clear_errors();

	if ( ! $success ) {
		$file['error'] = __( 'Invalid SVG file.', 'loden-consulting' );
		return $file;
	}

	// Remove potentially dangerous elements and attributes.
	$dangerous_tags = array(
		'script',
		'use',
		'foreignObject',
		'set',
		'animate',
		'animateMotion',
		'animateTransform',
	);

	foreach ( $dangerous_tags as $tag ) {
		$elements = $dom->getElementsByTagName( $tag );
		for ( $i = $elements->length - 1; $i >= 0; $i-- ) {
			$element = $elements->item( $i );
			$element->parentNode->removeChild( $element );
		}
	}

	// Remove event handlers and dangerous attributes.
	$dangerous_attributes = array(
		'onload',
		'onerror',
		'onclick',
		'onmouseover',
		'onmouseout',
		'onfocus',
		'onblur',
		'href', // Remove only javascript: hrefs below
		'xlink:href',
	);

	$xpath = new DOMXPath( $dom );

	// Remove event handler attributes.
	foreach ( $dangerous_attributes as $attr ) {
		// Skip href for now, we'll handle it specially.
		if ( 'href' === $attr || 'xlink:href' === $attr ) {
			continue;
		}

		$nodes = $xpath->query( '//*[@' . $attr . ']' );
		foreach ( $nodes as $node ) {
			$node->removeAttribute( $attr );
		}
	}

	// Handle href attributes - only remove if they contain javascript.
	$href_nodes = $xpath->query( '//*[@href]' );
	foreach ( $href_nodes as $node ) {
		$href_value = $node->getAttribute( 'href' );
		if ( preg_match( '/^\s*javascript:/i', $href_value ) ) {
			$node->removeAttribute( 'href' );
		}
	}

	$xlink_nodes = $xpath->query( '//*[@xlink:href]' );
	foreach ( $xlink_nodes as $node ) {
		$href_value = $node->getAttribute( 'xlink:href' );
		if ( preg_match( '/^\s*javascript:/i', $href_value ) ) {
			$node->removeAttribute( 'xlink:href' );
		}
	}

	// Save sanitized SVG.
	$sanitized_svg = $dom->saveXML();

	if ( false === $sanitized_svg ) {
		$file['error'] = __( 'Unable to process SVG file.', 'loden-consulting' );
		return $file;
	}

	file_put_contents( $file['tmp_name'], $sanitized_svg );

	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'loden_consulting_sanitize_svg' );

/**
 * Display SVG in media library
 *
 * @param string $response    HTML response.
 * @param object $attachment  Attachment object.
 * @param array  $meta        Attachment meta data.
 * @return string
 */
function loden_consulting_svg_media_thumbnails( $response, $attachment, $meta ) {
	if ( 'image/svg+xml' === $response['mime'] ) {
		$response['image'] = array(
			'src' => $response['url'],
		);
	}

	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'loden_consulting_svg_media_thumbnails', 10, 3 );

/**
 * Add SVG dimensions to media library
 *
 * @param array  $response    Response array.
 * @param object $attachment  Attachment object.
 * @param array  $meta        Attachment meta.
 * @return array
 */
function loden_consulting_svg_dimensions( $response, $attachment, $meta ) {
	if ( 'image/svg+xml' !== $response['mime'] ) {
		return $response;
	}

	$svg_path = get_attached_file( $attachment->ID );

	if ( ! file_exists( $svg_path ) ) {
		return $response;
	}

	$svg = simplexml_load_file( $svg_path );

	if ( false === $svg ) {
		return $response;
	}

	$attributes = $svg->attributes();
	$width      = 0;
	$height     = 0;

	if ( isset( $attributes->width, $attributes->height ) ) {
		$width  = intval( $attributes->width );
		$height = intval( $attributes->height );
	} elseif ( isset( $attributes->viewBox ) ) {
		$viewbox = explode( ' ', (string) $attributes->viewBox );
		if ( 4 === count( $viewbox ) ) {
			$width  = intval( $viewbox[2] );
			$height = intval( $viewbox[3] );
		}
	}

	if ( $width && $height ) {
		$response['width']  = $width;
		$response['height'] = $height;

		$response['sizes']['full'] = array(
			'url'         => $response['url'],
			'width'       => $width,
			'height'      => $height,
			'orientation' => $width > $height ? 'landscape' : 'portrait',
		);
	}

	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'loden_consulting_svg_dimensions', 10, 3 );

/**
 * Fix SVG display in admin media library grid view
 */
function loden_consulting_svg_admin_styles() {
	echo '<style>
		.attachment-266x266.size-266x266,
		.thumbnail .media-icon img[src$=".svg"] {
			width: 100% !important;
			height: auto !important;
		}
	</style>';
}
add_action( 'admin_head', 'loden_consulting_svg_admin_styles' );
