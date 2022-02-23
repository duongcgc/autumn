<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Emoson
 * @since Emoson 1.0
 */

/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'EMOSON_THEME_NAME', $theme['Name'] );
define( 'EMOSON_THEME_VERSION', $theme['Version'] );
define( 'EMOSON_THEME_DIR', get_template_directory() );
define( 'EMOSON_THEME_URI', get_template_directory_uri() );
define( 'EMOSON_THEME_ASSETS_URI', get_template_directory_uri() . '/assets' );
define( 'EMOSON_THEME_IMAGE_URI', EMOSON_THEME_ASSETS_URI . '/images' );
define( 'EMOSON_INC_DIR', get_template_directory() . DS . 'inc' );
define( 'EMOSON_WIDGETS_DIR', get_template_directory() . DS . 'inc/widgets' );
define( 'EMOSON_CUSTOMIZER_DIR', EMOSON_THEME_DIR . DS . '/inc/customizer' );
define( 'EMOSON_PROTOCOL', is_ssl() ? 'https' : 'http' );
define( 'EMOSON_IS_RTL', is_rtl() ? true : false );

define( 'EMOSON_ELEMENTOR_DIR', get_template_directory() . DS . 'inc/elementor' );
define( 'EMOSON_ELEMENTOR_URI', get_template_directory_uri() . '/inc/elementor' );
define( 'EMOSON_ELEMENTOR_ASSETS', get_template_directory_uri() . '/inc/elementor/assets' );

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
	require EMOSON_INC_DIR . '/back-compat.php';
}

// Start Point
require_once EMOSON_INC_DIR . '/class-emoson-theme.php';

\Emoson\Theme::instance()->init();