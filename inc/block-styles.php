<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Emoson
 * @since Emoson 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Emoson 1.0
	 *
	 * @return void
	 */
	function emoson_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'emoson-columns-overlap',
				'label' => esc_html__( 'Overlap', 'emoson' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'emoson-border',
				'label' => esc_html__( 'Borders', 'emoson' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'emoson-border',
				'label' => esc_html__( 'Borders', 'emoson' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'emoson-border',
				'label' => esc_html__( 'Borders', 'emoson' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'emoson-image-frame',
				'label' => esc_html__( 'Frame', 'emoson' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'emoson-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'emoson' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'emoson-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'emoson' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'emoson-border',
				'label' => esc_html__( 'Borders', 'emoson' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'emoson-separator-thick',
				'label' => esc_html__( 'Thick', 'emoson' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'emoson-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'emoson' ),
			)
		);
	}
	add_action( 'init', 'emoson_register_block_styles' );
}
