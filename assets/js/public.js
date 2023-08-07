/**
 * Initializes the chat input behavior.
 * Resizes the input field based on its content, handles the Enter key to send messages, and appends messages to the chat container.
 * @function
 */
document.addEventListener("DOMContentLoaded", function () {
  /**
   * Reference to the chat input textarea element.
   * @type {HTMLTextAreaElement}
   */
  const textArea = document.getElementById("chatdope-input");

  /**
   * Reference to the chat messages container element.
   * @type {HTMLElement}
   */
  const chatContainer = document.getElementById("chatdope-chats");

  /**
   * Original height of the textarea when the page is loaded.
   * @type {number}
   */
  const initialHeight = textArea.offsetHeight;

  /**
   * Height of a single line within the textarea, excluding padding.
   * @type {number}
   */
  const singleLineHeight = textArea.clientHeight;

  // Hide overflow initially
  textArea.style.overflowY = "hidden";

  /**
   * Event handler for text input within the textarea.
   * Adjusts the textarea's height based on its content.
   */
  textArea.addEventListener("input", function () {
    // Reset to auto height for proper calculation
    this.style.height = "auto";

    // Handle case where input is blank
    if (this.value.trim() === "") {
      this.style.height = initialHeight + "px";
      this.style.overflowY = "hidden";
      return;
    }

    // Resize textarea based on content and max height (5 lines)
    if (
      this.scrollHeight > singleLineHeight &&
      this.scrollHeight <= singleLineHeight * 5
    ) {
      this.style.height = this.scrollHeight + "px";
    } else if (this.scrollHeight > singleLineHeight * 5) {
      this.style.height = singleLineHeight * 5 + "px";
      this.style.overflowY = "auto";
    } else {
      this.style.height = initialHeight + "px";
    }
  });

  /**
   * Event handler for the Enter key within the textarea.
   * Appends messages to the chat container and clears the input.
   */
  textArea.addEventListener("keyup", function (e) {
    if (e.key === "Enter" && this.value.trim() !== "") {
      e.preventDefault();

      // Create and append the message to the chat container
      const messageDiv = document.createElement("div");
      messageDiv.className = "chat-message sender";
      messageDiv.textContent = this.value.trim();
      chatContainer.insertBefore(messageDiv, chatContainer.firstChild); // Insert at the beginning

      // Clear the input and reset to original height
      this.value = "";
      this.style.height = initialHeight + "px";
      this.style.overflowY = "hidden";
    }
  });
});
