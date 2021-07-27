<?php

if (!function_exists('_themename_posted_on')) :
	function _themename_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x(' %s', 'post date', '_themename'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo '<li><i class="icon fal fa-calendar"></i><span class="posted-on">' . $posted_on . '</span></li>';
	}
endif;

if (!function_exists('_themename_posted_by')) :
	function _themename_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x(' %s', 'post author', '_themename'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);
		echo '<li><i class="icon fal fa-user"></i><span class="byline"> ' . $byline . '</span></li>';
	}
endif;


if (!function_exists('_themename_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function _themename_entry_footer() {
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', '_themename'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', '_themename') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', '_themename'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', '_themename') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', '_themename'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', '_themename'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('_themename_post_thumbnail')) :

	function _themename_post_thumbnail() {
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

		<?php
		endif;
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action('wp_body_open');
	}
endif;



if (!function_exists('_themename_post_categories')) :
	function _themename_post_categories() {
		?>
		<li class="d-flex align-items-center">
			<i class="icon fal fa-archive"></i>
			<span>
				<ul class="post-categories">
					<?php
					// the_category();
					$categories = wp_get_post_categories(get_the_ID());
					$cats = array();

					foreach ($categories as $c) {
						$cat = get_category($c);
						$cats[] = array('name' => $cat->name, 'slug' => $cat->slug);
						echo '<li><a href="' .  get_site_url() . '/category/' . $cat->slug . '" rel="category tag"> ' . $cat->name . '</a></li>,';
					}
					?>
					<!-- <ul class="post-categories">
                            <li><a href="http://localhost/negarshop/category/%da%a9%d8%aa%d8%a7%d8%a8/" rel="category tag"><?php the_category() ?></a></li>
                        </ul> -->
				</ul>
			</span>
		</li>
<?php
	}
endif;
