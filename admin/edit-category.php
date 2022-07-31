<?php include 'partials/header.php';

if (isset($_GET['id'])) {
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

	// fetch category from db
	$query = "SELECT * FROM categories WHERE id=$id";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) == 1) {
		$cat = mysqli_fetch_assoc($result);
	}
} else {
	header('location: ' . ROOT_URL . 'admin/manage-categories.php');
	die();
}
$_SESSION['mode'] = 'edit-category';
?>


<section class="form__section">
	<div class="container form__section-container">
		<h2>Edit Category</h2>
		<form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $cat['id'] ?>" />
			<input type="text" name="title" value="<?= $cat['title'] ?>" placeholder="Title" />
			<textarea rows="4" name="description" placeholder="Description"><?= $cat['description'] ?></textarea>
			<button class="btn" name="submit" type="submit">Update</button>
		</form>
	</div>
</section>


<?php include '../partials/footer.php' ?>