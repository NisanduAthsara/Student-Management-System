<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>
<?php

if(isset($_GET['up'])){
    if($_GET['up'] == 'success'){
        echo "<p class='details_up'>Successfully Edit Setting</p>";
    }
    else if($_GET['up'] == 'fail'){
        echo "<p class='not_details_up'>Unable to Edit Setting!</p>";
    }
}

?>
<div class='back_div'><a href="admin.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
<h1 class="seeting_h1">Settings</h1>
<a href="edit_setting.php" class="edit_set_link"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Settings</a>
<?php

$sql = "SELECT * FROM settings";

$query = mysqli_query($conn,$sql);

while($res = mysqli_fetch_assoc($query)){
    // if($res['seeting'] == 'user_login'){
    //     echo "<div>Allow Users to Login : {$res['action']}</div>";
    // }
    // else if($res['seeting'] == 'user_exam'){
    //     echo "<div>Allow Users to Watch Exam Marks : {$res['action']}</div>";
    // }
    // else if($res['seeting'] == 'user_assignment'){
    //     echo "<div>Allow Users to Watch Assignment Marks : {$res['action']}</div>";
    // }
    echo "<div class='set_allow_div f1'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>Allow Users to Login : {$res['user_login']}</div>";
    echo "<div class='set_allow_div'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>Allow Users to Watch Exam Marks : {$res['user_exam']}</div>";
    echo "<div class='set_allow_div'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>Allow Users to Watch Assignment Marks : {$res['user_assignment']}</div>";
    echo "<div class='set_allow_div'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>Allow Users to Watch Notices : {$res['user_notice']}</div>";
    echo "<div class='set_allow_div'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>Allow Users to Watch Behaviour : {$res['user_behaviour']}</div>";
}

?>