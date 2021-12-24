<?php
session_start();

// session_destroy();

if(isset($_SESSION['sindex'])){
    unset($_SESSION['sindex']);
}else if(isset($_SESSION['tindex'])){
    unset($_SESSION['tindex']);
}

header('Location: ../index.php?logout=yes');


?>