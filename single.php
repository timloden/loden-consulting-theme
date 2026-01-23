<?php
/**
 * The template for displaying all single posts
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
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail relative">
				<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-96 object-cover' ) ); ?>
				<div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
			</div>
			<?php endif; ?>

			<div class="container mx-auto px-4 py-8">
				<header class="entry-header mb-8">
					<?php the_title( '<h1 class="entry-title text-4xl font-bold mb-4">', '</h1>' ); ?>

					<div class="entry-meta text-gray-600 flex flex-wrap items-center gap-4 text-sm">
						<?php
						loden_consulting_posted_on();
						loden_consulting_posted_by();
						?>
					</div>
				</header>

				<div class="entry-content prose prose-lg max-w-none">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'loden-consulting' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'loden-consulting' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
					<?php loden_consulting_entry_footer(); ?>
				</footer>
			</div>
		</article>

		<?php
		// Post navigation.
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle text-sm text-gray-500">' . esc_html__( 'Previous:', 'loden-consulting' ) . '</span> <span class="nav-title font-medium">%title</span>',
				'next_text' => '<span class="nav-subtitle text-sm text-gray-500">' . esc_html__( 'Next:', 'loden-consulting' ) . '</span> <span class="nav-title font-medium">%title</span>',
				'class'     => 'container mx-auto px-4 py-8',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</main>

<?php
get_sidebar();
get_footer();
