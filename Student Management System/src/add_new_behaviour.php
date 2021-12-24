<?php
	session_start();
	include('inc/db_con.php');
	if(!isset($_SESSION['tindex'])){
		header('Location: ../index.php');
	}
?>
<?php
include('inc/admin_log_out.php')
?>

<div class="back_to"><a href="behaviour.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<h1 class="h1_add_new_behav">Select a Student</h1>

<?php

if(isset($_GET['add'])){
    if($_GET['add'] !== 'failed'){
        echo "<p class='details_up'>Successfully add student Behaviour!</p>";
    }
    else if($_GET['add'] !== 'have'){
        echo "<p class='not_details_up'>Behaviour already added!</p>";
    }
    else{
        echo "<p class='not_details_up'>Something went wrong!</p>";
    }
}

?>

<a href='add_new_behaviour.php' class='refresh move_Right'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>

<form method="GET">
    <input type="text" placeholder="Search students by Class No. , Name , Index number" id="search" class="search_move_right" name="search" autofocus required='' value='<?php if(isset($search)){echo $search;}?>'>
</form>

<?php
    if(isset($_GET['search'])){
        $search = $_GET['search'];

        $sql = "SELECT * FROM sample_usertable WHERE(classno LIKE '%{$search}%' OR first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR indexno LIKE '%{$search}%')AND user_type = 'Student' AND is_deleted = '0' ";
    }else{
        $sql = "SELECT * FROM sample_usertable WHERE user_type = 'Student' AND is_deleted = '0'";
    }

    $query = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($query);

    if($count>0){
        echo "<table style='border: solid 1px black;' id='behav_table'>";
        echo "<tr><th>Class No.</th><th>Name</th><th>Index No.</th></tr>";

        while($res = mysqli_fetch_assoc($query)){
            echo "<tr><td><a href='add_a_new_behaviour.php?classno={$res['classno']}' class='rem_un'>{$res['classno']}</a></td><td>{$res['first_name']} {$res['last_name']}</td><td>{$res['indexno']}</td></tr>";
        }

        echo "</table>";
    }else{
        echo "<p class='details_up behav_not_p'>No results found!</p>";
    }

?>