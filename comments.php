<?php
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
	?>
		<h2 class="comments-title">
			<?php
			$_themename_comment_count = get_comments_number();
			if ('1' === $_themename_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('یک دیدگاه برای &ldquo;%1$s&rdquo;', '_themename'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s دیدگاه برای &ldquo;%2$s&rdquo;', '%1$s دیدگاه برای &ldquo;%2$s&rdquo;', $_themename_comment_count, 'comments title', '_themename')),
					number_format_i18n($_themename_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();
		if (!comments_open()) :
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', '_themename'); ?></p>
	<?php
		endif;

	endif;

	comment_form();
	?>

</div>