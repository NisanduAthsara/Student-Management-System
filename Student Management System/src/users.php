<?php
session_start();
if(!isset($_SESSION['tindex'])){
    header('Location: ../index.php');
}
?>
<!-- <?php
// 	if(!isset($_SESSION['tindex'])){        //************** Bug ********************
// 		header('Location: ../index.php');
// 	}
// ?> -->
<head>
    <title>Users</title>
</head>
<?php
    include('inc/admin_log_out.php'); //************** Bug ********************
    include('inc/db_con.php')
?>
    <!-- Backup Code -->
    <!-- <div><a href="log_out.php" class="log-out">Logout</a></div>   -->
    <!-- ---------------- -->

    <div class="back_to"><a href="admin.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back to Admin Page</a></div>

    <?php
        if(isset($_GET['register'])){
            echo "<p class='details_up'>You entered student successfully registered!</p>";
        }
        if(isset($_GET['update'])){
            if($_GET['update'] == 'yes'){
                echo "<p class='details_up'>User details updated!</p>";
            }
            else{
                echo "<p class='not_details_up'>Unable to update User details!</p>";
            }
        }
        if(isset($_GET['del'])){
            if($_GET['del'] == 'yes'){
                echo "<p class='details_up'>Successfully Deleted User</p>";
            }
            else{
                echo "<p class='not_details_up'>Unable to delete User!</p>";
            }
        }
        if(isset($_GET['err'])){
            if($_GET['err'] == 'cannot_delete_crnt_user'){
                echo "<p class='not_details_up'>You Cannot delete your account!</p>";
            }
        }        
    ?>
    
<?php
    //pages = add_new.php , modify_user.php , delete_user.php

    if(isset($_GET['search'])){
        $search = $_GET['search'];

        $sql = "SELECT first_name,last_name,indexno,classno,telno,grade,class,user_type,email,pwd FROM sample_usertable WHERE (first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR classno LIKE '%{$search}%')AND user_type!='Teacher' AND is_deleted='0'";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count==0){
            echo "<p class='not_details_up'>No Users Found!</p>"."<br>";
            echo "<a href='register.php?from=admin' class='add_new'><span></span>  <i class='fa fa-plus' aria-hidden='true'></i>Add New</a> <span class='af_ad'>|</span> <a href='users.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";
            die();
        }
    }else{
        $sql = "SELECT first_name,last_name,indexno,telno,grade,class,user_type,email,pwd,classno FROM sample_usertable WHERE user_type='Student' AND is_deleted='0'";

    }

    $res = mysqli_query($conn,$sql);

    echo "<span class='u_count'>".mysqli_num_rows($res)." Students are available</span>";
    echo "<a href='register.php?from=admin' class='add_new'><span>|</span>  <i class='fa fa-plus' aria-hidden='true'></i>Add New</a> <span class='af_ad'>|</span> <a href='users.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>";

    ?>
    <div>
        <form method="GET">
        <p><input type="text" name="search" id="search" placeholder='Enter First name or last name or class number and enter' autofocus required='' value='<?php if(isset($search)){echo $search;}?>'></p>
    </form>
    </div>
    <?php

    if(mysqli_num_rows($res)>0){
        echo "<table style='border: solid 1px black;' id='u_table'><tr><th>Class No.</th><th>First Name</th><th>Last Name</th><th>Index No.</th><th>Tel. No.</th><th>Email</th></tr>";
        while($row = mysqli_fetch_assoc($res)){
            $class = $row['grade']."-".$row['class'];
            echo "<tr><td><a href='std_profile.php?from=admin&classno={$row['classno']}' class='rem_un'>".$row['classno']."</a></td><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['indexno']."</td><td>".$row['telno']."</td><td>".$row['email']."</td><td>"."<a href='modify_user.php?index_no={$row['indexno']}' class='edit_u_table'>Edit</a>"."</td><td>"."<a href='delete_user.php?index_no={$row['indexno']}' onclick=\"return confirm('Are you sure?');\" class='del_u_table'>Delete</a>"."</tr>";
        }
        echo "</table>";
    }
    
?>
</body>
</html>
<?php
	mysqli_close($conn);
?>