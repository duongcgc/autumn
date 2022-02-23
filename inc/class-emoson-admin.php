<?php
/**
 * Admin functions and definitions.
 *
 * @package Emoson
 */

namespace Emoson;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin initial
 *
 */
class Admin {
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
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action( 'wp', array( $this, 'add_actions'), 0);

	}

	/**
	 * Add actions
	 */
	public function add_actions() {

		if ( is_admin() ) {
			$this->get( 'plugin' );
			$this->get( 'block_editor' );
			$this->get( 'meta_boxes' );
		}

		$this->get( 'widget_area' );

	}

	/**
	 * Get Admin Class Init.
	 *
	 * @since 1.0.0
	 *
	 * @return object
	 */
	public function get( $class ) {
		switch ( $class ) {

			// case 'plugin':
			// 	return \Emoson\Admin\Plugin_Install::instance();
			// 	break;
			// case 'block_editor':
			// 	return \Emoson\Admin\Block_Editor::instance();
			// 	break;
			// case 'meta_boxes':
			// 	return \Emoson\Admin\Meta_Boxes::instance();
			// 	break;
		
		}
	}
}

