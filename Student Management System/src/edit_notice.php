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

<div class="back_to"><a href="manage_notice.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<?php

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql = "SELECT * FROM notices WHERE id='{$id}' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count>0){

            $res = mysqli_fetch_assoc($query);

            $title = $res['title'];
            $content = $res['content'];
            $type = $res['type'];


        }else{
            header('Location: manage_notice.php?update=failed');
        }

    }else{
        header('Location: manage_notice.php?update=failed');
    }

?>
<h1 class="h1-manage_notices add_new_not_h1">Edit Notice</h1>
<div class="add_new_not_div">
    <form method="POST">
        <p class="reg_p_inone">Enter Title of the Notice</p>
        <input type="text" name="notice_title" value=<?php echo $title; ?> id="reg" class="reg1" required=""> 

        <p class="reg_p_inone">Enter Notice</p>
        <textarea rows="15" cols="90" name="notice_content" class="textarea-notice" required=""><?php echo $content;?></textarea>
        <p class="reg_p_inone not_p_last">Select Notice Type</p>
        <select name="notice_type" class="options">
            <option value="Normal" <?php if($type == 'Normal'){echo("selected");}?>>Normal</option>
            <option value="Attention" <?php if($type == 'Attention'){echo("selected");}?>>Attention</option>
        </select>
        <br><input type="submit" name="submit_btn" value="Save" class="reg_btn">
    </form>
</div>

<?php

    if(isset($_POST['submit_btn'])){

        $title = $_POST['notice_title'];
        $content = $_POST['notice_content'];
        $type = $_POST['notice_type'];

        $sql = "UPDATE notices SET title = '{$title}' , content = '{$content}' , type = '{$type}' WHERE id = '{$id}' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        if($query){
            header('Location: manage_notice.php?update=success');
        }else{
            header('Location: manage_notice.php?update=failed');
        }
    }

?>