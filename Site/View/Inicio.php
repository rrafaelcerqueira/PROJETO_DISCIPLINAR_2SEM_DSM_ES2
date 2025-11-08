<?php
// 1. VERIFICA A SESSÃO E INCLUI CLASSES
require_once('../Controller/sessao.php'); 
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');
require_once('../Model/Categoria.php'); // Incluído para buscar nome da categoria

// 2. PREPARA A CONEXÃO E OBJETOS
$database = new Database();
$db = $database->getConnection();

$tarefa = new Tarefa($db);
$categoria = new Categoria($db); // Objeto categoria

// 3. SETA O ID DO USUÁRIO (DA SESSÃO)
$tarefa->fk_usuario_id = $_SESSION['id'];
$categoria->fk_usuario_id = $_SESSION['id'];

// 4. BUSCA OS DADOS DO BANCO
// Assumindo que 1 = Pendente e 2 = Concluída
$tarefa->fk_estado_id = 1; 
$listaTarefasPendentes = $tarefa->listarPorEstado();

$tarefa->fk_estado_id = 2; 
$listaTarefasConcluidas = $tarefa->listarPorEstado();
?>
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

    <?php include_once('alertas.php'); ?>

    <div class="row justify-content-start g-3">
      
      <div class="col-md-8"> 
        <div class="card p-3 bg-light shadow">
          <h5 class="text-center fw-bold mb-4">Tarefas Pendentes</h5>
          
          <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col" style="width: 15%;">Categoria</th>
                <th scope="col" style="width: 20%;">Nome</th>
                <th scope="col" style="width: 15%;">Data</th> <th scope="col" style="width: 35%;">Descrição</th>
                <th scope="col" style="width: 15%;" class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($listaTarefasPendentes->num_rows > 0) : ?>
                <?php while ($row = $listaTarefasPendentes->fetch_assoc()) : ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['nome_categoria'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td>
                      <?php 
                        if (!empty($row['data'])) {
                            echo date('d/m/Y', strtotime($row['data']));
                        } else {
                            echo 'N/A';
                        }
                      ?>
                    </td> <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                    <td class="text-center">
                      <a href="edita_tarefa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white me-2" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </a>
                      
                      <form action="../Controller/concluir_tarefa.php" method="POST" class="d-inline">
                        <input type="hidden" name="id_tarefa" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-sm btn-success" title="Concluir">
                          <i class="bi bi-check-lg"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else : ?>
                <tr>
                  <td colspan="5" class="text-center">Nenhuma tarefa pendente.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          
          <div class="container text-end mt-3">
            <a href="cria_tarefa.php">
              <button class="btn btn-primary btn-sm">
                Nova Tarefa
              </button>
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card p-3 bg-light shadow">
          <h5 class="text-center fw-bold mb-3">Tarefas Concluídas</h5>
          
          <?php if ($listaTarefasConcluidas->num_rows > 0) : ?>
            <?php while ($row = $listaTarefasConcluidas->fetch_assoc()) : ?>
              <form action="../Controller/excluir_tarefa.php" method="POST">
                <div class="task-item">
                  <span><?php echo htmlspecialchars($row['nome']); ?></span>
                  <div>
                    <input type="hidden" name="id_tarefa" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                  </div>
                </div>
              </form>
            <?php endwhile; ?>
          <?php else : ?>
            <p class="text-center">Nenhuma tarefa concluída.</p>
          <?php endif; ?>
          
          </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>