<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Categoria.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $categoria = new Categoria($db);

    $categoria->nome = $_POST['nome_categoria'];
    $categoria->fk_usuario_id = $_SESSION['id'];

    if ($categoria->criar()) {
        $_SESSION['msg_sucesso'] = $mensagens['categoria_criada'];
    } else {
        $_SESSION['msg_erro'] = $mensagens['erro_generico'];
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>