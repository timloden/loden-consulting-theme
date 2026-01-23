<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Loden_Consulting
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-16">
	<section class="error-404 not-found text-center max-w-2xl mx-auto">
		<header class="page-header mb-8">
			<h1 class="page-title text-6xl font-bold text-gray-300 mb-4">404</h1>
			<p class="text-2xl font-semibold text-gray-900"><?php esc_html_e( 'Page Not Found', 'loden-consulting' ); ?></p>
		</header>

		<div class="page-content">
			<p class="text-gray-600 mb-8"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'loden-consulting' ); ?></p>

			<div class="max-w-md mx-auto mb-8">
				<?php get_search_form(); ?>
			</div>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
				<?php esc_html_e( 'Back to Home', 'loden-consulting' ); ?>
			</a>
		</div>
	</section>
</main>

<?php
get_footer();
