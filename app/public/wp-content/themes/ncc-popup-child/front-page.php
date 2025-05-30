<?php
get_header();
?>
<main>
    <h1>This is front-page.php in NCC Popup Child</h1>
    <h2>Request More Info</h2>
    <div>123
      <form id="ncc-contact-form" style="display: block;">
        <label>First Name:
          <input type="text" name="first_name" required>
        </label><br>
        <label>Last Name:
          <input type="text" name="last_name" required>
        </label><br>
        <label>Email:
          <input type="email" name="email_address" required>
        </label><br>
        <button type="submit">Submit</button>
      </form>
    </div>
    <div id="ncc-popup-message" style="display:none;"></div>
    <div>xyz</div>
</main>
<?php
get_footer();
