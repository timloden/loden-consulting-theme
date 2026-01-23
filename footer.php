<?php
/**
 * The template for displaying the footer
 *
 * @package Loden_Consulting
 */

?>
	<footer id="colophon" class="site-footer bg-gray-900 text-gray-300 mt-auto">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="footer-widgets container mx-auto px-4 py-12">
			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="footer-bottom border-t border-gray-800">
			<div class="container mx-auto px-4 py-6">
				<div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
					<!-- Copyright -->
					<div class="site-info text-sm">
						<?php
						printf(
							/* translators: %1$s: current year, %2$s: site name */
							esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'loden-consulting' ),
							date_i18n( 'Y' ),
							get_bloginfo( 'name' )
						);
						?>
					</div>

					<!-- Footer Navigation -->
					<?php
					if ( has_nav_menu( 'footer' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_id'        => 'footer-menu',
								'menu_class'     => 'flex flex-wrap justify-center space-x-6 text-sm',
								'container'      => 'nav',
								'container_class' => 'footer-navigation',
								'depth'          => 1,
							)
						);
					endif;
					?>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
