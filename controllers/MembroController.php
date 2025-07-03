<?php

class MembroController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvar()
    {
        $erros = [];
        $dados = $_POST;

        // Validações
        if (empty($dados['nome'])) {
            $erros['nome'] = 'O nome é obrigatório.';
        }

        if (empty($dados['email'])) {
            $erros['email'] = 'O email é obrigatório.';
        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = 'Email inválido.';
        }

        if (!preg_match('/[A-Za-z]/', $dados['senha']) ||
            !preg_match('/[0-9]/', $dados['senha']) ||
            !preg_match('/[^A-Za-z0-9]/', $dados['senha'])) {
            $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
        }

        if (empty($dados['sobre'])) {
            $erros['sobre'] = 'O campo "Sobre" é obrigatório.';
        }

        if (empty($dados['perfil'])) {
            $erros['perfil'] = 'O perfil é obrigatório.';
        }

        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /ProjetoMuseu/views/membro/cadastraMembro.php');
            exit();
        }

        try {
            $membro = new Membro($this->pdo);
            $membro->adicionar($dados);

            $_SESSION['sucesso'] = 'Membro adicionado com sucesso!';
            header('Location: /ProjetoMuseu/views/gerenciaMembro.php');
            exit();

        } catch (PDOException $e) {
            $_SESSION['erros']['geral'] = 'Erro ao salvar: ' . $e->getMessage();
            $_SESSION['dados'] = $dados;
            header('Location: /ProjetoMuseu/views/membro/cadastraMembro.php');
            exit();
        }
    }

    public function listar()
    {
    require_once __DIR__ . '/../models/MembroModel.php';
    $membroModel = new Membro($this->pdo);
    $membros = $membroModel->listar(); // pega do banco
    include __DIR__ . '/../views/membro/listaMembro.php';
    }

}
