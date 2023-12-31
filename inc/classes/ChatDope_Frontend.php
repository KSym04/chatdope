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
		$chat_with_admin_only = false; // Default value

		if ( is_user_logged_in() ) {
			$current_user      = wp_get_current_user();
			$user_display_name = ( ! empty( $current_user->user_firstname ) ) ? $current_user->user_firstname : $current_user->user_login;
			$online_status     = $this->check_online_status( $current_user );
			$dot_class         = ( $online_status ) ? 'status-dot--online' : 'status-dot--offline';

			if ( ! current_user_can( 'manage_options' ) ) {
				$chat_with_admin_only = true; // Set to true if non-admin
			}
		} else {
			$user_display_name = esc_html__( 'Admin', 'chatdope' );
			$dot_class         = 'status-dot--offline';
			$chat_with_admin_only = true; // Set to true if guest
		}

		echo '<div class="chatdope-container" role="dialog" aria-labelledby="chatdope-title">';

			echo '<div class="chatdope-container__user-header">';
				echo '<div class="chatdope-container__user-header-info">';
					echo '<span class="user-name" id="chatdope-title">' . esc_html( $user_display_name ) . '</span>';
					echo '<span class="status-dot ' . esc_attr( $dot_class ) . '" aria-hidden="true"></span>';
				echo '</div>';

				echo '<div class="chatdope-container__user-header-controls">';
					// Minimize button.
					echo '<button class="chatdope-container__user-header-controls-button" id="chatdope-minimize" aria-label="' . esc_html__( 'Minimize', 'chatdope' ) . '">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">';
							echo '<line x1="5" y1="12" x2="19" y2="12"></line>';
						echo '</svg>';
					echo '</button>';

					// Close button.
					echo '<button class="chatdope-container__user-header-controls-button" id="chatdope-close" aria-label="' . esc_html__( 'Close', 'chatdope' ) . '">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">';
							echo '<line x1="18" y1="6" x2="6" y2="18"></line>';
							echo '<line x1="6" y1="6" x2="18" y2="18"></line>';
						echo '</svg>';
					echo '</button>';
				echo '</div>';
			echo '</div>';

			// Main chat window.
			echo '<div id="chatdope-chats" class="chatdope-container__chats" role="log" aria-live="polite"></div>';

			echo '<div class="chatdope-container__input-box">';
				echo '<div class="chatdope-container__input">';
					echo '<textarea id="chatdope-input" class="chatdope-container__input-text" placeholder="' . esc_html__( 'Type a message...', 'chatdope' ) . '" role="textbox" aria-multiline="true" aria-label="' . esc_html__( 'Type a message', 'chatdope' ) . '"></textarea>';
				echo '</div>';

				echo '<div class="chatdope-container__submit">';
					echo '<button id="chatdope-send" class="chatdope-container__submit-button" aria-label="Send">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="chatdope-container__submit-icon">';
							echo '<path d="M22 2 15 22 11 13 2 9 22 2z"></path>';
						echo '</svg>';
					echo '</button>';
				echo '</div>';
			echo '</div>';

		echo '</div>';

		// Contact box for logged-in users who are not admins
		if ( is_user_logged_in() && $chat_with_admin_only ) {
			echo '<div class="chatdope-container__contact-box">';
				echo '<div class="chatdope-container__user-header">';
					echo '<div class="chatdope-container__user-header-info">';
						echo '<span class="user-name" id="chatdope-title">' . esc_html__( 'Contacts', 'chatdope' ) . '</span>';
					echo '</div>';
				echo '</div>';

				echo '<ul class="chatdope-container__contact-list">';
					echo '<li class="chatdope-container__contact-list-item"><a href="#" data-user-id="[user_id_goes_here]">Sample Contact 1</a></li>';
					echo '<li class="chatdope-container__contact-list-item"><a href="#" data-user-id="[user_id_goes_here]">Sample Contact 2</a></li>';
					echo '<li class="chatdope-container__contact-list-item"><a href="#" data-user-id="[user_id_goes_here]">Sample Contact 3</a></li>';
				echo '</ul>';
			echo '</div>';
		}
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
