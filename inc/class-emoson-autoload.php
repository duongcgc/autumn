<?php
/**
 * Emoson Autoload init
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emoson
 */

namespace Emoson;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 * Emoson Autoload init
*/

class AutoLoad {

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
        if ( ! isset( self::$instance ) ) {
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

        spl_autoload_register( [ $this, 'load' ] );

    }

    /**
     * Auto load class files
     * 
     * @since 1.0.0
     * 
     * @return void
     */ 
    public function load( $class ) {
        if (false === strpos($class, Theme::instance()->theme_name)) {
            return;
        }

        $relative_class_name = preg_replace('/^' . __NAMESPACE__ . '\\\/', '', $class);
        $relative_class_name = strtolower($relative_class_name);
        $relative_class_name = str_replace('_', '-', $relative_class_name);
        $file_parts          = explode('\\', $relative_class_name);
        $file_name           = $relative_class_name;

        $file_dir            = get_template_directory() . Theme::instance()->class_dir;

        if (count($file_parts) > 1) {

            $i         = 0;
            $file_name = '';
            foreach ($file_parts as $file_part) {
                $file_part = $file_part === 'woocommerce' ? 'woo' : $file_part;
                $file_name .= $i == 0 ? '' : '-';
                $file_name .= $file_part;
                $i ++;
            }
            if ($file_parts['0'] === 'mobile') {
                $file_dir .= 'mobile/';
            } elseif ($file_parts['0'] === 'woocommerce') {
                $file_dir .= 'woocommerce/';
            } elseif ($file_parts['0'] === 'customizer') {
                $file_dir .= 'customizer/';
            } elseif ($file_parts['0'] === 'admin') {
                $file_dir .= 'admin/';
            } elseif ($file_parts['0'] === 'blog') {
                $file_dir .= 'blog/';
            }
        }

        $file_name = $file_dir . 'class-' . Theme::instance()->theme_prefix . '-' . $file_name . '.php';

        if (is_readable($file_name)) {
            include($file_name);
        }
    }    

}