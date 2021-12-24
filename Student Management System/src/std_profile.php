<?php
	session_start();
	include('inc/db_con.php');
	if(isset($_GET['from'])){
		if(!isset($_SESSION['tindex'])){
			header('Location: ../index.php');
		}
	}
	else{
		if(!isset($_SESSION['sindex'])){
			header('Location: ../index.php');
		}
	}
	
?>
<?php
	if(isset($_GET['from'])){
		include('inc/admin_log_out.php');
		echo "<div class='back_div'><a href=\"users.php\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
	}else{
		include('inc/std_log_out.php');
		echo "<div class='back_div'><a href=\"student.php\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
	}
	
?>


<div>
<div class="user_large_div"><i class="fa fa-user big_user" aria-hidden="true"></i></div>

<?php

	if(!isset($_GET['from'])){
		?>
		<p class="user_name_prof">First Name 	<span>: </span><?php echo $_SESSION['sfname'];?></p>
		<p class="user_name_prof">Last Name 	<span>: </span><?php echo $_SESSION['slname'];?></p>
		<p class="user_name_prof">Class No. 	<span>: </span><?php echo $_SESSION['sclassno'];?></p>
		<p class="user_name_prof">Index No. 	<span>: </span><?php echo $_SESSION['sindex'];?></p>
		<p class="user_name_prof">Email 		<span>: </span><?php echo $_SESSION['semail'];?></p>
		<p class="user_name_prof">Password 		<span>: </span><?php echo $_SESSION['spwd'];?></p>

		<?php

			$sql = "SELECT * FROM group_marks WHERE classno = '{$_SESSION['sclassno']}' AND is_deleted = '0'";

			$query = mysqli_query($conn,$sql);

			$count = mysqli_num_rows($query);

			if($count>0){
				echo "<hr class='prof_hr_1'>";
				echo "<div class='profile_exam_marks_div'>Exam Marks</div>";
				echo "<table id='profile_exam_marks'>";
				echo "<tr><th>Exam Name</th><th>Semester</th><th>Marks</th><th>Average</th><th>Rank</th></tr>";
				while($res = mysqli_fetch_assoc($query)){
					echo "<tr><td>{$res['group_name']}</td><td>{$res['semester']}</td><td>{$res['marks']}</td><td>{$res['average']}</td><td>{$res['rank']}</td></tr>";
				}
				echo "</table>";
			}

			$sql = "SELECT * FROM assignment_marks WHERE classno = '{$_SESSION['sclassno']}' AND is_deleted = '0'";

			$query = mysqli_query($conn,$sql);

			$count = mysqli_num_rows($query);

			if($count>0){
				echo "<hr class='prof_hr_1'>";
				echo "<div class='profile_exam_marks_div'>Assignment Marks</div>";
				echo "<table id='profile_asssignment_marks'>";
				echo "<tr><th>Assignment Name</th><th>Marks</th></tr>";
				while($res = mysqli_fetch_assoc($query)){
					echo "<tr><td>{$res['group_name']}</td><td>{$res['marks']}</td></tr>";
				}
				echo "</table>";
			}
	}else{

		$sql = "SELECT * FROM sample_usertable WHERE classno = '{$_GET['classno']}' LIMIT 1";

		//echo $_GET['from']; 

		$query = mysqli_query($conn,$sql);

		$count = mysqli_num_rows($query);

		if($count>0){

			$res = mysqli_fetch_assoc($query);

			?>

			<p class="user_name_prof">First Name 	<span>: </span><?php echo $res['first_name'];?></p>
			<p class="user_name_prof">Last Name 	<span>: </span><?php echo $res['last_name'];?></p>
			<p class="user_name_prof">Class No. 	<span>: </span><?php echo $res['classno'];?></p>
			<p class="user_name_prof">Index No. 	<span>: </span><?php echo $res['indexno'];?></p>
			<p class="user_name_prof">Email 		<span>: </span><?php echo $res['email'];?></p>
			<p class="user_name_prof">Password 		<span>: </span><?php echo $res['pwd'];?></p>

			<?php

				$sql = "SELECT * FROM group_marks WHERE classno = '{$_GET['classno']}' AND is_deleted = '0'";

				$query = mysqli_query($conn,$sql);

				$count = mysqli_num_rows($query);

				if($count>0){
					echo "<hr class='prof_hr_1'>";
					echo "<div class='profile_exam_marks_div'>Exam Marks</div>";
					echo "<table id='profile_exam_marks'>";
					echo "<tr><th>Exam Name</th><th>Semester</th><th>Marks</th><th>Average</th><th>Rank</th></tr>";
					while($res = mysqli_fetch_assoc($query)){
						echo "<tr><td>{$res['group_name']}</td><td>{$res['semester']}</td><td>{$res['marks']}</td><td>{$res['average']}</td><td>{$res['rank']}</td></tr>";
					}
					echo "</table>";
				}

				$sql = "SELECT * FROM assignment_marks WHERE classno = '{$_GET['classno']}' AND is_deleted = '0'";

				$query = mysqli_query($conn,$sql);

				$count = mysqli_num_rows($query);

				if($count>0){
					echo "<hr class='prof_hr_1'>";
					echo "<div class='profile_exam_marks_div'>Assignment Marks</div>";
					echo "<table id='profile_asssignment_marks'>";
					echo "<tr><th>Assignment Name</th><th>Marks</th></tr>";
					while($res = mysqli_fetch_assoc($query)){
						echo "<tr><td>{$res['group_name']}</td><td>{$res['marks']}</td></tr>";
					}
					echo "</table>";
				}

		}else{
			echo "<p class='not_details_up'>Something Went Wrong!</p>"."<br>";
		}

	}

?>

</div>