<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>

<?php

if(isset($_GET['classno']) && isset($_GET['name'])){
    $classno = $_GET['classno'];
    $group_name = $_GET['name'];

    $sql = "UPDATE assignment_marks SET is_deleted = '1' WHERE classno = '{$classno}' AND group_name = '{$group_name}'";
    $res = mysqli_query($conn,$sql);

    if($res){
        header('Location: student_assignment_add_marks.php?name='.$group_name.'&del_std_marks=yes');
    }else{
        header('Location: student_assignment_add_marks.php?del_std_marks=no');
    }
}

?>