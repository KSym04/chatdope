/**
 * Functionality for displaying a custom tooltip in the ChatDope admin interface.
 * Adds a tooltip to the table header containing the "Choose Color Theme" label.
 * The tooltip text is internationalized, with the translation provided from the server-side.
 */
jQuery(document).ready(function ($) {
  /**
   * Tooltip text, translated and passed from the server-side.
   * @type {string}
   */
  var tooltipText = chatdope_admin_translation.tooltipText;

  /**
   * Creates a sup element containing a question mark.
   * @type {jQuery}
   */
  var tooltipTrigger = $('<sup class="tooltip-trigger">?</sup>');

  /**
   * Creates a span element to house the tooltip with the given tooltip text.
   * @type {jQuery}
   */
  var tooltip = $(
    '<span class="theme-color__tooltip">' + tooltipText + "</span>"
  );

  // Appends the tooltip trigger (sup element) to the table header containing the "Choose Color Theme" text.
  $('th:contains("Choose Color Theme")').append(tooltipTrigger);

  // Appends the tooltip span to the tooltip trigger element.
  tooltipTrigger.append(tooltip);

  // Event listener for showing the tooltip on hover.
  tooltipTrigger.hover(
    function () {
      tooltip.show();
    },
    function () {
      tooltip.hide();
    }
  );
});
