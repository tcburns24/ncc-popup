jQuery(document).ready(function ($) {
  const $overlay = $("#ncc-popup-overlay");
  const $formWrapper = $("#ncc-popup-form-wrapper");

  // Open the popup
  $("#ncc-open-popup").on("click", function () {
    $overlay.addClass("show");
    $("#ncc-form-message").hide();
  });

  // Close the popup
  $("#ncc-close-popup, #ncc-popup-overlay").on("click", function (e) {
    if (e.target === this) {
      $overlay.removeClass("show");
    }
  });

  $("#ncc-contact-form")
    .off("submit")
    .on("submit", function (e) {
      e.preventDefault();
      const formData = $(this).serialize();

      $("#ncc-spinner").show();

      $.post(
        ncc_ajax_obj.ajax_url,
        {
          action: "ncc_submit_form",
          data: formData,
        },
        function (response) {
          $("#ncc-spinner").hide();
          $("#ncc-form-message").text(response.message).show();
          if (response.success) {
            $("#ncc-contact-form")[0].reset();
          }
        },
        "json"
      );
    });
});
