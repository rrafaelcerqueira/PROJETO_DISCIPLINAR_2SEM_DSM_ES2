<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light shadow-sm px-3">
        <div class="container-fluid d-flex justify-content-end align-items-center">
            <label for="uploadBackground" class="btn btn-secondary btn-sm me-2">
                <i class="bi bi-image"></i> Mudar Fundo
            </label>
            <input type="file" id="uploadBackground" accept="image/*" style="display: none;">
            <button id="removeBackground" class="btn btn-outline-danger btn-sm me-2">
                <i class="bi bi-x-lg"></i> Remover Fundo
            </button>
            <a href="../Controller/logout.php" class="text-decoration-none">
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-box-arrow-left"></i> Sair
                </button>
            </a>
        </div>
    </nav>
    <div class="container py-3">
        <div class="row justify-content-start g-3">
            <div class="col-md-4">
                <div class="card p-3 bg-light shadow">
                    <h5 class="text-center fw-bold mb-4">Tarefas</h5>
                    <div class="task-wrapper mb-2" style="position: relative;">
                        <div class="task-item d-flex justify-content-between align-items-center p-2 bg-white rounded shadow-sm">
                            <span>Fazer Lição de Casa</span>
                            <form action="../Controller/processa_concluir_tarefa.php" method="POST" class="m-0 position-relative" style="z-index: 2;">
                                <input type="hidden" name="id_tarefa" value="1">
                                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                            </form>
                        </div>
                        <a href="edita_tarefa.php" class="stretched-link" aria-label="Editar Tarefa"></a>
                    </div>
                    <div class="container text-end">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                            Nova Tarefa
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 bg-light shadow">
                    <h5 class="text-center fw-bold mb-3">Tarefas Concluídas</h5>
                    <form action="../Controller/processa_excluir_tarefa.php" method="POST">
                        <div class="task-item">
                            <span>Tomar Banho</span>
                            <div>
                                <input type="hidden" name="id_tarefa" value="4">
                                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 task-card">
                    <div class="card-header bg-transparent border-bottom-0">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="editar-tab" data-bs-toggle="tab" data-bs-target="#editar-pane" type="button" role="tab" aria-controls="editar-pane" aria-selected="true">
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
                            <div class="tab-pane fade show active" id="editar-pane" role="tabpanel" aria-labelledby="editar-tab">
                                <form action="Inicio.php" method="POST">
                                    <div class="mb-3">
                                        <label for="taskName" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="taskName" name="nome_tarefa">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="taskCategory" class="form-label">Categoria:</label>
                                            <select class="form-select" id="taskCategory" name="categoria_tarefa">
                                                <option selected disabled value="">Selecione...</option>
                                                <option value="trabalho">Trabalho</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="taskDate" class="form-label">Data:</label>
                                            <input type="date" class="form-control" id="taskDate" name="data_tarefa">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="taskDescription" class="form-label">Descrição:</label>
                                        <textarea class="form-control" id="taskDescription" name="descricao_tarefa" rows="5"></textarea>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-primary ms-2">Criar Tarefa</button>
                                        <a href="Inicio.php">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="categorias-pane" role="tabpanel" aria-labelledby="categorias-tab">
                                <form action="../Controller/processa_nova_categoria.php" method="POST">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Nome:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="categoryName" name="nome_categoria" placeholder="Nova categoria">
                                            <button class="btn btn-primary" type="submit">Criar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <label class="form-label">Categorias Criadas:</label>
                                <div class="category-list-container">
                                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                        <span>Escola</span>
                                        <form action="../Controller/processa_deletar_categoria.php" method="POST" class="m-0">
                                            <input type="hidden" name="id_categoria" value="1">
                                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/script.js"></script>
</body>

</html>