<?php
// Disable block theme support to force use of index.php
remove_theme_support( 'block-templates' );

add_action('wp_footer', function() {
    echo '<!-- Active theme: ' . wp_get_theme()->get('Name') . ' -->';
});

function ncc_child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'ncc_child_enqueue_styles');

function ncc_enqueue_assets() {
    wp_enqueue_script('ncc-popup-js', get_stylesheet_directory_uri() . '/ncc-script.js', [], null, true);
    
    wp_localize_script('ncc-popup-js', 'nccPopup', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ncc_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'ncc_enqueue_assets');


function ncc_enqueue_popup_assets() {
    // Enqueue CSS
    wp_enqueue_style(
        'ncc-style',
        get_stylesheet_directory_uri() . '/ncc-style.css',
        array(),
        '1.0'
    );

    // Enqueue JS with jQuery dependency
    wp_enqueue_script(
        'ncc-script',
        get_stylesheet_directory_uri() . '/ncc-script.js',
        array('jquery'),
        '1.0',
        true
    );

    // Pass AJAX URL to JS
    wp_localize_script('ncc-script', 'ncc_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'ncc_enqueue_popup_assets');

add_action('wp_ajax_ncc_submit_form', 'ncc_handle_form_submission');
add_action('wp_ajax_nopriv_ncc_submit_form', 'ncc_handle_form_submission');

function ncc_add_popup_html() {
    ?>
    <!-- Your popup markup -->
    <div id="ncc-popup-overlay" class="ncc-hidden">
      <div id="ncc-popup-form-wrapper">
        <form id="ncc-popup-form">
          <h2>Send Me More Information</h2>
          <label>First Name: <input type="text" name="first_name" required></label>
          <label>Last Name: <input type="text" name="last_name" required></label>
          <label>Email: <input type="email" name="email_address" required></label>
          <button type="submit">Submit</button>
        </form>
        <div id="ncc-popup-message" class="ncc-hidden"></div>
      </div>
    </div>
    <?php
}
add_action('wp_footer', 'ncc_add_popup_html');


function ncc_handle_form_submission() {
    global $wpdb;

    // Parse the serialized data string
    parse_str($_POST['data'], $form);

    // Sanitize the input
    $first_name = sanitize_text_field($form['first_name'] ?? '');
    $last_name = sanitize_text_field($form['last_name'] ?? '');
    $email = sanitize_email($form['email_address'] ?? '');

    // Basic validation
    if (empty($first_name) || empty($last_name) || !is_email($email)) {
        wp_send_json([
            'success' => false,
            'message' => 'Please enter valid information.'
        ]);
    }

    // Insert into custom table
    $table_name = $wpdb->prefix . 'ncc_contacts';
    $result = $wpdb->insert(
        $table_name,
        [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email_address' => $email,
            'created' => current_time('mysql')
        ],
        ['%s', '%s', '%s', '%s']
    );

    if ($result) {
        wp_send_json([
            'success' => true,
            'message' => 'Success! Info has been submitted.'
        ]);
    } else {
        wp_send_json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.'
        ]);
    }

    wp_die();
}
