<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/MembroModel.php';
require_once __DIR__ . '/../controllers/MembroController.php';

$controller = new MembroController($pdo);
$controller->listar(); // Vai carregar a lista e incluir a view
