<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #FF9604; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="card shadow-lg p-4" style="width: 320px; border-radius: 15px;">
        <h4 class="text-center fw-bold mb-3 text-decoration-underline">LOGIN</h4>
        
        <?php include_once('alertas.php'); ?>

        <form action="../Controller/login.php" method="POST">
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Insira seu email:" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="senha" placeholder="Insira sua senha:" required>
            </div>
            <div class="text-center mb-3">
                <span class="small">Não tem conta? <a href="cadastro.php" class="small text-decoration-underline">Cadastre-se aqui</a></span>
            </div>
                <div class="d-grid">
                    <button class="btn btn-primary fw-bold">ENTRAR</button>
                </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>