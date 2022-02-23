<?php

/**
 * Register widget area.
 *
 * @since Emoson 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */

namespace Emoson;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Widget Area class for this theme
 * 
 * @since 1.0.0
 * 
 * @return void 
 */

if (!class_exists('Widget_Area')) {

    class Widget_Area {

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

            // Add task at init
            add_action('widgets_init', array ( $this, 'sidebars_create'), 0 ) ;
        }
      
        public function sidebars_create() {

            echo 'Callback here ...';

            register_sidebar(
                array(
                    'name'          => esc_html__('Footer', 'emoson'),
                    'id'            => 'sidebar-1',
                    'description'   => esc_html__('Add widgets here to appear in your footer.', 'emoson'),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h2 class="widget-title">',
                    'after_title'   => '</h2>',
                )
            );
            
        }
    }
}
