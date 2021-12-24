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

<div class="back_to"><a href="users(teachers).php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<h1 class="h1-manage_notices">Edit</h1>

<?php

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];

        $sql = "SELECT * FROM sample_usertable WHERE id={$id} LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count>0){

            $val = mysqli_fetch_assoc($query);

        }else{
            header("Location: users(teachers).php?update=no");
        }


    }else{
        header("Location: users(teachers).php?update=no");
    }

?>

<form method="POST" id="reg_form">
    <p class="reg_p_in">NIC Number : </p>
	<input type="text" name="index" required="" value=<?php echo $val['indexno'];?> disabled id="reg"><br>
    <p class="reg_p_in">Enter First Name : </p>
    <input type="text" name="fname" required="" value=<?php echo $val['first_name'];?> id="reg"><br>
    <p class="reg_p_in">Enter Last Name : </p>
    <input type="text" name="lname" required="" value=<?php echo $val['last_name'];?> id="reg"><br>
    <p class="reg_p_in">Enter Tel. Number : </p>
    <input type="text" name="tel_no" required="" value=<?php echo $val['telno'];?> id="reg"><br>
    <p class="reg_p_in">Email : </p>
	<input type="text" name="index" required="" value=<?php echo $val['email'];?> disabled id="reg"><br>
    <p class="reg_p_in">Password : </p>
	<input type="text" name="index" required="" value=<?php echo $val['pwd'];?> disabled id="reg"><br>
    <input type="submit" name="savebtn" value="Save" class="reg_btn">
</form>

<?php

    if(isset($_POST['savebtn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $telno = $_POST['tel_no'];

        $sql = "UPDATE sample_usertable SET first_name = '{$fname}' , last_name = '{$lname}' , telno = '{$telno}' WHERE id = '{$id}' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        if($query){
            header("Location: users(teachers).php?update=yes");
        }else{
            header("Location: users(teachers).php?update=no");
        }
    }

?>