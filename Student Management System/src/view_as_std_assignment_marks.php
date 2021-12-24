<?php

session_start();
include('inc/db_con.php');

if(isset($_GET['from'])){
    if(!isset($_SESSION['tindex'])){
        header('Location: ../index.php');
    }else{
        include('inc/admin_log_out.php');
        echo "<div class='back_div'><a href=\"view_std_assignment_marks.php?from=admin\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
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
if(!isset($_GET['from'])){
    echo "<div class='back_div'><a href=\"view_std_assignment_marks.php\" class=\"back_to_reg\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</a></div>";
}
?>

<?php
if(isset($_GET['name'])){
        
    $name_url = $_GET['name'];

    if(isset($_GET['from'])){
        echo "<a href='view_as_std_assignment_marks.php?from=admin&name={$name_url}' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
    }else{
        echo "<a href='view_as_std_assignment_marks.php?name={$name_url}' class='refresh new_refre'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
    }
?>
<form action="" method="POST">
    <input type="text" name="search" class="search" placeholder="Search By Class No." autofocus required='' value='<?php if(isset($search)){echo $search;}?>'>
    <input type="submit" value="Search" class="search_btn">
</form>
<?php
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM assignment_marks WHERE (classno LIKE '%{$search}%' AND group_name = '{$name_url}') AND is_deleted='0'";
        
        // echo $sql;
        // die();

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        if($count>0){
            echo "<table id='view_as_std_marks_table'>";
            echo "<tr><th>Class no.</th><th>Marks</th></tr>";
            while($res = mysqli_fetch_assoc($result)){
                echo "<tr><td>{$res['classno']}</td><td>{$res['marks']}</td></tr>";
            }
            echo "</table>";
        }else{
            echo "<p class='not_details_up'>Marks Not Found!</p>";
        }
    }
    else{
        $sql = "SELECT * FROM assignment_marks WHERE group_name='{$name_url}' AND is_deleted = '0' ORDER BY classno";

        $result = mysqli_query($conn,$sql);

        if($result){
            $count = mysqli_num_rows($result);

            if($count>0){
            // echo "hi";
                echo "<table id='view_as_std_marks_table'>";
                echo "<tr><th>Class no.</th><th>Marks</th></tr>";
                while($res = mysqli_fetch_assoc($result)){
                    echo "<tr><td>{$res['classno']}</td><td>{$res['marks']}</td></tr>";
                }
                echo "</table>";
            }else{
                echo "<p class='not_details_up'>Marks Not Found!</p>";
            }
        }else{
            echo "<p class='not_details_up'>Something went wrong!</p>";
        }
    }
    

}else{
    echo "<p class='not_details_up'>Something went wrong!</p>";
    die();
}

?>