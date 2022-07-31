<?php include 'partials/header.php';

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


  $query = "";

  // Update category_id of posts that belong to this category to id of uncategorized posts



  // Delete category
  $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
  $result = mysqli_query($con, $query);

  $_SESSION['delete-category-success'] = "Category deleted successfully";
}
$_SESSION['mode'] = 'delete-category';
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
