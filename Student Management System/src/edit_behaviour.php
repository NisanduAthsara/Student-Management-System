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

<div class="back_to"><a href="manage_behaviour.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<?php

    if(!isset($_GET['id'])){
        header('Location: manage_behaviour.php?update=no');
    }else{
        $id = $_GET['id'];

        $sql = "SELECT * FROM behaviour WHERE id = '{$id}' AND is_deleted = '0' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count>0){
            
            $res = mysqli_fetch_assoc($query); 

        }else{
            header('Location: manage_behaviour.php?update=no');
        }
    }

?>

<h1 class="h1-manage_notices add_new_not_h1">Edit Behaviour</h1>
<div class="add_new_not_div">
    <form method="POST">
        <p class="reg_p_inone">Enter New Behaviour : </p>
        <textarea rows="15" cols="90" name="behaviour" class="textarea-notice" required=""><?php echo $res['behaviour'];?></textarea>
        <br><input type="submit" name="submit_btn" value="Save" class="reg_btn">
    </form>
</div>

<?php

if(isset($_POST['submit_btn'])){

    $behaviour = $_POST['behaviour'];

    $sql = "UPDATE behaviour SET behaviour = '{$behaviour}' WHERE id = '{$id}' LIMIT 1";

    $query = mysqli_query($conn,$sql);

    if($query){
        header('Location: manage_behaviour.php?update=yes');
    }else{
        header('Location: manage_behaviour.php?update=no');
    }
}

?>