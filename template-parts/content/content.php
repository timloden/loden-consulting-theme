<?php
/**
 * Template part for displaying posts
 *
 * @package Loden_Consulting
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-lg shadow-sm overflow-hidden transition-shadow hover:shadow-md' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-105' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="p-6">
		<header class="entry-header mb-3">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title text-2xl font-bold">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title text-xl font-bold"><a href="' . esc_url( get_permalink() ) . '" class="hover:text-primary transition-colors" rel="bookmark">', '</a></h2>' );
			endif;
			?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta text-sm text-gray-500 mt-2 flex items-center gap-3">
					<?php
					loden_consulting_posted_on();
					?>
				</div>
			<?php endif; ?>
		</header>

		<div class="entry-content text-gray-600">
			<?php
			if ( is_singular() ) :
				the_content();
			else :
				echo '<p>' . esc_html( loden_consulting_get_excerpt( 20 ) ) . '</p>';
			endif;
			?>
		</div>

		<?php if ( ! is_singular() ) : ?>
			<footer class="entry-footer mt-4">
				<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-primary font-medium hover:underline">
					<?php esc_html_e( 'Read more', 'loden-consulting' ); ?>
					<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
					</svg>
				</a>
			</footer>
		<?php endif; ?>
	</div>
</article>
