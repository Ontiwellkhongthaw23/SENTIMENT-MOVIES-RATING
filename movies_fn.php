<?php
function calculate_shipping_cost() {
  
  return 20.00;
}

function get_categories() {
  
   $conn = db_connect();
   $query = "select catid, catname from categories";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_category_name($catid) {

   $conn = db_connect();
   $query = "select catname from categories
             where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->catname;
}


function get_movies($catid) {
 
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from movies where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_movies = @$result->num_rows;
   if ($num_movies == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_movie_details($movieid) {
  // query database for all details for a particular movie
  if ((!$movieid) || ($movieid=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from movies where movieid='".$movieid."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

function calculate_price($cart) {
  
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $movieid => $qty) {
      $query = "select price from movies where movieid='".$movieid."'";
      $result = $conn->query($query);
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart) {
  
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $movieid => $qty) {
      $items += $qty;
    }
  }
  return $items;
}
?>