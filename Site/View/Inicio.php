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
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <a href="edita_tarefa.php">
            <div class="task-item">
              <span>Fazer Lição de Casa</span>
              <div>
                <input type="hidden" name="id_tarefa" value="1">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
              </div>
            </div>
            </a>
          </form>
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Fazer Compras</span>
              <div>
                <input type="hidden" name="id_tarefa" value="2">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
              </div>
            </div>
          </form>
          <form action="../Controller/processa_concluir_tarefa.php" method="POST">
            <div class="task-item">
              <span>Almoçar</span>
              <div>
                <input type="hidden" name="id_tarefa" value="3">
                <button type="submit" class="btn btn-success btn-sm">Concluir</button>
              </div>
            </div>
          </form>
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
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>
  