<?php include 'partials/header.php';

// fetch post from db if id is set
if (isset($_GET['id'])) {
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT * FROM posts WHERE id=$id";
	$result = mysqli_query($con, $query);
	$post = mysqli_fetch_assoc($result);
} else {
	header('location: ' . ROOT_URL . 'blog.php');
	die();
}
?>

<!-- #region SINGLE POST -->
<section class="singlePost">
	<div class="container singlePost__container">
		<h2>
			<?= $post['title'] ?>
		</h2>
		<div class="post__author">
			<?php
			// Fetch author from users table using author id
			$author_id = $post['author_id'];
			$author_query = "SELECT * FROM users WHERE id=$author_id";
			$author_result = mysqli_query($con, $author_query);
			$author = mysqli_fetch_assoc($author_result);
			$author_firstname = $author['firstname'];
			$author_lastname = $author['lastname'];
			?>
			<div class="post__author-avatar">
				<img src="./images/users/<?= $author['avatar'] ?>" alt="" />
			</div>
			<div class="post__author-info">
				<h5>By: <?= "{$author_firstname} {$author_lastname}" ?></h5>
				<small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
			</div>
		</div>
		<div class="singlePost__thumbnail">
			<img src="./images/posts/<?= $post['thumbnail'] ?>" />
		</div>
		<p>
			<?= $post['body'] ?>
		</p>

	</div>
</section>
<!-- #endregion SINGLE POST -->

<?php include 'partials/footer.php';
