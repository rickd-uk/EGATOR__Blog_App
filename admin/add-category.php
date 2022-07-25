<?php include 'partials/header.php' ?>

<section class="form__section">
	<div class="container form__section-container">
		<h2>Add Category</h2>
		<div>
			<p class="alert__message error">This is an error message</p>
		</div>
		<form action="" enctype="multipart/form-data">
			<input type="text" placeholder="Title" />
			<textarea rows="4" placeholder="Description"></textarea>
			<button class="btn" type="submit">Add</button>
		</form>
	</div>
</section>

<?php include '../partials/footer.php' ?>