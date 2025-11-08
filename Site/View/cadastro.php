<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Givanildo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #FF9604; height: 100vh; display: flex; justify-content: center; align-items: center;">

  <div class="card shadow-lg p-4" style="width: 320px; border-radius: 15px;">
    <h4 class="text-center fw-bold mb-3 text-decoration-underline">CRIAR CONTA</h4>
    
    <form method="post" action="../Controller/process_cadastro.php">
      <div class="mb-3">
        <input type="name" class="form-control" name="nome" placeholder="Informe seu nome:">
      </div>
      <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Informe seu Email:">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="senha" placeholder="Senha:">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="senha" placeholder="Confirmar Senha:">
      </div>


      <div class="d-grid">
        <button type="submit" class="btn btn-primary fw-bold">CRIAR CONTA</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>