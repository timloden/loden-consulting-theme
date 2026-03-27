<?php
/**
 * The header for our theme
 *
 * @package Loden_Consulting
 */

// ACF Website Settings (options page).
$header_logo       = function_exists( 'get_field' ) ? get_field( 'header_image', 'option' ) : null;
$header_logo_white = function_exists( 'get_field' ) ? get_field( 'header_image_white_background', 'option' ) : null;
$cta_text          = function_exists( 'get_field' ) ? get_field( 'header_cta_button_text', 'option' ) : '';
$cta_link          = function_exists( 'get_field' ) ? get_field( 'header_cta_button_link', 'option' ) : '';
$phone_number      = function_exists( 'get_field' ) ? get_field( 'phone_number', 'option' ) : '';

// Fallback values if ACF fields are empty.
$cta_text     = $cta_text ?: esc_html__( 'Get a Free Quote', 'loden-consulting' );
$cta_link     = $cta_link ?: '/contact';
$phone_number = $phone_number ?: '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased' ); ?>>
<?php wp_body_open(); ?>

<?php
/*
 * DaisyUI Drawer (drawer-end = slides in from right)
 * ─────────────────────────────────────────────────
 * drawer-content wraps the entire page (header + main + footer).
 * drawer-side holds the mobile nav panel.
 * Both are closed in footer.php.
 */
