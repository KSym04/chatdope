<?php
class ChatDope_Chat_Model {

	// Table name
	private $table_name;

	// Constructor
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'chatdope_messages';
	}

	// Method to create a new chat session
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

	// Method to add a new message to a session
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

	// Method to retrieve messages from a session
	public function get_messages( $session_id ) {
		global $wpdb;
		$query = $wpdb->prepare( "SELECT * FROM $this->table_name WHERE session_id = %s", $session_id );
		return $wpdb->get_results( $query );
	}
}
