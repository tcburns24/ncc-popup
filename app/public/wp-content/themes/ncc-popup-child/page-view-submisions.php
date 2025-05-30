<?php
/**
 * Template Name: View Submissions
 */
get_header();

if (!current_user_can('manage_options')) {
    echo "<p>Access denied.</p>";
    get_footer();
    exit;
}

global $wpdb;
$table = $wpdb->prefix . 'ncc_contacts';
$results = $wpdb->get_results("SELECT * FROM $table ORDER BY created DESC");

echo '<div class="wrap"><h1>Form Submissions</h1>';
if ($results) {
    echo '<table style="width: 100%; border-collapse: collapse;" border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Created</th></tr>';
    foreach ($results as $row) {
        echo "<tr>
            <td>{$row->id}</td>
            <td>{$row->first_name}</td>
            <td>{$row->last_name}</td>
            <td>{$row->email_address}</td>
            <td>{$row->created}</td>
        </tr>";
    }
    echo '</table>';
} else {
    echo '<p>No submissions found.</p>';
}
echo '</div>';

get_footer();
