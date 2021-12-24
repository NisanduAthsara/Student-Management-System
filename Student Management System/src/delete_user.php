<?php
session_start();
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}

include('inc/db_con.php');

if(isset($_GET['index_no'])){
    if($_GET['index_no'] == $_SESSION['tindex']){
        header('Location: users.php?err=cannot_delete_crnt_user');
    }
    else{
        $query = "UPDATE sample_usertable SET is_deleted='1' WHERE indexno={$_GET['index_no']} LIMIT 1";

        $result = mysqli_query($conn,$query);

        if($result){
            header('Location: users.php?del=yes');
        }else{
            header('Location: users.php?del=no');
        }
    }
}
else{
    header('Location: users.php?err=index_no_not_found');
}
// $_SESSION['tindex']

?>