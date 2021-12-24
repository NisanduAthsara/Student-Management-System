<?php
session_start();
include('inc/db_con.php');
include('inc/admin_log_out.php');
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>
<?php
if(isset($_GET['run'])){
    if($_GET['run'] == 'success'){
        echo '<p class="info">You have successfully edit student marks!</p>';
    }
    else if($_GET['run'] == 'failed'){
        echo "<p class='not_details_up'>Something went wrong!</p>";
    }
}

if(isset($_GET['student_marks'])){
    if($_GET['student_marks'] == 'already_save'){
        echo "<p class='not_details_up'>Student class no is already taken!</p>";
    }
}

if(isset($_GET['del_std_marks'])){
    if($_GET['del_std_marks'] == 'yes'){
        echo '<p class="info">You have successfully delete student marks!</p>';
    }
    else if($_GET['del_std_marks'] == 'no'){
        echo "<p class='not_details_up'>Something went wrong!</p>";
    }
}

if(isset($_GET['name'])){
    $name_url = $_GET['name'];

    if(isset($_POST['submit_marks'])){
        $classno = $_POST['classno'];
        //$semester = $_POST['semester'];
        $marks = $_POST['marks'];
        //$average = $_POST['average'];
        //$rank = $_POST['rank'];

        $sql_query = "SELECT * FROM assignment_marks WHERE classno='{$classno}' AND group_name='{$name_url}' AND is_deleted='0' LIMIT 1";
        // echo $sql_query;
        // die();
        $query = mysqli_query($conn,$sql_query);
        $count = mysqli_num_rows($query);

        if($count == 0){

            $sql = "INSERT INTO assignment_marks(classno,group_name,marks) VALUES('{$classno}','{$name_url}','{$marks}') LIMIT 1";
            // echo $sql;
            // die();
            
            $run_sql = mysqli_query($conn,$sql);

            unset($classno);
            //unset($semester);
            unset($marks);
            // unset($average);
            // unset($rank);

            if($run_sql){
                echo '<p class="info">You have successfully add student marks!</p>';
               // header('Location: student_marks.php');
            }


            

            // echo "Successfully inserted!";
        }else{
            echo "<p class='not_details_up'>User marks already added!</p>";
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class='back_div'><a href="student_assignment_marks.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
<!-- <a href='student_add_marks?name={$name_url}.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a> -->

<?php
echo "<a href='student_assignment_add_marks.php?name={$name_url}' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
?>

    <form action="" method="POST">
        <input type="text" name="search" class="search " placeholder="Search By Class No." autofocus required='' value='<?php if(isset($search)){echo $search;}?>'>
        <input type="submit" value="Search" class="search_btn">
    </form>
    <form action="" method="post">
        <p class="addnew_sec_p margin_mi_search"><i class='fa fa-plus' aria-hidden='true'></i>Add New : </p>
        <input type="text" name="classno" class="sec_formname" placeholder="Class No." required=""><br>
        <input type="text" name="marks" class="sec_formname" placeholder="Marks" required=""><br>
        <input type="submit" value="Submit" name = "submit_marks" class = "sec_submit">
    </form>

    <!-- <?php
   // $sql = "INSERT INTO group_marks(classno,group_name,semester,marks,average,rank) VALUES()";
    ?> -->

    <?php

        if(isset($_GET['name'])){

            if(isset($_POST['search'])){
                $search = $_POST['search'];
                $sql = "SELECT * FROM assignment_marks WHERE group_name='{$name_url}' AND is_deleted = '0' AND classno = '{$search}' ORDER BY classno";

                $result = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($result);

                if($count>0){
                    echo "<table id='sec_ad_marks_table'>";
                    echo "<tr><th>Class No.</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
                    while($res = mysqli_fetch_assoc($result)){
                        echo "<tr><td>{$res['classno']}</td><td>{$res['marks']}</td><td><a href='edit_std_assignment_marks.php?classno={$res['classno']}&name={$name_url}' class='sec_name_blue sec_name_txt'>Edit</a></td><td><a href='del_std_assignment_marks.php?classno={$res['classno']}&name={$name_url}' onclick=\"return confirm('Are you sure?');\" class='sec_name_blue sec_name_txt'>Delete</a></td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo "<p class='not_details_up'>Marks Not Found!</p>";
                }
            }else{
                $sql = "SELECT * FROM assignment_marks WHERE group_name='{$name_url}' AND is_deleted = '0' ORDER BY classno";

                $result = mysqli_query($conn,$sql);

                if($result){
                    $count = mysqli_num_rows($result);

                    if($count>0){
                    // echo "hi";
                        echo "<table id='sec_ad_marks_table'>";
                        echo "<tr><th>Class No.</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>";
                        while($res = mysqli_fetch_assoc($result)){
                            echo "<tr><td>{$res['classno']}</td><td>{$res['marks']}</td><td><a href='edit_std_assignment_marks.php?classno={$res['classno']}&name={$name_url}' class='sec_name_blue sec_name_txt'>Edit</a></td><td><a href='del_std_assignment_marks.php?classno={$res['classno']}&name={$name_url}' onclick=\"return confirm('Are you sure?');\" class='sec_name_blue sec_name_txt'>Delete</a></td></tr>";
                        }
                        echo "</table>";
                    }
                }else{
                    echo "<p class='not_details_up'>Something went wrong!</p>";
                }
            }   

        }
    ?>
</body>
</html>