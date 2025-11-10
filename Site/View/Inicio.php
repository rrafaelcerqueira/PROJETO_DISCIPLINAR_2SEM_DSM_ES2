<?php
require_once('../Controller/sessao.php');
require_once('../Model/Database.php');
require_once('../Model/Tarefa.php');
require_once('../Model/Categoria.php');

$database = new Database();
$db = $database->getConnection();

$tarefa = new Tarefa($db);
$categoria = new Categoria($db);

$tarefa->fk_usuario_id = $_SESSION['id'];
$categoria->fk_usuario_id = $_SESSION['id'];

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

  <div class="container py-4">
    <?php include_once('alertas.php'); ?>

    <div class="row justify-content-start g-3">

      <div class="col-md-8">
        <div class="card p-3 bg-light shadow">
          <h5 class="text-center fw-bold mb-4">Tarefas Pendentes</h5>

          <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col" style="width: 15%;">Categoria</th>
                <th scope="col" style="width: 25%;">Nome</th>
                <th scope="col" style="width: 15%;">Expiração</th>
                <th scope="col" style="width: 30%;">Descrição</th>
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
                      if (!empty($row['data_expiracao'])) {
                        echo date('d/m/Y', strtotime($row['data_expiracao']));
                      } else {
                        echo 'N/A';
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <?php if (!empty($row['descricao'])): ?>
                        <span class="badge rounded-pill bg-secondary text-white px-3 py-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#descModal<?php echo $row['id']; ?>">
                          <i class="bi bi-text-paragraph"></i> Descrição
                        </span>
                      <?php else: echo 'N/A';
                      endif; ?>
                    </td>
                    <td class="text-center">
                      <a href="edita_tarefa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary text-white me-1" title="Editar">
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

                  <div class="modal fade" id="descModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalTitle<?php echo $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle<?php echo $row['id']; ?>">Descrição: <?php echo htmlspecialchars($row['nome']); ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <?php echo nl2br(htmlspecialchars($row['descricao'])); ?>
                        </div>
                      </div>
                    </div>
                  </div>
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

              <?php
              $dataConclusao = strtotime($row['data_conclusao']);
              $dataExpiracao = !empty($row['data_expiracao']) ? strtotime($row['data_expiracao']) : null;

              $mensagemConclusao = "Concluído em: " . date('d/m/Y', $dataConclusao);
              $corTexto = "text-muted";

              if ($dataExpiracao && $dataConclusao > $dataExpiracao) {
                $mensagemConclusao = "Concluído com atraso em: " . date('d/m/Y', $dataConclusao);
                $corTexto = "text-danger";
              }
              ?>

              <div class="task-item mb-2">
                <div>
                  <span><?php echo htmlspecialchars($row['nome']); ?></span>
                  <br>
                  <small class="<?php echo $corTexto; ?> fw-bold">
                    <?php echo $mensagemConclusao; ?>
                  </small>
                </div>
                <div class="d-flex gap-1">
                  <?php if (!empty($row['descricao'])): ?>
                    <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" data-bs-toggle="modal" data-bs-target="#descModalConcluida<?php echo $row['id']; ?>" title="Ver Descrição">
                      <i class="bi bi-card-text"></i>
                    </button>
                  <?php endif; ?>
                  <form action="../Controller/excluir_tarefa.php" method="POST" class="m-0">
                    <input type="hidden" name="id_tarefa" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm py-1 px-2" title="Deletar">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </div>

              <?php if (!empty($row['descricao'])): ?>
                <div class="modal fade" id="descModalConcluida<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalTitleConcluida<?php echo $row['id']; ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleConcluida<?php echo $row['id']; ?>">Descrição: <?php echo htmlspecialchars($row['nome']); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php echo nl2br(htmlspecialchars($row['descricao'])); ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
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
