<?php
/**
 * Class ChatDope_Admin
 *
 * Defines the admin functionality for the ChatDope plugin.
 * Includes methods to add admin menu, register settings, render the admin page, and display the theme color field.
 *
 * @since 1.0.0
 */
class ChatDope_Admin {

    /**
     * Adds the admin menu page for ChatDope settings.
     * Utilizes the WordPress add_menu_page function to create a menu item in the WordPress dashboard.
     *
     * @since 1.0.0
     */
    public function add_admin_menu() {
        add_menu_page(
            __( 'ChatDope Settings', 'chatdope' ), // Title using internationalization.
            __( 'ChatDope', 'chatdope' ), // Menu title using internationalization.
            'manage_options',
            'chatdope-settings',
            array( $this, 'admin_page_html' )
        );
    }

    /**
     * Registers settings, sections, and fields for the admin page using the WordPress Settings API.
     * Registers a color theme option for the chat system.
     *
     * @since 1.0.0
     */
    public function register_settings() {
        register_setting( 'chatdope', 'chatdope_theme_color' );

        add_settings_section(
            'chatdope_section',
            __( 'Chat Theme Color', 'chatdope' ), // Title using internationalization.
            null,
            'chatdope'
        );

        add_settings_field(
            'chatdope_theme_color',
            __( 'Choose Color Theme', 'chatdope' ), // Label using internationalization.
            array( $this, 'theme_color_html' ),
            'chatdope',
            'chatdope_section'
        );
    }

    /**
     * Renders the HTML for the admin page, including a form for the ChatDope settings.
     * Handles the permissions check and utilizes WordPress functions to display the settings fields and submit button.
     *
     * @since 1.0.0
     */
	public function admin_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		settings_errors( 'chatdope_messages' );

		echo '<div class="chatdope-admin">';
			echo '<h1 class="chatdope-admin__title">' . esc_html( get_admin_page_title() ) . '</h1>';
			echo '<form action="options.php" class="chatdope-admin__form" method="post">';

				settings_fields( 'chatdope' );
				do_settings_sections( 'chatdope' );

				echo '<button type="submit" class="chatdope-admin__form__submit--special">' . __( 'Save Settings', 'chatdope' ) . '</button>'; // Button label using internationalization.

			echo '</form>';
		echo '</div>';
	}

	/**
	 * Renders the HTML for the theme color settings field.
	 * Displays radio buttons to select either a light or dark theme.
	 * The dark theme option is disabled and semi-transparent if the user does not have a premium license.
	 *
	 * @since 1.0.0
	 */
	public function theme_color_html() {
		$theme_color = get_option( 'chatdope_theme_color' );
		$is_premium_license = false;

		echo '<div class="theme-color">';
			echo '<div class="theme-color__option">';
				echo '<label class="theme-color__label">';
					echo '<input type="radio" name="chatdope_theme_color" value="light" class="theme-color__input"' . checked( $theme_color, 'light', false ) . '>';
					echo __( 'Light', 'chatdope' );
				echo '</label>';
			echo '</div>';

			echo '<div class="theme-color__option' . ( $is_premium_license ? '' : ' theme-color__option--disabled' ) . '">';
				echo '<label class="theme-color__label">';
					echo '<input type="radio" name="chatdope_theme_color" value="dark" class="theme-color__input"' . checked( $theme_color, 'dark', false ) . ( $is_premium_license ? '' : ' disabled' ) . '>';
					echo __( 'Dark', 'chatdope' ) . '<sup class="theme-color__pro">' . __( 'PRO', 'chatdope' ) . '</sup>';
				echo '</label>';
			echo '</div>';
		echo '</div>';
	}

}
