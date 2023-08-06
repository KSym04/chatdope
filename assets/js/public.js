/**
 * This script handles the frontend chat interface for ChatDope.
 * It manages click events for contacts and the send button, fetches chat messages, and sends messages.
 *
 * @file public.js
 */

document.addEventListener("DOMContentLoaded", function () {
  let textArea = document.getElementById("chatdope-input");
  let inputBoxWrapper = document.querySelector(
    ".chatdope-container__input-box"
  );
  let maxRows = 5;
  let minRows = 1;
  let singleRowHeight = textArea.scrollHeight;

  textArea.addEventListener("input", function () {
    this.style.height = "auto";
    let lines = this.value.split("\n");

    if (this.value === "") {
      // if there's no text, return the textarea to its original size
      this.style.height = singleRowHeight + "px";
      inputBoxWrapper.style.height = "auto";
    } else if (lines.length > minRows && lines.length <= maxRows) {
      // otherwise, if the number of lines is between 2 and 5, adjust the height
      this.style.height = this.scrollHeight + "px";
      inputBoxWrapper.style.height = this.scrollHeight + "px";
    }
  });
});
