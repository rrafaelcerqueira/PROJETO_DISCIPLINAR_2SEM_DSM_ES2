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
    $tarefa->nome = $_POST['nome'];
    $tarefa->data_expiracao = $_POST['data'];
    $tarefa->descricao = $_POST['descricao'];
    $tarefa->fk_categoria_id = !empty($_POST['fk_categoria_id']) ? $_POST['fk_categoria_id'] : null;

    $tarefa->fk_usuario_id = $_SESSION['id'];

    if ($tarefa->editar()) {
        $_SESSION['msg_sucesso'] = $mensagens['tarefa_editada'];
        header("Location: ../View/Inicio.php");
    } else {
        $_SESSION['msg_erro'] = $mensagens['erro_generico'];
        header("Location: ../View/edita_tarefa.php?id=" . $tarefa->id);
    }
} else {
    header("Location: ../View/Inicio.php");
}
exit();