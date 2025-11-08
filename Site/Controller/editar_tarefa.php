<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $database = new Database();
    $db = $database->getConnection();
    $tarefa = new Tarefa($db);

    $tarefa->nome = $_POST['nome'];
    $tarefa->data = $_POST['data'];
    $tarefa->descricao = $_POST['descricao'];
    $tarefa->fk_categoria_id = !empty($_POST['fk_categoria_id']) ? $_POST['fk_categoria_id'] : null;
    $tarefa->fk_estado_id = $_POST['fk_estado_id'];

    $tarefa->fk_usuario_id = $_SESSION['id'];

    if ($tarefa->editar()) {
        header("Location: ../View/Inicio.php?sucesso=2");
    } else {
        header("Location: ../View/edita_tarefa.php?id=" . $tarefa->id . "&erro=1");
    }
} else {
    header("Location: ../View/Inicio.php");
}
exit();
