<?php
	session_start();
	if(!isset($_SESSION['tindex'])){
		header('Location: ../index.php');
	}
	include('inc/admin_log_out.php');
	include('inc/db_con.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
	<!-- <?php
			// echo "<div class='back_div'><a href='users.php' class='back_to_reg'>< Back to the Users page</a></div><br>";
			// echo "<a href='register.php' class='refr'>Refresh</a>";
	?> -->
	<?php
		if(isset($_GET['type'])){
			?>
			<div class='back_div'><a href='users(teachers).php' class='back_to_reg'><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to the Users page</a></div>
			<?php
		}else{
			?>
			<div class='back_div'><a href='users.php' class='back_to_reg'><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to the Users page</a></div>
			<?php
		}
	
	?>
	<!-- <a href='register.php' class='refr'><i class='fa fa-refresh' aria-hidden='true'></i>Refresh</a> -->
	<h1 class="h1-reg">Registration</h1>

	<form action="" method="POST" id="reg_form">
		<p class="reg_p_inone">Enter First Name : </p> 
		<input type="text" name="fname" required="" id="reg" class="reg1"><br>
		<p class="reg_p_in">Enter Last Name : </p>
		<input type="text" name="lname" required="" id="reg"><br>
		<?php

			if(!isset($_GET['type'])){
				?>
					<p class="reg_p_in">Enter Index Number : </p>
					<input type="text" name="index" required="" id="reg"><br>
					<p class="reg_p_in">Enter Class Number : </p>
					<input type="text" name="classnum" required="" id="reg"><br>
				<?php
			}else{
				?>
				<p class="reg_p_in">Enter NIC Number : </p>
				<input type="text" name="index" required="" id="reg"><br>
				<?php
			}
		
		?>
		<p class="reg_p_in">Enter Telephone Number : </p>
		<input type="text" name="tel_no" required="" id="reg"><br>
		<p class="reg_p_in">Select Grade</p>
		<select name="grade" class="options">
			<option value="9">9</option>
		</select>
		<p class="reg_p_in">Select Class</p>
		<select name="class" class="options">
			<option value="7">7</option>
		</select>
		<?php
		
			if(isset($_GET['type'])){
				?>
				<p class="reg_p_in">Select User Type</p>
				<select name="user_type" class="options">
					<option value="Teacher">Teacher</option>
				</select><br>
				<?php
			}else{
				?>
				<p class="reg_p_in">Select User Type</p>
				<select name="user_type" class="options">
					<option value="Student">Student</option>
				</select><br>
				<?php
			}
		
		?>
		<p class="reg_p_in">Enter Email : </p>
		<input type="email" name="email" required="" id="reg"><br>
		<p class="reg_p_in">Enter Password : </p>
		<input type="text" name="pwd" required="" id="reg"><br>
		<input type="submit" name="registerbtn" value="Register" class="reg_btn">
	</form>


	<?php

		if(isset($_POST['registerbtn'])){
		

			$fname = mysqli_real_escape_string($conn,$_POST['fname']);
			$lname = mysqli_real_escape_string($conn,$_POST['lname']);
			$index = mysqli_real_escape_string($conn,$_POST['index']);
			$tel_no = mysqli_real_escape_string($conn,$_POST['tel_no']);
			$grade = mysqli_real_escape_string($conn,$_POST['grade']);
			$class = mysqli_real_escape_string($conn,$_POST['class']);
			$user_type = mysqli_real_escape_string($conn,$_POST['user_type']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
			if(!isset($_GET['type'])){
				$classnum = mysqli_real_escape_string($conn,$_POST['classnum']);
				$sql_query = "SELECT * FROM sample_usertable WHERE email='{$email}' OR indexno='{$index}' OR pwd='{$pwd}' OR classno='{$classnum}' AND is_deleted='0' LIMIT 1";
			}else{
				$classnum = '-';
				$sql_query = "SELECT * FROM sample_usertable WHERE email='{$email}' OR indexno='{$index}' OR pwd='{$pwd}' AND is_deleted='0' LIMIT 1";
			}
			
			//$sql_query = "SELECT * FROM sample_usertable WHERE email='{$email}' OR indexno='{$index}' OR pwd='{$pwd}' OR classno='{$classnum}' AND is_deleted='0' LIMIT 1";
			// echo $sql_query;
			// die();
			$query = mysqli_query($conn,$sql_query);
			
			$count = mysqli_num_rows($query);
			
			if($count == 0){
				$sql_register = "INSERT INTO sample_usertable(first_name,last_name,indexno,telno,grade,class,user_type,email,pwd,classno) VALUES('$fname','$lname','$index','$tel_no','$grade','$class','$user_type','$email','$pwd','$classnum')";
				//$backup = "INSERT INTO backup_usertable(first_name,last_name,indexno,telno,grade,class,user_type,email,pwd,classno) VALUES('$fname','$lname','$index','$tel_no','$grade','$class','$user_type','$email','$pwd','$classnum')";
				// echo $sql_register;
				// die();
				$run_sql_register = mysqli_query($conn,$sql_register);
				//$run_backup = mysqli_query($conn,$backup);

				unset($fname);
				unset($lname);
				unset($index);
				unset($tel_no);
				unset($class);
				unset($user_type);
				unset($email);
				unset($pwd);
				unset($classnum);
	
				if(!$run_sql_register){
					?>
					<script type="text/javascript">
						alert("Oops! Something went wrong! Unable to Register!");
					</script>
					<?php
				}
				else{
					?>
					<script type="text/javascript">
						alert("Successfully Registered!");
					</script>
					<?php
						if(isset($_GET['type'])){
							header("Location: users(teachers).php?register=success");
						}else{
							header("Location: users.php?register=success");
						}
						

				} 
				
			}
			else{
				?>
					<script type="text/javascript">
						alert("Student already registered!");
					</script>
					<?php
			}
	
			
		}
	?>
</body>
</html>
<?php
	mysqli_close($conn);
?>