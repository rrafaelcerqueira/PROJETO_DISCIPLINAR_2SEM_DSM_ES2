<?php
session_start();
require_once('../Model/Database.php');
require_once('../Model/Usuario.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);

    $usuario->email = $_POST['email'];
    $usuario->senha = $_POST['senha'];

    if ($usuario->login()) {
        $_SESSION['id'] = $usuario->id;
        $_SESSION['usuario'] = $usuario->nome;
        header("Location: ../View/Inicio.php");
        exit();
    } else {
        $_SESSION['msg_erro'] = $mensagens['login_invalido'];
        header("Location: ../View/login.php");
        exit();
    }
} else {
    header("Location: ../View/login.php");
    exit();
}
