<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $tarefa = new Tarefa($db);

    $tarefa->nome = $_POST['nome'];
    $tarefa->data = $_POST['data'];
    $tarefa->descricao = $_POST['descricao'];
    $tarefa->fk_categoria_id = !empty($_POST['fk_categoria_id']) ? $_POST['fk_categoria_id'] : null;
    $tarefa->fk_usuario_id = $_SESSION['id'];
    $tarefa->fk_estado_id = 1; 

    if (empty($tarefa->fk_usuario_id)) {
        $_SESSION['msg_erro'] = $mensagens['sessao_invalida'];
        header("Location: ../View/login.php");
        exit();
    }

    if ($tarefa->criar()) {
        $_SESSION['msg_sucesso'] = $mensagens['tarefa_criada'];
        header("Location: ../View/Inicio.php");
    } else {
        $_SESSION['msg_erro'] = $mensagens['erro_generico'];
        header("Location: ../View/cria_tarefa.php");
    }
} else {
    header("Location: ../View/Inicio.php");
}
exit();
?>