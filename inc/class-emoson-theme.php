<?php
/**
 * Emoson init
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
 * Emoson theme init
 * Not allow inherit from this class
 */
if (!class_exists('Theme')) {
    final class Theme {

        /**
         * Instance
         *
         * @var $instance
         */
        protected static $instance = null;
        public $theme_prefix = 'emoson';
        public $theme_name = 'Emoson';
        public $class_dir = '/inc/';


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
            require_once get_template_directory() . '/inc/class-' . $this->theme_prefix . '-autoload.php';

        }

        /**
         * Get and prepare the class instance for ready put-in
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        public function init() {

            // Befor init action
            do_action('emoson_before_init_theme');

            // Setup
            $this->get('autoload');
            $this->get('setup');
            $this->get('template_functions');
            $this->get('starter_content');
            $this->get('widget_area');
            $this->get('widgets');
            $this->get('woocommerce');

            // Header
            $this->get('preloader');
            $this->get('topbar');
            $this->get('header');            

            // Page Header
            $this->get('page_header');
            $this->get('breadcrumbs');

            // Layout & Style
            $this->get('layout');
            $this->get('dynmaic_css');

            // Comments
            $this->get('comments');

            // Footer
            $this->get('footer');


            // Modules & Sections


            // Templates
            $this->get('page');

            //$this->get('blog');


            // Admin
            $this->get('admin');            

            // After init action
            do_action('emoson_after_init_theme');
        }


        /**
         * Take Emoson Class.
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        public function get($class) {

            switch ($class) {
                case 'woocommerce':
                    if (class_exists('woocommerce')) {
                        return WooCommerce::instance();
                    }
                    break;

                case 'settings':
                    return Settings::instance();
                    break;

                default:
                    $class = ucwords($class);
                    // $class = "\Emoson\\" . $class;
                    $class = '\\' . $this->theme_name . '\\' . $class;
                    if (class_exists($class)) {
                        return $class::instance();
                    }
                    break;
            }
        }
    }
}
