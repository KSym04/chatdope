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
    exit; // Exit if accessed outside of WordPress
}

/**
 * Class ChatDope
 *
 * Main class that defines all the hooks and actions required for the ChatDope plugin.
 * Includes methods for enqueuing scripts, initializing admin functionalities, activation, and deactivation.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'ChatDope' ) ) {
	class ChatDope {

		/**
		 * ChatDope constructor.
		 *
		 * Initializes the plugin by registering actions, filters, and loading dependencies.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->load_dependencies(); // Load required files and classes
			$this->define_admin_hooks(); // Set up admin-related hooks
			$this->define_frontend_hooks(); // Set up frontend-related hooks
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts_styles' ) ); // Enqueue admin scripts and styles
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts_styles' ) ); // Enqueue public scripts and styles
		}

		/**
		 * Enqueue the necessary scripts and styles for the admin area.
		 * Includes the CSS and JS files used within the admin dashboard.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_scripts_styles() {
			wp_enqueue_style( 'chatdope-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
			wp_enqueue_script( 'chatdope-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );

			// Localize the script with the translated tooltip text.
			$translation_array = array(
				'tooltipText' => __( 'Choose the color theme for your ChatDope interface. Select Light for a standard look or Dark (PRO version) for a sleek, professional appearance.', 'chatdope' ),
			);
			wp_localize_script( 'chatdope-admin-script', 'chatdope_admin_translation', $translation_array );
		}

		/**
		 * Enqueue public-facing scripts and styles.
		 * Includes the CSS and JS files used on the frontend of the site.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_public_scripts_styles() {
			wp_enqueue_style( 'chatdope-public-style', plugins_url( 'assets/css/public.css', __FILE__ ) );
			wp_enqueue_script( 'chatdope-public-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		}

		/**
		 * Define the admin hooks to manage the ChatDope settings.
		 * Binds the admin functionalities to the WordPress action hooks.
		 *
		 * @since 1.0.0
		 */
		private function define_admin_hooks() {
			$admin = new ChatDope_Admin(); // Instantiate the admin class
			add_action( 'admin_menu', array( $admin, 'add_admin_menu' ) ); // Create admin menu
			add_action( 'admin_init', array( $admin, 'register_settings' ) ); // Register settings
		}

		/**
		 * Define the frontend hooks to manage the ChatDope interface.
		 * Instantiates the frontend class and binds the necessary frontend functionality.
		 *
		 * @since 1.0.0
		 */
		private function define_frontend_hooks() {
			$frontend = new ChatDope_Frontend(); // Instantiate the frontend class
		}

		/**
		 * Load the required dependencies for this plugin.
		 * Includes the necessary files, classes, and sets up hooks for the admin area and the public side of the site.
		 *
		 * @since 1.0.0
		 */
		private function load_dependencies() {
			require_once plugin_dir_path( __FILE__ ) . 'inc/class-chatdope-admin.php'; // Include admin class
			require_once plugin_dir_path( __FILE__ ) . 'inc/class-chatdope-chat-model.php'; // Include chat model class
		}

		/**
		 * Activation hook to run when the plugin is activated.
		 * Implement any required logic here for when the plugin is enabled.
		 *
		 * @since 1.0.0
		 */
		public static function activate() {
			global $wpdb;
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . 'chatdope_messages';

			$sql = "CREATE TABLE $table_name (
				chat_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				session_id VARCHAR(255) NOT NULL,
				user_id BIGINT(20) UNSIGNED,
				guest_id VARCHAR(255),
				message TEXT NOT NULL,
				timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
				sender ENUM('user', 'guest') NOT NULL,
				conversation_start_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		/**
		 * Deactivation hook to run when the plugin is deactivated.
		 * Implement any required logic here for cleaning up after the plugin is disabled.
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
    $chatDope = new ChatDope(); // Instantiate main plugin class
}

// Hooks for activating and deactivating the plugin
register_activation_hook( __FILE__, array( 'ChatDope', 'activate' ) ); // Hook activation method
register_deactivation_hook( __FILE__, array( 'ChatDope', 'deactivate' ) ); // Hook deactivation method
