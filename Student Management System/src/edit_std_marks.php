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

        $sql = "SELECT * FROM group_marks WHERE classno='{$classno}' AND group_name='{$group_name}' AND is_deleted='0'";

        echo "<div class='back_div'><a href=\"student_add_marks.php?name=".$group_name."\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back to Student Marks Page</a></div>";

        $result = mysqli_query($conn,$sql);

        //$count = mysqli_num_rows($result);

        $vals = mysqli_fetch_assoc($result);
        // $old_class_no = $vals['classno'];
    }

    if(isset($_POST['submit_marks'])){
        // $nclassno = $_POST['classno'];
        $semester = mysqli_real_escape_string($conn,$_POST['semester']);
        $marks = mysqli_real_escape_string($conn,$_POST['marks']);
        $average = mysqli_real_escape_string($conn,$_POST['average']);
        $rank = mysqli_real_escape_string($conn,$_POST['rank']);

        //$select_sql = "SELECT * FROM group_marks WHERE classno = '{$nclassno}' AND group_name='{$group_name}' AND is_deleted='0'";
        // echo $select_sql;
        // die();
        // $run_sql = mysqli_query($conn,$select_sql);

        // $count_rows = mysqli_num_rows($run_sql);

        // if($count_rows == 1){
            $sql = "UPDATE group_marks SET classno = '{$classno}' , semester = '{$semester}' , marks = '{$marks}' , average = '{$average}' , rank = '{$rank}' WHERE classno='{$classno}' AND group_name='{$group_name}' AND is_deleted='0'";

            $run = mysqli_query($conn,$sql);

            // echo $sql;
            // die();
    
            if($sql){
                header('Location: student_add_marks.php?name='.$group_name.'&run=success');
            }else{
                header('Location: student_add_marks.php?name='.$group_name.'&run=failed');
            }
        // }else{
        //     header('Location: student_add_marks.php?name='.$group_name.'&student_marks=already_save');
        // }

        
    }

?>

<form action="" method="POST">
    <input type="text" name="classno" class="sec_formname" value=<?php echo $vals['classno']; ?> required="" disabled><br>
    <select name="semester" class="semester_op">
            <option value="Semester 1"<?php if($vals['semester'] == 'Semester 1'){echo ('selected');}?>>Semester 1</option>
            <option value="Semester 2"<?php if($vals['semester'] == 'Semester 2'){echo ('selected');}?>>Semester 2</option>
            <option value="Semester 3"<?php if($vals['semester'] == 'Semester 3'){echo ('selected');}?>>Semester 3</option>
    </select><br>
    <input type="text" name="marks" class="sec_formname" placeholder="marks" required="" value=<?php echo $vals['marks']; ?>><br>
    <input type="text" name="average" class="sec_formname" placeholder="average" required="" value=<?php echo $vals['average']; ?>><br>
    <input type="text" name="rank" class="sec_formname" placeholder="rank" required="" value=<?php echo $vals['rank']; ?>><br>
    <input type="submit" value="Save" name = "submit_marks" class = "sec_submit">
</form>