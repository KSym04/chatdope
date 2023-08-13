<?php
/**
 * ChatDope Namespace
 *
 * This namespace contains all the classes and functions related to the ChatDope plugin.
 * It's responsible for handling chat interactions, sessions, and other related functionalities.
 *
 * @package ChatDope
 * @since 1.0.0
 */
namespace ChatDope;

/**
 * Class ChatDope_Session
 *
 * This class handles the session management related to chat interactions.
 *
 * @since 1.0.0
 */
class ChatDope_Session {

	/**
	 * Constructor
	 * Initializes the session based on the PHP session status.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		if ( session_status() == PHP_SESSION_NONE ) {
			session_start();
		}
	}

	/**
	 * Start a new chat session or resume existing one.
	 *
	 * @since 1.0.0
	 *
	 * @param int|string $user_id The user ID associated with the session.
	 * @param string $user_type The type of user ('admin', 'user', or 'guest').
	 */
	public function start_session( $user_id, $user_type = 'user' ) {
		if ( ! isset( $_SESSION['user_id'] ) ) {
			$_SESSION['user_id']   = $user_id;
			$_SESSION['user_type'] = $user_type; // Added user type in session.
		}
	}

	/**
	 * Get the user type from the session.
	 *
	 * @since 1.0.0
	 *
	 * @return string The user type stored in session or 'guest' if not found.
	 */
	public function get_user_type() {
		return $_SESSION['user_type'] ?? 'guest'; // Default to 'guest' if not found.
	}

	/**
	 * Set a specific data into the session.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key   The key for the session data to set.
	 * @param mixed  $value The value to be stored in the session.
	 */
	public function set_session_data( $key, $value ) {
		$_SESSION[$key] = $value;
	}

	/**
	 * Destroy the current session.
	 *
	 * @since 1.0.0
	 */
	public function destroy_session() {
		session_destroy();
	}

}
