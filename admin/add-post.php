<?php include 'partials/header.php';

$_SESSION['mode'] = 'add-post';

// fetch categories from db
$query = "SELECT * FROM categories";
$categories = mysqli_query($con, $query);

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
$is_featured =  $_SESSION['add-post-data']['is_featured'] ?? null;

$user_is_admin = $_SESSION['user_is_admin'] ?? null;

?>
<section class="form__section">
	<div class=" form__section-container">
		<h2>Add Post</h2>

		<p>
			<?php display_message($_SESSION['mode']) ?>
		</p>


		<form action="<?= ROOT_URL . 'admin/add-post-logic.php' ?>" enctype="multipart/form-data" method="POST">
			<input type="text" name="title" value="<?= $title ?>" placeholder="Title" />
			<select name="category_id">
				<?php while ($category = mysqli_fetch_assoc($categories)) : ?>
					<option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
				<?php endwhile; ?>
			</select>
			<textarea rows="10" name="body" placeholder="Body"><?= $body  ?></textarea>

			<?php if (isset($user_is_admin)) : ?>
				<div class="form__control inline">
					<input type="checkbox" name="is_featured" value="1" id="is_featured" checked />
					<label for="is_featured">Featured</label>
				</div>
			<?php endif; ?>
			<div class="form__control">
				<label for="file">Add Thumbnail</label>
				<input type="file" name="thumbnail" id="thumbnail" accept="image/x-png,image/gif,image/jpeg, image/webp" />
			</div>
			<button type="submit" name="submit" class="btn">Add</button>
		</form>
	</div>
</section>

<?php include '../partials/footer.php' ?>