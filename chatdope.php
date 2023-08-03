<?php
/**
 * Plugin Name: ChatDope
 * Plugin URI: https://www.dopethemes.com/downloads/chatdope/
 * Description: A modern and engaging chat system for WordPress.
 * Version: 1.0
 * Author: DopeThemes
 * Author URI: https://www.dopethemes.com
 * Text Domain: chatdope
 * Domain Path: /lang
 * License: GPLv3
 * License URI: license.txt
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class ChatDope
 * Defines the main functionality for the ChatDope plugin.
 * 
 * @since 1.0.0
 */
if ( ! class_exists( 'ChatDope' ) ) {
    class ChatDope {
        /**
         * ChatDope constructor.
         * Initializes the plugin by registering actions and filters.
         * 
         * @since 1.0.0
         */
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        }

        /**
         * Enqueue necessary scripts and styles for the plugin.
         *
         * @since 1.0.0
         */
        public function enqueue_scripts_styles() {
            wp_enqueue_style( 'chatdope-style', plugins_url( 'css/chatdope.css', __FILE__ ) );
            wp_enqueue_script( 'chatdope-script', plugins_url( 'js/chatdope.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        }

        /**
         * Activation hook to run when the plugin is activated.
         *
         * @since 1.0.0
         */
        public static function activate() {
            // Activation code here
        }

        /**
         * Deactivation hook to run when the plugin is deactivated.
         *
         * @since 1.0.0
         */
        public static function deactivate() {
            // Deactivation code here
        }
    }
}

// Initialize ChatDope if class exists
if ( class_exists( 'ChatDope' ) ) {
    $chatDope = new ChatDope();
}

// Hooks for activating and deactivating the plugin
register_activation_hook( __FILE__, array( 'ChatDope', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ChatDope', 'deactivate' ) );