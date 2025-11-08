<?php 

require_once('../Model/Database.php');
require_once('../Model/Usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);

    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email'];
    $usuario->senha = $_POST['senha'];

    if ($usuario->emailExiste()){
        header("Location: ../View/cadastro.php?erro=2");
        exit();
    }

    if ($usuario->cadastrar()){
        header("Location: ../View/login.php?sucesso=1");
        exit();
    } else{
        header("Location: ../View/cadastro.php?erro=1");
        exit();
    }
} else{
    header("Location: ../View/cadastro.php");
    exit();
}
?>