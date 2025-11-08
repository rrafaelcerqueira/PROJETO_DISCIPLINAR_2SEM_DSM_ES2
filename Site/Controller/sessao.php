<?php
session_start();
$mensagens = include(__DIR__ . '/../config/mensagens.php');
if (!isset($_SESSION['id'])) {
    $_SESSION['msg_erro'] = $mensagens['login_necessario'];
    header("Location: ../View/login.php");
    exit();
}
?>