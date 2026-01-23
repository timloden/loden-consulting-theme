<?php
/**
 * The template for displaying search results pages
 *
 * @package Loden_Consulting
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
	<?php if ( have_posts() ) : ?>

		<header class="page-header mb-8">
			<h1 class="page-title text-3xl font-bold">
				<?php
				printf(
					/* translators: %s: search query. */
					esc_html__( 'Search Results for: %s', 'loden-consulting' ),
					'<span class="text-primary">' . get_search_query() . '</span>'
				);
				?>
			</h1>
		</header>

		<div class="search-results space-y-8">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'search' );
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination(
			array(
				'prev_text' => __( '&larr; Previous', 'loden-consulting' ),
				'next_text' => __( 'Next &rarr;', 'loden-consulting' ),
				'class'     => 'mt-8',
			)
		);

	else :
		?>

		<div class="no-results text-center py-12">
			<h1 class="page-title text-3xl font-bold mb-4"><?php esc_html_e( 'Nothing Found', 'loden-consulting' ); ?></h1>

			<p class="text-gray-600 mb-8"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'loden-consulting' ); ?></p>

			<div class="max-w-md mx-auto">
				<?php get_search_form(); ?>
			</div>
		</div>

	<?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();
