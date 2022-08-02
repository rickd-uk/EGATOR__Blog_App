<?php include 'partials/header.php';

// Fetch current users posts
$current_user_id = $_SESSION['user-id'];
// $query = "SELECT posts.id, posts.title, posts.category_id FROM posts JOIN users ON posts.author_id = users.id WHERE posts.author_id = $current_user_id ORDER BY posts.id DESC";

// Shorter alternative clearer query, which is preferable
$query = "SELECT id, title, category_id FROM posts WHERE author_id = $current_user_id ORDER BY id DESC";
$posts = mysqli_query($con, $query);

$mode = $_SESSION['mode'];
?>

<section class="dashboard">


	<?php display_message($mode) ?>

	<div class="container dashboard__container">

		<button class="sidebar__toggle" id="show__sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
		<button class="sidebar__toggle" id="hide__sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
		<aside>
			<ul>
				<li>
					<a href="add-post.php"><i class="uil uil-pen"></i>
						<h5>Add Post</h5>
					</a>
				</li>
				<li>
					<a href="index.php" class="active"><i class="uil uil-postcard"></i>
						<h5>Manage Posts</h5>
					</a>
				</li>


				<!-- Only display if user is admin -->
				<?php if (isset($_SESSION['user_is_admin'])) : ?>
					<li>
						<a href="add-user.php"><i class="uil uil-user-plus"></i>
							<h5>Add User</h5>
						</a>
					</li>
					<li>
						<a href="manage-users.php"><i class="uil uil-users-alt"></i>
							<h5>Manage User</h5>
						</a>
					</li>
					<li>
						<a href="add-category.php"><i class="uil uil-plus"></i>
							<h5>Add Category</h5>
						</a>
					</li>
					<li>
						<a href="manage-categories.php"><i class="uil uil-list-ul"></i>
							<h5>Manage Categories</h5>
						</a>
					</li>
			</ul>
		<?php endif; ?>
		</aside>

		<main>
			<h2>Manage Posts</h2>
			<?php if (mysqli_num_rows($posts) == 0) : ?>
				<h3 class="alert__message error">There are None</h3>
			<?php else : ?>
				<table>
					<thead>
						<tr>
							<th>Title</th>
							<th>Category</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($post = mysqli_fetch_assoc($posts)) : ?>
							<!-- Get category title for each post from categories table -->
							<?php
							$category_id = $post['category_id'];
							$category_query = "SELECT title FROM categories WHERE id = $category_id";
							$category_result = mysqli_query($con, $category_query);
							$category = mysqli_fetch_assoc($category_result);

							?>
							<tr>
								<td><?= $post['title'] ?></td>
								<td><?= $category['title'] ?></td>
								<td><a href="<?= ROOT_URL . 'admin/edit-post.php?id=' . $post['id'] ?>" class="btn sm">Edit</a></td>
								<td><a href="<?= ROOT_URL . 'admin/delete-post.php?id=' . $post['id'] ?>" class="btn sm danger">Delete</a></td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</main>
	</div>
</section>


<?php include '../partials/footer.php' ?>