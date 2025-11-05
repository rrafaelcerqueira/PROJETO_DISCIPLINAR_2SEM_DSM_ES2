<?php 
    session_start();

    require_once '../Model/Database.php';
    require_once '../Model/Usuario.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $database = new Database();
        $db = $database->getConnection();
        $usuario = new Usuario($db);

        $usuario->email = $_POST['email'];
        $usuario->senha = $_POST['senha'];

        if ($usuario->login()){
            $_SESSION['id'] = $usuario->id;
            $_SESSION['usuario'] = $usuario->nome;

            header("Location: ../View/inicio.html");
            exit();
        } else {
            header("Location: ../View/login.php?erro=1");
        }
    } else {
        header("Location: ../View/login.php");
        exit();
    }
?>