<?php
session_start();
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}

include('inc/db_con.php');

if(isset($_GET['name'])){
    $group_name = $_GET['name'];
    echo $group_name;
    $sql = "UPDATE group_names SET is_deleted = '1' WHERE group_name = '{$group_name}'";
    $res = mysqli_query($conn,$sql);

    $sql = "UPDATE group_marks SET is_deleted = '1' WHERE group_name = '{$group_name}'";
    $result = mysqli_query($conn,$sql);

    if($res && $result){
        header('Location: student_marks.php?del=success');
    }else{
        header('Location: student_marks.php?del=failed'); 
    }
}

?>