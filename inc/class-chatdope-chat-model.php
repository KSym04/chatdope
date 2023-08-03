<?php
/**
 * Class ChatDope_Chat_Model
 *
 * This class handles the database interactions related to chat sessions and messages.
 *
 * @since 1.0.0
 */
class ChatDope_Chat_Model {

	/**
	 * @var string $table_name The name of the table where chat messages are stored.
	 */
	private $table_name;

	/**
	 * Constructor
	 * Initializes the table name based on the WordPress table prefix.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'chatdope_messages';
	}

	/**
	 * Create a new chat session.
	 *
	 * @since 1.0.0
	 *
	 * @param int|string $user_id   The user ID associated with the chat session.
	 * @param int|string $guest_id  The guest ID associated with the chat session.
	 * @return string               The newly created session ID.
	 */
	public function create_session( $user_id, $guest_id ) {
		global $wpdb;
		$data = array(
			'session_id'                  => wp_generate_uuid4(),
			'user_id'                     => $user_id,
			'guest_id'                    => $guest_id,
			'conversation_start_timestamp'=> current_time( 'mysql' ),
		);
		$wpdb->insert( $this->table_name, $data );
		return $data['session_id'];
	}

	/**
	 * Add a new message to a chat session.
	 *
	 * @since 1.0.0
	 *
	 * @param string $session_id The session ID to add the message to.
	 * @param string $message    The text content of the message.
	 * @param string $sender     The sender of the message (either 'user' or 'guest').
	 */
	public function add_message( $session_id, $message, $sender ) {
		global $wpdb;
		$data = array(
			'session_id' => $session_id,
			'message'    => $message,
			'sender'     => $sender,
			'timestamp'  => current_time( 'mysql' ),
		);
		$wpdb->insert( $this->table_name, $data );
	}

	/**
	 * Retrieve messages from a specific chat session.
	 *
	 * @since 1.0.0
	 *
	 * @param string $session_id The session ID to retrieve messages from.
	 * @return array             An array of message objects for the specified session.
	 */
	public function get_messages( $session_id ) {
		global $wpdb;
		$query = $wpdb->prepare( "SELECT * FROM $this->table_name WHERE session_id = %s", $session_id );
		return $wpdb->get_results( $query );
	}

}
