<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  // get form data
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (!$title) {
    $_SESSION['add-category'] = "Enter title";
  } elseif (!$description) {
    $_SESSION['add-category'] = "Enter description";
  }

  // Redirect back to add-category dpage if there was invalid input
  if (isset($_SESSION['add-category'])) {
    $_SESSION['add-category-data'] = $_POST;

    header('location: ' . ROOT_URL . 'admin/add-category.php');
    die();
  } else {
    //　Insert category info into db
    $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
    $result = mysqli_query($con, $query);

    if (mysqli_errno($con)) {
      $_SESSION['add-category'] = "Couldn't add category";
      header('location: ' . ROOT_URL . 'admin/add-category.php');
      die();
    } else {
      $_SESSION['add-category-success'] = "Added category $title successfully";
      header('location: ' . ROOT_URL . 'admin/manage-categories.php');
      die();
    }
  }
}
