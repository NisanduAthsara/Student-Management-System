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


<div class="back_to"><a href="admin.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back to Admin Page</a></div>

<a href="add_new_behaviour.php" class='add_new new_not_link'><i class='fa fa-plus' aria-hidden='true'></i>Add New Behaviour</a> <span class='af_ad'>|</span> <a href='behaviour.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh<span class='af_ad'>|</span></a>

<a href="manage_behaviour.php" class="refresh"><i class="fa fa-pencil" aria-hidden="true"></i> Manage</a>


<?php

    $sql = "SELECT * FROM behaviour WHERE is_deleted = '0' ORDER BY id DESC";

    // echo $sql;
    // die();

    $query = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($query);

    $rows = 1;

    if($count>0){

        while($res = mysqli_fetch_assoc($query)){

            $classno = $res['classno'];

            $sqlquery = "SELECT * FROM sample_usertable WHERE classno = '{$classno}' AND is_deleted = '0' LIMIT 1";

            $run = mysqli_query($conn,$sqlquery);

            $result = mysqli_fetch_assoc($run);

            echo "<div class='std_behaviour_div'>";

            echo "<p class='behav_to_p'><span>To : </span>{$result['first_name']} {$result['last_name']} ({$res['classno']}) ({$result['indexno']})</p>";

            if($res['teacher'] == $_SESSION['tfname']){
                $from = "Me";
            }else{
                $from = $res['teacher'];
            }

            echo "<p class='behav_to_p'>From : {$from}</p>";

            echo "<p class='behav_content'>{$res['behaviour']}</p>";

            echo "<p class='behav_date'>{$res['date']}</p>";

            echo "</div><br>";

        }


    }


?>