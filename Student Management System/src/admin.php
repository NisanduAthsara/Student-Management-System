<?php
	session_start();
	include('inc/db_con.php');
	if(!isset($_SESSION['tindex'])){
		header('Location: ../index.php');
	}
?>
<?php
include('inc/admin_log_out.php')
?>
 <h1 class="admin_h1">Welcome you to the Teacher's Panel</h1>
 <a href="users.php" class="users_link">Students</a>
 <a href="users(teachers).php" class="users_link">Teachers</a>
 <a href="student_marks.php" class="users_link">Exam Marks</a>
 <a href="student_assignment_marks.php" class="users_link">Assignment Marks</a><br><br><br><br>
 <a href="notices.php" class="users_link sec_line_user_link">Notices</a>
 <a href="behaviour.php" class="users_link sec_line_user_link">Students Behaviour</a>
 <a href="settings.php" class="users_link sec_line_user_link"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
</body>
</html>
<?php
	mysqli_close($conn);
?>