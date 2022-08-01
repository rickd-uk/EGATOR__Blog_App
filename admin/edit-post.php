<?php include 'partials/header.php';

$_SESSION['mode'] = 'edit-post';

$category_query = "SELECT * FROM categories";
$categories = mysqli_query($con, $category_query);

// fetch post data from db if id is set
if (isset($_GET['id'])) {
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT * FROM posts WHERE id=$id";
	$result = mysqli_query($con, $query);
	$post = mysqli_fetch_assoc($result);
} else {
	header('location: ' . ROOT_URL . 'admin/');
	die();
}
?>

<section class="form__section">
	<div class="container form__section-container">
		<h2>Edit Post</h2>

		<form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
			<input type="hidden" name="id" value="<?= $post['id'] ?>">
			<input type="hidden" name="previous_thumbnail" value="<?= $post['thumbnail'] ?>">
			<input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title" />
			<select name="category_id">
				<?php while ($category = mysqli_fetch_assoc($categories)) : ?>
					<option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
				<?php endwhile; ?>
			</select>
			<textarea rows="10" name="body" pslaceholder="Body"><?= $post['body'] ?></textarea>
			<div class="form__control inline">
				<input type="checkbox" name="is_featured" value="1" checked />
				<label for="is_featured">Featured</label>
			</div>
			<div class="form__control">
				<label for="file">Change Thumbnail</label>
				<input type="file" name="thumbnail" id="thumbnail" />
			</div>
			<button type="submit" name="submit" class="btn">Update</button>
		</form>
	</div>
</section>


<?php include '../partials/footer.php'; ?>