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

<div class="back_to"><a href="add_new_behaviour.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<?php

    if(!isset($_GET['classno'])){
        header('Location: add_new_behaviour.php?add=failed');
    }else{
        $classno = $_GET['classno'];

        $sql = "SELECT * FROM sample_usertable WHERE classno = '{$classno}' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count>0){

        }else{
            header('Location: add_new_behaviour.php?add=failed');
        }
    }

?>

<div class="add_new_not_div">
    <form method="POST">
        <p class="reg_p_inone">Enter Behaviour : </p>
        <textarea rows="15" cols="90" name="behaviour" class="textarea-notice" required=""></textarea>

        <br><input type="submit" name="submit_btn" value="Submit" class="reg_btn">
    </form>
</div>

<?php

    if(isset($_POST['submit_btn'])){
        date_default_timezone_set("Asia/Colombo");

        $now = date("Y-m-d")."  ".date("h:ia");

        $author = $_SESSION['tfname'];
        $behaviour = $_POST['behaviour'];

        $sql = "SELECT * FROM behaviour WHERE classno = '{$classno}' AND behaviour = '{$behaviour}' AND teacher = '{$author}' AND is_deleted = '0' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count>0){

            header('Location: add_new_behaviour.php?add=have');

        }else{
            $sql = "INSERT INTO behaviour(classno,behaviour,teacher,date) VALUES ('{$classno}','{$behaviour}','{$author}','{$now}') LIMIT 1";

            $query = mysqli_query($conn,$sql);

            if($query){
                header('Location: add_new_behaviour.php?add=success');
            }else{
                header('Location: add_new_behaviour.php?add=have');
            }
        }

    }

?>