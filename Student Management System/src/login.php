<?php

if(isset($_POST['submitbtn'])){
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$pwd = mysqli_real_escape_string($conn,$_POST['password']);
//$indexno = mysqli_real_escape_string($conn,$_POST['indexno']);
	//$type = mysqli_real_escape_string($conn,$_POST['type']);
	
	// echo $indexno."<br>";
	
	$sqllogin = "SELECT * FROM sample_usertable WHERE email='{$email}' AND pwd='{$pwd}' AND is_deleted='0' LIMIT 1"; //indexno='{$indexno}' AND // AND user_type='{$type}'
	
	$query = mysqli_query($conn,$sqllogin);
	
	$count = mysqli_num_rows($query);//to thsis section success
	
	// echo $count;
	
	if($count == 0){
		echo "<p class='invalid'>Invalid email or password!</p>";
	}
	else{
		//echo "Success";
		$sql_data = mysqli_fetch_assoc($query);
		$type = $sql_data['user_type'];
		if($type == 'Student'){

			$sql = "SELECT user_login FROM settings WHERE user_login = 'Yes' LIMIT 1";

			$query = mysqli_query($conn,$sql);

			$count = mysqli_num_rows($query);

			if($count>0){
				$_SESSION['sfname'] = $sql_data['first_name'];
				$_SESSION['slname'] = $sql_data['last_name'];
				$_SESSION['semail'] = $sql_data['email'];
				$_SESSION['sindex'] = $sql_data['indexno'];
				$_SESSION['sclass'] = $sql_data['grade']."-".$sql_data['class'];
				$_SESSION['sclassno'] = $sql_data['classno'];
				$_SESSION['spwd'] = $sql_data['pwd'];
				
				header("Location: src/student.php");
			}

			else{
				echo "<p class='invalid'>Currently Teacher Blocked students to the login!</p>";
			}
			
			
		}
		else if($type == 'Teacher'){
			$_SESSION['tfname'] = $sql_data['first_name'];
			$_SESSION['tlname'] = $sql_data['last_name'];
			$_SESSION['temail'] = $sql_data['email'];
			$_SESSION['tindex'] = $sql_data['indexno'];
			$_SESSION['tclass'] = $sql_data['grade']."-".$sql_data['class'];
			$_SESSION['tclassno'] = $sql_data['classno'];
			
			header("Location: src/admin.php");
		}
		
	}
}
?>