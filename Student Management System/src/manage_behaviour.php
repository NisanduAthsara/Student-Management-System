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

<a href='manage_behaviour.php' class='refresh move_Right'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>

<form method="POST">
    <input type="text" placeholder="Search by Reciever's Class No. or Sender's name" name="search" id="search" class="search_margin_bot">
</form>

<?php

if(isset($_GET['update'])){
    if($_GET['update'] == 'yes'){
        echo "<p class='details_up'>User Behaviour updated!</p>";
    }
    else{
        echo "<p class='not_details_up'>Unable to update Behaviour!</p>";
    }
}
if(isset($_GET['delete'])){
    if($_GET['delete'] == 'success'){
        echo "<p class='details_up'>User Behaviour deleted!</p>";
    }
    else{
        echo "<p class='not_details_up'>Unable to delete Behaviour!</p>";
    }
}

?>

<?php

    if(isset($_POST['search'])){
        $search = $_POST['search'];

        $sql = "SELECT * FROM behaviour WHERE (classno LIKE '%{$search}%' OR teacher LIKE '%{$search}%') AND is_deleted = '0'";
    }else{
        $sql = "SELECT * FROM behaviour WHERE is_deleted = '0'";
    }

    $query = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($query);

    if($count>0){
        echo "<table style='border: solid 1px black;' id='manage_behav_table'>";
        echo "<tr><th>Receiver's Name</th><th>Index No.</th><th>Class No.</th><th>Sender's Name</th><th>Date & Time</th><th>Edit</th><th>Delete</th></tr>";
        while($res = mysqli_fetch_assoc($query)){
            $sqlquery = "SELECT * FROM sample_usertable WHERE classno = '{$res['classno']}' AND is_deleted = '0' LIMIT 1";

            $run = mysqli_query($conn,$sqlquery);

            $result = mysqli_fetch_assoc($run);

            echo "<tr><td>{$result['first_name']}</td><td>{$result['indexno']}</td><td>{$res['classno']}</td><td>{$res['teacher']}</td><td>{$res['date']}</td><td><a href='edit_behaviour.php?id={$res['id']}' class='edit_u_table'>Edit</a></td><td><a href='delete_behaviour.php?id={$res['id']}' onclick=\"return confirm('Are you sure?');\" class='edit_u_table'>Delete</a></td></tr>";
        }
        echo "</table>";
    }else{
        echo "<p class='details_up behav_not_p'>No results found!</p>";
    }

?>