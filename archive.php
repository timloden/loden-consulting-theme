<?php
/**
 * The template for displaying archive pages
 *
 * @package Loden_Consulting
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
	<?php if ( have_posts() ) : ?>

		<header class="page-header mb-8">
			<?php
			the_archive_title( '<h1 class="page-title text-3xl font-bold mb-2">', '</h1>' );
			the_archive_description( '<div class="archive-description text-gray-600">', '</div>' );
			?>
		</header>

		<div class="posts-grid grid gap-8 md:grid-cols-2 lg:grid-cols-3">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', get_post_type() );
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

		get_template_part( 'template-parts/content/content', 'none' );

	endif;
	?>
</main>

<?php
get_sidebar();
get_footer();
