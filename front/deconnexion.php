<?php require_once "./inc/init.php";

if(isConnected()){
    unset($_SESSION['user']);
} 

header("location:index.php");
exit;

?>