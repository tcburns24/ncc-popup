jQuery(document).ready(function ($) {
  const $overlay = $("#ncc-popup-overlay");
  const $popup = $("#ncc-popup-form");

  // Show popup
  $("#send-info-button").on("click", function (e) {
    e.preventDefault();
    $overlay.addClass("show");
    $popup.addClass("show");
  });

  // Close popup
  $overlay.on("click", closePopup);
  $("#ncc-close-popup").on("click", closePopup);

  function closePopup() {
    $overlay.removeClass("show");
    $popup.removeClass("show");
  }

  // AJAX form submissoin
  $("#ncc-contact-form").on("submit", function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.post(
      ncc_ajax_obj.ajax_url,
      {
        action: "ncc_submit_form",
        data: formData,
      },
      function (response) {
        $("#ncc-form-message").text(response.message);
        if (response.success) {
          setTimeout(closePopup, 3000);
        }
      },
      "json"
    );
  });
});
