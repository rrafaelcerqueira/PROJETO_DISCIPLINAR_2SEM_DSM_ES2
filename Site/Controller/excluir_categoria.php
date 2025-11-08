<?php
require_once('sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Categoria.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $database = new Database();
    $db = $database->getConnection();
    $categoria = new Categoria($db);

    $categoria->id = $_POST['id_categoria'];
    $categoria->fk_usuario_id = $_SESSION['id'];
    $categoria->excluir();

    header("Location: ../View/cria_tarefa.php?sucesso_cat=2");

} else {
    header("Location: ../View/Inicio.php");
}
exit();
?>