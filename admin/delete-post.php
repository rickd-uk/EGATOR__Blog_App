<?php

require 'config/database.php';

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // Fetch post from db in order ro delete thumbnail from images folder;
  $query = "SELECT * FROM posts WHERE id='$id'";
  $result = mysqli_query($con, $query);

  // Make sure only one record was fetched
  if (mysqli_num_rows($result) == 1) {
    $post = mysqli_fetch_assoc($result);
    $thumbnail_name = $post['thumbnail'];
    $thumbnail_path = '../images/posts/' . $thumbnail_name;


    if ($thumbnail_path) {
      unlink($thumbnail_path);

      // delete from db
      $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
      $delete_post_result = mysqli_query($con, $delete_post_query);

      // show_and_freeze($delete_post_result);


      if (!mysqli_errno($con)) {
        $title = $post['title'];
        $_SESSION['delete-post-success']  = "Post $title deleted successfully";
      } else {
        $_SESSION['delete-post-error']  = "Couldn't delete $title";
      }
    }
  }
}

header('location: ' . ROOT_URL . 'admin/');
die();
