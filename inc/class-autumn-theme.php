
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
        protected static $_instance = null;

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /** 
         * Instantiate theme object.
         * 
         * @return void          
         * 
         */
        public function __construct() {

            // Auto task code when create object here ...

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
            do_action('emoson/before_init_theme');


            // Setup
            $this->get('autoload');
            $this->get('setup');
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

            $this->get('blog');


            // Admin
            $this->get('admin');


            // After init action
            do_action('emoson/after_init_theme');
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
                    $class = "\Emoson\\" . $class;
                    if (class_exists($class)) {
                        return $class::instance();
                    }
                    break;
            }
        }
    }
}
