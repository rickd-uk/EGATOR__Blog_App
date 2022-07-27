<?php
require './config/constants.php';
require './config/functions.php';

// get post form data back due to reg Error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete session
unset($_SESSION['signup-data']);
?>

<!-- #region HEAD -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="css/styles.css" />

	<title>Blog</title>
</head>
<!-- #endregion HEAD -->

<body>
	<section class="form__section">
		<div class="container form__section-container">
			<h2>Sign Up</h2>
			<?php
			if (isset($_SESSION['signup'])) : ?>
				<div class="alert__message error">
					<p>Error Message</p>
					<p><?php show($_SESSION['signup']) ?></p>
					<?php unset($_SESSION['signup']); ?>
				</div>
			<?php endif; ?>
			<form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
				<input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name" />
				<input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name" />
				<input type="text" name="username" value="<?= $username ?>" placeholder="Username" />
				<input type="email" name="email" value="<?= $email ?>" placeholder="Email" />
				<input type="password" name="password" value="<?= $password ?>" placeholder="Create Password" />
				<input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password" />
				<div class="form__control">
					<label for="avatar">User Avatar</label>
					<input type="file" name="avatar" id="avatar" />
				</div>
				<button class="btn" name="submit" type="submit">Sign Up</button>
				<small>Already have an account?<a href="signin.html">Sign In</a></small>
			</form>
		</div>
	</section>
</body>

</html>