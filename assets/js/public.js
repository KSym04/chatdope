/**
 * This script handles the frontend chat interface for ChatDope.
 * It manages click events for contacts and the send button, fetches chat messages, and sends messages.
 *
 * @file public.js
 */

document.addEventListener("DOMContentLoaded", function () {
  let textArea = document.getElementById("chatdope-input");
  let initialHeight = textArea.offsetHeight; // Get the original height
  let singleLineHeight = textArea.clientHeight; // Single line height without padding

  textArea.style.overflowY = "hidden"; // Hide overflow initially

  textArea.addEventListener("input", function () {
    this.style.height = "auto";

    if (this.value.trim() === "") {
      this.style.height = initialHeight + "px"; // Reset to original height if blank
      return;
    }

    if (this.scrollHeight > singleLineHeight) {
      this.style.height = this.scrollHeight + "px"; // Adjust height to fit content
    } else {
      this.style.height = initialHeight + "px"; // Keep original height if one line
    }
  });
});
