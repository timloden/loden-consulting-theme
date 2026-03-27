<?php

/**
 * The template for displaying the footer
 *
 * @package Loden_Consulting
 */

// ACF Website Settings — CTA for mobile drawer.
$cta_text          = function_exists('get_field') ? get_field('header_cta_button_text', 'option') : '';
$cta_link          = function_exists('get_field') ? get_field('header_cta_button_link', 'option') : '';
$header_logo_white = function_exists('get_field') ? get_field('header_image', 'option') : null;

$cta_text = $cta_text ?: esc_html__('Get a Free Quote', 'loden-consulting');
$cta_link = $cta_link ?: '/contact';
?>
<footer id="colophon" class="site-footer bg-gray-900 text-gray-300 mt-auto">
	<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
		<div class="footer-widgets container mx-auto px-4 py-12">
			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php if (is_active_sidebar('footer-1')) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php endif; ?>

				<?php if (is_active_sidebar('footer-2')) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php endif; ?>

				<?php if (is_active_sidebar('footer-3')) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar('footer-3'); ?>
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
						esc_html__('&copy; %1$s %2$s. All rights reserved.', 'loden-consulting'),
						date_i18n('Y'),
						get_bloginfo('name')
					);
					?>
				</div>

				<?php
				if (has_nav_menu('footer')) :
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

	<?php /* Overlay — required by daisyUI; hidden behind the full-screen panel */ ?>
	<label
		for="mobile-nav"
		aria-hidden="true"
		class="drawer-overlay"></label>

	<?php /* ── Full-screen mobile nav panel ── */ ?>
	<div class="mobile-menu-panel">

		<?php /* Panel header: logo (left) + close button (right) */ ?>
		<div class="mobile-menu-header">

			<a
				href="<?php echo esc_url(home_url('/')); ?>"
				rel="home"
				aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
				<?php if ($header_logo_white) : ?>
					<img
						src="<?php echo esc_url($header_logo_white['url']); ?>"
						alt="<?php echo esc_attr($header_logo_white['alt'] ?: get_bloginfo('name')); ?>"
						class="h-9 w-auto">
				<?php else : ?>
					<span class="text-lg font-bold text-white"><?php bloginfo('name'); ?></span>
				<?php endif; ?>
			</a>

			<label
				for="mobile-nav"
				class="mobile-menu-close"
				aria-label="<?php esc_attr_e('Close menu', 'loden-consulting'); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
					<g clip-path="url(#clip0_831_26848)">
						<path d="M23.7072 0.293153C23.5196 0.105682 23.2653 0.000366211 23.0002 0.000366211C22.735 0.000366211 22.4807 0.105682 22.2932 0.293153L12.0002 10.5862L1.70715 0.293153C1.51963 0.105682 1.26532 0.000366211 1.00015 0.000366211C0.734988 0.000366211 0.48068 0.105682 0.293153 0.293153C0.105682 0.48068 0.000366211 0.734988 0.000366211 1.00015C0.000366211 1.26532 0.105682 1.51963 0.293153 1.70715L10.5862 12.0002L0.293153 22.2932C0.105682 22.4807 0.000366211 22.735 0.000366211 23.0002C0.000366211 23.2653 0.105682 23.5196 0.293153 23.7072C0.48068 23.8946 0.734988 23.9999 1.00015 23.9999C1.26532 23.9999 1.51963 23.8946 1.70715 23.7072L12.0002 13.4142L22.2932 23.7072C22.4807 23.8946 22.735 23.9999 23.0002 23.9999C23.2653 23.9999 23.5196 23.8946 23.7072 23.7072C23.8946 23.5196 23.9999 23.2653 23.9999 23.0002C23.9999 22.735 23.8946 22.4807 23.7072 22.2932L13.4142 12.0002L23.7072 1.70715C23.8946 1.51963 23.9999 1.26532 23.9999 1.00015C23.9999 0.734988 23.8946 0.48068 23.7072 0.293153Z" fill="white" />
					</g>
					<defs>
						<clipPath id="clip0_831_26848">
							<rect width="24" height="24" fill="white" />
						</clipPath>
					</defs>
				</svg>
				<span><?php esc_html_e('Close', 'loden-consulting'); ?></span>
			</label>

		</div>
		<?php /* /panel header */ ?>

		<?php /* Mobile navigation — wp_nav_menu with custom accordion walker */ ?>
		<nav
			class="mobile-menu-nav"
			aria-label="<?php esc_attr_e('Mobile navigation', 'loden-consulting'); ?>">
			<?php
			if (has_nav_menu('mobile')) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'walker'         => new Loden_Mobile_Nav_Walker(),
						'container'      => false,
						'menu_id'        => 'mobile-nav-menu',
						'menu_class'     => 'mobile-nav-list',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
						'depth'          => 2,
						'fallback_cb'    => false,
					)
				);
			} else {
				// Placeholder until a menu is assigned in WP Admin.
			?>
				<ul class="mobile-nav-list" role="list">
					<li class="mobile-nav-item"><a href="/services" class="mobile-nav-link"><?php esc_html_e('Services', 'loden-consulting'); ?></a></li>
					<li class="mobile-nav-item"><a href="/about" class="mobile-nav-link"><?php esc_html_e('About', 'loden-consulting'); ?></a></li>
					<li class="mobile-nav-item"><a href="/residential" class="mobile-nav-link"><?php esc_html_e('Residential', 'loden-consulting'); ?></a></li>
					<li class="mobile-nav-item"><a href="/commercial" class="mobile-nav-link"><?php esc_html_e('Commercial', 'loden-consulting'); ?></a></li>
					<li class="mobile-nav-item"><a href="/service-areas" class="mobile-nav-link"><?php esc_html_e('Service Areas', 'loden-consulting'); ?></a></li>
					<li class="mobile-nav-item"><a href="/contact" class="mobile-nav-link"><?php esc_html_e('Contact Us', 'loden-consulting'); ?></a></li>
				</ul>
			<?php
			}
			?>
		</nav>

		<?php /* CTA button — pinned to bottom via mt-auto on this wrapper */ ?>
		<div class="mobile-menu-cta">
			<a href="<?php echo esc_url($cta_link); ?>" class="btn-cta w-full justify-center">
				<?php echo esc_html($cta_text); ?>
			</a>
		</div>

	</div>
	<?php /* /mobile-menu-panel */ ?>

</div>
<?php /* /mobile drawer */ ?>

</div><!-- .drawer -->

<?php wp_footer(); ?>

</body>

</html>