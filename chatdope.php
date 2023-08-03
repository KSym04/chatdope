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
 * License URI: https://www.dopethemes.com/gplv3/
 */

/*
    Copyright DopeThemes

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1335, USA
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
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts_styles' ) );
		}

		/**
		 * Enqueue necessary scripts and styles for the admin area.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_scripts_styles() {
			wp_enqueue_style( 'chatdope-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
			wp_enqueue_script( 'chatdope-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
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
