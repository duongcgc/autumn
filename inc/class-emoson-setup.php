<?php

/**
 * Setup Theme
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
 * Emoson after setup theme
 */
if (!class_exists('Setup')) {
    class Setup {
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

            // Auto task code when create object here ...
            add_action('after_setup_theme', array($this, 'setup_theme'), 2);
            add_action('after_setup_theme', array($this, 'setup_content_width'));
        }


        /**
         * Setup theme
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        public function setup_theme() {


            protected $editor_font_sizes = array();

            /*
            * Make theme available for translation.
            * Translations can be filed in the /languages/ directory.
            * If you're building a theme based on Emoson, use a find and replace
            * to change 'emoson' to the name of your theme in all the template files.
            */
            load_theme_textdomain( 'emoson', get_template_directory() . '/languages' );

            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );

            /*
            * Let WordPress manage the document title.
            * This theme does not use a hard-coded <title> tag in the document head,
            * WordPress will provide it for us.
            */
            add_theme_support( 'title-tag' );

            /**
             * Add post-formats support.
             */
            add_theme_support(
                'post-formats',
                array(
                    'link',
                    'aside',
                    'gallery',
                    'image',
                    'quote',
                    'status',
                    'video',
                    'audio',
                    'chat',
                )
            );

            /*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
            add_theme_support(
                'html5',
                array(
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'style',
                    'script',
                    'navigation-widgets',
                )
            );

            /*
            * Add support for core custom logo.
            *
            * @link https://codex.wordpress.org/Theme_Logo
            */
            $logo_width  = 300;
            $logo_height = 100;

            add_theme_support(
                'custom-logo',
                array(
                    'height'               => $logo_height,
                    'width'                => $logo_width,
                    'flex-width'           => true,
                    'flex-height'          => true,
                    'unlink-homepage-logo' => true,
                )
            );

            // Add theme support for selective refresh for widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );

            // Add support for Block Styles.
            add_theme_support( 'wp-block-styles' );

            // Add support for responsive embeds.
            add_theme_support( 'responsive-embeds' );

            // Add support for full and wide align images.
            add_theme_support( 'align-wide' );

            add_theme_support( 'align-full' );

            /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
            */
            add_theme_support( 'post-thumbnails' );
            set_post_thumbnail_size( 1568, 9999 );

            add_image_size( 'emoson-blog-grid', 600, 398, true );
            add_image_size( 'emoson-post-full', 1170, 450, true );
            add_image_size( 'emoson-products-with-thumbnails-large', 270, 270, true );
            add_image_size( 'emoson-products-with-thumbnails-small', 94, 86, true );

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus( array(
                'primary'    => esc_html__( 'Primary Menu', 'razzi' ),
                'secondary'  => esc_html__( 'Secondary Menu', 'razzi' ),
                'hamburger'  => esc_html__( 'Hamburger Menu', 'razzi' ),
                'socials'    => esc_html__( 'Social Menu', 'razzi' ),
                'department' => esc_html__( 'Department Menu', 'razzi' ),
                'mobile'     => esc_html__( 'Mobile Menu', 'razzi' ),
            ) );

            // Add support for editor styles.
            add_theme_support( 'editor-styles' );
            $background_color = get_theme_mod( 'background_color', 'D1E4DD' );
            if ( 127 > Emoson_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
                add_theme_support( 'dark-editor-style' );
            }

            $editor_stylesheet_path = './assets/css/style-editor.css';

            // Note, the is_IE global variable is defined by WordPress and is used
            // to detect if the current browser is internet explorer.
            global $is_IE;
            if ( $is_IE ) {
                $editor_stylesheet_path = './assets/css/ie-editor.css';
            }

            // Enqueue editor styles.
            add_editor_style( $editor_stylesheet_path );

            // Add custom editor font sizes.
            add_theme_support(
                'editor-font-sizes',
                array(
                    array(
                        'name'      => esc_html__( 'Extra small', 'emoson' ),
                        'shortName' => esc_html_x( 'XS', 'Font size', 'emoson' ),
                        'size'      => 16,
                        'slug'      => 'extra-small',
                    ),
                    array(
                        'name'      => esc_html__( 'Small', 'emoson' ),
                        'shortName' => esc_html_x( 'S', 'Font size', 'emoson' ),
                        'size'      => 18,
                        'slug'      => 'small',
                    ),
                    array(
                        'name'      => esc_html__( 'Normal', 'emoson' ),
                        'shortName' => esc_html_x( 'M', 'Font size', 'emoson' ),
                        'size'      => 20,
                        'slug'      => 'normal',
                    ),
                    array(
                        'name'      => esc_html__( 'Large', 'emoson' ),
                        'shortName' => esc_html_x( 'L', 'Font size', 'emoson' ),
                        'size'      => 24,
                        'slug'      => 'large',
                    ),
                    array(
                        'name'      => esc_html__( 'Extra large', 'emoson' ),
                        'shortName' => esc_html_x( 'XL', 'Font size', 'emoson' ),
                        'size'      => 40,
                        'slug'      => 'extra-large',
                    ),
                    array(
                        'name'      => esc_html__( 'Huge', 'emoson' ),
                        'shortName' => esc_html_x( 'XXL', 'Font size', 'emoson' ),
                        'size'      => 96,
                        'slug'      => 'huge',
                    ),
                    array(
                        'name'      => esc_html__( 'Gigantic', 'emoson' ),
                        'shortName' => esc_html_x( 'XXXL', 'Font size', 'emoson' ),
                        'size'      => 144,
                        'slug'      => 'gigantic',
                    ),
                )
            );

            // Custom background color.
            add_theme_support(
                'custom-background',
                array(
                    'default-color' => 'd1e4dd',
                )
            );

            // Editor color palette.
            $black     = '#000000';
            $dark_gray = '#28303D';
            $gray      = '#39414D';
            $green     = '#D1E4DD';
            $blue      = '#D1DFE4';
            $purple    = '#D1D1E4';
            $red       = '#E4D1D1';
            $orange    = '#E4DAD1';
            $yellow    = '#EEEADD';
            $white     = '#FFFFFF';

            add_theme_support(
                'editor-color-palette',
                array(
                    array(
                        'name'  => esc_html__( 'Black', 'emoson' ),
                        'slug'  => 'black',
                        'color' => $black,
                    ),
                    array(
                        'name'  => esc_html__( 'Dark gray', 'emoson' ),
                        'slug'  => 'dark-gray',
                        'color' => $dark_gray,
                    ),
                    array(
                        'name'  => esc_html__( 'Gray', 'emoson' ),
                        'slug'  => 'gray',
                        'color' => $gray,
                    ),
                    array(
                        'name'  => esc_html__( 'Green', 'emoson' ),
                        'slug'  => 'green',
                        'color' => $green,
                    ),
                    array(
                        'name'  => esc_html__( 'Blue', 'emoson' ),
                        'slug'  => 'blue',
                        'color' => $blue,
                    ),
                    array(
                        'name'  => esc_html__( 'Purple', 'emoson' ),
                        'slug'  => 'purple',
                        'color' => $purple,
                    ),
                    array(
                        'name'  => esc_html__( 'Red', 'emoson' ),
                        'slug'  => 'red',
                        'color' => $red,
                    ),
                    array(
                        'name'  => esc_html__( 'Orange', 'emoson' ),
                        'slug'  => 'orange',
                        'color' => $orange,
                    ),
                    array(
                        'name'  => esc_html__( 'Yellow', 'emoson' ),
                        'slug'  => 'yellow',
                        'color' => $yellow,
                    ),
                    array(
                        'name'  => esc_html__( 'White', 'emoson' ),
                        'slug'  => 'white',
                        'color' => $white,
                    ),
                )
            );

            add_theme_support(
                'editor-gradient-presets',
                array(
                    array(
                        'name'     => esc_html__( 'Purple to yellow', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'purple-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__( 'Yellow to purple', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
                        'slug'     => 'yellow-to-purple',
                    ),
                    array(
                        'name'     => esc_html__( 'Green to yellow', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'green-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__( 'Yellow to green', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
                        'slug'     => 'yellow-to-green',
                    ),
                    array(
                        'name'     => esc_html__( 'Red to yellow', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'red-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__( 'Yellow to red', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
                        'slug'     => 'yellow-to-red',
                    ),
                    array(
                        'name'     => esc_html__( 'Purple to red', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
                        'slug'     => 'purple-to-red',
                    ),
                    array(
                        'name'     => esc_html__( 'Red to purple', 'emoson' ),
                        'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
                        'slug'     => 'red-to-purple',
                    ),
                )
            );

            /*
            * Adds starter content to highlight the theme on fresh sites.
            * This is done conditionally to avoid loading the starter content on every
            * page load, as it is a one-off operation only needed once in the customizer.
            */
            if ( is_customize_preview() ) {
                require get_template_directory() . '/inc/starter-content.php';
                add_theme_support( 'starter-content', emoson_get_starter_content() );
            }

            // Add support for responsive embedded content.
            add_theme_support( 'responsive-embeds' );

            // Add support for custom line height controls.
            add_theme_support( 'custom-line-height' );

            // Add support for experimental link color control.
            add_theme_support( 'experimental-link-color' );

            // Add support for experimental cover block spacing.
            add_theme_support( 'custom-spacing' );

            // Add support for custom units.
            // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
            add_theme_support( 'custom-units' );

            // Remove feed icon link from legacy RSS widget.
            add_filter( 'rss_widget_feed_link', '__return_false' );

        }

        /**
         * Set the $content_width global variable used by WordPress to set image dimennsions.
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function setup_content_width() {

            // This variable is intended to be overruled from themes.
            // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $GLOBALS['content_width'] = apply_filters( 'emoson_content_width', 750 );

        }
    }
}
