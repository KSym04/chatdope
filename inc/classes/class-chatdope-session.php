<?php
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
	 */
	public function start_session( $user_id ) {
		if ( ! isset( $_SESSION['user_id'] ) ) {
			$_SESSION['user_id'] = $user_id;
		}
	}

	/**
	 * Get a specific data from the session.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key The key for the session data to retrieve.
	 * @return mixed      The value stored in session or null.
	 */
	public function get_session_data( $key ) {
		return $_SESSION[$key] ?? null;
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
