<?php
/**
 * The main template file
 *
 * @package Loden_Consulting
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header class="page-header mb-8">
				<h1 class="page-title text-3xl font-bold"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;
		?>

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
