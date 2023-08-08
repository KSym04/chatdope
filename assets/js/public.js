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

  // References to control elements
  const minimizeButton = document.getElementById("chatdope-minimize");
  const closeButton = document.getElementById("chatdope-close");
  const chatdopeContainer = document.querySelector(".chatdope-container");
  const minimizeSVG = `<line x1="5" y1="12" x2="19" y2="12"/>`;

  function minimize() {
    const containerHeight = chatdopeContainer.clientHeight;
    const headerHeight = document.querySelector(
      ".chatdope-container__user-header"
    ).clientHeight;
    const minimizeHeight = containerHeight - headerHeight;
    chatdopeContainer.style.bottom = `-${minimizeHeight}px`;
    chatdopeContainer.classList.add("chatdope-minimized");
    minimizeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 19l14-14M15 5l4 0M19 9l0-4"/></svg>`;
    localStorage.setItem("chatdopeMinimized", "true");
  }

  function maximize() {
    chatdopeContainer.style.bottom = "0";
    chatdopeContainer.classList.remove("chatdope-minimized");
    minimizeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">${minimizeSVG}</svg>`;
    localStorage.setItem("chatdopeMinimized", "false");
  }

  function toggleMinimizeMaximize() {
    chatdopeContainer.classList.contains("chatdope-minimized")
      ? maximize()
      : minimize();
  }

  function initializeChatState() {
    const isMinimized = localStorage.getItem("chatdopeMinimized") === "true";
    if (isMinimized) {
      minimize();
    } else {
      maximize();
    }

    const isClosed = sessionStorage.getItem("chatdopeClosed") === "true";
    if (isClosed) {
      chatdopeContainer.style.display = "none";
    }
  }

  // Event listeners
  minimizeButton.addEventListener("click", toggleMinimizeMaximize);

  closeButton.addEventListener("click", function () {
    chatdopeContainer.style.display = "none";
    sessionStorage.setItem("chatdopeClosed", "true");
  });

  // Initialize the chat state based on localStorage
  initializeChatState();
});
