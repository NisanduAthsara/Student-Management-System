<?php
	session_start();
	include('inc/db_con.php');
	if(!isset($_SESSION['sindex'])){
		header('Location: ../index.php');
	}

	$sql = "SELECT user_login FROM settings WHERE user_login = 'Yes' LIMIT 1";

	$query = mysqli_query($conn,$sql);

	$count = mysqli_num_rows($query);

	if($count>0){

	}else{
		// session_destroy();
		unset($_SESSION['sindex']);
	}
	
?>
<?php
	include('inc/std_log_out.php')
?>

<?php

	if(isset($_GET['block_assignment'])){
		if($_GET['block_assignment'] == 'yes'){
			echo "<p class='not_details_up'>Teacher Blocked that Section!</p>"."<br>";
		}
	}
	if(isset($_GET['block_exam'])){
		if($_GET['block_exam'] == 'yes'){
			echo "<p class='not_details_up'>Teacher Blocked that Section!</p>"."<br>";
		}
	}
	if(isset($_GET['block_notice'])){
		if($_GET['block_notice'] == 'yes'){
			echo "<p class='not_details_up'>Teacher Blocked that Section!</p>"."<br>";
		}
	}
	if(isset($_GET['block_behaviour'])){
		if($_GET['block_behaviour'] == 'yes'){
			echo "<p class='not_details_up'>Teacher Blocked that Section!</p>"."<br>";
		}
	}
?>

<h1 class="admin_h1">Welcome you to the Student's Page</h1>
 <a href="std_profile.php" class="users_link"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
 <a href="view_std_marks.php" class="users_link">Exam Marks</a>
 <a href="view_std_assignment_marks.php" class="users_link">Assignment Marks</a>
 <a href="notices.php?from=student" class="users_link">Notices</a><br><br><br><br>
 <a href="student_behaviour.php" class="users_link">Behaviour</a>
</body>
</html>