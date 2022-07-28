<?php include 'partials/header.php';

$query = "SELECT * FROM users where id=$current_admin_id";
$users = mysqli_query($con, $query);
?>


<section class="form__section">
  <div class="container form__section-container">
    <h2>Delete User</h2>
    <form action="" enctype="multipart/form-data">
      <div type="text" placeholder="First Name"></div>
      <div type="text" placeholder="Last Name"></div>

      <button class="btn" type="submit">Delete</button>
    </form>
  </div>
</section>



<?php include '../partials/footer.php' ?>