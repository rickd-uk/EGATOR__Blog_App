<?php

// include 'partials/header.php';
require 'config/database.php';

function look_for_uncategorized($con)
{
  // Find id for category 'uncategorized'
  $query = "SELECT id FROM categories WHERE title='Uncategorized' LIMIT 1";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  return  $row['id'];
}

function create_category($con, $name = 'Uncategorized')
{
  $query = "INSERT INTO categories (title, description) VALUES ('$name', '')";
  mysqli_query($con, $query);

  if (mysqli_errno($con)) {
    $_SESSION['mode'] = 'add-post-error';
    $_SESSION['add-post-error'] = 'Could not create category $name';
  }
}

function update_to_uncategorized($con, $id, $category_id)
{
  // Update category_id of posts that belong to this category to id of uncategorized posts
  $update_query = "UPDATE posts SET category_id='$category_id' WHERE category_id=$id";
  mysqli_query($con, $update_query);

  if (!mysqli_errno($con)) {
    // Delete category
    $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    mysqli_query($con, $query);

    if (!mysqli_errno($con)) {
      $_SESSION['delete-category-success'] = "Category deleted successfully";
    } else {
      // TODO: Error Deleting
    }
  } else {
    // TODO: Error Updating
  }
}

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $category_id = look_for_uncategorized($con);



  if ($category_id) {
    update_to_uncategorized($con, $id, $category_id);
  } else {
    // Create default category 'Uncategorized' because it does not exist and is required
    create_category($con);
    // Now that previously missing 'Uncategorized' category is avaliable
    //Update category_id of posts that belong to this category to id of uncategorized posts
    update_to_uncategorized($con, $id, $category_id);
  }
}
$_SESSION['mode'] = 'delete-category';
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
