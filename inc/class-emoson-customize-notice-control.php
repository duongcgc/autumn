<?php
/**
 * Customize API: Emoson_Customize_Notice_Control class
 *
 * @package WordPress
 * @subpackage Emoson
 * @since Emoson 1.0
 */

/**
 * Customize Notice Control class.
 *
 * @since Emoson 1.0
 *
 * @see WP_Customize_Control
 */
class Emoson_Customize_Notice_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since Emoson 1.0
	 *
	 * @var string
	 */
	public $type = 'emoson-notice';

	/**
	 * Renders the control content.
	 *
	 * This simply prints the notice we need.
	 *
	 * @since Emoson 1.0
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'To access the Dark Mode settings, select a light background color.', 'emoson' ); ?></p>
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/emoson/#dark-mode-support', 'emoson' ) ); ?>">
				<?php esc_html_e( 'Learn more about Dark Mode.', 'emoson' ); ?>
			</a></p>
		</div>
		<?php
	}
}
