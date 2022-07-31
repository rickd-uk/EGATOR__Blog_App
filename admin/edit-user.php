<?php include 'partials/header.php';



// get from params
if (isset($_GET['id'])) {
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT * FROM users where id=$id";
	$result = mysqli_query($con, $query);
	$user = mysqli_fetch_assoc($result);

	$_SESSION['edit-user-initial']['firstname'] = $firstname = $user['firstname'];
	$_SESSION['edit-user-initial']['lastname'] = $lastname = $user['lastname'];
	$_SESSION['edit-user-initial']['username'] = $username = $user['username'];
	$_SESSION['edit-user-initial']['email'] = $email = $user['email'];
	$_SESSION['edit-user-initial']['is_admin'] = $userrole = $user['is_admin'];
} else {
	header('location: ' . ROOT_URL . 'admin/manage-users.php');
	die();
}

$_SESSION['mode'] = 'edit-user';
?>

<section class="form__section">
	<div class="container form__section-container">

		<h2>Edit User</h2>
		<?php if (isset($_SESSION['edit-user'])) : ?>
			<div>
				<p class="alert__message error">
					<?= $_SESSION['edit-user'];
					unset($_SESSION['edit-user'])
					?></p>
			</div>
		<?php endif; ?>
		<form action="<?= ROOT_URL ?>admin/add-or-edit-user-logic.php" method="POST">
			<input type="text" name="firstname" value="<?= $user['firstname'] ?>" placeholder="First Name" />
			<input type="text" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Last Name" />
			<input type="text" name="username" value="<?= $user['username'] ?>" placeholder="Username" />
			<input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Email" />
			<select name="userrole">
				<option value="0">Author</option>
				<option <?= $user['is_admin'] ? 'selected' : '' ?> value="1">Admin</option>
			</select>
			<!-- <input type="hidden" name="mode" value="edit-user"> -->
			<input type="hidden" name="id" value="<?= $id ?>">
			<!-- <img style="width: 100px;" src="<?= ROOT_URL ?>images/users/<?= $user['avatar'] ?>">
			<label for="avatar">User Avatar</label>
			<div class="form__control" style="display: flex; flex-direction: row">

				<input type="file" name="avatar" id="avatar" accept="image/*" />
				<button class="btn" name="clear" id="clear" type="button" style="float: right; background: green; color: white">Clear</button>
			</div> -->
			<div>
				<button class="btn" name="submit" type="submit">Edit</button>
			</div>

		</form>
	</div>
</section>


<?php include '../partials/footer.php' ?>