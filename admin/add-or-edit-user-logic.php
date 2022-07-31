<?php
require 'config/database.php';
require 'config/constants.php';

// Get user id from edit page (passed as hidden input)
$id = $_POST['id'];
// Set mode (passed as hidden input)
$mode = $_SESSION['mode'];

// Set valid modes
$valid_mode = ['add-user', 'edit-user'];

// get user form if submit btn clicked
if (isset($_POST['submit']) &&  in_array($mode, $valid_mode)) {
  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

  if ($mode == 'edit-user') {
    $firstname = !$firstname ? $_SESSION['edit-user-initial']['firstname'] : $firstname;
    $lastname = !$lastname ? $_SESSION['edit-user-initial']['lastname'] : $lastname;
    $username = !$username ? $_SESSION['edit-user-initial']['username'] : $username;
    $email = !$email ? $_SESSION['edit-user-initial']['email'] : $email;
    unset($_SESSION['edit-user-initial']);
  }

  if ($mode == 'add-user') {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    if (!$firstname) {
      $_SESSION[$mode] = "Please enter your First name";
    } elseif (!$lastname) {
      $_SESSION[$mode] = "Please enter your Last name";
    } elseif (!$username) {
      $_SESSION[$mode] = "Please enter your Username";
    } elseif (!$email) {
      $_SESSION[$mode] = "Please enter a valid email";
    } elseif (strlen($password) < 8 || strlen($confirmpassword) < 8) {
      $_SESSION[$mode] = "Password should be 8 characters or more";
    } elseif ($password !== $confirmpassword) {
      $_SESSION[$mode] = "Passwords do not match";
    } elseif (!$avatar['name']) {
      $_SESSION[$mode] = "Please add an avatar image";
    } else {
      //hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // check if username or email exists
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
      $user_check_result = mysqli_query($con, $user_check_query);
      if (mysqli_num_rows($user_check_result) > 0) {
        $_SESSION[$mode] = "Username or Email already exists";
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
            $_SERVER[$mode] = 'File too large';
          }
        } else {
          $_SESSION[$mode] = 'File should be png, jpg, or jpeg';
        }
      }
    }
  }

  // REDIRECT ON VALIDATION ERROR
  if ($_SESSION[$mode]) {
    // Store user entered data or edit data in array (to send back to previous page)
    $_SESSION[$mode . '-data'] = $_POST;

    // Handle params for edit-user page
    // if ($mode == 'edit-user') {
    //   $params = "?id=" . $_SESSION['edit-user-data']['id'];
    // }
    header('location: ' . ROOT_URL . "admin/$mode.php");
    die();
  } else {
    // insert new users into users table
    if ($mode == 'add-user') {
      $query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";
    } elseif ($mode == 'edit-user') {
      $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', is_admin=$is_admin WHERE id=$id LIMIT 1";
    }
    $insert_user_result = mysqli_query($con, $query);

    if (!mysqli_errno($con)) {
      // redirect to login page with success message
      if ($mode == 'add-user') {
        $_SESSION['add-user-success'] = "New user $firstname $lastname added";
      } else {
        $_SESSION['edit-user-success'] = "User $firstname $lastname updated";
      }
    } else {
      $_SESSION[$mode . '-error'] = "Data not added or updated";
    }
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
  }
} else {
  header('location: ' . ROOT_URL) . 'index.php';
  die();
}
