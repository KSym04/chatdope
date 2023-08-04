/**
 * This script handles the frontend chat interface for ChatDope.
 * It manages click events for contacts and the send button, fetches chat messages, and sends messages.
 *
 * @file public.js
 */

document.addEventListener("DOMContentLoaded", function () {
  /**
   * Handles the click event on a contact item.
   *
   * @param {HTMLElement} contact - The contact element that was clicked.
   */
  const handleContactClick = function (contact) {
    contact.addEventListener("click", function () {
      // Remove active class from all contacts
      contactItems.forEach((item) => item.classList.remove("active"));

      // Add active class to the clicked contact
      contact.classList.add("active");

      // Retrieve the contact ID from the data attribute
      const contactId = contact.dataset.contactId;

      // Load the chat messages for the selected contact using fetch API
      fetch(`your-ajax-endpoint-url?contact_id=${contactId}`)
        .then((response) =>
          response.ok
            ? response.text()
            : Promise.reject("Network response was not ok.")
        )
        .then((data) => {
          // Update the #chatdope-chats section with the retrieved messages
          document.getElementById("chatdope-chats").innerHTML = data;
        })
        .catch((error) => {
          // Handle error
          console.error("Error fetching chat messages:", error);
        });
    });
  };

  // Get contact items and add click event listeners
  const contactItems = document.querySelectorAll(".chatdope-contact");
  contactItems.forEach(handleContactClick);

  /**
   * Sends the user's message when the send button is clicked.
   */
  const handleSendClick = function () {
    const message = document.getElementById("chatdope-input").value;

    // Send the message using fetch API to your backend endpoint
    fetch("your-ajax-send-message-endpoint-url", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ message: message }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok.");
        }
        // Handle success
      })
      .catch((error) => {
        // Handle error
        console.error("Error sending message:", error);
      });
  };

  // Handle send button click
  const sendButton = document.getElementById("chatdope-send");
  sendButton.addEventListener("click", handleSendClick);
});
