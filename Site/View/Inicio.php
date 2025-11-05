<?php
require_once('../Controller/sessao_admin.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tarefas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/Site/css/style.css">
</head>

<body>

  <!-- Navbar -->
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

  <!-- Conteúdo principal -->
  <div class="container py-5">
    <div class="row justify-content-center g-4">

      <!-- Coluna 1 - Tarefas -->
      <div class="col-md-4">
        <div class="card p-3 bg-light shadow">
          <h5 class="text-center fw-bold mb-3">Tarefas</h5>

          <!-- FORM: concluir tarefa -->
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Fazer Lição de Casa</span>
              <div>
                <input type="hidden" name="id_tarefa" value="1">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                  Editar
                </button>
              </div>
            </div>
          </form>
          <!-- /FORM -->

          <!-- FORM: concluir tarefa -->
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Fazer Compras</span>
              <div>
                <input type="hidden" name="id_tarefa" value="2">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                  Editar
                </button>
              </div>
            </div>
          </form>
          <!-- /FORM -->

          <!-- FORM: concluir tarefa -->
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Almoçar</span>
              <div>
                <input type="hidden" name="id_tarefa" value="3">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                  Editar
                </button>
              </div>
            </div>
          </form>
          <!-- /FORM -->

          <div class="container text-end">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTarefa">
              Nova Tarefa
            </button>
          </div>
        </div>
      </div>

      <!-- Coluna 2 - Tarefas Concluídas -->
      <div class="col-md-4">
        <div class="card p-3 bg-light shadow">
          <h5 class="text-center fw-bold mb-3">Tarefas Concluídas</h5>

          <!-- FORM: deletar tarefa concluída -->
          <form action="../Controller/processa_excluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Tomar Banho</span>
              <div>
                <input type="hidden" name="id_tarefa" value="4">
                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
              </div>
            </div>
          </form>
          <!-- /FORM -->
        </div>
      </div>

    </div>
  </div>

  <!-- MODAL DE CRIAR/EDITAR TAREFA -->
  <div class="modal fade" id="modalTarefa" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTarefaLabel">Nova Tarefa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">

          <!-- FORM: criar/editar tarefa -->
          <form id="formTarefa" action="../Controller/processa_add_tarefa.php" method="POST">
            <div class="mb-3">
              <label for="nomeTarefa" class="form-label">Nome:</label>
              <input type="text" class="form-control" id="nomeTarefa" name="titulo" placeholder="Nome da tarefa">
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="categoria" class="form-label">Categoria:</label>
                <select id="categoria" class="form-select" name="fk_categoria_id">
                  <option selected disabled>Selecione</option>
                </select>
              </div>
              <div class="col">
                <label for="data" class="form-label">Data:</label>
                <input type="date" id="data" class="form-control" name="data">
              </div>
            </div>

            <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalCategoria">
              <p class="modal-title" id="modalCategoriaLabel">Criar Categoria</p>
            </button>

            <div class="mb-3">
              <label for="descricao" class="form-label">Descrição:</label>
              <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descrição da tarefa"></textarea>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
          </form>
          <!-- /FORM -->

        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DE CRIAR CATEGORIA -->
  <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCategoriaLabel">Criar Categoria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">

          <!-- FORM: criar categoria -->
          <form id="formCategoria" action="../Controller/processa_add_categoria.php" method="POST">
            <div class="mb-3">
              <label for="nomeCategoria" class="form-label">Nome da Categoria:</label>
              <input type="text" class="form-control" id="nomeCategoria" name="nome_categoria" placeholder="Ex: Pessoal, Trabalho, Estudo...">
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success">
                Salvar
              </button>
            </div>
          </form>
          <!-- /FORM -->

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/Site/js/script.js"></script>
</body>

</html>
  