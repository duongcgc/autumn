<?php

/**
 * Custom CSs functions and definitions.
 *
 * @package Emoson
 */

namespace Emoson;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Woocommerce initial
 *
 */
class Custom_CSS {
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
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'non_latin_languages'));
	}

	/**
	 * Enqueue non-latin language styles.
	 *
	 * @since Emoson 1.0
	 *
	 * @return void
	 */
	function non_latin_languages() {
		$custom_css = \Emoson\Template_Function::get_non_latin_css('front-end');

		if ($custom_css) {
			wp_add_inline_style('emoson-style', $custom_css);
		}
	}
}
