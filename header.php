<?php
/**
 * The header for our theme
 *
 * @package Loden_Consulting
 */

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

<div id="page" class="site min-h-screen flex flex-col">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'loden-consulting' ); ?></a>

	<header id="masthead" class="site-header bg-white shadow-sm sticky top-0 z-50">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-between h-16">
				<!-- Logo / Site Title -->
				<div class="site-branding flex-shrink-0">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-bold text-gray-900 hover:text-primary transition-colors" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description text-sm text-gray-600 hidden md:block"><?php echo $description; ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<!-- Desktop Navigation -->
				<nav id="site-navigation" class="main-navigation hidden md:flex items-center space-x-6">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'flex items-center space-x-6',
							'container'      => false,
							'fallback_cb'    => false,
							'depth'          => 2,
						)
					);
					?>
				</nav>

				<!-- Mobile Menu Button -->
				<button
					type="button"
					class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
					data-menu-toggle
					aria-expanded="false"
					aria-controls="mobile-menu"
				>
					<span class="sr-only"><?php esc_html_e( 'Open main menu', 'loden-consulting' ); ?></span>
					<!-- Hamburger icon -->
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
				</button>
			</div>

			<!-- Mobile Navigation -->
			<div id="mobile-menu" class="md:hidden hidden" data-mobile-menu>
				<div class="px-2 pt-2 pb-3 space-y-1 border-t">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'mobile-primary-menu',
							'menu_class'     => 'space-y-1',
							'container'      => false,
							'fallback_cb'    => false,
							'depth'          => 2,
							'link_class'     => 'block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100',
						)
					);
					?>
				</div>
			</div>
		</div>
	</header>
