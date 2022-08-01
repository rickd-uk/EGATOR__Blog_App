<?php
require 'config/database.php';

function generate_message($msg)
{
  $_SESSION['edit-post'] = $msg;
}

function generate_imagefile_name()
{
  $time = time();
  return $time . '__' . $_FILES['thumbnail']['name'];
}

function generate_imagefile_path($imagefile_name)
{
  return "../images/posts/" . $imagefile_name;
}

function validate_image($image_filename)
{
  $imagefile = $_FILES['thumbnail'];
  $imagefile_tmp_name = $imagefile['tmp_name'];

  // Get Image Attributes
  $fileinfo = @getimagesize($imagefile_tmp_name);
  $width = $fileinfo[0];
  $height = $fileinfo[1];

  $allowed_image_ext = array('png', 'jpg', 'jpeg', 'gif', 'webp');
  $file_ext = pathinfo($imagefile['name'], PATHINFO_EXTENSION);

  // Check file is not empty
  if (!file_exists($imagefile['tmp_name'])) {
    $response = array(
      'type' => 'error',
      'message' =>  "Choose image file to upload"
    );
    // ..is of allowed type
  } elseif (!in_array($file_ext, $allowed_image_ext)) {
    $response = array(
      'type' => 'error',
      'message' => 'Uploaded image is not a valid type'
    );
    // ...is not > 2MB
  } elseif ($imagefile['size'] > 2000000) {
    $response = array(
      'type' => 'error',
      'message' => 'Image size exceeds 2mb'
    );
    // ...width not > 1200 OR height not > 800
  } elseif ($width > "1200" || $height > '1200') {
    $response = array(
      'type' => 'error',
      'message' => 'Image dimensions should be within 1200 x 800'
    );
    $_SESSION['edit-post'] = 'File dimensions too big. Max: 1200 x 1200';
    // Then Validation Passed
  } else {





    // Move temp file to destnation & check it was successfully moved
    $imagefile_path = generate_imagefile_path($image_filename);
    if (move_uploaded_file($imagefile['tmp_name'], $imagefile_path)) {
      $response = array(
        "type" => "success",
        "message" => "Image uploaded successfully"
      );
      // There was a problem mving it!!
    } else {
      $response = array(
        "type" => "error",
        "message" => "Problem uploading image files"
      );
    }
  }
}

if (isset($_POST['submit'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $previous_thumbnail_name = filter_var($_POST['previous_thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
  $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
  $thumbnail = $_FILES['thumbnail'];

  // Set is_featured to 0 if Unchecked
  $is_featured = $is_featured == 1 ?: 0;

  // Validate form data
  if (!$title) {
    generate_message('Enter title');
  } else if (!$category_id) {
    generate_message('Select a category');
  } elseif (!$body) {
    generate_message('Write post contents');
  } else {
    if ($thumbnail['name']) {
      $previous_thumbnail_path = '../images/posts/' . $previous_thumbnail_name;
      if ($previous_thumbnail_path) unlink($previous_thumbnail_path);

      // Make sure file is an image
      $image_filename = generate_imagefile_name();
      validate_image($image_filename);
    }
  }

  // Redirect back (with form data) if there are errors
  if (isset($_SESSION['edit-post'])) {
    $_SESSION['edit-post-data'] = $_POST;



    header('location: ' . ROOT_URL . 'admin/');
    die();
  } else {
    // Set is_featured for all posts to 0 if is_featured for this post is 1
    if ($is_featured == 1) {
      $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
      $zero_all_is_featured_result = mysqli_query($con, $zero_all_is_featured_query);
    }

    // Set thumbnail if a new one was uploaded, else keep old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

    // Insert post into db
    $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id='$category_id', is_featured='$is_featured' WHERE id=$id LIMIT 1";
    $result = mysqli_query($con, $query);

    if (!mysqli_errno($con)) {
      $_SESSION['edit-post-success'] = "New post $title updated successfully";
      unset($_SESSION['edit-post-data']);

      header('location: ' . ROOT_URL . 'admin/');
      die();
    } else {
      // Mode not successful, so it is unset to indicate other error, i.e. db, file system

      $_SESSION['mode'] = 'edit-post-error';
      unset($_SESSION['edit-post-data']);
      header('location: ' . ROOT_URL . 'admin/');
      die();
    }
  }
}

header('location: ' . ROOT_URL . 'admin/edit-post.php');
die();
