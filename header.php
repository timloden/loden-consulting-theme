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

// Header banner fields.
$banner_text      = function_exists( 'get_field' ) ? get_field( 'header_banner_text', 'option' ) : '';
$banner_cta_text  = function_exists( 'get_field' ) ? get_field( 'header_banner_cta_text', 'option' ) : '';
$banner_cta_link  = function_exists( 'get_field' ) ? get_field( 'header_banner_cta_link', 'option' ) : '';
$banner_login_url = function_exists( 'get_field' ) ? get_field( 'header_banner_login_url', 'option' ) : '';

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

			<?php /* ── Header Banner (only rendered when header_banner_text is set) ── */ ?>
			<?php if ( $banner_text ) : ?>
			<div class="bg-[#45B5E8] text-white text-base">

				<?php /* Mobile layout (hidden on lg+) */ ?>
				<div class="lg:hidden flex flex-col items-center gap-4 px-6 py-5 text-center">
					<div class="[&_p]:inline [&_p]:m-0"><?php echo wp_kses_post( $banner_text ); ?></div>
					<?php if ( $banner_cta_text && $banner_cta_link ) : ?>
					<a href="<?php echo esc_url( $banner_cta_link ); ?>"
					   class="inline-flex items-center rounded-full bg-white text-[#12242B] font-semibold text-base px-5 py-1.5 hover:bg-white/90 transition-colors">
						<?php echo esc_html( $banner_cta_text ); ?>
					</a>
					<?php endif; ?>
					<?php if ( $banner_login_url ) : ?>
					<div class="w-full border-t border-white/30 pt-4">
						<a href="<?php echo esc_url( $banner_login_url ); ?>"
						   class="inline-flex items-center justify-center gap-2 text-white hover:text-white/80 transition-colors">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none" aria-hidden="true">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M11.5319 1.90055C12.0263 2.12823 12.4687 2.46442 12.842 2.88599C13.2269 3.31289 13.532 3.82607 13.7384 4.39527C13.9394 4.94224 14.0542 5.54613 14.0542 6.17849C14.0542 6.81084 13.9394 7.41473 13.7384 7.96704C13.5311 8.53713 13.2269 9.04408 12.842 9.47099C12.4687 9.89255 12.0263 10.2287 11.5319 10.4626C11.0546 10.685 10.5315 10.8042 9.98591 10.8042C9.44036 10.8042 8.91724 10.6841 8.43989 10.4626C7.94548 10.2287 7.49774 9.89255 7.12357 9.47099C6.74401 9.04942 6.43355 8.53713 6.22718 7.96704C6.02618 7.42007 5.91133 6.81617 5.91133 6.17849C5.91133 5.5408 6.02618 4.94224 6.22718 4.39527C6.43445 3.82607 6.74401 3.31289 7.12357 2.88599C7.49684 2.46442 7.94548 2.12823 8.43989 1.90055C8.91724 1.67287 9.44036 1.5528 9.98591 1.5528C10.5315 1.5528 11.0546 1.67287 11.5319 1.90055ZM9.98591 13.5506H10.0146C10.4283 13.5506 10.8365 13.5106 11.2331 13.4314C11.6351 13.3576 12.0317 13.2375 12.4113 13.0837C12.7908 12.936 13.1587 12.7421 13.5033 12.5198C13.8595 12.2974 14.187 12.036 14.4975 11.7505L14.5549 11.6882L14.5666 11.6829L14.5782 11.6882L14.641 11.7051C15.1875 11.899 15.6989 12.1498 16.1754 12.4744C16.6528 12.7991 17.0835 13.2037 17.463 13.716C17.8363 14.2345 18.1584 14.8669 18.4114 15.6415C18.6582 16.4162 18.8368 17.3331 18.9229 18.4217V18.4449H1.07764V18.4217C1.16378 17.334 1.34234 16.4162 1.5891 15.6415C1.84213 14.8669 2.15798 14.2345 2.53753 13.716C2.91708 13.2037 3.34778 12.7991 3.82514 12.4744C4.30249 12.1498 4.81933 11.899 5.3595 11.7051L5.41693 11.6882L5.42859 11.6829L5.44025 11.6882C5.45192 11.6998 5.46269 11.7113 5.47435 11.7167C5.48602 11.7282 5.49768 11.7398 5.50306 11.7505C5.81353 12.0351 6.14104 12.2974 6.49726 12.5198C6.84182 12.7421 7.20971 12.936 7.58926 13.0837C7.96881 13.2375 8.35913 13.3576 8.7674 13.4314C9.164 13.5115 9.57226 13.5506 9.98591 13.5506ZM0.681042 15.3391C0.399293 16.2107 0.203685 17.2362 0.117545 18.4555H0.118442L0.106777 18.5356C0.0951128 18.7126 0.083448 18.8433 0.112161 18.9518C0.135491 19.0603 0.192917 19.151 0.313154 19.2533C0.491714 19.4018 0.646945 19.4018 0.934077 19.3956H19.0665C19.3536 19.401 19.5088 19.401 19.6874 19.2533C19.9288 19.0541 19.9171 18.8887 19.8947 18.5409V18.5356L19.883 18.4555C19.7969 17.2362 19.6012 16.2107 19.3195 15.3391C19.0378 14.4675 18.6699 13.7498 18.2392 13.1575C17.7968 12.5536 17.2907 12.0804 16.7389 11.7051C16.1925 11.3236 15.5949 11.039 14.9686 10.8166C14.9515 10.8113 14.9345 10.8051 14.9111 10.7935C14.8941 10.7882 14.8707 10.7766 14.8537 10.7704H14.8483C14.6357 10.6903 14.5325 10.6512 14.3485 10.6903L14.3431 10.6957C14.1592 10.7357 14.0901 10.8042 13.9636 10.9349L13.9582 10.9402L13.8434 11.0541V11.0594C13.5733 11.304 13.2915 11.5264 12.9873 11.7202C12.6885 11.9079 12.3781 12.0733 12.0506 12.2041C11.7347 12.3295 11.4009 12.4317 11.0564 12.5002C10.7172 12.5625 10.3726 12.5972 10.0164 12.5972H9.98771C9.63149 12.5972 9.28693 12.5634 8.94775 12.5002C8.60858 12.4317 8.27568 12.3348 7.95356 12.2041C7.62605 12.0733 7.31559 11.9079 7.01679 11.7202C6.71171 11.5264 6.43086 11.304 6.16616 11.0594V11.0541C6.14283 11.0372 6.12578 11.0194 6.11412 11.0087C6.0854 10.9803 6.06208 10.9634 6.04503 10.9402L6.03964 10.9349C5.91313 10.8042 5.84403 10.7357 5.66637 10.6957L5.66099 10.6903C5.47166 10.6503 5.36757 10.6903 5.15492 10.7704H5.14953C5.1262 10.7819 5.10377 10.7873 5.08044 10.7988C5.06339 10.8042 5.04545 10.8104 5.03468 10.8157C4.40837 11.0381 3.81616 11.3227 3.26433 11.7042C2.7125 12.0804 2.20643 12.5527 1.76407 13.1566C1.33337 13.7489 0.965482 14.4667 0.683733 15.3383L0.681042 15.3391ZM11.9232 1.02895C11.3256 0.755914 10.6705 0.602051 9.98591 0.602051C9.2959 0.602051 8.64088 0.755914 8.04867 1.02895C7.42775 1.31356 6.87053 1.73513 6.40484 2.25986C5.95081 2.77215 5.57754 3.3876 5.32989 4.06531C5.08313 4.71456 4.95034 5.43229 4.95034 6.17849C4.95034 6.92468 5.08852 7.64241 5.32989 8.29789C5.57664 8.9756 5.95081 9.59105 6.40484 10.1033C6.87053 10.6218 7.42775 11.0434 8.04867 11.328C8.64626 11.6073 9.2959 11.7549 9.98591 11.7549C10.6759 11.7549 11.3247 11.6073 11.9232 11.328C12.5378 11.0434 13.0959 10.6218 13.5607 10.1033C14.0201 9.59105 14.388 8.9756 14.641 8.29789C14.8824 7.64241 15.0143 6.93091 15.0143 6.17849C15.0143 5.42607 14.8824 4.71456 14.641 4.06531C14.388 3.38138 14.0201 2.77215 13.5607 2.25986C13.095 1.73602 12.5378 1.31445 11.9232 1.02895Z" fill="white"/>
							</svg>
							<span class="text-base font-medium">Customer Portal</span>
						</a>
					</div>
					<?php endif; ?>
				</div>

				<?php /* Desktop layout (hidden below lg) */ ?>
				<div class="hidden lg:flex relative items-center justify-center min-h-[44px] px-6 py-2">
					<div class="flex items-center gap-3 [&_p]:inline [&_p]:m-0">
						<?php echo wp_kses_post( $banner_text ); ?>
						<?php if ( $banner_cta_text && $banner_cta_link ) : ?>
						<a href="<?php echo esc_url( $banner_cta_link ); ?>"
						   class="inline-flex items-center rounded-full bg-white text-[#12242B] font-semibold text-base px-5 py-1.5 hover:bg-white/90 transition-colors flex-shrink-0">
							<?php echo esc_html( $banner_cta_text ); ?>
						</a>
						<?php endif; ?>
					</div>
					<?php if ( $banner_login_url ) : ?>
					<a href="<?php echo esc_url( $banner_login_url ); ?>"
					   class="absolute right-6 top-1/2 -translate-y-1/2 flex items-center gap-2 text-white hover:text-white/80 transition-colors flex-shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none" aria-hidden="true">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M11.5319 1.90055C12.0263 2.12823 12.4687 2.46442 12.842 2.88599C13.2269 3.31289 13.532 3.82607 13.7384 4.39527C13.9394 4.94224 14.0542 5.54613 14.0542 6.17849C14.0542 6.81084 13.9394 7.41473 13.7384 7.96704C13.5311 8.53713 13.2269 9.04408 12.842 9.47099C12.4687 9.89255 12.0263 10.2287 11.5319 10.4626C11.0546 10.685 10.5315 10.8042 9.98591 10.8042C9.44036 10.8042 8.91724 10.6841 8.43989 10.4626C7.94548 10.2287 7.49774 9.89255 7.12357 9.47099C6.74401 9.04942 6.43355 8.53713 6.22718 7.96704C6.02618 7.42007 5.91133 6.81617 5.91133 6.17849C5.91133 5.5408 6.02618 4.94224 6.22718 4.39527C6.43445 3.82607 6.74401 3.31289 7.12357 2.88599C7.49684 2.46442 7.94548 2.12823 8.43989 1.90055C8.91724 1.67287 9.44036 1.5528 9.98591 1.5528C10.5315 1.5528 11.0546 1.67287 11.5319 1.90055ZM9.98591 13.5506H10.0146C10.4283 13.5506 10.8365 13.5106 11.2331 13.4314C11.6351 13.3576 12.0317 13.2375 12.4113 13.0837C12.7908 12.936 13.1587 12.7421 13.5033 12.5198C13.8595 12.2974 14.187 12.036 14.4975 11.7505L14.5549 11.6882L14.5666 11.6829L14.5782 11.6882L14.641 11.7051C15.1875 11.899 15.6989 12.1498 16.1754 12.4744C16.6528 12.7991 17.0835 13.2037 17.463 13.716C17.8363 14.2345 18.1584 14.8669 18.4114 15.6415C18.6582 16.4162 18.8368 17.3331 18.9229 18.4217V18.4449H1.07764V18.4217C1.16378 17.334 1.34234 16.4162 1.5891 15.6415C1.84213 14.8669 2.15798 14.2345 2.53753 13.716C2.91708 13.2037 3.34778 12.7991 3.82514 12.4744C4.30249 12.1498 4.81933 11.899 5.3595 11.7051L5.41693 11.6882L5.42859 11.6829L5.44025 11.6882C5.45192 11.6998 5.46269 11.7113 5.47435 11.7167C5.48602 11.7282 5.49768 11.7398 5.50306 11.7505C5.81353 12.0351 6.14104 12.2974 6.49726 12.5198C6.84182 12.7421 7.20971 12.936 7.58926 13.0837C7.96881 13.2375 8.35913 13.3576 8.7674 13.4314C9.164 13.5115 9.57226 13.5506 9.98591 13.5506ZM0.681042 15.3391C0.399293 16.2107 0.203685 17.2362 0.117545 18.4555H0.118442L0.106777 18.5356C0.0951128 18.7126 0.083448 18.8433 0.112161 18.9518C0.135491 19.0603 0.192917 19.151 0.313154 19.2533C0.491714 19.4018 0.646945 19.4018 0.934077 19.3956H19.0665C19.3536 19.401 19.5088 19.401 19.6874 19.2533C19.9288 19.0541 19.9171 18.8887 19.8947 18.5409V18.5356L19.883 18.4555C19.7969 17.2362 19.6012 16.2107 19.3195 15.3391C19.0378 14.4675 18.6699 13.7498 18.2392 13.1575C17.7968 12.5536 17.2907 12.0804 16.7389 11.7051C16.1925 11.3236 15.5949 11.039 14.9686 10.8166C14.9515 10.8113 14.9345 10.8051 14.9111 10.7935C14.8941 10.7882 14.8707 10.7766 14.8537 10.7704H14.8483C14.6357 10.6903 14.5325 10.6512 14.3485 10.6903L14.3431 10.6957C14.1592 10.7357 14.0901 10.8042 13.9636 10.9349L13.9582 10.9402L13.8434 11.0541V11.0594C13.5733 11.304 13.2915 11.5264 12.9873 11.7202C12.6885 11.9079 12.3781 12.0733 12.0506 12.2041C11.7347 12.3295 11.4009 12.4317 11.0564 12.5002C10.7172 12.5625 10.3726 12.5972 10.0164 12.5972H9.98771C9.63149 12.5972 9.28693 12.5634 8.94775 12.5002C8.60858 12.4317 8.27568 12.3348 7.95356 12.2041C7.62605 12.0733 7.31559 11.9079 7.01679 11.7202C6.71171 11.5264 6.43086 11.304 6.16616 11.0594V11.0541C6.14283 11.0372 6.12578 11.0194 6.11412 11.0087C6.0854 10.9803 6.06208 10.9634 6.04503 10.9402L6.03964 10.9349C5.91313 10.8042 5.84403 10.7357 5.66637 10.6957L5.66099 10.6903C5.47166 10.6503 5.36757 10.6903 5.15492 10.7704H5.14953C5.1262 10.7819 5.10377 10.7873 5.08044 10.7988C5.06339 10.8042 5.04545 10.8104 5.03468 10.8157C4.40837 11.0381 3.81616 11.3227 3.26433 11.7042C2.7125 12.0804 2.20643 12.5527 1.76407 13.1566C1.33337 13.7489 0.965482 14.4667 0.683733 15.3383L0.681042 15.3391ZM11.9232 1.02895C11.3256 0.755914 10.6705 0.602051 9.98591 0.602051C9.2959 0.602051 8.64088 0.755914 8.04867 1.02895C7.42775 1.31356 6.87053 1.73513 6.40484 2.25986C5.95081 2.77215 5.57754 3.3876 5.32989 4.06531C5.08313 4.71456 4.95034 5.43229 4.95034 6.17849C4.95034 6.92468 5.08852 7.64241 5.32989 8.29789C5.57664 8.9756 5.95081 9.59105 6.40484 10.1033C6.87053 10.6218 7.42775 11.0434 8.04867 11.328C8.64626 11.6073 9.2959 11.7549 9.98591 11.7549C10.6759 11.7549 11.3247 11.6073 11.9232 11.328C12.5378 11.0434 13.0959 10.6218 13.5607 10.1033C14.0201 9.59105 14.388 8.9756 14.641 8.29789C14.8824 7.64241 15.0143 6.93091 15.0143 6.17849C15.0143 5.42607 14.8824 4.71456 14.641 4.06531C14.388 3.38138 14.0201 2.77215 13.5607 2.25986C13.095 1.73602 12.5378 1.31445 11.9232 1.02895Z" fill="white"/>
						</svg>
						<span class="text-sm font-medium">Customer Portal</span>
					</a>
					<?php endif; ?>
				</div>

			</div>
			<?php endif; ?>
			<?php /* /header banner */ ?>

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

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'loden-consulting' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'walker'         => new Loden_Desktop_Nav_Walker(),
								'container'      => false,
								'menu_id'        => 'primary-nav-menu',
								'menu_class'     => 'flex items-center gap-8 list-none m-0 p-0',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
					} else {
						// Static placeholder — shown until a Primary Menu is assigned in WP Admin.
						?>
						<ul class="flex items-center gap-8 list-none m-0 p-0">
							<li class="mega-menu-item"><a href="/services" class="nav-link"><?php esc_html_e( 'Services', 'loden-consulting' ); ?></a></li>
							<li class="mega-menu-item"><a href="/about" class="nav-link"><?php esc_html_e( 'About', 'loden-consulting' ); ?></a></li>
							<li class="mega-menu-item"><a href="/residential" class="nav-link"><?php esc_html_e( 'Residential', 'loden-consulting' ); ?></a></li>
							<li class="mega-menu-item"><a href="/commercial" class="nav-link"><?php esc_html_e( 'Commercial', 'loden-consulting' ); ?></a></li>
							<li class="mega-menu-item"><a href="/service-areas" class="nav-link"><?php esc_html_e( 'Service Areas', 'loden-consulting' ); ?></a></li>
						</ul>
						<?php
					}
					?>
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
