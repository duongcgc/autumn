<?php
/**
 * Blog functions and definitions.
 *
 * @package Emoson
 */

namespace Emoson;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woocommerce initial
 *
 */
class Blog {
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
		add_action( 'wp', array( $this, 'add_actions' ), 0 );
	}

	/**
	 * Add actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_actions() {
		$this->get( 'posts' );
		$this->get( 'post_loop' );
		$this->get( 'post' );
		$this->get( 'related_posts' );
		$this->get( 'search' );
	}

	/**
	 * Get Razzi Page Template Class.
	 *
	 * @since 1.0.0
	 *
	 * @return object
	 */
	public function get( $class ) {
		switch ( $class ) {
			case 'posts':
				if ( \Emoson\Helper::is_blog() ) {
					return \Emoson\Blog\Posts::instance();
				}
				break;
			case 'post_loop':
				return \Emoson\Blog\Post_Loop::instance();
				break;

			case 'post':
				if ( is_singular( 'post' ) ) {
					return \Emoson\Blog\Post::instance();
				}
				break;

			case 'related_posts':
				if ( is_singular( 'post' ) && Helper::get_option('related_posts') ) {
					return \Emoson\Blog\Related_Posts::instance();
				}
				break;

			case 'search':
				if ( is_search() ) {
					return \Emoson\Blog\Search::instance();
				}
				break;
		}

	}
}
