<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Categoria.php');
$mensagens = include('../config/mensagens.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $database = new Database();
    $db = $database->getConnection();
    $categoria = new Categoria($db);
    
    $categoria->id = $_POST['id_categoria'];
    $categoria->fk_usuario_id = $_SESSION['id'];
    
    if ($categoria->excluir()) {
        $_SESSION['msg_sucesso'] = $mensagens['categoria_excluida'];
        header("Location: ../View/inicio.php");
        exit();
    } else {
        $_SESSION['msg_erro'] = $mensagens['categoria_em_uso'];
        header("Location: ../View/inicio.php");
        exit();
    }
    
} else {
    header("Location: ../View/Inicio.php");
    exit();
}
?>
