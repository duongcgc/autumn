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

        

    }
}
