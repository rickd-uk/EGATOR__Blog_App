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


  // delete all thumbnails of user's posts


  // delete user from db
  $delete_user_query = "DELETE FROM users WHERE id=$id";
  $delete_user_result = mysqli_query($con, $delete_user_query);

  if (mysqli_errno($con)) {
    $_SESSION['delete-user'] = "Couldn't delete {$user['firstname']} {$user['lastname']}";
  } else {
    $_SESSION['delete-user-success'] = " '{$user['firstname']} {$user['lastname']}' has been deleted successfully";
  }

  header('location: ' . ROOT_URL . 'admin/manage-users.php');
  die();
}
?>


<!-- <section class="form__section">

  <div class="container form__section-container">
    <h2>Delete User</h2>
    <form action="" enctype="multipart/form-data">
      <div type="text" placeholder="First Name"></div>
      <div type="text" placeholder="Last Name"></div>

      <button class="btn" type="submit">Delete</button>
    </form>
  </div>

</section>