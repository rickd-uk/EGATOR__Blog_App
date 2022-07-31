<?php include 'partials/header.php';

// get user info from db, but not current user
$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM users where NOT id=$current_admin_id";
$users = mysqli_query($con, $query);
$mode = $_SESSION['mode'];

?>

<section class="dashboard">
	<div>
		<?php display_message($mode) ?>
	</div>


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
					<a href="index.php"><i class="uil uil-postcard"></i>
						<h5>Manage Posts</h5>
					</a>
				</li>
				<li>
					<a href="add-user.php"><i class="uil uil-user-plus"></i>
						<h5>Add User</h5>
					</a>
				</li>
				<li>
					<a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
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
		</aside>

		<main>
			<h2>Manage Users</h2>

			<?php if (mysqli_num_rows($users) == 0) : ?>
				<h3 class="alert__message error">There are None</h3>
			<?php else : ?>
				<table>
					<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Admin</th>
						</tr>
					</thead>

					<tbody>
						<?php while ($user = mysqli_fetch_assoc($users)) : ?>
							<tr style="margin-bottom: 2rem;">
								<td><?= "{$user['firstname']}  {$user['lastname']}" ?></td>
								<td><?= $user['username'] ?></td>
								<td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
								<td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
								<td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
							</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			<?php endif; ?>
		</main>
	</div>
</section>


<?php include '../partials/footer.php' ?>