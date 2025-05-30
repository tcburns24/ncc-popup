jQuery(document).ready(function ($) {
  $("#ncc-contact-form")
    .off("submit")
    .on("submit", function (e) {
      e.preventDefault();
      const formData = $(this).serialize();

      $.post(
        ncc_ajax_obj.ajax_url,
        {
          action: "ncc_submit_form",
          data: formData,
        },
        function (response) {
          $("#ncc-form-message").text(response.message).show();
          if (response.success) {
            $("#ncc-contact-form")[0].reset();
          }
        },
        "json"
      );
    });
});
