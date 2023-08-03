<?php
/**
 * Class ChatDope_Frontend
 *
 * This class handles the frontend functionality to render the chat interface.
 *
 * @since 1.0.0
 */
class ChatDope_Frontend {

	/**
	 * Constructor
	 * Initializes the class and adds the necessary action hooks to render the chat interface.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'render_chat_interface' ) ); // Add chat interface to footer
	}

	/**
	 * Render the chat interface on the frontend.
	 * This method outputs the HTML structure for the chat window, message container, input field, and send button.
	 *
	 * @since 1.0.0
	 */
	public function render_chat_interface() {
		echo '<div id="chatdope-window">';
			echo '<div id="chatdope-messages"></div>';
			echo '<textarea id="chatdope-input"></textarea>';
			echo '<button id="chatdope-send">Send</button>';
		echo '</div>';
	}

}