?>
<div class="drawer drawer-end">
	<input id="mobile-nav" type="checkbox" class="drawer-toggle" />

	<div class="drawer-content flex flex-col">

		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'loden-consulting' ); ?></a>

		<?php
		/*
		 * ================================================================
		 * Site Header
		 * Fixed. Transparent by default → white once user scrolls.
		 * JS (frontend.js → initHeaderScroll) adds .is-scrolled to toggle.
		 * ================================================================
		 */
		?>
		<header id="masthead" class="site-header fixed top-0 left-0 right-0 z-50" data-header>

			<?php /* ── Desktop (lg+): constrained container ── */ ?>
			<div class="hidden lg:flex items-center justify-between h-20 container mx-auto px-6">

				<?php /* Logo */ ?>
				<a
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					class="site-branding flex-shrink-0"
					rel="home"
					aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — <?php esc_attr_e( 'Home', 'loden-consulting' ); ?>">

					<?php if ( $header_logo ) : ?>
						<img
							src="<?php echo esc_url( $header_logo['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							width="<?php echo esc_attr( $header_logo['width'] ); ?>"
							height="<?php echo esc_attr( $header_logo['height'] ); ?>"
							class="logo-transparent h-10 w-auto"
							loading="eager">
					<?php endif; ?>

					<?php if ( $header_logo_white ) : ?>
						<img
							src="<?php echo esc_url( $header_logo_white['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo_white['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							width="<?php echo esc_attr( $header_logo_white['width'] ); ?>"
							height="<?php echo esc_attr( $header_logo_white['height'] ); ?>"
							class="logo-white h-10 w-auto"
							loading="eager">
					<?php endif; ?>

					<?php if ( ! $header_logo && ! $header_logo_white ) : ?>
						<span class="text-xl font-bold"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<?php
				/*
				 * Primary Navigation — static placeholder links.
				 * TODO: Swap for wp_nav_menu() once the menu is built in WP Admin
				 * (Appearance → Menus, assign to "Primary Menu").
				 */
				?>
				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'loden-consulting' ); ?>">
					<ul class="flex items-center gap-8 list-none m-0 p-0">
						<li>
							<a href="/services" class="nav-link">
								<?php esc_html_e( 'Services', 'loden-consulting' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
							</a>
						</li>
						<li>
							<a href="/about" class="nav-link">
								<?php esc_html_e( 'About', 'loden-consulting' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
							</a>
						</li>
						<li>
							<a href="/residential" class="nav-link"><?php esc_html_e( 'Residential', 'loden-consulting' ); ?></a>
						</li>
						<li>
							<a href="/commercial" class="nav-link"><?php esc_html_e( 'Commercial', 'loden-consulting' ); ?></a>
						</li>
						<li>
							<a href="/service-areas" class="nav-link">
								<?php esc_html_e( 'Service Areas', 'loden-consulting' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
							</a>
						</li>
					</ul>
				</nav>

				<?php /* CTA Button */ ?>
				<a href="<?php echo esc_url( $cta_link ); ?>" class="btn-nav-cta flex-shrink-0">
					<?php echo esc_html( $cta_text ); ?>
				</a>

			</div>
			<?php /* /desktop header */ ?>

			<?php /* ── Mobile (< lg): full width, no container constraint ── */ ?>
			<div class="flex lg:hidden items-center justify-between h-16 px-4 w-full">

				<?php /* Mobile Logo */ ?>
				<a
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					class="site-branding flex-shrink-0"
					rel="home"
					aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — <?php esc_attr_e( 'Home', 'loden-consulting' ); ?>">

					<?php if ( $header_logo ) : ?>
						<img
							src="<?php echo esc_url( $header_logo['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							class="logo-transparent h-8 w-auto"
							loading="eager">
					<?php endif; ?>

					<?php if ( $header_logo_white ) : ?>
						<img
							src="<?php echo esc_url( $header_logo_white['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo_white['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							class="logo-white h-8 w-auto"
							loading="eager">
					<?php endif; ?>

					<?php if ( ! $header_logo && ! $header_logo_white ) : ?>
						<span class="font-bold"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<?php /* Mobile actions: Call Us + Menu */ ?>
				<div class="flex items-center gap-5">

					<?php
					/*
					 * Call Us — links to phone number.
					 * TODO: Add a `header_phone_number` ACF text field to Website Settings
					 * and replace the placeholder href below.
					 */
					?>
					<a
						href="<?php echo $phone_number ? 'tel:' . esc_attr( preg_replace( '/[^+\d]/', '', $phone_number ) ) : '#'; ?>"
						class="mobile-call-btn flex flex-col items-center gap-0.5"
						aria-label="<?php esc_attr_e( 'Call us', 'loden-consulting' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="17" viewBox="0 0 17 17" fill="none" aria-hidden="true">
							<mask id="mask0_800_49729" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="17" height="17">
								<rect width="17" height="17" fill="url(#pattern0_800_49729)"/>
							</mask>
							<g mask="url(#mask0_800_49729)">
								<rect x="-4.25" y="-4.51562" width="32.6719" height="26.8281" fill="currentColor"/>
							</g>
							<defs>
								<pattern id="pattern0_800_49729" patternContentUnits="objectBoundingBox" width="1" height="1">
									<use xlink:href="#image0_800_49729" transform="scale(0.015625)"/>
								</pattern>
								<image id="image0_800_49729" width="64" height="64" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAJ1AAACdQF32cIiAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAA3VJREFUeJzl20uIHUUUxvGfnXGiozhCXASRzEjQ6EgiKogiRoIPBMUXuHChZCXuDLhQQlYuRTBB3bkSwQeiSCA+NlmIOKLiAxETFyqK6CKaqCSizo2LmsZhmGSs7jrd99784TBwYb57znerqrtOV/Mf27APh3E8Mw7jTdxoRHkEA/mFL48BHu0499ZsU6b4pSbc1GkFLdmnXPF1vNNpBS35VXkD/ui0ghachn+wJkB7CscCdItS4e8g7TODdItS4a8g7akg3aJU4ubreUG6RalwKEh7Q5BuUSINmAnSLUqFn4K054J0i1Lh2yDtq4J0i1LhmyDtzZgM0i5GhYNB2mfguiDtYlT4PFD/1kDtonyv/H7gOD7tsogmVIt/54P05wz5OlAbsD9I/3QxG63iXCJmCkRdYYpRj4Cv8GOA/nMBmmG8oOyv/4Ehn//L2a5c8b9gtsvkSzCNo9oXP8DdHedejJe1N+DJzrMuyO1OsXm/nAlpe3zKzPuV2K3ZvL+zj2Qj2CS1yjMM2N1LpgWoVvjsAF7N1LmwQC5DxWVYkDcKbukl00DekGfAZ9IiOjZcLX8xfKyXTAN5XZ4Bx3BpL5kGMSM9OcoxYV7qA4wEqzUrjkhF5Rx9uUDaV7zVNKlhYxJfyl8P7usj2Si2yj9Gc3Tx/8aGZ+SPgiO4so9kI1iLj+Wb8DOuKJzLhJ6arRs1P0d4Q8vvXotd0pOsgXTJncfjuFaHhtwr34D6HuH+ht+5ER+tov873pU2Zg9KT6XmpIMa5zT83hOyZ5VkThbPymua3KPZqFspDmEvrm9S9FLWSDvGpol8KG24Tsak9GuWPMRZxwA72hhAmpP7WyTxJ3ZaeQM1K7XXShe+NBYUGAnT+KRlIl/g5iWad0jttcji69jb1gBYj68LJbNHzJA/URQ7H7Ve+5HQVxTjbLw9BAX1ZgBp5S7xcKWzKH33tCA1UaZxTWHtkeMu3a3mQzMFljOD94egyN4MIN0wPa3by9tQGVCzVbrp6bvg3gwgNUsfxm8FEh9JA2o24LX/meBYGlBzOZ6X/xhubAyo2YwX5T+VHhsDai7GU5of0siNqJdFWjOB2/CS1EqLMqDIdjiaaTwgrRU/KJd8kYZIH2zCQ3gF32le/A7Sm6OjzrnYgoukkyqzOB/rFmNK2qWeJb0m/B6ekDrI/gXJ3Zu5fhYDHgAAAABJRU5ErkJggg=="/>
							</defs>
						</svg>
						<span class="text-[11px] font-bold leading-none"><?php esc_html_e( 'Call Us', 'loden-consulting' ); ?></span>
					</a>

					<?php /* Hamburger — opens the DaisyUI drawer */ ?>
					<label
						for="mobile-nav"
						class="mobile-menu-btn flex flex-col items-center gap-1 cursor-pointer"
						aria-label="<?php esc_attr_e( 'Open navigation menu', 'loden-consulting' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 25 18" fill="none" aria-hidden="true">
							<line y1="1.11175" x2="24.5" y2="1.11175" stroke="currentColor" stroke-width="2.22353"/>
							<line y1="8.8117" x2="24.5" y2="8.8117" stroke="currentColor" stroke-width="2.22353"/>
							<path d="M0 16.2235H24.5" stroke="currentColor" stroke-width="2.22353"/>
						</svg>
						<span class="text-[11px] font-bold leading-none"><?php esc_html_e( 'Menu', 'loden-consulting' ); ?></span>
					</label>

				</div>
				<?php /* /mobile actions */ ?>

			</div>
			<?php /* /mobile header */ ?>

		</header>
		<?php /* /site-header */ ?>

		<div id="page" class="site min-h-screen flex flex-col">
