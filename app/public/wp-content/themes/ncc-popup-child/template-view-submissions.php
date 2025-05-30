<?php
/**
 * Template Name: View Submissions Template
 */

get_header(); ?>

<main>
  <h1>Submissions Table</h1>
  <p>This is a custom PHP template file.</p>

  <?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'ncc_contacts';
  $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created DESC");

  if ($results) {
      echo '<table border="1" cellpadding="8"><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Created</th></tr>';
      foreach ($results as $row) {
          echo '<tr>';
          echo '<td>' . esc_html($row->first_name) . '</td>';
          echo '<td>' . esc_html($row->last_name) . '</td>';
          echo '<td>' . esc_html($row->email_address) . '</td>';
          echo '<td>' . esc_html($row->created) . '</td>';
          echo '</tr>';
      }
      echo '</table>';
  } else {
      echo '<p>No submissions found.</p>';
  }
  ?>
</main>

<?php get_footer(); ?>
