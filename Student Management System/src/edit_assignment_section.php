<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>

<div class='back_div'><a href="student_assignment_marks.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>

<?php

if(isset($_GET['name'])){
    $name_of_url = $_GET['name'];

    $sql = "SELECT * FROM assignment_names WHERE group_name = '{$name_of_url}' AND is_deleted=0";
    $run = mysqli_query($conn,$sql);
    $vals = mysqli_fetch_assoc($run);

    if(isset($_POST['editbtn'])){
        $new_sec_name = $_POST['new_sec_name'];

        $sql = "SELECT * FROM assignment_names WHERE group_name = '{$new_sec_name}' AND is_deleted=0";
        //unset($new_sec_name);
        $query = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($query);
        //$vals = mysqli_fetch_assoc($query);

        if($count == 0){
            $sql = "UPDATE assignment_names SET group_name='{$new_sec_name}' WHERE group_name='{$name_of_url}' LIMIT 1";

            $res = mysqli_query($conn,$sql);

            $sql_marks = "UPDATE assignment_marks SET group_name='{$new_sec_name}' WHERE group_name='{$name_of_url}'";

            $res_marks = mysqli_query($conn,$sql_marks);

            if($res && $res_marks){
                header('Location: student_assignment_marks.php?up_sec=success');
                //echo '<p class="info">You have successfully edit name!</p>';
            }
        }else{
            header('Location: student_assignment_marks.php?up_sec=failed');
            //echo "<p class='not_details_up'>Name already taken!</p>";
        }
    }
}

?>
<?php

    echo "<div class='crnt_sec_name_div'><p class='crnt_sec_name_dis'><i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"></i>Current Section Name     :      {$vals['group_name']}</p></div>";

?>
<form action="" method="post">
    <input type="text" name="new_sec_name" class="sec_formname" required="" placeholder="Enter new section name">
    <input type="submit" value="Edit" name="editbtn" class = "sec_submit">
</form>