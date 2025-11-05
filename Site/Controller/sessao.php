<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../View/login.php?erro=2");
    exit();
}

?>