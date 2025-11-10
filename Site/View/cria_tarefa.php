<?php
require_once('../Controller/sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Categoria.php');

$database = new Database();
$db = $database->getConnection();
$categoria = new Categoria($db);

$categoria->fk_usuario_id = $_SESSION['id'];

$resultadoCategorias = $categoria->listar();

$listaCategoriasArray = [];
while ($row = $resultadoCategorias->fetch_assoc()) {
    $listaCategoriasArray[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <input type="file" id="uploadBackground" accept="image/*" style="display: none;">

    <div class="floating-buttons">
        <button id="logoutBtn" class="btn btn-danger btn-floating mb-2" title="Sair">
            <i class="bi bi-box-arrow-left"></i>
        </button>
        <label for="uploadBackground" class="btn btn-primary btn-floating mb-2" title="Mudar Fundo">
            <i class="bi bi-image"></i>
        </label>
        <button id="removeBackground" class="btn btn-secondary btn-floating" title="Remover Fundo">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php include_once('alertas.php'); ?>

                <div class="card shadow-sm border-0 task-card">
                    <div class="card-header bg-transparent border-bottom-0">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="criar-tab" data-bs-toggle="tab" data-bs-target="#criar-pane" type="button" role="tab" aria-controls="criar-pane" aria-selected="true">
                                    Criar Tarefa
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="categorias-tab" data-bs-toggle="tab" data-bs-target="#categorias-pane" type="button" role="tab" aria-controls="categorias-pane" aria-selected="false">
                                    Categorias
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="criar-pane" role="tabpanel" aria-labelledby="criar-tab">
                                <form action="../Controller/add_tarefa.php" method="POST">
                                    <div class="mb-3">
                                        <label for="taskName" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="taskName" name="nome" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="taskCategory" class="form-label">Categoria:</label>
                                            <select class="form-select" id="taskCategory" name="fk_categoria_id">
                                                <option selected disabled value="">Selecione...</option>

                                                <?php foreach ($listaCategoriasArray as $row_cat) : ?>
                                                    <option value="<?php echo $row_cat['id']; ?>"><?php echo htmlspecialchars($row_cat['nome']); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="taskDate" class="form-label">Data de Expiração:</label>
                                            <input type="date" class="form-control" id="taskDate" name="data">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="taskDescription" class="form-label">Descrição:</label>
                                        <textarea class="form-control" id="taskDescription" name="descricao" rows="5"></textarea>
                                    </div>
                                    <div class="text-end mt-3">
                                        <a href="Inicio.php" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary ms-2">Criar Tarefa</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="categorias-pane" role="tabpanel" aria-labelledby="categorias-tab">
                                <form action="../Controller/add_categoria.php" method="POST">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Nome:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="categoryName" name="nome_categoria" placeholder="Nova categoria" required>
                                            <button class="btn btn-primary" type="submit">Criar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <label class="form-label">Categorias Criadas:</label>
                                <div class="category-list-container" style="max-height: 250px; overflow-y: auto;">

                                    <?php foreach ($listaCategoriasArray as $row_cat) : ?>
                                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                            <span><?php echo htmlspecialchars($row_cat['nome']); ?></span>
                                            <div>
                                                <button type="button" class="btn btn-warning btn-sm me-2 edit-categoria"
                                                    data-id="<?php echo $row_cat['id']; ?>"
                                                    data-nome="<?php echo htmlspecialchars($row_cat['nome']); ?>">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <form action="../Controller/excluir_categoria.php" method="POST" class="d-inline m-0">
                                                    <input type="hidden" name="id_categoria" value="<?php echo $row_cat['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Deletar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoriaModal" tabindex="-1" aria-labelledby="editCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../Controller/editar_categoria.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoriaModalLabel">Editar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_categoria" name="id_categoria">
                        <div class="mb-3">
                            <label for="edit_nome_categoria" class="form-label">Nome da Categoria:</label>
                            <input type="text" class="form-control" id="edit_nome_categoria" name="nome_categoria" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>
