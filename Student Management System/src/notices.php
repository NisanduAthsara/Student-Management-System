<?php
	session_start();
	include('inc/db_con.php');

    if(!isset($_GET['from'])){
        if(!isset($_SESSION['tindex'])){
            header('Location: ../index.php');
        }else{
            include('inc/admin_log_out.php');
        }
    }else{
        if(!isset($_SESSION['sindex'])){
            header('Location: ../index.php');
        }else{
            $sql = "SELECT user_notice FROM settings WHERE user_notice = 'No' LIMIT 1";

            $query = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($query);

            if($count>0){
                header('Location: student.php?block_notice=yes');
            }else{
                include('inc/std_log_out.php');
            }

        }
    }
?>
<!-- <?php
// include('inc/admin_log_out.php')
?> -->

<?php

if(!isset($_GET['from'])){
    ?>

        <div class="back_to"><a href="admin.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back to Admin Page</a></div>

        <a href="add_new_notice.php" class='add_new new_not_link'><i class='fa fa-plus' aria-hidden='true'></i>Add New Notice</a> <span class='af_ad'>|</span> <a href='notices.php' class='refresh'><i class='fa fa-refresh' aria-hidden='true'></i>      Refresh<span class='af_ad'>|</span></a>

        <a href="manage_notice.php" class="refresh"><i class="fa fa-pencil" aria-hidden="true"></i> Manage</a>

    <?php
}else{

    ?>

    <div class="back_to"><a href="student.php" class="back_to_a"><i class="fa fa-arrow-left" aria-hidden="true"></i>   Back</a></div>
    
    <?php

}

?>


<?php

if(isset($_GET['add_new'])){
    if($_GET['add_new'] == 'success'){
        echo "<p class='details_up'>Successfully Add Notice</p>";
    }else{
        echo "<p class='not_details_up'>Unable to Add Notice!</p>";
    }
}

$sql = "SELECT * FROM notices WHERE is_deleted='0' ORDER BY id DESC";

$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

if($count>0){
    while($res = mysqli_fetch_assoc($query)){

        if($res['type'] == 'Normal'){
            echo "<div class='normal_notice notices_div'>";
        }else if($res['type'] == 'Attention'){
            echo "<div class='attention_notice notices_div'>";
        }

        echo "<h1 class='notice_h'>".$res['title']."</h1>";

        echo "<p class='notice_content'>".$res['content']."</p>";

        echo "<p class='notice_author'>- ".$res['author']."</p>";

        echo "<p class='notice_time'>".$res['sendtime']."</p>";

        echo "</div>";
    }
}

?>