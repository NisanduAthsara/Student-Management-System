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

<div class="back_to"><a href="notices.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>

<h1 class="h1-manage_notices">Manage Notices</h1> 

<?php

	if(isset($_GET['update'])){
		if($_GET['update'] == 'failed'){
			echo "<p class='not_details_up'>Unable to Update!</p>";
		}else if($_GET['update'] == 'success'){
			echo "<p class='details_up'>Successfully Update Notice!</p>";
		}
	}

	if(isset($_GET['delete'])){
		if($_GET['delete'] == 'failed'){
			echo "<p class='not_details_up'>Unable to delete!</p>";
		}else if($_GET['delete'] == 'success'){
			echo "<p class='details_up'>Successfully delete Notice!</p>";
		}
	}

?>

<a href="add_new_notice.php?from=manage" class='add_new new_not_link'><i class='fa fa-plus' aria-hidden='true'></i>Add New Notice</a> <span class='af_ad'>|</span> <a href='manage_notice.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh</a>

<?php

//SELECT left(content, 10,title,author) from notices WHERE id=3;

$sql = "SELECT * FROM notices WHERE is_deleted='0' ORDER BY id DESC";

$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

if($count>0){

	echo "<table style='border: solid 1px black;' id='not_manage_table'>";
	echo "<tr><th>Title</th><th>Author</th><th>Send Time</th><th>Type</th><th>Edit</th><th>Delete</th></tr>";
	while($res = mysqli_fetch_assoc($query)){
		echo "<tr><td>".$res['title']."</td><td>".$res['author']."</td><td>".$res['sendtime']."</td><td>".$res['type']."</td><td><a href='edit_notice.php?id={$res['id']}' class='edit_not_manage_table'>Edit</a></td><td><a href='delete_notice.php?id={$res['id']}' onclick=\"return confirm('Are you sure?');\" class='del_not_manage_table'>Delete</a></td></tr>";
	}
	echo "</table>";

}

?>