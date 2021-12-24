<?php
    session_start();
    if(!isset($_SESSION['tindex'])){
        header('Location: ../index.php');
    }
    include('inc/db_con.php');
    include('inc/admin_log_out.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
<?php

if(isset($_GET['index_no'])){
    $index = $_GET['index_no'];
    
    $sql = "SELECT * FROM sample_usertable WHERE indexno='{$index}' LIMIT 1"; //*************** Bug when enter a wrong index ***********

    $res = mysqli_query($conn,$sql);

    $result = mysqli_fetch_assoc($res);

    $fname = $result['first_name'];
    $lname = $result['last_name'];
    $telno = $result['telno'];
    $grade = $result['grade'];
    $class = $result['class'];
    $user_type = $result['user_type'];
    $email = $result['email'];
    $pwd = $result['pwd'];
    $classno = $result['classno'];
}

?>
    <div class='back_div'><a href="users.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to User Page</a></div>
    <form action="" method="POST" id="reg_form">
		<p class="reg_p_inone">Enter First Name : </p>
		<input type="text" name="fname" required="" value=<?php echo $fname;?> id="reg" class="reg1"><br>
		<p class="reg_p_in">Enter Last Name : </p>
		<input type="text" name="lname" required="" value=<?php echo $lname;?> id="reg"><br>
		<p class="reg_p_in">Enter Index Number : </p>
		<input type="text" name="index" required="" value=<?php echo $index;?> disabled id="reg"><br>
        <p class="reg_p_in">Enter Class Number : </p>
		<input type="text" name="classno" required="" value=<?php echo $classno;?> disabled id="reg"><br>
		<p class="reg_p_in">Enter Telephone Number : </p>
		<input type="text" name="tel_no" required="" value=<?php echo $telno;?> id="reg"><br>
		<p class="reg_p_in">Select Grade</p>
		<select name="grade" class="options">
			<option value="9" <?php if($grade == '9'){echo("selected");}?>>9</option>
		</select>
		<p class="reg_p_in">Select Class</p>
		<select name="class" class="options">
			<option value="7" <?php if($class == '7'){echo("selected");}?>>7</option>
		</select>
		<p class="reg_p_in">Select User Type</p>
		<select name="user_type" class="options">
			<option value="Student" <?php if($user_type == 'Student'){echo("selected");}?>>Student</option>
			<option value="Teacher" <?php if($user_type == 'Teacher'){echo("selected");}?>>Teacher</option>
		</select><br>
		<p class="reg_p_in">Enter Email : </p>
		<input type="email" name="email" required="" value=<?php echo $email;?> disabled id="reg"><br>
		<p class="reg_p_in">Enter Password : </p>
		<input type="text" name="pwd" required="" value=<?php echo $pwd;?> disabled id="reg"><br>
		<input type="submit" name="savebtn" value="Save" class="reg_btn">
	</form>

    <?php
    
        if(isset($_POST['savebtn'])){
            $nfname = mysqli_real_escape_string($conn,$_POST['fname']);
            $nlname = mysqli_real_escape_string($conn,$_POST['lname']);
            $nindex = mysqli_real_escape_string($conn,$index);
            $ntel_no = mysqli_real_escape_string($conn,$_POST['tel_no']);
            $ngrade = mysqli_real_escape_string($conn,$_POST['grade']);
            $nclass = mysqli_real_escape_string($conn,$_POST['class']);
            $nuser_type = mysqli_real_escape_string($conn,$_POST['user_type']);
            $nemail = mysqli_real_escape_string($conn,$email);
            $npwd = mysqli_real_escape_string($conn,$pwd);
            $nclassno = mysqli_real_escape_string($conn,$classno);

            // if($nindex === $index){
            //     header('Location: users.php?user=excists');
            //    // echo "User index already excists";
            // }

            // else{
                $sql_up = "UPDATE sample_usertable SET first_name = '{$nfname}' , last_name = '{$nlname}' , indexno = '{$nindex}' , telno = '{$ntel_no}' , grade = '{$ngrade}' , class = '{$nclass}' , user_type = '{$nuser_type}' , email = '{$nemail}' , pwd = '{$npwd}' , classno = '{$nclassno}' WHERE indexno = {$index} LIMIT 1";
                //$sql_backup = "UPDATE backup_usertable SET first_name = '{$nfname}' , last_name = '{$nlname}' , indexno = '{$nindex}' , telno = '{$ntel_no}' , grade = '{$ngrade}' , class = '{$nclass}' , user_type = '{$nuser_type}' , email = '{$nemail}' , pwd = '{$npwd}', classno = '{$nclassno}' WHERE indexno = {$index} LIMIT 1";                      

                if(mysqli_query($conn,$sql_up)){
                    header('Location: users.php?update=yes');
                }
                else{
                    header('Location: users.php?update=no');
                }
                // if(mysqli_query($conn,$sql_backup)){
                //     header('Location: users.php?update=yes');
                // }
                // else{
                //     header('Location: users.php?update=no');
                // }
            // }

            
        }

    ?>
</body>
</html>
<?php
	mysqli_close($conn);
?>