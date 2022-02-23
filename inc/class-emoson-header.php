<?php

/**
 * Emoson Header init
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emoson
 */

namespace Emoson;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** 
 * Emoson Header init
 * Enqueue scripts and styles on headers.
 * 
 * @since 1.0.0
 * 
 * @return void
 * 
 */

class Header {

    /**
     * Instance
     *
     * @var @instance
     */
    protected static $instance;

    /**
     * Initiator
     *
     * @since 1.0.0
     *
     * @return object
     */
    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
    }

    /**
     * Instantiate the object.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct() {

        // Add into header
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }


    /**
     * Enqueue styles
     */
    function enqueue_styles() {

        // Note, the is_IE global variable is defined by WordPress and is used
        // to detect if the current browser is internet explorer.
        global $is_IE;
        if ($is_IE) {
            // If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
            wp_enqueue_style(Theme::instance()->theme_prefix . '-style', EMOSON_THEME_ASSETS_URI . '/css/ie.css', array(), EMOSON_THEME_VERSION);
        } else {
            // If not IE, use the standard stylesheet.
            wp_enqueue_style(Theme::instance()->theme_prefix . '-style', EMOSON_THEME_URI . '/style.css', array(), EMOSON_THEME_VERSION);
        }

        // RTL styles.
        wp_style_add_data(Theme::instance()->theme_prefix . '-style', 'rtl', 'replace');

        // Print styles.
        wp_enqueue_style(Theme::instance()->theme_prefix . '-print-style', EMOSON_THEME_ASSETS_URI . '/css/print.css', array(), EMOSON_THEME_VERSION, 'print');

        // Threaded comment reply styles.
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
