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

if(isset($_GET['from'])){
    ?>
    <div class="back_to"><a href="manage_notice.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back </a></div>
    <?php
}else{
    ?>
    <div class="back_to"><a href="notices.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back </a></div>
    <?php
}

?>


<h1 class="h1-manage_notices add_new_not_h1">Add New Notice</h1>
<div class="add_new_not_div">
    <form method="POST">
        <p class="reg_p_inone">Enter Title of the Notice</p>
        <input type="text" name="notice_title" id="reg" class="reg1" required="">

        <p class="reg_p_inone">Enter Notice</p>
        <textarea rows="15" cols="90" name="notice_content" class="textarea-notice" required=""></textarea>
        <p class="reg_p_inone not_p_last">Select Notice Type</p>
        <select name="notice_type" class="options">
            <option value="Normal">Normal</option>
            <option value="Attention">Attention</option>
        </select>
        <br><input type="submit" name="submit_btn" value="Submit" class="reg_btn">
    </form>
</div>

<?php

    if(isset($_POST['submit_btn'])){

        date_default_timezone_set("Asia/Colombo");

        $now = date("Y-m-d")." ".date("h:i:sa");

        $title = mysqli_real_escape_string($conn,$_POST['notice_title']);
        $content = mysqli_real_escape_string($conn,$_POST['notice_content']);
        $type = mysqli_real_escape_string($conn,$_POST['notice_type']);
        $author = $_SESSION['tfname'];
        $time = $now;

        $sql = "SELECT * FROM notices WHERE title = '{$title}' AND content = '{$content}' AND is_deleted = '0' LIMIT 1";

        $query = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($query);

        if($count == 1){

            echo "<p class='not_details_up'>Already add that notice!</p>";

        }else{
            $sql = "INSERT INTO notices(title,content,author,sendtime,type) VALUES ('{$title}','{$content}','{$author}','{$time}','{$type}') LIMIT 1";

            $query = mysqli_query($conn,$sql);

            if($query){
                header('Location: notices.php?add_new=success');
            }else{
                header('Location: notices.php?add_new=failed');
            }
        }
        

    }

?>
