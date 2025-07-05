<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gerenciamento - Museu</title>
  
  <!-- CSS principal -->
  <link rel="stylesheet" href="/ProjetoMuseu/static/css/gerencia.css" />
  
  <!-- CSS específico, se existir -->
  <?php if (isset($pagina_css)): ?>
    <link rel="stylesheet" href="/ProjetoMuseu/static/css/<?= htmlspecialchars($pagina_css) ?>" />
  <?php endif; ?>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <div class="container-geral">
    <?php require __DIR__ . '/sidebar.php'; ?>

    <main class="main-content">
      <?= $conteudo ?>
    </main>
  </div>
</body>
</html>
