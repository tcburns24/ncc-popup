<?php
get_header();

if (is_page('view-submissions')) {
    get_template_part('view-submissions-content');
} else {
    the_content(); // fallback to block content or whatever is in the page editor
}

get_footer();
