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
		// Check if a user is logged in
		if ( is_user_logged_in() ) {
			$current_user      = wp_get_current_user();
			$user_display_name = ( ! empty( $current_user->user_firstname ) ) ? $current_user->user_firstname : $current_user->user_login;
			$online_status     = $this->check_online_status( $current_user );
			$dot_class         = ( $online_status ) ? 'status-dot--online' : 'status-dot--offline';
		} else {
			$user_display_name = esc_html__( 'User', 'chatdope' );
			$dot_class         = 'status-dot--offline';
		}

		echo '<div class="chatdope-container">';

			echo '<div class="chatdope-container__user-header">';
				echo '<div class="chatdope-container__user-header-info">';
					echo '<span class="user-name">' . esc_html( $user_display_name ) . '</span>';
					echo '<span class="status-dot ' . esc_attr( $dot_class ) . '"></span>';
				echo '</div>';

				echo '<div class="chatdope-container__user-header-controls">';
					// Minimize button.
					echo '<div class="chatdope-container__user-header-controls-button" id="chatdope-minimize">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">';
							echo '<line x1="5" y1="12" x2="19" y2="12"></line>';
						echo '</svg>';
					echo '</div>';

					// Close button.
					echo '<div class="chatdope-container__user-header-controls-button" id="chatdope-close">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">';
							echo '<line x1="18" y1="6" x2="6" y2="18"></line>';
							echo '<line x1="6" y1="6" x2="18" y2="18"></line>';
						echo '</svg>';
					echo '</div>';
				echo '</div>';

			echo '</div>';

			// Main chat window.
			echo '<div id="chatdope-chats" class="chatdope-container__chats"></div>';

			echo '<div class="chatdope-container__input-box">';
				echo '<div class="chatdope-container__input">';
					echo '<textarea id="chatdope-input" class="chatdope-container__input-text" placeholder="' . esc_html__( 'Type a message...', 'chatdope' ) . '"></textarea>';
				echo '</div>';

				echo '<div class="chatdope-container__submit">';
					echo '<button id="chatdope-send" class="chatdope-container__submit-button">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="chatdope-container__submit-icon">';
							echo '<path d="M22 2 15 22 11 13 2 9 22 2z"></path>';
						echo '</svg>';
					echo '</button>';
				echo '</div>';
			echo '</div>';

		echo '</div>';
	}

	/**
	 * Check if a user is online or not.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_User $user
	 * @return bool True if online, false if not.
	 */
	public function check_online_status( $user ) {
		// TODO: Implement a method to check if the user is online or not.
		return false;  // Temporary return value
	}

}
