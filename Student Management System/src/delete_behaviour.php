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

<?php

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql = "SELECT * FROM behaviour WHERE id = '{$id}' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count= mysqli_num_rows($query);

        if($count>0){

            $sql = "UPDATE behaviour SET is_deleted = '1' WHERE id = '{$id}'";

            // echo $sql;
            // die();

            $query = mysqli_query($conn,$sql);

            if($query){

                header('Location: manage_behaviour.php?delete=success');

            }else{
                header('Location: manage_behaviour.php?delete=failed');
            }

        }else{
            header('Location: manage_behaviour.php?delete=failed');
        }

    }else{
        header('Location: manage_behaviour.php?delete=failed');
    }

?>