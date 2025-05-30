<?php
/* Template: front-page.php in ncc-popup-child */
get_header();

if (is_page('view-submissions')) {
    get_template_part('view-submissions-content');
} else {
?>
<main>
    <h1>Contact Form</h1>
    <div class="sub-header">Nursing CE Central Figure-It-Out Challenge</div>
    <div class="open-modal-btn-wrap">
     <button id="ncc-open-popup" class="open-modal-btn">Send Me More Information</button>
    </div>
      <div id="ncc-popup-overlay" class="ncc-hidden">
        <div id="ncc-popup-form-wrapper">
          <button id="ncc-close-popup" class="ncc-close-button">×</button>
          <div class="form-instruction form-row">Submit a new contact</div>
          <form id="ncc-contact-form" style="display: block;">
            <div class="form-row">
              <label>First Name:
                <input type="text" name="first_name" required>
              </label>
            </div>
            <div class="form-row">
              <label>Last Name:
                <input type="text" name="last_name" required>
              </label>
            </div>
            <div class="form-row">
              <label>Email:
                <input type="email" name="email_address" required>
              </label>
            </div>
            <div class="form-row">
              <button type="submit">Submit</button>
            </div>
            <div id="ncc-form-message"></div>
            <div id="ncc-spinner" style="display: none;">
              <div class="spinner"></div>
            </div>
          </form>
        </div>
      </div>
</main>
<?php
}
get_footer();
