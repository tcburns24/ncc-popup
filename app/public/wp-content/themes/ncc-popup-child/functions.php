<?php
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
