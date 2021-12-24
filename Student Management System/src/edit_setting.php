<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>
<!-- <?php
    // $sql = "SELECT * FROM settings";

    // $query = mysqli_query($conn,$sql);

    // $res = mysqli_fetch_assoc($query);

?> -->
<div class='back_div'><a href="settings.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
<h1 class="seeting_h1">Edit Settings</h1>
<form action="" method="post">
    <?php
    
        $sql = "SELECT * FROM settings";

        $query = mysqli_query($conn,$sql);

        $res = mysqli_fetch_assoc($query);
    
        // while($res = mysqli_fetch_assoc($query)){
        //     if($res['seeting'] == 'user_login'){
        //         //echo $res['action'];
        //         echo "<p>Allow Users to Login</p>";
        //         echo "<input type=\"radio\" name=\"user_login\" id=\"\" value=\"Yes\" <?php if($res['action'] == 'Yes'){echo ('checked');}

    ?>

    <p class="edit_set_p_form edit_set_p_form1">Allow Users to Login</p>
    <input type="radio" name="user_login" class="checkset" value="Yes" <?php if($res['user_login'] == 'Yes'){echo ('checked');}?>><label class="containerlabel">Yes
    <input type="radio" name="user_login" class="checkset" value="No" <?php if($res['user_login'] == 'No'){echo ('checked');}?>><label class="containerlabel">No<br>

    <p class="edit_set_p_form">Allow Users to Watch Exam Marks</p>
    <input type="radio" name="user_exam" class="checkset" value="Yes" <?php if($res['user_exam'] == 'Yes'){echo ('checked');}?>><label class="containerlabel">Yes
    <input type="radio" name="user_exam" class="checkset" value="No" <?php if($res['user_exam'] == 'No'){echo ('checked');}?>><label class="containerlabel">No<br>

    <p class="edit_set_p_form">Allow Users to Watch Assignment Marks</p>
    <input type="radio" name="user_assignment" class="checkset" value="Yes" <?php if($res['user_assignment'] == 'Yes'){echo ('checked');}?>><label class="containerlabel">Yes
    <input type="radio" name="user_assignment" class="checkset" value="No" <?php if($res['user_assignment'] == 'No'){echo ('checked');}?>><label class="containerlabel">No<br>

    <p class="edit_set_p_form">Allow Users to Watch Notices</p>
    <input type="radio" name="user_notice" class="checkset" value="Yes" <?php if($res['user_notice'] == 'Yes'){echo ('checked');}?>><label class="containerlabel">Yes
    <input type="radio" name="user_notice" class="checkset" value="No" <?php if($res['user_notice'] == 'No'){echo ('checked');}?>><label class="containerlabel">No<br>

    <p class="edit_set_p_form">Allow Users to Watch Behaviour</p>
    <input type="radio" name="user_behaviour" class="checkset" value="Yes" <?php if($res['user_behaviour'] == 'Yes'){echo ('checked');}?>><label class="containerlabel">Yes
    <input type="radio" name="user_behaviour" class="checkset" value="No" <?php if($res['user_behaviour'] == 'No'){echo ('checked');}?>><label class="containerlabel">No<br>

    <input type="submit" value="Save" name="save_btn" class="sec_submit set_last_sub">
</form>

<?php

    if(isset($_POST['save_btn'])){
        $user_log_ac = $_POST['user_login'];
        $user_exam_ac = $_POST['user_exam'];
        $user_assign_ac = $_POST['user_assignment'];
        $user_notice_ac = $_POST['user_notice'];
        $user_behaviour_ac = $_POST['user_behaviour'];

        $sql = "UPDATE settings SET user_login = '{$user_log_ac}' , user_exam = '{$user_exam_ac}' , user_assignment = '{$user_assign_ac}' , user_notice = '{$user_notice_ac}' , user_behaviour = '{$user_behaviour_ac}' WHERE id = '1'";

        $query = mysqli_query($conn,$sql);

        // $sql = "UPDATE settings SET action = '{$user_exam_ac}' WHERE seeting = 'user_exam'";

        // $query = mysqli_query($conn,$sql);

        // $sql = "UPDATE settings SET action = '{$user_assign_ac}' WHERE seeting = 'user_assignment'";

        // $query = mysqli_query($conn,$sql);

        if($query){
            header('Location: settings.php?up=success');
        }else{
            header('Location: settings.php?up=fail');
        }

    }

?>