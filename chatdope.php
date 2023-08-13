<?php
/**
 * Plugin Name: ChatDope
 * Plugin URI: https://www.dopethemes.com/downloads/chatdope/
 * Description: A modern and engaging chat system for WordPress.
 * Version: 1.0.0
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

// Require Composer autoload.
require plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

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
		 * The current version of the plugin.
		 *
		 * This value is used to manage changes between different versions of the plugin
		 * and can be utilized to handle upgrades, enqueue assets, or other version-specific logic.
		 *
		 * @since 1.0.0
		 *
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * Holds the single instance of the ChatDope class.
		 *
		 * Ensures that only one instance of ChatDope is loaded or can be loaded.
		 * The contents of the instance are a reference to an object that holds the unique
		 * ChatDope instance.
		 *
		 * @since 1.0.0
		 * @var ChatDope|null The single instance of the class.
		 */
		private static $instance = null;

        /**
         * ChatDope constructor.
         *
         * Initializes the plugin by registering actions, filters, and loading dependencies.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->autoload_libraries();
            $this->define_admin_hooks();
            $this->define_frontend_hooks();
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts_styles' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts_styles' ) );
        }

		/**
		 * Retrieve the instance of the ChatDope class.
		 *
		 * This method ensures that only one instance of ChatDope exists at any time
		 * and provides a global point of access to the instance.
		 *
		 * @since 1.0.0
		 *
		 * @return ChatDope The single instance of the class.
		 */
		public static function getInstance() {
			if ( null === self::$instance ) {
				self::$instance = new self(); // Create a new instance if one doesn't exist
			}

			return self::$instance; // Return the single instance of the class
		}

        /**
         * Enqueue the necessary scripts and styles for the admin area.
         * Includes the CSS and JS files used within the admin dashboard.
         *
         * @since 1.0.0
         */
        public function enqueue_admin_scripts_styles() {
            wp_enqueue_style( 'chatdope-admin', plugins_url( 'assets/dist/css/backend.css', __FILE__ ) );
            wp_enqueue_script( 'chatdope-admin', plugins_url( 'assets/dist/js/admin.js', __FILE__ ), array( 'jquery' ), $this->version, true );

			// Tooltips.
            $translation_array = array(
                'tooltipText' => esc_html__( 'Choose the color theme for your ChatDope interface. Select Light for a standard look or Dark (PRO version) for a sleek, professional appearance.', 'chatdope' ),
            );

            wp_localize_script( 'chatdope-admin', 'chatdope_admin_translation', $translation_array );
        }

		/**
		 * Enqueue public-facing scripts and styles.
		 * Includes the CSS and JS files used on the frontend of the site.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_public_scripts_styles() {
			// Enqueue Open Sans Google Font
			wp_enqueue_style( 'google-fonts-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700', false );

			// Enqueue ChatDope Styles and Scripts
			wp_enqueue_style( 'chatdope-public', plugins_url( 'assets/dist/css/frontend.css', __FILE__ ) );
			wp_enqueue_script( 'chatdope-public', plugins_url( 'assets/dist/js/public.js', __FILE__ ), array( 'jquery' ), $this->version, true );
		}

		/**
		 * Define the admin hooks to manage the ChatDope settings.
		 * Binds the admin functionalities to the WordPress action hooks.
		 *
		 * @since 1.0.0
		 */
		private function define_admin_hooks() {
			if ( class_exists( 'ChatDope_Admin' ) ) {
				$admin = new ChatDope_Admin(); // Instantiate the admin class
				add_action( 'admin_menu', array( $admin, 'add_admin_menu' ) ); // Create admin menu
				add_action( 'admin_init', array( $admin, 'register_settings' ) ); // Register settings
			} else {
				// Handle the error, perhaps log it
				error_log( 'ChatDope_Admin class not found.' );
			}
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
		 * Autoload the classes, functions, vendor needed for the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param string $class_name Name of the class to load.
		 */
		public function autoload_libraries() {
			$base_path = plugin_dir_path( __FILE__ ) . 'inc/';

			// Autoload vendor files without specific naming rules
			foreach ( glob( $base_path . 'vendor/*.php' ) as $filename ) {
				if ( file_exists( $filename ) ) {
					require_once $filename;
					error_log( "Included vendor file: {$filename}" ); // Logging included vendor file
				}
			}

			// Autoload function files with "function-" prefix
			foreach ( glob( $base_path . 'functions/function-*.php' ) as $filename ) {
				if ( file_exists( $filename ) ) {
					require_once $filename;
					error_log( "Included function file: {$filename}" ); // Logging included function file
				}
			}
		}

		private static function start_server() {
			$loop   = React\EventLoop\Factory::create();
			$webSock = new React\Socket\Server('0.0.0.0:8080', $loop); // Listen on the given port

			// Ratchet magic
			$webServer = new Ratchet\Server\IoServer(
				new Ratchet\Http\HttpServer(
					new Ratchet\WebSocket\WsServer(
						new YourWebSocketClass() // Define a class to handle WebSocket connections
					)
				),
				$webSock
			);

			$loop->run(); // Start the server
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
            $table_name      = $wpdb->prefix . 'chatdope_messages';

            $sql = "CREATE TABLE $table_name (
                chat_id                    BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                session_id                 VARCHAR(255) NOT NULL,
                user_id                    BIGINT(20) UNSIGNED,
                guest_id                   VARCHAR(255),
                message                    TEXT NOT NULL,
                timestamp                  DATETIME DEFAULT CURRENT_TIMESTAMP,
                sender                     ENUM('user', 'guest') NOT NULL,
                conversation_start_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

			self::start_server(); // Start the WebSocket server
        }

        /**
         * Deactivation hook to run when the plugin is deactivated.
         * Implement any required logic here for cleaning up after the plugin is disabled.
         *
         * @since 1.0.0
         */
		public static function deactivate() {
			// Deactivation code here.
		}
	}

}

// Initialize ChatDope if class exists
if ( class_exists( 'ChatDope' ) ) {
    $chatDope = ChatDope::getInstance();
}

// Hooks for activating and deactivating the plugin
register_activation_hook( __FILE__, array( 'ChatDope', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ChatDope', 'deactivate' ) );
