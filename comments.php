<?php
/**
 * The template for displaying comments
 *
 * @package Loden_Consulting
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area container mx-auto px-4 py-8 border-t border-gray-200">
	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title text-2xl font-bold mb-8">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'loden-consulting' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'loden-consulting' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list space-y-6">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
					'callback'    => 'loden_consulting_comment',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note.
		if ( ! comments_open() ) :
			?>
			<p class="no-comments text-gray-600 italic mt-8"><?php esc_html_e( 'Comments are closed.', 'loden-consulting' ); ?></p>
			<?php
		endif;

	endif;

	comment_form(
		array(
			'class_form'         => 'comment-form space-y-4',
			'title_reply'        => __( 'Leave a Comment', 'loden-consulting' ),
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold mb-6">',
			'title_reply_after'  => '</h3>',
			'class_submit'       => 'btn btn-primary',
			'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		)
	);
	?>
</div>
