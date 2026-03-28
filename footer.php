<?php

/**
 * The template for displaying the footer
 *
 * @package Loden_Consulting
 */

// ACF Website Settings — CTA for mobile drawer + logos.
$cta_text           = function_exists('get_field') ? get_field('header_cta_button_text', 'option') : '';
$cta_link           = function_exists('get_field') ? get_field('header_cta_button_link', 'option') : '';
$header_logo_white  = function_exists('get_field') ? get_field('header_image', 'option') : null;
$footer_logo        = function_exists('get_field') ? get_field('footer_image', 'option') : null;
$footer_logo_mobile = function_exists('get_field') ? get_field('footer_image_mobile', 'option') : null;

// ACF footer content fields.
$footer_logo_text      = function_exists('get_field') ? get_field('footer_logo_text', 'option') : '';
$footer_disclaimer     = function_exists('get_field') ? get_field('footer_disclaimer', 'option') : '';
$footer_service_areas  = function_exists('get_field') ? get_field('footer_service_areas', 'option') : [];
$facebook_link         = function_exists('get_field') ? get_field('facebook_link', 'option') : '';
$instagram_link        = function_exists('get_field') ? get_field('instagram_link', 'option') : '';
$google_link           = function_exists('get_field') ? get_field('google_link', 'option') : '';
$yelp_link             = function_exists('get_field') ? get_field('yelp_link', 'option') : '';
$refer_title           = function_exists('get_field') ? get_field('footer_refer_title', 'option') : '';
$refer_sub_title       = function_exists('get_field') ? get_field('footer_refer_sub_title', 'option') : '';
$refer_link            = function_exists('get_field') ? get_field('footer_refer_link', 'option') : '';
?>

