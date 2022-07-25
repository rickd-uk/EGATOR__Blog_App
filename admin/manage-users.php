<?php include 'partials/header.php' ?>


<section class="dashboard">
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
					<a href="dashboard.php"><i class="uil uil-postcard"></i>
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
					<tr>
						<td>Frank Willis</td>
						<td>fwills</td>
						<td><a href="edit-user.php" class="btn sm">Edit</a></td>
						<td><a href="delete-user.php" class="btn sm danger">Delete</a></td>
					</tr>

					<tr>
						<td>Frank Willis</td>
						<td>fwills</td>
						<td><a href="edit-user.php" class="btn sm">Edit</a></td>
						<td><a href="delete-user.php" class="btn sm danger">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</main>
	</div>
</section>


<?php include '../partials/footer.php' ?>