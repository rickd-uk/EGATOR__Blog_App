<?php

require 'config/database.php';


if (isset($_POST['signin_submit'])) {


  // get form data
  $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$username_email) {
    $_SESSION['signin'] = "Username or Email required";
  } elseif (!$password) {
    $_SESSION['signin'] = "Password required";
  } else {

    // fetch user from db
    $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
    $fetch_user_result = mysqli_query($con, $fetch_user_query);

    if (mysqli_num_rows($fetch_user_result) == 1) {
      // Convert record > assoc arr
      $user_record = mysqli_fetch_assoc($fetch_user_result);
      $db_password = $user_record['password'];


      // Compare form pw with db pw
      if (password_verify($password, $db_password)) {
        // set session for access control
        $_SESSION['user-id'] = $user_record['id'];

        // set session if user is an admin
        if ($user_record['is_admin'] == 1) {
          $_SESSION['user_is_admin'] = true;
        }
        // log user in
        $_SESSION['username'] = $user_record['username'];

        header('location: ' . ROOT_URL . 'admin/');
      } else {
        $_SESSION['signin'] = "Something went wrong";
      }
    } else {
      $_SESSION['signin'] = "User not found";
    }
  }

  // if there are any problems, redirect to signin page with details
  if (isset($_SESSION['signin'])) {
    $_SESSION['signin-data'] = $_POST;
    header('location: ' . ROOT_URL . 'signin.php');
    die();
  }
} else {
  header('location: ' . ROOT_URL . 'signin.php');
  die();
}
