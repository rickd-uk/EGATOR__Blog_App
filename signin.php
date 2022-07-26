<?php
require './config/constants.php';
require 'config/constants.php';
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
			<h2>Sign In</h2>
			<?php if (isset($_SESSION['signup-success'])) : ?>
				<div>
					<p class="alert__message success">
						<?= $_SESSION['signup-success'];
						unset($_SESSION['signup-success']);
						?>
					</p>
				</div>
			<?php endif; ?>
			<form action="" enctype="multipart/form-data">
				<input type="text" placeholder="Username or Email" />
				<input type="password" placeholder="Password" />
				<button class="btn" type="submit">Sign Up</button>
				<small>Don't have an account?<a href="signup.php">Sign Up</a></small>
			</form>
		</div>
	</section>
</body>

</html>