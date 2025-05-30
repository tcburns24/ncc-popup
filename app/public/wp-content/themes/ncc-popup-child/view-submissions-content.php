<?php
global $wpdb;
$table = $wpdb->prefix . 'ncc_contacts';
$results = $wpdb->get_results("SELECT * FROM $table ORDER BY created DESC");
?>

<h2>Form Submissions</h2>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email Address</th>
      <th>Submitted At</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($results): ?>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?php echo esc_html($row->first_name); ?></td>
          <td><?php echo esc_html($row->last_name); ?></td>
          <td><?php echo esc_html($row->email_address); ?></td>
          <td><?php echo esc_html($row->created); ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="4">No submissions found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>
