<?php
	session_start();
	include('inc/db_con.php');
	if(!isset($_SESSION['sindex'])){
		header('Location: ../index.php');
	}
    include('inc/std_log_out.php')
?>

<div class='back_div'><a href="student.php" class="back_to_reg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>

<?php

	$sql = "SELECT * FROM settings WHERE user_behaviour='Yes' AND id = '1' LIMIT 1";

	$query = mysqli_query($conn,$sql);

	$count = mysqli_num_rows($query);

	if($count>0){

	}else{
		header('Location: student.php?block_behaviour=yes');
	}

?>


<?php

$sql = "SELECT * FROM behaviour WHERE is_deleted = '0' AND classno = '{$_SESSION['sclassno']}' ORDER BY id DESC";

$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

if($count>0){

    while($res = mysqli_fetch_assoc($query)){
        $teacher = $res['teacher'];

        $sqlquery = "SELECT * FROM sample_usertable WHERE first_name = '{$teacher}' AND is_deleted = '0' LIMIT 1";

        $run = mysqli_query($conn,$sqlquery);

        $result = mysqli_fetch_assoc($run);

        echo "<div class='std_behaviour_div'>";

        echo "<p class='behav_to_p'>From : {$result['first_name']} {$result['last_name']}</p>";

        echo "<p class='behav_content'>{$res['behaviour']}</p>";

        echo "<p class='behav_date'>{$res['date']}</p>";

        echo "</div><br>";
    }


}else{ 
    echo "<p class='details_up behav_not_p'>Haven't Any Behaviour To You!</p>";
}

?>