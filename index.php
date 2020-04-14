<?php
  include ('movie_sc_fns.php');
  include_once('analyticstracking.php');
  
  session_start();
  do_html_header("Welcome to Columbia Movie!");

  echo "<p>Please choose a category:</p>";

  
  $cat_array = get_categories();
  
  display_categories($cat_array);

  display_recommended_movies();
  
  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Admin Menu");
  }
  do_html_footer();
?>