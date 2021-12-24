<?php
session_start();
include('inc/db_con.php');

if(isset($_GET['from'])){
    if(!isset($_SESSION['tindex'])){
        header('Location: ../index.php');
    }else{
        include('inc/admin_log_out.php');
    }
}
else{
    if(!isset($_SESSION['sindex'])){
        header('Location: ../index.php');
    }else{
        include('inc/std_log_out.php');
    }
}
$sql = "SELECT user_login FROM settings WHERE user_assignment = 'Yes' LIMIT 1";

$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

if($count>0){

}else{
    header('Location: student.php?block_assignment=yes');
}

$sql = "SELECT user_login FROM settings WHERE user_login = 'Yes' LIMIT 1";

$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

if($count>0){

}else{
    // session_destroy();
    unset($_SESSION['sindex']);
}
?>
<?php

if(isset($_GET['from'])){
    echo "<div class='back_div'><a href=\"student_assignment_marks.php\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
    echo "<a href='view_std_assignment_marks.php?from=admin' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
}else{
    echo "<div class='back_div'><a href=\"student.php\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
    echo "<a href='view_std_assignment_marks.php' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
}

?>
<!-- <?php
//echo "<a href='view_std_marks.php' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
?> -->
<form action="" method="POST">
    <input type="text" name="search" class="search" placeholder="Search By Semester Name" autofocus required='' value='<?php if(isset($search)){echo $search;}?>'>
    <input type="submit" value="Search" class="search_btn">
</form>



<?php
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT group_name FROM assignment_names WHERE (group_name LIKE '%{$search}%') AND is_deleted='0'";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count==0){
            echo "<p class='not_details_up'>No Section Found!</p>"."<br>";
            //echo "<a href='register.php?from=admin' class='add_new'><span></span>  <i class='fa fa-plus' aria-hidden='true'></i>Add New</a> <span class='af_ad'>|</span> <a href='users.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
            die();
        }else{
            $sql = "SELECT * FROM assignment_names WHERE is_deleted = '0' AND group_name LIKE '%{$search}%' ORDER BY id DESC";
            $res = mysqli_query($conn,$sql);
            if(isset($_GET['from'])){
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($result = mysqli_fetch_assoc($res)){
                            echo "<div class='sec_div_view'><a href='view_as_std_assignment_marks.php?from=admin&name={$result['group_name']}' class='view_sec_btn'>{$result['group_name']}</a></div><br>";
                        }
                    }
                }
            }else{
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($result = mysqli_fetch_assoc($res)){
                            echo "<div class='sec_div_view'><a href='view_as_std_assignment_marks.php?name={$result['group_name']}' class='view_sec_btn'>{$result['group_name']}</a></div><br>";
                        }
                    }
                }
            }
        }
    }else{
        if(isset($_GET['from'])){
      
            $sql = "SELECT * FROM assignment_names WHERE is_deleted = '0' ORDER BY id DESC";
             $res = mysqli_query($conn,$sql);
             if($res){
                 $count = mysqli_num_rows($res);
                 if($count>0){
                     while($result = mysqli_fetch_assoc($res)){
                         echo "<div class='sec_div_view'><a href='view_as_std_assignment_marks.php?from=admin&name={$result['group_name']}' class='view_sec_btn'>{$result['group_name']}</a></div><br>";
                     }
                 }
             }
         }
         else{
     
            $sql = "SELECT * FROM assignment_names WHERE is_deleted = '0' ORDER BY id DESC";
             $res = mysqli_query($conn,$sql);
             if($res){
                 $count = mysqli_num_rows($res);
                 if($count>0){
                     while($result = mysqli_fetch_assoc($res)){
                         echo "<div class='sec_div_view'><a href='view_as_std_assignment_marks.php?name={$result['group_name']}' class='view_sec_btn'>{$result['group_name']}</a></div><br>";
                     }
                 }
             }
         }
    }

    


?>