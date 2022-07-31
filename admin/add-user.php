<?php include 'partials/header.php';

$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
$userrole = $_SESSION['add-user-data']['userrole'] ?? null;

$_SESSION['mode'] = 'add-user';

// delete session data
unset($_SESSION['add-user-data'])
?>

<section class="form__section">
	<div class="container form__section-container">
		<h2>Add User</h2>
		<?php if (isset($_SESSION['add-user'])) : ?>
			<div>
				<p class="alert__message error">
					<?= $_SESSION['add-user'];
					unset($_SESSION['add-user'])
					?></p>
			</div>
		<?php endif; ?>
		<form action="<?= ROOT_URL ?>admin/add-or-edit-user-logic.php" enctype="multipart/form-data" method="POST">
			<input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name" />
			<input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name" />
			<input type="text" name="username" value="<?= $username ?>" placeholder="Username" />
			<input type="email" name="email" value="<?= $email ?>" placeholder="Email" />
			<input type="password" name="password" value="<?= $password ?>" placeholder="Create Password" />
			<input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password" />
			<select name="userrole">
				<!-- <option value="" disabled hidden>Select Role</option> -->
				<option selected value="0">Author</option>
				<option value="1">Admin</option>
			</select>
			<!-- <input type="hidden" name="mode" value="add-user"> -->
			<label for="avatar">User Avatar</label>
			<div class="form__control" style="display: flex; flex-direction: row">
				<input type="file" name="avatar" id="avatar" accept="image/*" />
				<button class="btn" name="clear" id="clear" type="button" style="float: right; background: green; color: white">Clear</button>
			</div>
			<div>
				<button class="btn" name="submit" type="submit">Add</button>
			</div>
		</form>
	</div>
</section>


<?php include '../partials/footer.php' ?>