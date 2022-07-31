<?php include 'partials/header.php';

$_SESSION['mode'] = 'add-post';

// fetch categories from db
$query = "SELECT * FROM categories";
$categories = mysqli_query($con, $query);
?>
<section class="form__section">
	<div class="container form__section-container">
		<h2>Add Post</h2>
		<?php if (isset($_SESSION['add-post'])) : ?>
			<div class="alert__message error">
				<p>
					<?= $_SESSION['add-post'];
					unset($_SESSION['add-post']); ?>
				</p>
			</div>
		<?php endif; ?>

		<form action="<?= ROOT_URL . 'admin/add-post-logic.php' ?>" enctype="multipart/form-data" method="POST">
			<input type="text" name="title" value="<?= $_SESSION['add-post-data']['title'] ?>" placeholder="Title" />
			<select name="category_id">
				<?php while ($category = mysqli_fetch_assoc($categories)) : ?>
					<option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
				<?php endwhile; ?>
			</select>
			<textarea rows="10" name="body" placeholder="Body"><?= $_SESSION['add-post-data']['body']  ?></textarea>

			<?php if (isset($_SESSION['user_is_admin'])) : ?>
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