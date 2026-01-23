<?php
/**
 * WooCommerce Compatibility File
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce setup function.
 */
function loden_consulting_woocommerce_setup() {
	// Declare WooCommerce support.
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 400,
			'single_image_width'    => 600,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);

	// Product gallery features.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'loden_consulting_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 */
function loden_consulting_woocommerce_scripts() {
	// Only load on WooCommerce pages.
	if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
		return;
	}

	// Add any WooCommerce-specific scripts or styles here.
}
add_action( 'wp_enqueue_scripts', 'loden_consulting_woocommerce_scripts' );

/**
 * Add custom classes to the body for WooCommerce pages.
 *
 * @param array $classes Body classes.
 * @return array
 */
function loden_consulting_woocommerce_body_class( $classes ) {
	if ( is_woocommerce() ) {
		$classes[] = 'woocommerce-active';
	}

	return $classes;
}
add_filter( 'body_class', 'loden_consulting_woocommerce_body_class' );

/**
 * Before content wrapper.
 */
function loden_consulting_woocommerce_wrapper_before() {
	?>
	<main id="primary" class="site-main">
		<div class="container mx-auto px-4 py-8">
	<?php
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'loden_consulting_woocommerce_wrapper_before' );

/**
 * After content wrapper.
 */
function loden_consulting_woocommerce_wrapper_after() {
	?>
		</div>
	</main>
	<?php
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'loden_consulting_woocommerce_wrapper_after' );

/**
 * Remove default WooCommerce sidebar.
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Modify WooCommerce breadcrumb defaults.
 *
 * @param array $defaults Default breadcrumb arguments.
 * @return array
 */
function loden_consulting_woocommerce_breadcrumb_defaults( $defaults ) {
	$defaults['delimiter']   = '<span class="mx-2 text-gray-400">/</span>';
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text-sm text-gray-600 mb-6" aria-label="Breadcrumb">';
	$defaults['wrap_after']  = '</nav>';

	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'loden_consulting_woocommerce_breadcrumb_defaults' );

/**
 * Related Products settings.
 *
 * @param array $args Related products arguments.
 * @return array
 */
function loden_consulting_woocommerce_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'loden_consulting_woocommerce_related_products_args' );

/**
 * Remove default product thumbnail from product loops (to customize if needed).
 * Uncomment if you want to customize the product image output.
 */
// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

/**
 * Cart Fragments - ensure cart widget updates via AJAX.
 *
 * @param array $fragments Cart fragments.
 * @return array
 */
function loden_consulting_woocommerce_cart_link_fragment( $fragments ) {
	ob_start();
	?>
	<span class="cart-count inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-primary rounded-full">
		<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
	</span>
	<?php
	$fragments['span.cart-count'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'loden_consulting_woocommerce_cart_link_fragment' );

/**
 * Checkout fields customization.
 *
 * @param array $fields Checkout fields.
 * @return array
 */
function loden_consulting_woocommerce_checkout_fields( $fields ) {
	// Add custom classes to form fields.
	foreach ( $fields as $fieldset_key => $fieldset_values ) {
		foreach ( $fieldset_values as $field_key => $field ) {
			$fields[ $fieldset_key ][ $field_key ]['class'][] = 'mb-4';
		}
	}

	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'loden_consulting_woocommerce_checkout_fields' );

/**
 * Customize add to cart button text.
 *
 * @param string $text Default button text.
 * @return string
 */
function loden_consulting_woocommerce_product_add_to_cart_text( $text ) {
	if ( is_product() ) {
		return __( 'Add to Cart', 'loden-consulting' );
	}

	return $text;
}
// add_filter( 'woocommerce_product_add_to_cart_text', 'loden_consulting_woocommerce_product_add_to_cart_text' );

/**
 * Modify sale flash HTML.
 *
 * @param string     $html    Sale badge HTML.
 * @param WP_Post    $post    Post object.
 * @param WC_Product $product Product object.
 * @return string
 */
function loden_consulting_woocommerce_sale_flash( $html, $post, $product ) {
	return '<span class="onsale absolute top-2 right-2 bg-accent text-white text-xs font-semibold px-3 py-1 rounded-full">' . esc_html__( 'Sale!', 'loden-consulting' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'loden_consulting_woocommerce_sale_flash', 10, 3 );

/**
 * Modify product thumbnail size in shop loop.
 *
 * @param string $size Image size.
 * @return string
 */
function loden_consulting_woocommerce_thumbnail_size( $size ) {
	return 'woocommerce_thumbnail';
}
add_filter( 'single_product_archive_thumbnail_size', 'loden_consulting_woocommerce_thumbnail_size' );

/**
 * Hide product meta (SKU, categories, tags) on single product page.
 * Uncomment to hide specific meta.
 */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Change products per page.
 *
 * @param int $cols Number of products per page.
 * @return int
 */
function loden_consulting_woocommerce_products_per_page( $cols ) {
	return 12;
}
add_filter( 'loop_shop_per_page', 'loden_consulting_woocommerce_products_per_page', 20 );

/**
 * Ensure cart contents update when products are added to the cart via AJAX.
 */
function loden_consulting_woocommerce_header_cart_count() {
	if ( ! WC()->cart ) {
		return '0';
	}

	return WC()->cart->get_cart_contents_count();
}

/**
 * Display mini cart.
 */
function loden_consulting_woocommerce_cart_link() {
	?>
	<a class="cart-link flex items-center gap-2 text-gray-700 hover:text-primary" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'loden-consulting' ); ?>">
		<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
		</svg>
		<span class="cart-count inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-primary rounded-full">
			<?php echo esc_html( loden_consulting_woocommerce_header_cart_count() ); ?>
		</span>
	</a>
	<?php
}
