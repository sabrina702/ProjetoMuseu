<?php
    session_start();/*
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /ProjetoMuseu/template/login.php');
        exit();
    }

    if ($_SESSION['usuario_perfil'] !== 'Coordenador(a) do Museu') {
        echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Acesso negado</title>
            <meta http-equiv="refresh" content="2;url=/ProjetoMuseu/template/gerenciaMembro.php">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f8f9fa;
                }
                .alert {
                    max-width: 500px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="alert alert-danger shadow p-4 rounded">
                <h4 class="alert-heading">Acesso negado!</h4>
                <p>Você não tem permissão para acessar esta página.</p>
                <hr>
                <p class="mb-0">Você será redirecionado em instantes...</p>
            </div>
        </body>
        </html>';
        exit();
    }
*/
    $sucesso = $_SESSION['sucesso'] ?? null;
    $erros = $_SESSION['erros'] ?? [];
    $dados = $_SESSION['dados'] ?? [];
    unset($_SESSION['sucesso']);
    unset($_SESSION['erros']);
    unset($_SESSION['dados']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/membro.css"/>
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/membro.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <aside class="sidebar">
      <img src="/ProjetoMuseu/static/imagens/logo.png" alt="Logo do Museu" class="logo">
      <h2>Museu de Ciências Naturais José Alencar de Carvalho</h2>       
    </aside>

    <main class="main-content">
        <div class="header">
        <h1>Cadastrar membro</h1>
        <a href="/ProjetoMuseu/views/membro/listaMembro.php" class="btn-add">← Voltar</a>
        </div>

        <form method="POST" action="/ProjetoMuseu/static/validaMembro.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>

            <?php if (!empty($erros['geral'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erros['geral']) ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" required>
                <?php if (isset($erros['nome'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['nome']) ?></span>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($dados['email'] ?? '') ?>" required>
                <?php if (isset($erros['email'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['email']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?= htmlspecialchars($dados['senha'] ?? '') ?>" required style="padding: 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;
            background-color: #f9f9f9; transition: border-color 0.3s; width: 100%;">
            <?php if (isset($erros['senha'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['senha']) ?></span>
            <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="sobre">Sobre:</label>
                <textarea id="sobre" name="sobre" required><?= htmlspecialchars($dados['sobre'] ?? '') ?></textarea>
                <?php if (isset($erros['sobre'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['sobre']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <select id="perfil" name="perfil" required>
                <option value="">-- Selecione --</option>
                <option value="Monitor(a)" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Monitor(a)') ? 'selected' : '' ?>>Monitor(a)</option>
                <option value="Professor(a)" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Professor(a)') ? 'selected' : '' ?>>Professor(a)</option>
                <option value="Coordenador(a) do Museu" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Coordenador(a) do Museu') ? 'selected' : '' ?>>Coordenador(a) do Museu</option>
                </select>
                <?php if (isset($erros['perfil'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-add-membro">Cadastrar</button>
        </form>
    </main>
  </div>
</body>
</html>