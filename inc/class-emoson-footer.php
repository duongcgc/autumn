<?php

/**
 * Emoson Footer init
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
 * Emoson Footer init
 * Enqueue scripts and scripts on footers.
 * 
 * @since 1.0.0
 * 
 * @return void
 * 
 */

class Footer {

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

        // Add theme's scripts into footer
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        /**
         * Enqueue block editor script.
         *
         * @since Emoson 1.0
         *
         * @return void
         */

        add_action('enqueue_block_editor_assets', array($this, 'block_editor_script'));

        /**
         * Fix skip link focus in IE11.
         *
         * This does not enqueue the script because it is tiny and because it is only for IE11,
         * thus it does not warrant having an entire dedicated blocking script being loaded.
         *
         * @since Emoson 1.0
         *
         * @link https://git.io/vWdr2
         */
        add_action('wp_print_footer_scripts', array($this, 'skip_link_focus_fix'));
    }


    /**
     * Enqueue scripts
     */
    function enqueue_scripts() {

        global $wp_scripts;

        // Register the IE11 polyfill file.
        wp_register_script(
            Theme::instance()->theme_prefix . '-ie11-polyfills-asset',
            EMOSON_THEME_ASSETS_URI . '/js/polyfills.js',
            array(),
            EMOSON_THEME_VERSION,
            true
        );

        // Register the IE11 polyfill loader.
        wp_register_script(
            Theme::instance()->theme_prefix . '-ie11-polyfills',
            null,
            array(),
            EMOSON_THEME_VERSION,
            true
        );

        wp_add_inline_script(
            Theme::instance()->theme_prefix . '-ie11-polyfills',
            wp_get_script_polyfill(
                $wp_scripts,
                array(
                    'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'emoson-ie11-polyfills-asset',
                )
            )
        );

        // Main navigation scripts.
        if (has_nav_menu('primary')) {
            wp_enqueue_script(
                Theme::instance()->theme_prefix . '-primary-navigation-script',
                EMOSON_THEME_ASSETS_URI . '/js/primary-navigation.js',
                array(Theme::instance()->theme_prefix . '-ie11-polyfills'),
                EMOSON_THEME_VERSION,
                true
            );
        }

        // Responsive embeds script.
        wp_enqueue_script(
            Theme::instance()->theme_prefix . '-responsive-embeds-script',
            EMOSON_THEME_ASSETS_URI . '/js/responsive-embeds.js',
            array(Theme::instance()->theme_prefix . '-ie11-polyfills'),
            EMOSON_THEME_VERSION,
            true
        );
    }

    /** 
     * Enqueue editor scripts
     */

    function block_editor_script() {
        wp_enqueue_script(Theme::instance()->theme_prefix . '-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
    }

    function skip_link_focus_fix() {

        // If SCRIPT_DEBUG is defined and true, print the unminified file.
        if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
            echo '<script>';
            include EMOSON_THEME_ASSETS_URI . '/js/skip-link-focus-fix.js';
            echo '</script>';
        } else {
            // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
        ?>
            <script>
                /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function() {
                    var t, e = location.hash.substring(1);
                    /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
                }), !1);
            </script>
        <?php
        }
    }
}
