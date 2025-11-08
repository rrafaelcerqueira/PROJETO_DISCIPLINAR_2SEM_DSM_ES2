<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $database = new Database();
    $db = $database->getConnection();
    $tarefa = new Tarefa($db);

    $tarefa->id = $_POST['id_tarefa'];
    $tarefa->fk_usuario_id = $_SESSION['id'];

    $tarefa->excluir(); 

    header("Location: ../View/Inicio.php");
} else {
    header("Location: ../View/Inicio.php");
}
exit();
?>