<footer id="colophon" class="site-footer mt-auto">

	<?php /* ============================================================
	 * Section 1 — Main footer body
	 * ============================================================ */ ?>
	<div class="bg-[#12242B] text-white">
		<div class="container mx-auto px-6 py-12 lg:py-16">

			<?php /* ── Mobile layout (hidden on lg+) ── */ ?>
			<div class="lg:hidden">

				<?php /* Mobile logo — centered */ ?>
				<div class="flex justify-center mb-6">
					<?php if ($footer_logo_mobile) : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<img
								src="<?php echo esc_url($footer_logo_mobile['url']); ?>"
								alt="<?php echo esc_attr($footer_logo_mobile['alt'] ?: get_bloginfo('name')); ?>"
								class="h-24 w-auto">
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-2xl font-bold text-white">
							<?php bloginfo('name'); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php /* Mobile tagline */ ?>
				<?php if ($footer_logo_text) : ?>
					<p class="text-center text-sm text-white/60 leading-relaxed max-w-xs mx-auto mb-6">
						<?php echo wp_kses_post($footer_logo_text); ?>
					</p>
				<?php endif; ?>

				<?php /* Social icons — mobile (displayed here, below tagline) */ ?>
				<?php if ($facebook_link || $instagram_link || $google_link || $yelp_link) : ?>
					<div class="flex justify-center items-center gap-5 mb-10">
						<?php if ($facebook_link) : ?>
							<a href="<?php echo esc_url($facebook_link); ?>" aria-label="Facebook" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
									<g clip-path="url(#clip0_840_100m)">
										<path d="M9.5 0C4.25334 0 0 4.25334 0 9.5C0 13.9551 3.06736 17.6936 7.20518 18.7203V12.4032H5.24628V9.5H7.20518V8.24904C7.20518 5.01562 8.66856 3.5169 11.8431 3.5169C12.445 3.5169 13.4835 3.63508 13.9084 3.75288V6.38438C13.6842 6.36082 13.2947 6.34904 12.8109 6.34904C11.2533 6.34904 10.6514 6.93918 10.6514 8.47324V9.5H13.7545L13.2213 12.4032H10.6514V18.9305C15.3554 18.3624 19.0004 14.3572 19.0004 9.5C19 4.25334 14.7467 0 9.5 0Z" fill="white" />
									</g>
									<defs>
										<clipPath id="clip0_840_100m">
											<rect width="19" height="19" fill="white" />
										</clipPath>
									</defs>
								</svg>
							</a>
						<?php endif; ?>
						<?php if ($instagram_link) : ?>
							<a href="<?php echo esc_url($instagram_link); ?>" aria-label="Instagram" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
									<g clip-path="url(#clip0_840_103m)">
										<path d="M9.5 1.71074C12.0383 1.71074 12.3389 1.72187 13.3371 1.76641C14.2648 1.80723 14.7658 1.96309 15.0998 2.09297C15.5414 2.26367 15.8605 2.47148 16.1908 2.80176C16.5248 3.13574 16.7289 3.45117 16.8996 3.89277C17.0295 4.22676 17.1854 4.73145 17.2262 5.65547C17.2707 6.65742 17.2818 6.95801 17.2818 9.49258C17.2818 12.0309 17.2707 12.3314 17.2262 13.3297C17.1854 14.2574 17.0295 14.7584 16.8996 15.0924C16.7289 15.534 16.5211 15.8531 16.1908 16.1834C15.8568 16.5174 15.5414 16.7215 15.0998 16.8922C14.7658 17.0221 14.2611 17.1779 13.3371 17.2188C12.3352 17.2633 12.0346 17.2744 9.5 17.2744C6.96172 17.2744 6.66113 17.2633 5.66289 17.2188C4.73516 17.1779 4.23418 17.0221 3.9002 16.8922C3.45859 16.7215 3.13945 16.5137 2.80918 16.1834C2.4752 15.8494 2.27109 15.534 2.10039 15.0924C1.97051 14.7584 1.81465 14.2537 1.77383 13.3297C1.7293 12.3277 1.71816 12.0271 1.71816 9.49258C1.71816 6.9543 1.7293 6.65371 1.77383 5.65547C1.81465 4.72773 1.97051 4.22676 2.10039 3.89277C2.27109 3.45117 2.47891 3.13203 2.80918 2.80176C3.14316 2.46777 3.45859 2.26367 3.9002 2.09297C4.23418 1.96309 4.73887 1.80723 5.66289 1.76641C6.66113 1.72187 6.96172 1.71074 9.5 1.71074ZM9.5 0C6.9209 0 6.59805 0.0111328 5.58496 0.0556641C4.57559 0.100195 3.88164 0.263477 3.28047 0.497266C2.65332 0.742188 2.12266 1.06504 1.5957 1.5957C1.06504 2.12266 0.742188 2.65332 0.497266 3.27676C0.263477 3.88164 0.100195 4.57187 0.0556641 5.58125C0.0111328 6.59805 0 6.9209 0 9.5C0 12.0791 0.0111328 12.402 0.0556641 13.415C0.100195 14.4244 0.263477 15.1184 0.497266 15.7195C0.742188 16.3467 1.06504 16.8773 1.5957 17.4043C2.12266 17.9312 2.65332 18.2578 3.27676 18.499C3.88164 18.7328 4.57188 18.8961 5.58125 18.9406C6.59434 18.9852 6.91719 18.9963 9.49629 18.9963C12.0754 18.9963 12.3982 18.9852 13.4113 18.9406C14.4207 18.8961 15.1147 18.7328 15.7158 18.499C16.3393 18.2578 16.8699 17.9312 17.3969 17.4043C17.9238 16.8773 18.2504 16.3467 18.4916 15.7232C18.7254 15.1184 18.8887 14.4281 18.9332 13.4188C18.9777 12.4057 18.9889 12.0828 18.9889 9.50371C18.9889 6.92461 18.9777 6.60176 18.9332 5.58867C18.8887 4.5793 18.7254 3.88535 18.4916 3.28418C18.2578 2.65332 17.935 2.12266 17.4043 1.5957C16.8773 1.06875 16.3467 0.742188 15.7232 0.500977C15.1184 0.267187 14.4281 0.103906 13.4188 0.059375C12.402 0.0111328 12.0791 0 9.5 0Z" fill="white" />
										<path d="M9.5 4.62012C6.80586 4.62012 4.62012 6.80586 4.62012 9.5C4.62012 12.1941 6.80586 14.3799 9.5 14.3799C12.1941 14.3799 14.3799 12.1941 14.3799 9.5C14.3799 6.80586 12.1941 4.62012 9.5 4.62012ZM9.5 12.6654C7.75215 12.6654 6.33457 11.2479 6.33457 9.5C6.33457 7.75215 7.75215 6.33457 9.5 6.33457C11.2479 6.33457 12.6654 7.75215 12.6654 9.5C12.6654 11.2479 11.2479 12.6654 9.5 12.6654Z" fill="white" />
										<path d="M15.7121 4.4271C15.7121 5.05796 15.2 5.56636 14.5729 5.56636C13.942 5.56636 13.4336 5.05425 13.4336 4.4271C13.4336 3.79624 13.9457 3.28784 14.5729 3.28784C15.2 3.28784 15.7121 3.79995 15.7121 4.4271Z" fill="white" />
									</g>
									<defs>
										<clipPath id="clip0_840_103m">
											<rect width="19" height="19" fill="white" />
										</clipPath>
									</defs>
								</svg>
							</a>
						<?php endif; ?>
						<?php if ($google_link) : ?>
							<a href="<?php echo esc_url($google_link); ?>" aria-label="Google" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
									<mask id="mask0_840_110m" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="19" height="19">
										<path d="M18.8175 7.73753H9.70237V11.39H14.94C14.8558 11.9069 14.6667 12.4154 14.3899 12.8791C14.0727 13.4103 13.6805 13.8147 13.2786 14.1227C12.0746 15.0453 10.6709 15.234 9.69601 15.234C7.23338 15.234 5.12923 13.6424 4.31467 11.4796C4.2818 11.4011 4.25997 11.3201 4.23339 11.2399C4.05339 10.6895 3.95504 10.1065 3.95504 9.5006C3.95504 8.87001 4.06154 8.26638 4.25573 7.69627C5.02169 5.44778 7.17328 3.76838 9.69778 3.76838C10.2056 3.76838 10.6945 3.82882 11.1582 3.94938C12.218 4.22489 12.9676 4.76751 13.4269 5.19672L16.1985 2.48247C14.5126 0.936674 12.3148 2.33714e-09 9.69317 2.33714e-09C7.59735 -4.51086e-05 5.6624 0.652952 4.07677 1.75654C2.79087 2.65152 1.73625 3.84978 1.02452 5.24143C0.362497 6.53177 0 7.96171 0 9.49918C0 11.0367 0.363051 12.4815 1.02507 13.7599V13.7685C1.72433 15.1257 2.74688 16.2943 3.98969 17.1852C5.07541 17.9635 7.02222 19 9.69317 19C11.2292 19 12.5905 18.7231 13.791 18.2041C14.6571 17.8297 15.4245 17.3414 16.1192 16.7138C17.0372 15.8846 17.7561 14.8589 18.2468 13.6788C18.7375 12.4987 19 11.1642 19 9.71744C19 9.04365 18.9323 8.35937 18.8175 7.73746V7.73753Z" fill="white" />
									</mask>
									<g mask="url(#mask0_840_110m)">
										<g filter="url(#f0m)">
											<path d="M-0.109619 9.54053C-0.0995439 11.0538 0.331656 12.6151 0.984349 13.8755V13.8842C1.45595 14.7995 2.10049 15.5226 2.83462 16.239L7.26854 14.6211C6.42967 14.195 6.30167 13.9339 5.70033 13.4574C5.08582 12.8378 4.62782 12.1264 4.3426 11.2923H4.33111L4.3426 11.2836C4.15495 10.7328 4.13644 10.1482 4.12952 9.54053H-0.109619Z" fill="white" />
										</g>
										<g filter="url(#f1m)">
											<path d="M9.7326 -0.0922852C9.29435 1.44734 9.46192 2.94391 9.7326 3.81468C10.2387 3.81506 10.7262 3.87538 11.1885 3.99556C12.2482 4.27107 12.9977 4.81371 13.4571 5.24292L16.2996 2.45933C14.6157 0.915373 12.5892 -0.0898526 9.7326 -0.0922852Z" fill="white" />
										</g>
										<g filter="url(#f2m)">
											<path d="M9.72304 -0.104492C7.57342 -0.104539 5.5888 0.565223 3.96247 1.69714C3.35861 2.11743 2.80446 2.60292 2.31102 3.1428C2.18176 4.35553 3.27869 5.84609 5.45097 5.83375C6.50494 4.60774 8.06375 3.81451 9.7987 3.81451C9.80028 3.81451 9.80182 3.81464 9.80341 3.81465L9.73255 -0.104215C9.72935 -0.104217 9.72625 -0.104492 9.72304 -0.104492Z" fill="white" />
										</g>
										<g filter="url(#f3m)">
											<path d="M16.818 9.97938L14.8994 11.2975C14.8152 11.8144 14.626 12.3229 14.3491 12.7866C14.0319 13.3178 13.6398 13.7223 13.2379 14.0303C12.0363 14.951 10.6363 15.1405 9.66173 15.1413C8.65439 16.857 8.47778 17.7164 9.73259 19.1011C11.2853 19.1 12.6618 18.8197 13.876 18.2948C14.7537 17.9154 15.5313 17.4205 16.2354 16.7845C17.1656 15.9442 17.8943 14.9047 18.3916 13.7088C18.8889 12.5129 19.1548 11.1605 19.1548 9.69434L16.818 9.97938Z" fill="white" />
										</g>
										<g filter="url(#f4m)">
											<path d="M9.59082 7.57544V11.5054H18.8221C18.9033 10.9672 19.1718 10.2707 19.1718 9.69415C19.1718 9.02036 19.1042 8.19735 18.9894 7.57544H9.59082Z" fill="white" />
										</g>
										<g filter="url(#f5m)">
											<path d="M2.35512 3.00415C1.78546 3.62744 1.29879 4.32508 0.912917 5.07957C0.250908 6.36991 -0.111572 7.93861 -0.111572 9.47607C-0.111572 9.49774 -0.109779 9.51893 -0.109635 9.54056C0.183549 10.1027 3.94016 9.99506 4.12951 9.54056C4.12927 9.51936 4.12688 9.49868 4.12688 9.47742C4.12688 8.84683 4.23341 8.38203 4.4276 7.81193C4.66715 7.10871 5.04225 6.46114 5.52188 5.90321C5.63061 5.7644 5.92063 5.46598 6.00524 5.28699C6.03747 5.21881 5.94673 5.18054 5.94165 5.15654C5.93597 5.1297 5.8143 5.15129 5.78705 5.13129C5.7005 5.06781 5.52912 5.03466 5.42505 5.0052C5.20261 4.94221 4.83397 4.80332 4.62921 4.65934C3.98199 4.20422 2.97194 3.6606 2.35512 3.00415Z" fill="white" />
										</g>
										<g filter="url(#f6m)">
											<path d="M4.64301 5.15918C6.14386 6.06832 6.57547 4.70028 7.57333 4.27219L5.83753 0.672607C5.199 0.940978 4.59573 1.2744 4.03598 1.66398C3.20004 2.24579 2.46185 2.95576 1.85205 3.76372L4.64301 5.15918Z" fill="white" />
										</g>
										<g filter="url(#f7m)">
											<path d="M5.25408 14.3429C3.23939 15.0702 2.92398 15.0963 2.73853 16.3448C3.09292 16.6907 3.47368 17.0106 3.8783 17.3006C4.96403 18.0789 7.05249 19.1154 9.72345 19.1154C9.72658 19.1154 9.72958 19.1151 9.73272 19.1151V15.0717C9.7307 15.0718 9.72838 15.0719 9.72635 15.0719C8.72617 15.0719 7.92693 14.8092 7.10746 14.3523C6.90541 14.2397 6.53884 14.5422 6.3525 14.407C6.0955 14.2205 5.47699 14.5676 5.25408 14.3429Z" fill="white" />
										</g>
										<g opacity="0.5" filter="url(#f8m)">
											<path d="M8.55273 14.9446V19.0453C8.92645 19.089 9.31537 19.1156 9.72337 19.1156C10.1324 19.1156 10.5281 19.0946 10.9125 19.056V14.9722C10.4817 15.0459 10.0758 15.0721 9.72627 15.0721C9.32366 15.0721 8.93212 15.0252 8.55273 14.9446Z" fill="white" />
										</g>
									</g>
									<defs>
										<filter id="f0m" x="-0.579698" y="9.07045" width="8.31833" height="7.63864" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f1m" x="8.99306" y="-0.562364" width="7.77658" height="6.27536" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f2m" x="1.8307" y="-0.574572" width="8.44284" height="6.87839" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f3m" x="8.37831" y="9.22426" width="11.2466" height="10.3469" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f4m" x="9.12074" y="7.10536" width="10.5212" height="4.87009" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f5m" x="-0.581652" y="2.53407" width="7.06394" height="7.85886" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f6m" x="-1.4528" y="-2.63224" width="12.3309" height="11.4019" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="1.65243" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f7m" x="2.26845" y="13.8566" width="7.9343" height="5.72898" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
										<filter id="f8m" x="8.08266" y="14.4745" width="3.30002" height="5.1113" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix" />
											<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
											<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
										</filter>
									</defs>
								</svg>
							</a>
						<?php endif; ?>
						<?php if ($yelp_link) : ?>
							<a href="<?php echo esc_url($yelp_link); ?>" aria-label="Yelp" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
									<path d="M10.0581 8.06605C10.0412 8.39395 10.0219 8.76851 9.81535 9.02801C9.79893 9.04697 9.78153 9.06507 9.76322 9.08223C9.66185 9.19003 9.53266 9.2676 9.38997 9.30638L9.36241 9.31277C9.20788 9.34868 9.04621 9.33784 8.8979 9.28167C8.87518 9.27442 8.85286 9.26595 8.83099 9.25639C8.5327 9.11409 8.35186 8.78638 8.19384 8.50003C8.17674 8.46903 8.15964 8.43805 8.14295 8.40832L7.90838 7.99043C7.4139 7.10965 6.91945 6.22892 6.43279 5.34342C6.37732 5.24234 6.32044 5.1424 6.26364 5.04257C6.10213 4.75876 5.94113 4.47583 5.81445 4.17056C5.80254 4.14186 5.79034 4.11287 5.77803 4.08362C5.6443 3.76585 5.49753 3.41709 5.56791 3.0755C5.70423 2.41565 6.50931 2.07132 7.08198 1.88374C7.2579 1.8274 7.4377 1.77977 7.61937 1.73615C7.80103 1.69254 7.98417 1.65842 8.16699 1.63305C8.7638 1.55042 9.63848 1.50665 10.0487 2.03929C10.2613 2.31564 10.2816 2.69288 10.3001 3.03695C10.3019 3.06895 10.3036 3.10066 10.3054 3.13198C10.3249 3.46231 10.3039 3.78752 10.2827 4.11382C10.2753 4.22822 10.2679 4.34277 10.2622 4.45771C10.2159 5.39967 10.16 6.34132 10.104 7.28283C10.0905 7.50976 10.077 7.73669 10.0636 7.96361C10.0617 7.99706 10.0599 8.03137 10.0581 8.06605Z" fill="white" />
									<path d="M15.4573 7.70244C15.2582 7.28467 14.9906 6.90327 14.6656 6.57408C14.6235 6.53229 14.5785 6.49362 14.5308 6.45839C14.4868 6.42536 14.441 6.39466 14.3938 6.36642C14.3452 6.33978 14.2953 6.31576 14.2441 6.29446C14.143 6.25477 14.0346 6.23688 13.9262 6.24195C13.8224 6.24785 13.7211 6.27628 13.6294 6.32526C13.4904 6.39438 13.3399 6.50548 13.1398 6.6915C13.1216 6.70966 13.1002 6.72935 13.0788 6.74906L13.0636 6.76305L13.0463 6.77916C12.9139 6.90362 12.7696 7.0513 12.6049 7.21982L12.479 7.34859C12.1413 7.68978 11.8088 8.03283 11.4784 8.37964L10.8872 8.99275C10.7789 9.10478 10.6803 9.2258 10.5925 9.3545C10.5176 9.46323 10.4646 9.58554 10.4366 9.7146C10.4203 9.81349 10.4227 9.91462 10.4436 10.0126L10.4466 10.0258C10.4934 10.2289 10.617 10.4059 10.7916 10.5194C10.9661 10.633 11.1779 10.6744 11.3824 10.6347C11.4148 10.6301 11.4399 10.6245 11.4552 10.6207L14.6553 9.88142C14.8881 9.82791 15.1223 9.77409 15.3312 9.65284C15.4809 9.56601 15.6233 9.47997 15.721 9.30638C15.7732 9.211 15.8048 9.10572 15.8137 8.99742C15.8621 8.56779 15.6378 8.07989 15.4573 7.70244Z" fill="white" />
									<path d="M7.32332 11.5732L8.05239 11.4047C8.06773 11.4012 8.09306 11.3954 8.124 11.3854C8.32516 11.3313 8.49755 11.2012 8.60485 11.0224C8.71215 10.8437 8.746 10.6304 8.69926 10.4273L8.69624 10.4142C8.67229 10.3169 8.63034 10.2249 8.57256 10.1431C8.49085 10.0394 8.38974 9.95269 8.27488 9.88777C8.13968 9.81063 7.99816 9.74506 7.85187 9.69184L7.05248 9.40004C6.60387 9.23328 6.15529 9.07068 5.70248 8.9121C5.64399 8.89129 5.58728 8.87098 5.53225 8.85127C5.31102 8.77205 5.11699 8.70257 4.94387 8.64903C4.93053 8.64492 4.91673 8.64081 4.90292 8.6367C4.87452 8.62823 4.84608 8.61976 4.82145 8.61125C4.56011 8.53115 4.37648 8.49794 4.22108 8.49685C4.11728 8.49304 4.01389 8.5119 3.91809 8.5521C3.81825 8.59517 3.72858 8.6588 3.65496 8.73888C3.61833 8.78053 3.5839 8.82405 3.55179 8.86923C3.52167 8.91534 3.49404 8.96295 3.46903 9.012C3.44149 9.06465 3.41782 9.11916 3.39821 9.17518C3.24985 9.61378 3.17594 10.0741 3.17957 10.537C3.18225 10.9555 3.19349 11.4926 3.42352 11.8568C3.47895 11.9502 3.55333 12.031 3.64188 12.0939C3.80575 12.207 3.97135 12.222 4.14364 12.2344C4.38484 12.2517 4.61899 12.1972 4.85205 12.143L7.32129 11.5725L7.32332 11.5732Z" fill="white" />
									<path d="M9.54183 12.1559C9.45267 12.0305 9.32614 11.9365 9.18032 11.8874C9.03451 11.8383 8.87688 11.8365 8.72996 11.8824C8.69545 11.8939 8.66182 11.9079 8.62933 11.9242C8.57908 11.9497 8.53114 11.9796 8.48604 12.0135C8.35467 12.1108 8.24404 12.2373 8.14331 12.3641C8.1343 12.3755 8.12557 12.3883 8.11671 12.4012C8.10043 12.4249 8.08372 12.4493 8.06405 12.4672L7.557 13.1647C7.26961 13.5554 6.98619 13.9471 6.70514 14.345C6.66857 14.3963 6.63299 14.4459 6.59847 14.4941L6.59782 14.495C6.45945 14.688 6.338 14.8574 6.23785 15.0109C6.2292 15.024 6.22043 15.0378 6.21168 15.0514C6.19642 15.0753 6.18123 15.0991 6.16689 15.1195C6.01672 15.3519 5.93167 15.5214 5.88802 15.6725C5.85524 15.7729 5.84486 15.8792 5.85763 15.984C5.87158 16.0931 5.90833 16.198 5.96549 16.2921C5.99587 16.3392 6.02862 16.3848 6.06361 16.4286C6.09998 16.4708 6.13859 16.511 6.17929 16.549C6.22276 16.5904 6.26925 16.6286 6.31838 16.6632C6.66836 16.9067 7.05148 17.0816 7.45449 17.2168C7.78985 17.3281 8.13844 17.3948 8.49126 17.4149C8.55128 17.418 8.61144 17.4167 8.67128 17.4111C8.72674 17.4063 8.78191 17.3985 8.83656 17.3879C8.89118 17.3752 8.94507 17.3594 8.99803 17.341C9.10106 17.3024 9.19487 17.2427 9.27342 17.1657C9.34776 17.0912 9.40499 17.0014 9.44109 16.9025C9.4997 16.7564 9.53824 16.5709 9.56359 16.2956C9.56507 16.2695 9.56803 16.24 9.571 16.2105C9.57249 16.1957 9.57399 16.1808 9.57529 16.1664C9.59099 15.987 9.60002 15.783 9.61029 15.5509C9.6131 15.4874 9.616 15.4217 9.61916 15.354C9.64395 14.8686 9.6634 14.3854 9.67878 13.9008C9.67878 13.9008 9.71143 13.0397 9.71133 13.0392C9.71881 12.8408 9.71269 12.6209 9.65764 12.4233C9.63347 12.3286 9.59438 12.2384 9.54183 12.1559Z" fill="white" />
									<path d="M14.7729 13.1295C15.0094 13.2725 15.1593 13.3882 15.2652 13.5043C15.3385 13.5801 15.3944 13.6711 15.4288 13.7709C15.4638 13.8751 15.4765 13.9854 15.4661 14.0949C15.4595 14.1505 15.45 14.2059 15.4378 14.2606C15.4235 14.3145 15.4064 14.3675 15.3868 14.4197C15.3657 14.476 15.3407 14.5307 15.3116 14.5834C15.1031 14.956 14.8351 15.2813 14.5319 15.5797C14.279 15.827 13.9948 16.0399 13.6863 16.2128C13.6338 16.2419 13.5792 16.2671 13.523 16.2882C13.471 16.3082 13.4179 16.3255 13.364 16.3399C13.3094 16.3525 13.2541 16.362 13.1984 16.3686C13.0889 16.3795 12.9783 16.3672 12.8739 16.3326C12.7746 16.2983 12.6839 16.2427 12.6082 16.1696C12.4914 16.0629 12.3763 15.9141 12.2329 15.6777C12.2196 15.6539 12.2034 15.6274 12.1872 15.6011C12.1801 15.5895 12.173 15.578 12.1662 15.5666C12.0726 15.4104 11.9739 15.2284 11.8615 15.0211C11.8325 14.9676 11.8026 14.9124 11.7716 14.8555C11.5373 14.4305 11.3089 14.0041 11.0831 13.5752L10.6774 12.8149C10.5841 12.6397 10.4938 12.4398 10.4567 12.2376C10.4381 12.1422 10.4346 12.0445 10.4462 11.948C10.4714 11.7962 10.5438 11.6563 10.6531 11.5481C10.7624 11.4399 10.903 11.369 11.0549 11.3455C11.091 11.3407 11.1272 11.3384 11.1637 11.3389C11.22 11.3399 11.2761 11.3457 11.3315 11.3563C11.4921 11.3862 11.6469 11.4513 11.7928 11.5211C11.8058 11.5274 11.8192 11.535 11.8328 11.5427C11.8579 11.5569 11.8837 11.5715 11.9093 11.579L12.669 11.9819C13.099 12.2079 13.5249 12.4357 13.9506 12.6694C14.0111 12.7022 14.0697 12.7338 14.1263 12.7644C14.3293 12.874 14.5079 12.9703 14.6618 13.0629C14.6742 13.0703 14.687 13.0782 14.6998 13.086C14.725 13.1014 14.7502 13.1168 14.7729 13.1295Z" fill="white" />
								</svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php /* /social icons */ ?>

				<?php /* Mobile nav — 2-column grid (Services | Company) */ ?>
				<div class="border-t border-white/10 pt-10 grid grid-cols-2 gap-x-6 gap-y-10">

					<?php /* SERVICES */ ?>
					<div>
						<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-4">Services</p>
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-menu-1',
							'menu_class'     => 'space-y-3',
							'container'      => false,
							'walker'         => new Loden_Footer_Nav_Walker(),
							'fallback_cb'    => false,
						));
						?>
					</div>

					<?php /* COMPANY */ ?>
					<div>
						<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-4">Company</p>
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-menu-2',
							'menu_class'     => 'space-y-3',
							'container'      => false,
							'walker'         => new Loden_Footer_Nav_Walker(),
							'fallback_cb'    => false,
						));
						?>
					</div>

				</div>
				<?php /* /mobile nav grid */ ?>

				<?php /* HOURS — full width, below nav grid */ ?>
				<div class="mt-10 pt-8 border-t border-white/10">
					<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-4">Hours</p>
					<dl class="space-y-2">
						<div class="flex justify-between gap-4 text-sm">
							<dt class="text-white/60">Mon-Fri</dt>
							<dd class="text-white text-right">7:30am – 7:00pm</dd>
						</div>
						<div class="flex justify-between gap-4 text-sm">
							<dt class="text-white/60">Saturday</dt>
							<dd class="text-white text-right">8:00am – 8:00pm</dd>
						</div>
						<div class="flex justify-between gap-4 text-sm">
							<dt class="text-white/60">Sunday</dt>
							<dd class="text-white text-right">Closed</dd>
						</div>
					</dl>
				</div>

				<?php /* Refer & Earn card — full width, below hours */ ?>
				<div class="mt-6">
					<a href="#" class="block border border-[#45B5E8] bg-[#143240] rounded-lg p-4 hover:brightness-110 transition-all">
						<p class="font-bold text-sm text-white">Refer &amp; Earn $100</p>
						<p class="text-xs text-[#45B5E8] mt-1 leading-relaxed">Send a friend, get rewarded - ask us how.</p>
					</a>
				</div>

			</div>
			<?php /* /mobile layout */ ?>

			<?php /* ── Desktop layout (hidden below lg) ── */ ?>
			<div class="hidden lg:grid lg:grid-cols-4 lg:gap-12">

				<?php /* Col 1 — Logo + tagline + social */ ?>
				<div class="flex flex-col gap-6">

					<?php /* Desktop logo */ ?>
					<?php if ($footer_logo) : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<img
								src="<?php echo esc_url($footer_logo['url']); ?>"
								alt="<?php echo esc_attr($footer_logo['alt'] ?: get_bloginfo('name')); ?>"
								class="h-16 w-auto">
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-xl font-bold text-white">
							<?php bloginfo('name'); ?>
						</a>
					<?php endif; ?>

					<?php if ($footer_logo_text) : ?>
						<p class="text-sm text-white/60 leading-relaxed">
							<?php echo wp_kses_post($footer_logo_text); ?>
						</p>
					<?php endif; ?>

					<?php /* Social icons */ ?>
					<?php if ($facebook_link || $instagram_link || $google_link || $yelp_link) : ?>
						<div class="flex items-center gap-4">
							<?php if ($facebook_link) : ?>
								<a href="<?php echo esc_url($facebook_link); ?>" aria-label="Facebook" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
										<g clip-path="url(#clip0_840_100)">
											<path d="M9.5 0C4.25334 0 0 4.25334 0 9.5C0 13.9551 3.06736 17.6936 7.20518 18.7203V12.4032H5.24628V9.5H7.20518V8.24904C7.20518 5.01562 8.66856 3.5169 11.8431 3.5169C12.445 3.5169 13.4835 3.63508 13.9084 3.75288V6.38438C13.6842 6.36082 13.2947 6.34904 12.8109 6.34904C11.2533 6.34904 10.6514 6.93918 10.6514 8.47324V9.5H13.7545L13.2213 12.4032H10.6514V18.9305C15.3554 18.3624 19.0004 14.3572 19.0004 9.5C19 4.25334 14.7467 0 9.5 0Z" fill="white" />
										</g>
										<defs>
											<clipPath id="clip0_840_100">
												<rect width="19" height="19" fill="white" />
											</clipPath>
										</defs>
									</svg>
								</a>
							<?php endif; ?>
							<?php if ($instagram_link) : ?>
								<a href="<?php echo esc_url($instagram_link); ?>" aria-label="Instagram" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
										<g clip-path="url(#clip0_840_103)">
											<path d="M9.5 1.71074C12.0383 1.71074 12.3389 1.72187 13.3371 1.76641C14.2648 1.80723 14.7658 1.96309 15.0998 2.09297C15.5414 2.26367 15.8605 2.47148 16.1908 2.80176C16.5248 3.13574 16.7289 3.45117 16.8996 3.89277C17.0295 4.22676 17.1854 4.73145 17.2262 5.65547C17.2707 6.65742 17.2818 6.95801 17.2818 9.49258C17.2818 12.0309 17.2707 12.3314 17.2262 13.3297C17.1854 14.2574 17.0295 14.7584 16.8996 15.0924C16.7289 15.534 16.5211 15.8531 16.1908 16.1834C15.8568 16.5174 15.5414 16.7215 15.0998 16.8922C14.7658 17.0221 14.2611 17.1779 13.3371 17.2188C12.3352 17.2633 12.0346 17.2744 9.5 17.2744C6.96172 17.2744 6.66113 17.2633 5.66289 17.2188C4.73516 17.1779 4.23418 17.0221 3.9002 16.8922C3.45859 16.7215 3.13945 16.5137 2.80918 16.1834C2.4752 15.8494 2.27109 15.534 2.10039 15.0924C1.97051 14.7584 1.81465 14.2537 1.77383 13.3297C1.7293 12.3277 1.71816 12.0271 1.71816 9.49258C1.71816 6.9543 1.7293 6.65371 1.77383 5.65547C1.81465 4.72773 1.97051 4.22676 2.10039 3.89277C2.27109 3.45117 2.47891 3.13203 2.80918 2.80176C3.14316 2.46777 3.45859 2.26367 3.9002 2.09297C4.23418 1.96309 4.73887 1.80723 5.66289 1.76641C6.66113 1.72187 6.96172 1.71074 9.5 1.71074ZM9.5 0C6.9209 0 6.59805 0.0111328 5.58496 0.0556641C4.57559 0.100195 3.88164 0.263477 3.28047 0.497266C2.65332 0.742188 2.12266 1.06504 1.5957 1.5957C1.06504 2.12266 0.742188 2.65332 0.497266 3.27676C0.263477 3.88164 0.100195 4.57187 0.0556641 5.58125C0.0111328 6.59805 0 6.9209 0 9.5C0 12.0791 0.0111328 12.402 0.0556641 13.415C0.100195 14.4244 0.263477 15.1184 0.497266 15.7195C0.742188 16.3467 1.06504 16.8773 1.5957 17.4043C2.12266 17.9312 2.65332 18.2578 3.27676 18.499C3.88164 18.7328 4.57188 18.8961 5.58125 18.9406C6.59434 18.9852 6.91719 18.9963 9.49629 18.9963C12.0754 18.9963 12.3982 18.9852 13.4113 18.9406C14.4207 18.8961 15.1147 18.7328 15.7158 18.499C16.3393 18.2578 16.8699 17.9312 17.3969 17.4043C17.9238 16.8773 18.2504 16.3467 18.4916 15.7232C18.7254 15.1184 18.8887 14.4281 18.9332 13.4188C18.9777 12.4057 18.9889 12.0828 18.9889 9.50371C18.9889 6.92461 18.9777 6.60176 18.9332 5.58867C18.8887 4.5793 18.7254 3.88535 18.4916 3.28418C18.2578 2.65332 17.935 2.12266 17.4043 1.5957C16.8773 1.06875 16.3467 0.742188 15.7232 0.500977C15.1184 0.267187 14.4281 0.103906 13.4188 0.059375C12.402 0.0111328 12.0791 0 9.5 0Z" fill="white" />
											<path d="M9.5 4.62012C6.80586 4.62012 4.62012 6.80586 4.62012 9.5C4.62012 12.1941 6.80586 14.3799 9.5 14.3799C12.1941 14.3799 14.3799 12.1941 14.3799 9.5C14.3799 6.80586 12.1941 4.62012 9.5 4.62012ZM9.5 12.6654C7.75215 12.6654 6.33457 11.2479 6.33457 9.5C6.33457 7.75215 7.75215 6.33457 9.5 6.33457C11.2479 6.33457 12.6654 7.75215 12.6654 9.5C12.6654 11.2479 11.2479 12.6654 9.5 12.6654Z" fill="white" />
											<path d="M15.7121 4.4271C15.7121 5.05796 15.2 5.56636 14.5729 5.56636C13.942 5.56636 13.4336 5.05425 13.4336 4.4271C13.4336 3.79624 13.9457 3.28784 14.5729 3.28784C15.2 3.28784 15.7121 3.79995 15.7121 4.4271Z" fill="white" />
										</g>
										<defs>
											<clipPath id="clip0_840_103">
												<rect width="19" height="19" fill="white" />
											</clipPath>
										</defs>
									</svg>
								</a>
							<?php endif; ?>
							<?php if ($google_link) : ?>
								<a href="<?php echo esc_url($google_link); ?>" aria-label="Google" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
										<mask id="mask0_840_110" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="19" height="19">
											<path d="M18.8175 7.73753H9.70237V11.39H14.94C14.8558 11.9069 14.6667 12.4154 14.3899 12.8791C14.0727 13.4103 13.6805 13.8147 13.2786 14.1227C12.0746 15.0453 10.6709 15.234 9.69601 15.234C7.23338 15.234 5.12923 13.6424 4.31467 11.4796C4.2818 11.4011 4.25997 11.3201 4.23339 11.2399C4.05339 10.6895 3.95504 10.1065 3.95504 9.5006C3.95504 8.87001 4.06154 8.26638 4.25573 7.69627C5.02169 5.44778 7.17328 3.76838 9.69778 3.76838C10.2056 3.76838 10.6945 3.82882 11.1582 3.94938C12.218 4.22489 12.9676 4.76751 13.4269 5.19672L16.1985 2.48247C14.5126 0.936674 12.3148 2.33714e-09 9.69317 2.33714e-09C7.59735 -4.51086e-05 5.6624 0.652952 4.07677 1.75654C2.79087 2.65152 1.73625 3.84978 1.02452 5.24143C0.362497 6.53177 0 7.96171 0 9.49918C0 11.0367 0.363051 12.4815 1.02507 13.7599V13.7685C1.72433 15.1257 2.74688 16.2943 3.98969 17.1852C5.07541 17.9635 7.02222 19 9.69317 19C11.2292 19 12.5905 18.7231 13.791 18.2041C14.6571 17.8297 15.4245 17.3414 16.1192 16.7138C17.0372 15.8846 17.7561 14.8589 18.2468 13.6788C18.7375 12.4987 19 11.1642 19 9.71744C19 9.04365 18.9323 8.35937 18.8175 7.73746V7.73753Z" fill="white" />
										</mask>
										<g mask="url(#mask0_840_110)">
											<g filter="url(#filter0_f_840_110)">
												<path d="M-0.109619 9.54053C-0.0995439 11.0538 0.331656 12.6151 0.984349 13.8755V13.8842C1.45595 14.7995 2.10049 15.5226 2.83462 16.239L7.26854 14.6211C6.42967 14.195 6.30167 13.9339 5.70033 13.4574C5.08582 12.8378 4.62782 12.1264 4.3426 11.2923H4.33111L4.3426 11.2836C4.15495 10.7328 4.13644 10.1482 4.12952 9.54053H-0.109619Z" fill="white" />
											</g>
											<g filter="url(#filter1_f_840_110)">
												<path d="M9.7326 -0.0922852C9.29435 1.44734 9.46192 2.94391 9.7326 3.81468C10.2387 3.81506 10.7262 3.87538 11.1885 3.99556C12.2482 4.27107 12.9977 4.81371 13.4571 5.24292L16.2996 2.45933C14.6157 0.915373 12.5892 -0.0898526 9.7326 -0.0922852Z" fill="white" />
											</g>
											<g filter="url(#filter2_f_840_110)">
												<path d="M9.72304 -0.104492C7.57342 -0.104539 5.5888 0.565223 3.96247 1.69714C3.35861 2.11743 2.80446 2.60292 2.31102 3.1428C2.18176 4.35553 3.27869 5.84609 5.45097 5.83375C6.50494 4.60774 8.06375 3.81451 9.7987 3.81451C9.80028 3.81451 9.80182 3.81464 9.80341 3.81465L9.73255 -0.104215C9.72935 -0.104217 9.72625 -0.104492 9.72304 -0.104492Z" fill="white" />
											</g>
											<g filter="url(#filter3_f_840_110)">
												<path d="M16.818 9.97938L14.8994 11.2975C14.8152 11.8144 14.626 12.3229 14.3491 12.7866C14.0319 13.3178 13.6398 13.7223 13.2379 14.0303C12.0363 14.951 10.6363 15.1405 9.66173 15.1413C8.65439 16.857 8.47778 17.7164 9.73259 19.1011C11.2853 19.1 12.6618 18.8197 13.876 18.2948C14.7537 17.9154 15.5313 17.4205 16.2354 16.7845C17.1656 15.9442 17.8943 14.9047 18.3916 13.7088C18.8889 12.5129 19.1548 11.1605 19.1548 9.69434L16.818 9.97938Z" fill="white" />
											</g>
											<g filter="url(#filter4_f_840_110)">
												<path d="M9.59082 7.57544V11.5054H18.8221C18.9033 10.9672 19.1718 10.2707 19.1718 9.69415C19.1718 9.02036 19.1042 8.19735 18.9894 7.57544H9.59082Z" fill="white" />
											</g>
											<g filter="url(#filter5_f_840_110)">
												<path d="M2.35512 3.00415C1.78546 3.62744 1.29879 4.32508 0.912917 5.07957C0.250908 6.36991 -0.111572 7.93861 -0.111572 9.47607C-0.111572 9.49774 -0.109779 9.51893 -0.109635 9.54056C0.183549 10.1027 3.94016 9.99506 4.12951 9.54056C4.12927 9.51936 4.12688 9.49868 4.12688 9.47742C4.12688 8.84683 4.23341 8.38203 4.4276 7.81193C4.66715 7.10871 5.04225 6.46114 5.52188 5.90321C5.63061 5.7644 5.92063 5.46598 6.00524 5.28699C6.03747 5.21881 5.94673 5.18054 5.94165 5.15654C5.93597 5.1297 5.8143 5.15129 5.78705 5.13129C5.7005 5.06781 5.52912 5.03466 5.42505 5.0052C5.20261 4.94221 4.83397 4.80332 4.62921 4.65934C3.98199 4.20422 2.97194 3.6606 2.35512 3.00415Z" fill="white" />
											</g>
											<g filter="url(#filter6_f_840_110)">
												<path d="M4.64301 5.15918C6.14386 6.06832 6.57547 4.70028 7.57333 4.27219L5.83753 0.672607C5.199 0.940978 4.59573 1.2744 4.03598 1.66398C3.20004 2.24579 2.46185 2.95576 1.85205 3.76372L4.64301 5.15918Z" fill="white" />
											</g>
											<g filter="url(#filter7_f_840_110)">
												<path d="M5.25408 14.3429C3.23939 15.0702 2.92398 15.0963 2.73853 16.3448C3.09292 16.6907 3.47368 17.0106 3.8783 17.3006C4.96403 18.0789 7.05249 19.1154 9.72345 19.1154C9.72658 19.1154 9.72958 19.1151 9.73272 19.1151V15.0717C9.7307 15.0718 9.72838 15.0719 9.72635 15.0719C8.72617 15.0719 7.92693 14.8092 7.10746 14.3523C6.90541 14.2397 6.53884 14.5422 6.3525 14.407C6.0955 14.2205 5.47699 14.5676 5.25408 14.3429Z" fill="white" />
											</g>
											<g opacity="0.5" filter="url(#filter8_f_840_110)">
												<path d="M8.55273 14.9446V19.0453C8.92645 19.089 9.31537 19.1156 9.72337 19.1156C10.1324 19.1156 10.5281 19.0946 10.9125 19.056V14.9722C10.4817 15.0459 10.0758 15.0721 9.72627 15.0721C9.32366 15.0721 8.93212 15.0252 8.55273 14.9446Z" fill="white" />
											</g>
										</g>
										<defs>
											<filter id="filter0_f_840_110" x="-0.579698" y="9.07045" width="8.31833" height="7.63864" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter1_f_840_110" x="8.99306" y="-0.562364" width="7.77658" height="6.27536" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter2_f_840_110" x="1.8307" y="-0.574572" width="8.44284" height="6.87839" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter3_f_840_110" x="8.37831" y="9.22426" width="11.2466" height="10.3469" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter4_f_840_110" x="9.12074" y="7.10536" width="10.5212" height="4.87009" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter5_f_840_110" x="-0.581652" y="2.53407" width="7.06394" height="7.85886" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter6_f_840_110" x="-1.4528" y="-2.63224" width="12.3309" height="11.4019" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="1.65243" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter7_f_840_110" x="2.26845" y="13.8566" width="7.9343" height="5.72898" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
											<filter id="filter8_f_840_110" x="8.08266" y="14.4745" width="3.30002" height="5.1113" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix" />
												<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
												<feGaussianBlur stdDeviation="0.23504" result="effect1_foregroundBlur_840_110" />
											</filter>
										</defs>
									</svg>
								</a>
							<?php endif; ?>
							<?php if ($yelp_link) : ?>
								<a href="<?php echo esc_url($yelp_link); ?>" aria-label="Yelp" class="text-white/50 hover:text-white transition-colors" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" aria-hidden="true">
										<path d="M10.0581 8.06605C10.0412 8.39395 10.0219 8.76851 9.81535 9.02801C9.79893 9.04697 9.78153 9.06507 9.76322 9.08223C9.66185 9.19003 9.53266 9.2676 9.38997 9.30638L9.36241 9.31277C9.20788 9.34868 9.04621 9.33784 8.8979 9.28167C8.87518 9.27442 8.85286 9.26595 8.83099 9.25639C8.5327 9.11409 8.35186 8.78638 8.19384 8.50003C8.17674 8.46903 8.15964 8.43805 8.14295 8.40832L7.90838 7.99043C7.4139 7.10965 6.91945 6.22892 6.43279 5.34342C6.37732 5.24234 6.32044 5.1424 6.26364 5.04257C6.10213 4.75876 5.94113 4.47583 5.81445 4.17056C5.80254 4.14186 5.79034 4.11287 5.77803 4.08362C5.6443 3.76585 5.49753 3.41709 5.56791 3.0755C5.70423 2.41565 6.50931 2.07132 7.08198 1.88374C7.2579 1.8274 7.4377 1.77977 7.61937 1.73615C7.80103 1.69254 7.98417 1.65842 8.16699 1.63305C8.7638 1.55042 9.63848 1.50665 10.0487 2.03929C10.2613 2.31564 10.2816 2.69288 10.3001 3.03695C10.3019 3.06895 10.3036 3.10066 10.3054 3.13198C10.3249 3.46231 10.3039 3.78752 10.2827 4.11382C10.2753 4.22822 10.2679 4.34277 10.2622 4.45771C10.2159 5.39967 10.16 6.34132 10.104 7.28283C10.0905 7.50976 10.077 7.73669 10.0636 7.96361C10.0617 7.99706 10.0599 8.03137 10.0581 8.06605Z" fill="white" />
										<path d="M15.4573 7.70244C15.2582 7.28467 14.9906 6.90327 14.6656 6.57408C14.6235 6.53229 14.5785 6.49362 14.5308 6.45839C14.4868 6.42536 14.441 6.39466 14.3938 6.36642C14.3452 6.33978 14.2953 6.31576 14.2441 6.29446C14.143 6.25477 14.0346 6.23688 13.9262 6.24195C13.8224 6.24785 13.7211 6.27628 13.6294 6.32526C13.4904 6.39438 13.3399 6.50548 13.1398 6.6915C13.1216 6.70966 13.1002 6.72935 13.0788 6.74906L13.0636 6.76305L13.0463 6.77916C12.9139 6.90362 12.7696 7.0513 12.6049 7.21982L12.479 7.34859C12.1413 7.68978 11.8088 8.03283 11.4784 8.37964L10.8872 8.99275C10.7789 9.10478 10.6803 9.2258 10.5925 9.3545C10.5176 9.46323 10.4646 9.58554 10.4366 9.7146C10.4203 9.81349 10.4227 9.91462 10.4436 10.0126L10.4466 10.0258C10.4934 10.2289 10.617 10.4059 10.7916 10.5194C10.9661 10.633 11.1779 10.6744 11.3824 10.6347C11.4148 10.6301 11.4399 10.6245 11.4552 10.6207L14.6553 9.88142C14.8881 9.82791 15.1223 9.77409 15.3312 9.65284C15.4809 9.56601 15.6233 9.47997 15.721 9.30638C15.7732 9.211 15.8048 9.10572 15.8137 8.99742C15.8621 8.56779 15.6378 8.07989 15.4573 7.70244Z" fill="white" />
										<path d="M7.32332 11.5732L8.05239 11.4047C8.06773 11.4012 8.09306 11.3954 8.124 11.3854C8.32516 11.3313 8.49755 11.2012 8.60485 11.0224C8.71215 10.8437 8.746 10.6304 8.69926 10.4273L8.69624 10.4142C8.67229 10.3169 8.63034 10.2249 8.57256 10.1431C8.49085 10.0394 8.38974 9.95269 8.27488 9.88777C8.13968 9.81063 7.99816 9.74506 7.85187 9.69184L7.05248 9.40004C6.60387 9.23328 6.15529 9.07068 5.70248 8.9121C5.64399 8.89129 5.58728 8.87098 5.53225 8.85127C5.31102 8.77205 5.11699 8.70257 4.94387 8.64903C4.93053 8.64492 4.91673 8.64081 4.90292 8.6367C4.87452 8.62823 4.84608 8.61976 4.82145 8.61125C4.56011 8.53115 4.37648 8.49794 4.22108 8.49685C4.11728 8.49304 4.01389 8.5119 3.91809 8.5521C3.81825 8.59517 3.72858 8.6588 3.65496 8.73888C3.61833 8.78053 3.5839 8.82405 3.55179 8.86923C3.52167 8.91534 3.49404 8.96295 3.46903 9.012C3.44149 9.06465 3.41782 9.11916 3.39821 9.17518C3.24985 9.61378 3.17594 10.0741 3.17957 10.537C3.18225 10.9555 3.19349 11.4926 3.42352 11.8568C3.47895 11.9502 3.55333 12.031 3.64188 12.0939C3.80575 12.207 3.97135 12.222 4.14364 12.2344C4.38484 12.2517 4.61899 12.1972 4.85205 12.143L7.32129 11.5725L7.32332 11.5732Z" fill="white" />
										<path d="M9.54183 12.1559C9.45267 12.0305 9.32614 11.9365 9.18032 11.8874C9.03451 11.8383 8.87688 11.8365 8.72996 11.8824C8.69545 11.8939 8.66182 11.9079 8.62933 11.9242C8.57908 11.9497 8.53114 11.9796 8.48604 12.0135C8.35467 12.1108 8.24404 12.2373 8.14331 12.3641C8.1343 12.3755 8.12557 12.3883 8.11671 12.4012C8.10043 12.4249 8.08372 12.4493 8.06405 12.4672L7.557 13.1647C7.26961 13.5554 6.98619 13.9471 6.70514 14.345C6.66857 14.3963 6.63299 14.4459 6.59847 14.4941L6.59782 14.495C6.45945 14.688 6.338 14.8574 6.23785 15.0109C6.2292 15.024 6.22043 15.0378 6.21168 15.0514C6.19642 15.0753 6.18123 15.0991 6.16689 15.1195C6.01672 15.3519 5.93167 15.5214 5.88802 15.6725C5.85524 15.7729 5.84486 15.8792 5.85763 15.984C5.87158 16.0931 5.90833 16.198 5.96549 16.2921C5.99587 16.3392 6.02862 16.3848 6.06361 16.4286C6.09998 16.4708 6.13859 16.511 6.17929 16.549C6.22276 16.5904 6.26925 16.6286 6.31838 16.6632C6.66836 16.9067 7.05148 17.0816 7.45449 17.2168C7.78985 17.3281 8.13844 17.3948 8.49126 17.4149C8.55128 17.418 8.61144 17.4167 8.67128 17.4111C8.72674 17.4063 8.78191 17.3985 8.83656 17.3879C8.89118 17.3752 8.94507 17.3594 8.99803 17.341C9.10106 17.3024 9.19487 17.2427 9.27342 17.1657C9.34776 17.0912 9.40499 17.0014 9.44109 16.9025C9.4997 16.7564 9.53824 16.5709 9.56359 16.2956C9.56507 16.2695 9.56803 16.24 9.571 16.2105C9.57249 16.1957 9.57399 16.1808 9.57529 16.1664C9.59099 15.987 9.60002 15.783 9.61029 15.5509C9.6131 15.4874 9.616 15.4217 9.61916 15.354C9.64395 14.8686 9.6634 14.3854 9.67878 13.9008C9.67878 13.9008 9.71143 13.0397 9.71133 13.0392C9.71881 12.8408 9.71269 12.6209 9.65764 12.4233C9.63347 12.3286 9.59438 12.2384 9.54183 12.1559Z" fill="white" />
										<path d="M14.7729 13.1295C15.0094 13.2725 15.1593 13.3882 15.2652 13.5043C15.3385 13.5801 15.3944 13.6711 15.4288 13.7709C15.4638 13.8751 15.4765 13.9854 15.4661 14.0949C15.4595 14.1505 15.45 14.2059 15.4378 14.2606C15.4235 14.3145 15.4064 14.3675 15.3868 14.4197C15.3657 14.476 15.3407 14.5307 15.3116 14.5834C15.1031 14.956 14.8351 15.2813 14.5319 15.5797C14.279 15.827 13.9948 16.0399 13.6863 16.2128C13.6338 16.2419 13.5792 16.2671 13.523 16.2882C13.471 16.3082 13.4179 16.3255 13.364 16.3399C13.3094 16.3525 13.2541 16.362 13.1984 16.3686C13.0889 16.3795 12.9783 16.3672 12.8739 16.3326C12.7746 16.2983 12.6839 16.2427 12.6082 16.1696C12.4914 16.0629 12.3763 15.9141 12.2329 15.6777C12.2196 15.6539 12.2034 15.6274 12.1872 15.6011C12.1801 15.5895 12.173 15.578 12.1662 15.5666C12.0726 15.4104 11.9739 15.2284 11.8615 15.0211C11.8325 14.9676 11.8026 14.9124 11.7716 14.8555C11.5373 14.4305 11.3089 14.0041 11.0831 13.5752L10.6774 12.8149C10.5841 12.6397 10.4938 12.4398 10.4567 12.2376C10.4381 12.1422 10.4346 12.0445 10.4462 11.948C10.4714 11.7962 10.5438 11.6563 10.6531 11.5481C10.7624 11.4399 10.903 11.369 11.0549 11.3455C11.091 11.3407 11.1272 11.3384 11.1637 11.3389C11.22 11.3399 11.2761 11.3457 11.3315 11.3563C11.4921 11.3862 11.6469 11.4513 11.7928 11.5211C11.8058 11.5274 11.8192 11.535 11.8328 11.5427C11.8579 11.5569 11.8837 11.5715 11.9093 11.579L12.669 11.9819C13.099 12.2079 13.5249 12.4357 13.9506 12.6694C14.0111 12.7022 14.0697 12.7338 14.1263 12.7644C14.3293 12.874 14.5079 12.9703 14.6618 13.0629C14.6742 13.0703 14.687 13.0782 14.6998 13.086C14.725 13.1014 14.7502 13.1168 14.7729 13.1295Z" fill="white" />
									</svg>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>
				<?php /* /col 1 */ ?>

				<?php /* Col 2 — SERVICES */ ?>
				<div>
					<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-5">Services</p>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-menu-1',
						'menu_class'     => 'space-y-3',
						'container'      => false,
						'walker'         => new Loden_Footer_Nav_Walker(),
						'fallback_cb'    => false,
					));
					?>
				</div>

				<?php /* Col 3 — COMPANY */ ?>
				<div>
					<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-5">Company</p>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-menu-2',
						'menu_class'     => 'space-y-3',
						'container'      => false,
						'walker'         => new Loden_Footer_Nav_Walker(),
						'fallback_cb'    => false,
					));
					?>
				</div>

				<?php /* Col 4 — HOURS + CTA card */ ?>
				<div class="flex flex-col gap-6">

					<div>
						<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] mb-5">Hours</p>
						<dl class="space-y-2">
							<div class="flex justify-between gap-4 text-sm">
								<dt class="text-white/60">Mon-Fri</dt>
								<dd class="text-white text-right">7:30am – 7:00pm</dd>
							</div>
							<div class="flex justify-between gap-4 text-sm">
								<dt class="text-white/60">Saturday</dt>
								<dd class="text-white text-right">8:00am – 8:00pm</dd>
							</div>
							<div class="flex justify-between gap-4 text-sm">
								<dt class="text-white/60">Sunday</dt>
								<dd class="text-white text-right">Closed</dd>
							</div>
						</dl>
					</div>

					<?php /* CTA card */ ?>
					<?php if ($refer_title && $refer_sub_title && $refer_link) : ?>
						<a href="<?php echo esc_url($refer_link); ?>" class="block border border-[#45B5E8] bg-[#143240] rounded-lg p-4 hover:brightness-110 transition-all">
							<p class="font-bold text-sm text-white"><?php echo $refer_title; ?></p>
							<p class="text-xs text-white/60 mt-1 leading-relaxed"><?php echo $refer_sub_title; ?></p>
						</a>
					<?php endif; ?>
				</div>
				<?php /* /col 4 */ ?>

			</div>
			<?php /* /desktop layout */ ?>

		</div>
	</div>
	<?php /* /section 1 */ ?>

	<?php /* ============================================================
	 * Section 2 — Service Areas band
	 * ============================================================ */ ?>
	<div class="bg-[#12242B] border-t border-white/10">
		<div class="container mx-auto px-6 py-12">

			<p class="text-[13px] font-bold uppercase tracking-widest text-[#45B5E8] text-center mb-10">Service Areas</p>

			<?php if (! empty($footer_service_areas)) : ?>
				<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 text-center">

					<?php foreach ($footer_service_areas as $area) :
						$area_name   = esc_html($area['name'] ?? '');
						$area_phone  = esc_html($area['phone_number'] ?? '');
						$area_street = esc_html($area['street_address'] ?? '');
						$area_city   = esc_html($area['city'] ?? '');
						$area_state  = esc_html($area['state'] ?? '');
						$area_zip    = esc_html($area['zip_code'] ?? '');
					?>
						<div>
							<?php if ($area_name) : ?>
								<p class="text-sm font-semibold text-white mb-2"><?php echo $area_name; ?></p>
							<?php endif; ?>
							<?php if ($area_phone) : ?>
								<?php $area_phone_tel = 'tel:' . preg_replace('/[^0-9+]/', '', $area_phone); ?>
								<a href="<?php echo esc_attr($area_phone_tel); ?>" class="text-sm text-white/60 hover:text-white transition-colors flex items-center justify-center gap-1.5 mb-1">
									<svg class="shrink-0" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l.87-.87a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
									</svg>
									<?php echo $area_phone; ?>
								</a>
							<?php endif; ?>
							<?php if ($area_street || $area_city) : ?>
								<address class="not-italic text-xs text-white/40 leading-relaxed">
									<?php if ($area_street) : ?><?php echo $area_street; ?><br><?php endif; ?>
								<?php echo esc_html(implode(', ', array_filter([$area_city, trim($area_state . ' ' . $area_zip)]))); ?>
								</address>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>

				</div>
			<?php endif; ?>

			<?php /* Fine print */ ?>
			<?php if ($footer_disclaimer) : ?>
				<div class="mt-10 pt-8 border-t border-white/10 text-center text-[13px] text-[#6D7572] [&_p]:mb-2 [&_p:last-child]:mb-0">
					<?php echo wp_kses_post($footer_disclaimer); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
	<?php /* /section 2 */ ?>

	<?php /* ============================================================
	 * Section 3 — Bottom bar
	 * ============================================================ */ ?>
	<div class="bg-[#0d1c22] border-t border-white/10">
		<div class="container mx-auto px-6 py-5">
			<div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-white/40">
				<span>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?></span>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'copyright',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'walker'         => new Loden_Copyright_Nav_Walker(),
					'fallback_cb'    => false,
				));
				?>
			</div>
		</div>
	</div>
	<?php /* /section 3 */ ?>

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