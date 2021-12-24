<?php
	session_start();
?>
<?php
	include('src/inc/db_con.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="src/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="src/img/images.png" type="image/icon type">
</head>
<body>
	<h1 class="login-h">Login</h1>
	<form method="POST" id="login-form">
		<?php 
			if (isset($_GET['logout'])) {
				echo '<p class="info">You have successfully logged out from the system!</p>';
			}
		?>
		<?php
			include('src/login.php')
		?>
		<p class="p1 email-p"><i class="fa fa-envelope" aria-hidden="true"></i>  Email : </p>
		<input type="email" name="email" required=""><br>
		<p class="p1"><i class="fa fa-unlock-alt" aria-hidden="true"></i>  Password : </p>
		<input type="password" name="password" required=""><br>
		<!-- <p class="p1"><i class="fa fa-id-card-o" aria-hidden="true"></i>  Index No : </p>
		<input type="text" name="indexno" required=""><br> -->
		<!-- <p class="p1"><i class="fa fa-user" aria-hidden="true"></i>  Login As : </p>
		<select name="type" class="login-op">
			<option value="Student">Student</option><br>
			<option value="Teacher">Teacher</option><br>
		</select><br> -->
		<br><input type="submit" name="submitbtn" value="Log in" class="log_in_btn">
	</form>
</body>
</html>
<?php
	mysqli_close($conn);
?>