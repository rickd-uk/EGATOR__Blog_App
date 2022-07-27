<?php
require 'config/database.php';
require 'config/constants.php';

// get user form if submit btn clicked
if (isset($_POST['submit'])) {
} else {
  header('location: ' . ROOT_URL . 'admin/add-user.php');
}

if (isset($_POST['submit'])) {
  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
  $avatar = $_FILES['avatar'];

  show($avatar['name']);

  if (!$firstname) {
    $_SESSION['add-user'] = "Please enter your First name";
  } elseif (!$lastname) {
    $_SESSION['add-user'] = "Please enter your Last name";
  } elseif (!$username) {
    $_SESSION['add-user'] = "Please enter your Username";
  } elseif (!$email) {
    $_SESSION['add-user'] = "Please enter a valid email";
  } elseif (strlen($password) < 8 || strlen($confirmpassword) < 8) {
    $_SESSION['add-user'] = "Password should be 8 characters or more";
  } elseif ($password !== $confirmpassword) {
    $_SESSION['add-user'] = "Passwords do not match";
  } elseif (!$avatar['name']) {
    $_SESSION['add-user'] = "Please add an avatar image";
  } else {
    //hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check if username or email exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $user_check_result = mysqli_query($con, $user_check_query);
    if (mysqli_num_rows($user_check_result) > 0) {
      $_SESSION['add-user'] = "Username or Email already exists";
    } else {
      $time = time();
      $avatar_name = $time . $avatar['name'];
      $avatar_tmp_name = $avatar['tmp_name'];
      $avatar_des_path = '../images/users/' . $avatar_name;


      // confirm file is image
      $allowed_img_types = ['png', 'jpg', 'jpeg', 'webp'];
      $ext = explode('.', $avatar_name);
      $ext = end($ext);
      if (in_array($ext, $allowed_img_types)) {
        // make sure image is not too large
        if ($avatar['size'] < 4000000) {
          // ul avatar
          // echo "upload avatar";
          // show($avatar_tmp_name);
          // show($avatar_des_path);

          move_uploaded_file($avatar_tmp_name, $avatar_des_path);
        } else {
          $_SERVER['add-user'] = 'File too large';
        }
      } else {
        $_SESSION['add-user'] = 'File should be png, jpg, or jpeg';
      }
    }
  }

  // redirect to add-user page if error
  if ($_SESSION['add-user']) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
  } else {

    // insert new users into users table
    $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";

    $insert_user_result = mysqli_query($con, $insert_user_query);

    if (!mysqli_errno($con)) {
      // redirect to login page with success message
      $_SESSION['add-user-success'] = 'Registration successful. Please log in';
      header('location: ' . ROOT_URL . 'admin/manage-users.php');
    }
  }
} else {
  header('location: ' . ROOT_URL . 'admin/add-user.php');
  die();
}
