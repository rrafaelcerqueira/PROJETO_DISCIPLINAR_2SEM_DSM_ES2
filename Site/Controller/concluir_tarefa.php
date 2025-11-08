<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $database = new Database();
    $db = $database->getConnection();
    $tarefa = new Tarefa($db);

    $tarefa->id = $_POST['id_tarefa'];
    $tarefa->fk_estado_id = 2;
    $tarefa->fk_usuario_id = $_SESSION['id'];

    if ($tarefa->mudarEstado()) {
        $_SESSION['msg_sucesso'] = $mensagens['tarefa_concluida'];
        header("Location: ../View/Inicio.php");
        exit();
    } else {
        $_SESSION['msg_erro'] = $mensagens['erro_generico'];
        header("Location: ../View/Inicio.php");
        exit();
    }
} else {
    header("Location: ../View/Inicio.php");
    exit();
}
