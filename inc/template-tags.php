<?php
/**
 * Custom template tags for this theme
 *
 * @package Loden_Consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prints HTML with meta information for the current post-date/time
 */
function loden_consulting_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated hidden" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	printf(
		'<span class="posted-on flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>%s</span>',
		$time_string
	);
}

/**
 * Prints HTML with meta information for the current author
 */
function loden_consulting_posted_by() {
	printf(
		'<span class="byline flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span class="author vcard"><a class="url fn n hover:text-primary" href="%1$s">%2$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Prints HTML with meta information for the categories, tags and comments
 */
function loden_consulting_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', 'loden-consulting' ) );
		if ( $categories_list ) {
			printf(
				'<span class="cat-links flex items-center gap-2 mb-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg><span class="text-gray-600">%1$s %2$s</span></span>',
				esc_html__( 'Posted in', 'loden-consulting' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'loden-consulting' ) );
		if ( $tags_list ) {
			printf(
				'<span class="tags-links flex items-center gap-2 mb-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg><span class="text-gray-600">%1$s %2$s</span></span>',
				esc_html__( 'Tagged', 'loden-consulting' ),
				$tags_list
			);
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'loden-consulting' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'loden-consulting' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link inline-block mt-4 text-sm text-gray-500 hover:text-primary">',
		'</span>'
	);
}

/**
 * Display featured image or placeholder
 *
 * @param string $size Image size.
 * @param array  $attr Image attributes.
 */
function loden_consulting_post_thumbnail( $size = 'post-thumbnail', $attr = array() ) {
	if ( post_password_required() || is_attachment() ) {
		return;
	}

	if ( has_post_thumbnail() ) {
		?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( $size, $attr ); ?>
		</div>
		<?php
	}
}

/**
 * Custom comment callback
 *
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Arguments.
 * @param int        $depth   Depth.
 */
function loden_consulting_comment( $comment, $args, $depth ) {
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'bg-white rounded-lg p-4 shadow-sm' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<header class="comment-meta flex items-center gap-3 mb-3">
				<?php echo get_avatar( $comment, 48, '', '', array( 'class' => 'rounded-full' ) ); ?>
				<div>
					<div class="comment-author vcard font-medium">
						<?php echo get_comment_author_link(); ?>
					</div>
					<div class="comment-metadata text-sm text-gray-500">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf(
									/* translators: 1: comment date, 2: comment time */
									esc_html__( '%1$s at %2$s', 'loden-consulting' ),
									get_comment_date( '', $comment ),
									get_comment_time()
								);
								?>
							</time>
						</a>
					</div>
				</div>
			</header>

			<?php if ( '0' === $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation text-yellow-600 text-sm mb-3">
					<?php esc_html_e( 'Your comment is awaiting moderation.', 'loden-consulting' ); ?>
				</p>
			<?php endif; ?>

			<div class="comment-content prose prose-sm">
				<?php comment_text(); ?>
			</div>

			<footer class="comment-footer mt-3 flex gap-4 text-sm">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply text-primary hover:underline">',
							'after'     => '</span>',
						)
					)
				);
				?>
				<?php edit_comment_link( esc_html__( 'Edit', 'loden-consulting' ), '<span class="edit-link text-gray-500 hover:text-primary">', '</span>' ); ?>
			</footer>
		</article>
	<?php
}
