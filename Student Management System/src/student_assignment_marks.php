<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>
    <div class='back_div'><a href="admin.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Admin Page</a></div>

    <a href="view_std_assignment_marks.php?from=admin" class="view_as_std"><i class="fa fa-eye" aria-hidden="true"></i>View As Student</a>
    <?php
        echo "<a href='student_assignment_marks.php' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
        if(isset($_GET['up_sec'])){
            if($_GET['up_sec'] == 'success'){
                echo '<p class="info">You have successfully edit name!</p>';
            }
            else if($_GET['up_sec'] == 'failed'){
                echo "<p class='not_details_up'>Name already taken!</p>";
            }
        }

        //echo "<a href='' id='add_ns' onclick='myfunc()'>Add new</a>";
        
        if(isset($_GET['sec_ad'])){
            if($_GET['sec_ad'] == 'success'){
                echo "<p class='info'>Successfully created a Assignment mark adding section!</p>";
            }
            else if($_GET['sec_ad'] == 'failed'){
                echo "<p class='not_details_up'>Failed to created a section!</p>";
            }
        }

        ?>
        <form action="" method="post" id="addnew_section">    <!--when js correct change this-->
            <p class="addnew_sec_p"><i class='fa fa-plus' aria-hidden='true'></i>Add New : </p>
            <input type="text" name="name" class="sec_formname" required="">
            <input type="submit" value="Add" name="submit" id="sec_formname_btn">
        </form>
        <?php
        $sql = "SELECT * FROM assignment_names WHERE is_deleted = '0' ORDER BY id DESC";
        $res = mysqli_query($conn,$sql);
        if($res){
            // echo "ela"."<br><br><br>";
            $count = mysqli_num_rows($res);
            if($count>0){
                echo "<table id='sec_name_id'>";
                echo "<tr><th>Assignment Name</th><th>Edit</th><th>Delete</th></tr>";
                while($result = mysqli_fetch_assoc($res)){
                    echo "<tr><td><a href='student_assignment_add_marks.php?name={$result['group_name']}' class='sec_name_txt'>{$result['group_name']}</a></td><td><a href='edit_assignment_section.php?name={$result['group_name']}'  class='sec_name_txt sec_name_blue'>Edit</a></td><td><a href='del_assignment_section.php?name={$result['group_name']}' onclick=\"return confirm('Are you sure?');\"  class='sec_name_txt sec_name_blue'>Delete</a></td></tr>";
                    // have to create files
                }
                echo "</table>";

            }
        }
    
    ?>

    <?php
        if(isset($_POST['submit'])){
            $group_name = $_POST['name'];
            // echo $group_name;

            $sql_sec = "SELECT * FROM assignment_names WHERE group_name='{$group_name}' AND is_deleted = '0' LIMIT 1";
            $res = mysqli_query($conn,$sql_sec);
            $count = mysqli_num_rows($res);

            if($count == 0){
                $sql = "INSERT INTO assignment_names(group_name) VALUES('{$group_name}')";
                $res = mysqli_query($conn,$sql);

                unset($group_name);

                if($sql){
                    header('Location: student_assignment_marks.php?sec_ad=success');
                    //echo "<p class='info'>Successfully created a mark adding section!</p>";
                }else{
                    //echo "<p class='not_details_up'>Failed to created a section!</p>";
                    header('Location: student_assignment_marks.php?sec_ad=failed');
                }
            }else{
                echo "<p class='not_details_up'>Assignment Name already taken!</p>";
            }

            
        }
    ?>
</body>
</html> 