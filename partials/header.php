<?php
require 'config/database.php';

// fetch current user from db
if (isset($_SESSION['user-id'])) {
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id='$id'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);
}
?>


<!-- #region HEAD -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= ROOT_URL ?>css/styles.css" />
  <script src="<?= ROOT_URL ?>js/main.js" defer></script>
  <title>Blog App with Admin Panel</title>
</head>
<!-- #endregion HEAD -->

<body>
  <!-- #region NAV -->
  <nav>
    <div class="container nav__container">
      <a class="nav__logo" href="<?= ROOT_URL ?>">STORM</a>
      <ul class="nav__items">
        <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
        <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
        <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
        <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>

        <?php if (isset($_SESSION['user-id'])) : ?>
          <li class="nav__profile">
            <div class="avatar">
              <img src="<?= ROOT_URL . 'images/users/' . $data['avatar'] ?>" alt="" />

            </div>
            <p style="margin-left: 5px;"><?= $_SESSION['username'] ?? null ?></p>
            <ul>
              <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
              <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else : ?>
          <li><a href="<?= ROOT_URL ?>signin.php">Sign In</a></li>
        <?php endif; ?>
      </ul>

      <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
      <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
    </div>
  </nav>

  <!-- #endregion NAV-->