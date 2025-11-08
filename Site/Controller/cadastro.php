<?php 
session_start();
require_once('../Model/Database.php');
require_once('../Model/Usuario.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ($_POST['senha'] != $_POST['confirmar_senha']) {
        $_SESSION['msg_erro'] = $mensagens['senhas_nao_conferem'];
        header("Location: ../View/cadastro.php");
        exit();
    }

    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);

    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email'];
    $usuario->senha = $_POST['senha'];

    if ($usuario->emailExiste()){
        $_SESSION['msg_erro'] = $mensagens['email_em_uso'];
        header("Location: ../View/cadastro.php");
        exit();
    }

    if ($usuario->cadastrar()){
        $_SESSION['msg_sucesso'] = $mensagens['cadastro_ok'];
        header("Location: ../View/login.php");
        exit();
    } else{
        $_SESSION['msg_erro'] = $mensagens['erro_generico'];
        header("Location: ../View/cadastro.php");
        exit();
    }
} else{
    header("Location: ../View/cadastro.php");
    exit();
}
?>