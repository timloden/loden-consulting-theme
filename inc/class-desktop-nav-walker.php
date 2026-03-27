<?php
/**
 * Desktop Navigation Walker
 *
 * Custom Walker_Nav_Menu for the desktop primary nav.
 * Top-level items with children and mega_menu_enabled == true render a
 * full-width mega menu panel populated from ACF fields on the menu item.
 * All other items render as standard <a> nav links.
 *
 * Two mega menu layouts (controlled via the "Mega Menu Type" field):
 *   icons           — 1/3 left info panel + 2/3 icon card grid (2 columns)
 *   icons_and_links — 1/3 left info panel + 2/3 split: icon cards (stacked) | text links
 *
 * Depth is always set to 1 in wp_nav_menu() so WordPress pre-processes
 * has-children classes but the walker never renders sub-menu items directly —
 * all right-panel content comes from ACF repeater fields.
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Loden_Desktop_Nav_Walker extends Walker_Nav_Menu {

	// ── Chevron SVG (currentColor inherits from nav-link) ──────────────────

	private function chevron_svg(): string {
		return '<svg xmlns="http://www.w3.org/2000/svg" class="mega-trigger-chevron h-3.5 w-3.5 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">'
			. '<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />'
			. '</svg>';
	}

	// =========================================================================
	// Walker methods
	// =========================================================================

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item         = $data_object;
		$classes      = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true );
		$is_current   = in_array( 'current-menu-item', $classes, true )
		                || in_array( 'current-menu-ancestor', $classes, true );

		$mega_enabled = $has_children
		                && function_exists( 'get_field' )
		                && get_field( 'mega_menu_enabled', $item->ID );

		$li_class = 'mega-menu-item'
			. ( $mega_enabled  ? ' has-mega-menu' : '' )
			. ( $is_current    ? ' is-current'    : '' );

		$output .= '<li class="' . esc_attr( $li_class ) . '">';

		if ( $mega_enabled ) {
			// ── Trigger button ────────────────────────────────────────────────
			$output .= '<button'
				. ' class="nav-link mega-menu-trigger"'
				. ' aria-expanded="false"'
				. ' aria-haspopup="true"'
				. '>'
				. esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
				. $this->chevron_svg()
				. '</button>';

			// ── Mega panel ────────────────────────────────────────────────────
			$output .= $this->render_mega_panel( $item );

		} else {
			// ── Standard link ─────────────────────────────────────────────────
			$url        = empty( $item->url ) ? '#' : esc_url( $item->url );
			$attr_title = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$target     = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$rel        = '_blank' === $item->target ? ' rel="noopener noreferrer"' : '';

			// Show chevron on plain items that have children but no mega menu.
			$chevron = $has_children ? $this->chevron_svg() : '';

			$output .= '<a'
				. ' href="' . $url . '"'
				. ' class="nav-link"'
				. $attr_title
				. $target
				. $rel
				. '>'
				. esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
				. $chevron
				. '</a>';
		}
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}

	// Walker depth is set to 1, so start_lvl / end_lvl are never called.
	// Override anyway to prevent any accidental output.
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	// =========================================================================
	// Mega panel builder
	// =========================================================================

	private function render_mega_panel( $item ): string {
		$type                = get_field( 'mega_menu_type', $item->ID ) ?: 'icons';
		$left_title          = get_field( 'mega_menu_left_title', $item->ID );
		$left_subtitle       = get_field( 'mega_menu_left_subtitle', $item->ID );
		$cta_card_title      = get_field( 'mega_menu_cta_card_title', $item->ID );
		$cta_card_subtitle   = get_field( 'mega_menu_cta_card_subtitle', $item->ID );
		$cta_card_link       = get_field( 'mega_menu_cta_card_link', $item->ID );
		$cta_card_link_label = get_field( 'mega_menu_cta_card_link_label', $item->ID );
		$cta_card_icon       = get_field( 'mega_menu_cta_card_icon', $item->ID );
		$cta_card_bg         = get_field( 'mega_menu_cta_card_bg', $item->ID ) ?: '#E8F4FD';
		$cards_title         = get_field( 'mega_menu_icon_cards_title', $item->ID );
		$icon_items          = get_field( 'mega_menu_icon_items', $item->ID ) ?: array();
		$text_links          = ( 'icons_and_links' === $type ) ? ( get_field( 'mega_menu_text_links', $item->ID ) ?: array() ) : array();
		$links_title         = ( 'icons_and_links' === $type ) ? get_field( 'mega_menu_text_links_title', $item->ID ) : '';

		$panel_label = esc_attr( apply_filters( 'the_title', $item->title, $item->ID ) ) . ' ' . esc_attr__( 'menu', 'loden-consulting' );

		ob_start();
		?>
		<div class="mega-menu-panel" role="region" aria-label="<?php echo $panel_label; ?>">
			<div class="container mx-auto px-6">
				<div class="mega-menu-layout">

					<?php /* ── Left 1/3 ── */ ?>
					<div class="mega-menu-left">
						<?php if ( $left_title ) : ?>
							<p class="mega-left-title"><?php echo esc_html( $left_title ); ?></p>
						<?php endif; ?>

						<?php if ( $left_subtitle ) : ?>
							<p class="mega-left-subtitle"><?php echo wp_kses_post( nl2br( $left_subtitle ) ); ?></p>
						<?php endif; ?>

						<?php $show_cta = $cta_card_title || $cta_card_subtitle || ! empty( $cta_card_link['url'] ) || $cta_card_icon; if ( $show_cta ) :
							// Render as <a> if a link URL exists, otherwise <div>.
							$cta_url    = ! empty( $cta_card_link['url'] ) ? esc_url( $cta_card_link['url'] ) : '';
							$cta_target = ! empty( $cta_card_link['target'] ) ? ' target="' . esc_attr( $cta_card_link['target'] ) . '"' : '';
							$cta_rel    = ( ! empty( $cta_card_link['target'] ) && '_blank' === $cta_card_link['target'] ) ? ' rel="noopener noreferrer"' : '';
							$cta_tag    = $cta_url ? 'a' : 'div';
							$cta_href   = $cta_url ? ' href="' . $cta_url . '"' . $cta_target . $cta_rel : '';
						?>
							<<?php echo $cta_tag . $cta_href; ?>
								class="mega-left-cta-card"
								style="background-color: <?php echo esc_attr( $cta_card_bg ); ?>">
								<?php if ( $cta_card_icon ) : ?>
									<div class="mega-cta-card-icon">
										<img
											src="<?php echo esc_url( $cta_card_icon['url'] ); ?>"
											alt="<?php echo esc_attr( $cta_card_icon['alt'] ?: $cta_card_title ?: '' ); ?>"
											width="<?php echo esc_attr( $cta_card_icon['width'] ); ?>"
											height="<?php echo esc_attr( $cta_card_icon['height'] ); ?>"
											loading="lazy">
									</div>
								<?php endif; ?>
								<div class="mega-cta-card-body">
									<span class="mega-cta-card-title"><?php echo esc_html( $cta_card_title ); ?></span>
									<?php if ( $cta_card_subtitle ) : ?>
										<span class="mega-cta-card-subtitle"><?php echo esc_html( $cta_card_subtitle ); ?></span>
									<?php endif; ?>
									<?php if ( $cta_card_link_label ) : ?>
										<span class="mega-cta-card-link-label"><?php echo esc_html( $cta_card_link_label ); ?> →</span>
									<?php endif; ?>
								</div>
							</<?php echo $cta_tag; ?>>
						<?php endif; ?>
					</div>
					<?php /* /mega-menu-left */ ?>

					<?php /* ── Right 2/3 ── */ ?>
					<div class="mega-menu-right<?php echo ( 'icons_and_links' === $type && ! empty( $text_links ) ) ? ' has-text-links' : ''; ?>">

						<?php /* Icon cards — always shown */ ?>
						<?php if ( ! empty( $icon_items ) ) : ?>
							<div class="mega-cards-group">
								<?php if ( $cards_title ) : ?>
									<p class="mega-cards-section-title"><?php echo esc_html( $cards_title ); ?></p>
								<?php endif; ?>
								<div class="mega-icon-cards">
									<?php foreach ( $icon_items as $card ) :
										$card_link   = ! empty( $card['item_link'] ) ? $card['item_link'] : array();
										$card_url    = ! empty( $card_link['url'] ) ? esc_url( $card_link['url'] ) : '#';
										$card_target = ! empty( $card_link['target'] ) ? ' target="' . esc_attr( $card_link['target'] ) . '"' : '';
										$card_rel    = ( ! empty( $card_link['target'] ) && '_blank' === $card_link['target'] ) ? ' rel="noopener noreferrer"' : '';
									?>
										<a href="<?php echo $card_url; ?>"<?php echo $card_target . $card_rel; ?> class="mega-card">
											<?php if ( ! empty( $card['item_icon'] ) ) : ?>
												<div class="mega-card-icon">
													<img
														src="<?php echo esc_url( $card['item_icon']['url'] ); ?>"
														alt="<?php echo esc_attr( $card['item_icon']['alt'] ?: $card['item_title'] ); ?>"
														width="<?php echo esc_attr( $card['item_icon']['width'] ); ?>"
														height="<?php echo esc_attr( $card['item_icon']['height'] ); ?>"
														loading="lazy">
												</div>
											<?php endif; ?>
											<div class="mega-card-text">
												<span class="mega-card-title"><?php echo esc_html( $card['item_title'] ); ?></span>
												<?php if ( ! empty( $card['item_description'] ) ) : ?>
													<span class="mega-card-desc"><?php echo esc_html( $card['item_description'] ); ?></span>
												<?php endif; ?>
											</div>
										</a>
									<?php endforeach; ?>
								</div><?php /* /mega-icon-cards */ ?>
							</div><?php /* /mega-cards-group */ ?>
						<?php endif; ?>

						<?php /* Text links column — icons_and_links type only */ ?>
						<?php if ( 'icons_and_links' === $type && ! empty( $text_links ) ) : ?>
							<div class="mega-text-links">
								<?php if ( $links_title ) : ?>
									<p class="mega-text-links-title"><?php echo esc_html( $links_title ); ?></p>
								<?php endif; ?>

								<ul class="mega-text-links-list">
									<?php foreach ( $text_links as $link ) :
										$link_data   = ! empty( $link['link_url'] ) ? $link['link_url'] : array();
										$link_url    = ! empty( $link_data['url'] ) ? esc_url( $link_data['url'] ) : '#';
										$link_target = ! empty( $link_data['target'] ) ? ' target="' . esc_attr( $link_data['target'] ) . '"' : '';
										$link_rel    = ( ! empty( $link_data['target'] ) && '_blank' === $link_data['target'] ) ? ' rel="noopener noreferrer"' : '';
									?>
										<li>
											<a href="<?php echo $link_url; ?>"<?php echo $link_target . $link_rel; ?> class="mega-text-link">
												<?php echo esc_html( $link['link_label'] ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php /* /mega-text-links */ ?>

					</div>
					<?php /* /mega-menu-right */ ?>

				</div>
				<?php /* /mega-menu-layout */ ?>
			</div>
		</div>
		<?php /* /mega-menu-panel */ ?>
		<?php
		return ob_get_clean();
	}
}
