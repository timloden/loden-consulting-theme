<?php
/**
 * The template for displaying the footer
 *
 * @package Loden_Consulting
 */

// ACF Website Settings — CTA for mobile drawer.
$cta_text          = function_exists( 'get_field' ) ? get_field( 'header_cta_button_text', 'option' ) : '';
$cta_link          = function_exists( 'get_field' ) ? get_field( 'header_cta_button_link', 'option' ) : '';
$header_logo_white = function_exists( 'get_field' ) ? get_field( 'header_image_white_background', 'option' ) : null;

$cta_text = $cta_text ?: esc_html__( 'Get a Free Quote', 'loden-consulting' );
$cta_link = $cta_link ?: '/contact';
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

					<?php
					if ( has_nav_menu( 'footer' ) ) :
						wp_nav_menu(
							array(
								'theme_location'  => 'footer',
								'menu_id'         => 'footer-menu',
								'menu_class'      => 'flex flex-wrap justify-center space-x-6 text-sm',
								'container'       => 'nav',
								'container_class' => 'footer-navigation',
								'depth'           => 1,
							)
						);
					endif;
					?>
				</div>
			</div>
		</div>
	</footer>

	</div><!-- #page -->

	</div><!-- .drawer-content -->

	<?php
	/*
	 * ================================================================
	 * Mobile Navigation Drawer — slides in from the right
	 * Opened by the <label for="mobile-nav"> in header.php.
	 * ================================================================
	 */
	?>
	<div class="drawer-side z-[100]">

		<?php /* Dim overlay — clicking closes the drawer */ ?>
		<label
			for="mobile-nav"
			aria-label="<?php esc_attr_e( 'Close navigation', 'loden-consulting' ); ?>"
			class="drawer-overlay"></label>

		<?php /* Side panel */ ?>
		<div class="bg-white min-h-screen w-[300px] flex flex-col p-6">

			<?php /* Panel header: logo + close button */ ?>
			<div class="flex items-center justify-between mb-8">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php if ( $header_logo_white ) : ?>
						<img
							src="<?php echo esc_url( $header_logo_white['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo_white['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							class="h-8 w-auto">
					<?php else : ?>
						<span class="text-lg font-bold text-simple-black"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<label
					for="mobile-nav"
					class="btn btn-ghost btn-sm btn-circle"
					aria-label="<?php esc_attr_e( 'Close menu', 'loden-consulting' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</label>

			</div>
			<?php /* /panel header */ ?>

			<?php
			/*
			 * Mobile nav links — static placeholder.
			 * TODO: Replace with wp_nav_menu() once the menu is set up in WP Admin
			 * (Appearance → Menus, assign to "Primary Menu").
			 */
			?>
			<nav
				class="flex-1"
				aria-label="<?php esc_attr_e( 'Mobile navigation', 'loden-consulting' ); ?>">
				<ul class="flex flex-col gap-1 list-none m-0 p-0">
					<li><a href="/" class="mobile-nav-link"><?php esc_html_e( 'Home', 'loden-consulting' ); ?></a></li>
					<li><a href="/services" class="mobile-nav-link"><?php esc_html_e( 'Services', 'loden-consulting' ); ?></a></li>
					<li><a href="/about" class="mobile-nav-link"><?php esc_html_e( 'About', 'loden-consulting' ); ?></a></li>
					<li class="mobile-nav-divider" role="separator"></li>
					<li><a href="/residential" class="mobile-nav-link"><?php esc_html_e( 'Residential', 'loden-consulting' ); ?></a></li>
					<li><a href="/commercial" class="mobile-nav-link"><?php esc_html_e( 'Commercial', 'loden-consulting' ); ?></a></li>
					<li><a href="/service-areas" class="mobile-nav-link"><?php esc_html_e( 'Service Areas', 'loden-consulting' ); ?></a></li>
					<li class="mobile-nav-divider" role="separator"></li>
					<li><a href="/contact" class="mobile-nav-link"><?php esc_html_e( 'Contact', 'loden-consulting' ); ?></a></li>
				</ul>
			</nav>

			<?php /* CTA button pinned to bottom of panel */ ?>
			<div class="mt-8">
				<a href="<?php echo esc_url( $cta_link ); ?>" class="btn-cta w-full justify-center">
					<?php echo esc_html( $cta_text ); ?>
				</a>
			</div>

		</div>
		<?php /* /side panel */ ?>

	</div>
	<?php /* /mobile drawer */ ?>

</div><!-- .drawer -->

<?php wp_footer(); ?>

</body>
</html>
