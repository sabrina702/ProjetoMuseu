<?php
session_start();
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . '/controllers/Autenticacao.php';

$pdo = conectarBD();
$page = $_GET['page'] ?? 'login';

$autenticacao = new Autenticacao($pdo);

switch ($page) {
    case 'login':
        $autenticacao->login();
        break;
    case 'logout':
        $autenticacao->logout();
        break;
    case 'gerencia':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /ProjetoMuseu/routerAuth.php?page=login');
            exit;
        }
        require __DIR__ . '/views/gerenciamento/gerenciamento.php';
        break;
    default:
        echo "Página não encontrada.";
}
