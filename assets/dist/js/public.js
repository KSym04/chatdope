/******/ (() => { // webpackBootstrap
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************!*\
  !*** ./assets/js/public.js ***!
  \*****************************/
/**
 * Initializes the chat input behavior.
 * Resizes the input field based on its content, handles the Enter key to send messages, and appends messages to the chat container.
 */
document.addEventListener("DOMContentLoaded", function () {
  /** @type {HTMLElement} Reference to the chat messages container element. */
  var chatContainer = document.getElementById("chatdope-chats");

  /** @type {HTMLTextAreaElement} Reference to the chat input textarea element. */
  var textArea = document.getElementById("chatdope-input");

  /** @type {HTMLElement} Reference to the send button of chat message. */
  var sendButton = document.getElementById("chatdope-send");

  /** @type {number} Original height of the textarea when the page is loaded. */
  var initialHeight = textArea.offsetHeight;

  /** @type {number} Height of a single line within the textarea, excluding padding. */
  var singleLineHeight = textArea.clientHeight;

  /** @type {string} SVG content for minimize button. */
  var minimizeSVG = "<line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/>";

  // Hide overflow initially
  textArea.style.overflowY = "hidden";

  /**
   * Event handler for text input within the textarea.
   * Adjusts the textarea's height based on its content.
   */
  textArea.addEventListener("input", handleInput);

  /**
   * Event handler for the Enter key within the textarea.
   * Appends messages to the chat container and clears the input.
   */
  textArea.addEventListener("keyup", function (e) {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  // Event handler for the send button
  sendButton.addEventListener("click", sendMessage);

  /** @type {HTMLElement} Reference to the minimize button. */
  var minimizeButton = document.getElementById("chatdope-minimize");
  minimizeButton.addEventListener("click", toggleMinimizeMaximize);

  /** @type {HTMLElement} Reference to the close button. */
  var closeButton = document.getElementById("chatdope-close");
  closeButton.addEventListener("click", closeChat);

  /** @type {HTMLElement} Reference to the chat container. */
  var chatdopeContainer = document.querySelector(".chatdope-container");

  // Initialize the chat state based on localStorage and sessionStorage
  initializeChatState();

  /**
   * Handles the resizing of the text area based on its content.
   */
  function handleInput() {
    // Reset to auto height for proper calculation
    this.style.height = "auto";

    // Handle case where input is blank
    if (this.value.trim() === "") {
      this.style.height = initialHeight + "px";
      this.style.overflowY = "hidden";
      return;
    }

    // Resize textarea based on content and max height (5 lines)
    resizeTextArea(this);
  }

  /**
   * Resizes the textarea based on content and max height (5 lines).
   * @param {HTMLTextAreaElement} textAreaElement - The text area element to resize.
   */
  function resizeTextArea(textAreaElement) {
    if (textAreaElement.scrollHeight > singleLineHeight && textAreaElement.scrollHeight <= singleLineHeight * 5) {
      textAreaElement.style.height = textAreaElement.scrollHeight + "px";
    } else if (textAreaElement.scrollHeight > singleLineHeight * 5) {
      textAreaElement.style.height = singleLineHeight * 5 + "px";
      textAreaElement.style.overflowY = "auto";
    } else {
      textAreaElement.style.height = initialHeight + "px";
    }
  }

  /**
   * Sends the message in the text area to the chat container.
   */
  function sendMessage() {
    var trimmedMessage = textArea.value.trim();
    if (trimmedMessage !== "" && trimmedMessage.length <= 500) {
      appendMessage(trimmedMessage);
      textArea.value = "";
      textArea.style.height = initialHeight + "px";
      textArea.style.overflowY = "hidden";
    }
  }

  /**
   * Appends a message to the chat container.
   * @param {string} message - The message to append.
   */
  function appendMessage(message) {
    var messageDiv = document.createElement("div");
    messageDiv.className = "chat-message sender";
    messageDiv.textContent = message;
    chatContainer.insertBefore(messageDiv, chatContainer.firstChild);
  }

  /**
   * Minimizes the chat window.
   */
  function minimize() {
    var containerHeight = chatdopeContainer.clientHeight;
    var headerHeight = document.querySelector(".chatdope-container__user-header").clientHeight;
    var minimizeHeight = containerHeight - headerHeight;
    chatdopeContainer.style.bottom = "-".concat(minimizeHeight, "px");
    chatdopeContainer.classList.add("chatdope-minimized");
    minimizeButton.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M5 19l14-14M15 5l4 0M19 9l0-4\"/></svg>";
    localStorage.setItem("chatdopeMinimized", "true");
  }

  /**
   * Maximizes the chat window.
   */
  function maximize() {
    chatdopeContainer.style.bottom = "0";
    chatdopeContainer.classList.remove("chatdope-minimized");
    minimizeButton.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\">".concat(minimizeSVG, "</svg>");
    localStorage.setItem("chatdopeMinimized", "false");
  }

  /**
   * Toggles between minimizing and maximizing the chat window.
   */
  function toggleMinimizeMaximize() {
    chatdopeContainer.classList.contains("chatdope-minimized") ? maximize() : minimize();
  }

  /**
   * Initializes the chat window's state based on the current local storage and session storage settings.
   */
  function initializeChatState() {
    var isMinimized = localStorage.getItem("chatdopeMinimized") === "true";
    isMinimized ? minimize() : maximize();
    var isClosed = sessionStorage.getItem("chatdopeClosed") === "true";
    if (isClosed) {
      chatdopeContainer.style.display = "none";
    }
  }

  /**
   * Closes the chat window and sets the session storage.
   */
  function closeChat() {
    chatdopeContainer.style.display = "none";
    sessionStorage.setItem("chatdopeClosed", "true");
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!**********************************!*\
  !*** ./assets/css/frontend.scss ***!
  \**********************************/
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin

})();

/******/ })()
;
//# sourceMappingURL=public.js.map