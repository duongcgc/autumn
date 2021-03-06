<?php

/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Emoson
 * @since Emoson 1.0
 */

namespace Emoson;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Emoson custom template tag
 */
if (!class_exists('Template_Tag')) {
	class Template_Tag {
		/**
		 * Instance
		 *
		 * @var $instance
		 */
		protected static $instance = null;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object
		 */
		public static function instance() {
			if (is_null(self::$instance)) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Instantiate theme object.
		 *
		 * @return void
		 *
		 */
		public function __construct() {

			// Add tasks on create instance

		}

		/**
		 * Prints HTML with meta information for the current post-date/time.
		 *
		 * @since Emoson 1.0
		 *
		 * @return void
		 */
		function posted_on() {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf(
				$time_string,
				esc_attr(get_the_date(DATE_W3C)),
				esc_html(get_the_date())
			);
			echo '<span class="posted-on">';
			printf(
				/* translators: %s: Publish date. */
				esc_html__('Published %s', 'emoson'),
				$time_string // phpcs:ignore WordPress.Security.EscapeOutput
			);
			echo '</span>';
		}

		/**
		 * Prints HTML with meta information about theme author.
		 *
		 * @since Emoson 1.0
		 *
		 * @return void
		 */
		function posted_by() {
			if (!get_the_author_meta('description') && post_type_supports(get_post_type(), 'author')) {
				echo '<span class="byline">';
				printf(
					/* translators: %s: Author name. */
					esc_html__('By %s', 'emoson'),
					'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">' . esc_html(get_the_author()) . '</a>'
				);
				echo '</span>';
			}
		}

		/**
		 * Prints HTML with meta information for the categories, tags and comments.
		 * Footer entry meta is displayed differently in archives and single posts.
		 *
		 * @since Emoson 1.0
		 *
		 * @return void
		 */
		function entry_meta_footer() {

			// Early exit if not a post.
			if ('post' !== get_post_type()) {
				return;
			}

			// Hide meta information on pages.
			if (!is_single()) {

				if (is_sticky()) {
					echo '<p>' . esc_html_x('Featured post', 'Label for sticky posts', 'emoson') . '</p>';
				}

				$post_format = get_post_format();
				if ('aside' === $post_format || 'status' === $post_format) {
					echo '<p><a href="' . esc_url(get_permalink()) . '">' . Template_Function::instance()->continue_reading_text() . '</a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput
				}

				// Posted on.
				$this->posted_on();

				// Edit post link.
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						esc_html__('Edit %s', 'emoson'),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					),
					'<span class="edit-link">',
					'</span><br>'
				);

				if (has_category() || has_tag()) {

					echo '<div class="post-taxonomies">';

					/* translators: Used between list items, there is a space after the comma. */
					$categories_list = get_the_category_list(__(', ', 'emoson'));
					if ($categories_list) {
						printf(
							/* translators: %s: List of categories. */
							'<span class="cat-links">' . esc_html__('Categorized as %s', 'emoson') . ' </span>',
							$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
						);
					}

					/* translators: Used between list items, there is a space after the comma. */
					$tags_list = get_the_tag_list('', __(', ', 'emoson'));
					if ($tags_list) {
						printf(
							/* translators: %s: List of tags. */
							'<span class="tags-links">' . esc_html__('Tagged %s', 'emoson') . '</span>',
							$tags_list // phpcs:ignore WordPress.Security.EscapeOutput
						);
					}
					echo '</div>';
				}
			} else {

				echo '<div class="posted-by">';
				// Posted on.
				$this->posted_on();
				// Posted by.
				$this->posted_by();
				// Edit post link.
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						esc_html__('Edit %s', 'emoson'),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					),
					'<span class="edit-link">',
					'</span>'
				);
				echo '</div>';

				if (has_category() || has_tag()) {

					echo '<div class="post-taxonomies">';

					/* translators: Used between list items, there is a space after the comma. */
					$categories_list = get_the_category_list(__(', ', 'emoson'));
					if ($categories_list) {
						printf(
							/* translators: %s: List of categories. */
							'<span class="cat-links">' . esc_html__('Categorized as %s', 'emoson') . ' </span>',
							$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
						);
					}

					/* translators: Used between list items, there is a space after the comma. */
					$tags_list = get_the_tag_list('', __(', ', 'emoson'));
					if ($tags_list) {
						printf(
							/* translators: %s: List of tags. */
							'<span class="tags-links">' . esc_html__('Tagged %s', 'emoson') . '</span>',
							$tags_list // phpcs:ignore WordPress.Security.EscapeOutput
						);
					}
					echo '</div>';
				}
			}
		}

		/**
		 * Displays an optional post thumbnail.
		 *
		 * Wraps the post thumbnail in an anchor element on index views, or a div
		 * element when on single views.
		 *
		 * @since Emoson 1.0
		 *
		 * @return void
		 */
		function post_thumbnail() {
			if ( ! Template_Function::instance()->can_show_post_thumbnail() ) {
				return;
			}
			?>

			<?php if (is_singular()) : ?>

				<figure class="post-thumbnail">
					<?php
					// Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
					the_post_thumbnail('post-thumbnail', array('loading' => false));
					?>
					<?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
						<figcaption class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
					<?php endif; ?>
				</figure><!-- .post-thumbnail -->

			<?php else : ?>

				<figure class="post-thumbnail">
					<a class="post-thumbnail-inner alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_post_thumbnail('post-thumbnail'); ?>
					</a>
					<?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
						<figcaption class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
					<?php endif; ?>
				</figure>

			<?php endif; ?>
		<?php
		}

		/**
		 * Print the next and previous posts navigation.
		 *
		 * @since Emoson 1.0
		 *
		 * @return void
		 */
		function the_posts_navigation() {
			the_posts_pagination(
				array(
					'before_page_number' => esc_html__('Page', 'emoson') . ' ',
					'mid_size'           => 0,
					'prev_text'          => sprintf(
						'%s <span class="nav-prev-text">%s</span>',
						is_rtl() ? Template_Function::instance()->get_icon_svg('ui', 'arrow_right') : Template_Function::instance()->get_icon_svg('ui', 'arrow_left'),
						wp_kses(
							__('Newer <span class="nav-short">posts</span>', 'emoson'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						)
					),
					'next_text'          => sprintf(
						'<span class="nav-next-text">%s</span> %s',
						wp_kses(
							__('Older <span class="nav-short">posts</span>', 'emoson'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						is_rtl() ? Template_Functions::instance()->get_icon_svg('ui', 'arrow_left') : Template_Function::instance()->get_icon_svg('ui', 'arrow_right')
					),
				)
			);
		}
	}
}