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
  var inputBoxWrapper = document.querySelector(".chatdope-container__input-box");
  var maxRows = 5;
  var minRows = 1;
  var singleRowHeight = textArea.scrollHeight;
  textArea.addEventListener("input", function () {
    this.style.height = "auto";
    var lines = this.value.split("\n");
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