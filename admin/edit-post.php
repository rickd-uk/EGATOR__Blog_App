<?php include 'partials/header.php' ?>

<section class="form__section">
	<div class="container form__section-container">
		<h2>Edit Post</h2>
		<div>
			<p class="alert__message error">This is an error message</p>
		</div>
		<form action="" enctype="multipart/form-data">
			<input type="text" placeholder="Title" />
			<select>
				<option value="1">Travel</option>
				<option value="1">Art</option>
				<option value="1">Science</option>
				<option value="1">Travel</option>
				<option value="1">Travel</option>
				<option value="1">Travel</option>
			</select>
			<textarea rows="10" placeholder="Body"></textarea>
			<div class="form__control inline">
				<input type="checkbox" id="is_featured" checked />
				<label for="is_featured">Featured</label>
			</div>
			<div class="form__control">
				<label for="file">Change Thumbnail</label>
				<input type="file" id="thumbnail" />
			</div>
			<button type="submit" class="btn">Update</button>
		</form>
	</div>
</section>


<?php include '../partials/footer.php' ?>