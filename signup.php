<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
	<div class="top">
		<a href="homepage.html"><img src="css/img/back_button.png" class="back_button"></a>
		<h2 class="title">Sign Up Form</h2>
	</div>
	<div class="form_container">
		<form action="signup_submit.php" method="post">
			<div class="username">
				<label for="username">Username: </label>
				<input type="text" name="Username" class="username_box"><br>
			</div>
			<div class="password">
				<label for="password">Password: </label>
				<input type="password" name="Password" class="password_box"><br>
			</div>
			<div class="submit">
				<input type="submit" name="submit" class="submit_button">
			</div>
		</form>
	</div>
</body>
</html>
