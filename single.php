<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Emoson
 * @since Emoson 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content/content-single' );

	if ( is_attachment() ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'emoson' ), '%title' ),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	// Previous/next post navigation.
	$emoson_next = is_rtl() ? emoson_get_icon_svg( 'ui', 'arrow_left' ) : emoson_get_icon_svg( 'ui', 'arrow_right' );
	$emoson_prev = is_rtl() ? emoson_get_icon_svg( 'ui', 'arrow_right' ) : emoson_get_icon_svg( 'ui', 'arrow_left' );

	$emoson_next_label     = esc_html__( 'Next post', 'emoson' );
	$emoson_previous_label = esc_html__( 'Previous post', 'emoson' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $emoson_next_label . $emoson_next . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' . $emoson_prev . $emoson_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
