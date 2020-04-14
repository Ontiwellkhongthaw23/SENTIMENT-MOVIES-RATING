<?php
  include ('movie_sc_fns.php');
 
  session_start();

  $movieid = $_GET['movieid'];

 
  $movie = get_movie_details($movieid);
  do_html_header($movie['title']);
  display_movie_details($movie);

  
  $target = "index.php";
  if($movie['catid']) {
    $target = "show_cat.php?catid=".$movie['catid'];
  }

  
  if(check_admin_user()) {
    display_button("edit_movie_form.php?movieid=".$movieid, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  } else {
    display_button("show_cart.php?new=".$movieid, "add-to-cart",
                   "Add".$movie['title']." To My Shopping Cart");
    display_button($target, "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>