<?php
// controllers/MembroController.php
require_once __DIR__ . '/../models/MembroModel.php';

class MembroController
{
    private $pdo;
    private $model;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->model = new Membro($pdo);
    }

    public function listar()
    {
        $membroModel = new Membro($this->pdo);
        $membros = $membroModel->listar(); 
        include __DIR__ . '/../views/membro/listaMembro.php';
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $erros = $this->validarDados($dados);

            if (count($erros) > 0) {
                session_start();
                $_SESSION['erros'] = $erros;
                $_SESSION['dados'] = $dados;
                header('Location: /ProjetoMuseu/views/membro/cadastraMembro.php');
                exit();
            }

            $this->model->adicionar($dados);
            session_start();
            $_SESSION['sucesso'] = "Membro adicionado com sucesso!";
            header('Location: /ProjetoMuseu/views/membro/listaMembro.php');
            exit();
        }
        // Se acessar direto o formulário, só incluir a view
        include __DIR__ . '/../views/membro/cadastraMembro.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $erros = $this->validarDados($dados, $editar=true);

            if (count($erros) > 0) {
                session_start();
                $_SESSION['erros'] = $erros;
                $_SESSION['dados'] = $dados;
                header("Location: /ProjetoMuseu/views/membro/editaMembro.php?id=$id");
                exit();
            }

            $this->model->editar($id, $dados);
            session_start();
            $_SESSION['sucesso'] = "Membro atualizado com sucesso!";
            header('Location: /ProjetoMuseu/views/membro/listaMembro.php');
            exit();
        }

        $membro = $this->model->buscarPorId($id);
        include __DIR__ . '/../views/membro/editaMembro.php';
    }

    public function excluir($id)
    {
        $this->model->excluir($id);
        session_start();
        $_SESSION['sucesso'] = "Membro excluído com sucesso!";
        header('Location: /ProjetoMuseu/views/membro/listaMembro.php');
        exit();
    }

    private function validarDados($dados, $editar = false)
    {
        $erros = [];

        if (empty($dados['nome'])) {
            $erros['nome'] = 'Nome é obrigatório.';
        }
        if (empty($dados['email']) || !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = 'Email inválido.';
        }
        if (!$editar) { // valida senha só para adicionar
            if (empty($dados['senha']) || 
                !preg_match('/[A-Za-z]/', $dados['senha']) || 
                !preg_match('/[0-9]/', $dados['senha']) || 
                !preg_match('/[^A-Za-z0-9]/', $dados['senha'])) {
                $erros['senha'] = 'Senha deve conter letras, números e caracteres especiais.';
            }
        }
        if (empty($dados['sobre'])) {
            $erros['sobre'] = 'Campo Sobre é obrigatório.';
        }
        if (empty($dados['perfil'])) {
            $erros['perfil'] = 'Perfil é obrigatório.';
        }

        return $erros;
    }
}
