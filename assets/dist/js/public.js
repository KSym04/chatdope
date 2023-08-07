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
 * This script handles the frontend chat interface for ChatDope.
 * It manages click events for contacts and the send button, fetches chat messages, and sends messages.
 *
 * @file public.js
 */

document.addEventListener("DOMContentLoaded", function () {
  var textArea = document.getElementById("chatdope-input");
  var initialHeight = textArea.offsetHeight; // Get the original height
  var singleLineHeight = textArea.clientHeight; // Single line height without padding

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