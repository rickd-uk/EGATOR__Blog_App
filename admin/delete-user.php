<?php

// include 'partials/header.php';
require 'config/database.php';

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch user from db
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($con, $query);

  $user = mysqli_fetch_assoc($result);

  // make sure we got back one result
  if (mysqli_num_rows($result) == 1) {
    $avatar_name = $user['avatar'];
    $avatar_path = '../images/' . $avatar_name;

    // delete image if exists
    if ($avatar_path) {
      unlink($avatar_path);
    }
  }

  // Fetch all thumbnails of user's posts & delete them
  $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
  $thumbnail_results = mysqli_query($con, $thumbnails_query);
  if (mysqli_num_rows($thumbnail_results) > 0) {
    while ($thumbnail = mysqli_fetch_assoc($thumbnail_results)) {
      $thumbnail_path = '.../images/posts/' . $thumbnail['thumbnail'];
      // delete thumbnail from dir
      if ($thumbnail_path) {
        unlink($thumbnail_path);
      }
    }
  }


  // delete all thumbnails of user's posts


  // delete user from db
  $delete_user_query = "DELETE FROM users WHERE id=$id";
  $delete_user_result = mysqli_query($con, $delete_user_query);

  if (mysqli_errno($con)) {
    $_SESSION['delete-user'] = "Couldn't delete {$user['firstname']} {$user['lastname']}";
  } else {
    $_SESSION['delete-user-success'] = " '{$user['firstname']} {$user['lastname']}' has been deleted successfully";
  }

  $_SESSION['mode'] = 'delete-user';
  header('location: ' . ROOT_URL . 'admin/manage-users.php');
  die();
}
