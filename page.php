<?php
/**
 * The template for displaying all pages
 *
 * @package Loden_Consulting
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() && ! is_front_page() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-64 object-cover' ) ); ?>
			</div>
			<?php endif; ?>

			<div class="container mx-auto px-4 py-8">
				<?php if ( ! is_front_page() ) : ?>
				<header class="entry-header mb-8">
					<?php the_title( '<h1 class="entry-title text-4xl font-bold">', '</h1>' ); ?>
				</header>
				<?php endif; ?>

				<div class="entry-content prose prose-lg max-w-none">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'loden-consulting' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer mt-8">
					<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post. Only visible to screen readers */
							wp_kses(
								__( 'Edit <span class="screen-reader-text">%s</span>', 'loden-consulting' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link text-sm text-gray-500">',
						'</span>'
					);
					?>
				</footer>
				<?php endif; ?>
			</div>
		</article>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</main>

<?php
get_footer();
