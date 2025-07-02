<?php
class Membro
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM membro");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionar($dados)
    {
        $sql = "INSERT INTO membro (nome, email, senha, sobre, perfil) 
                VALUES (:nome, :email, :senha, :sobre, :perfil)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            ':sobre' => $dados['sobre'],
            ':perfil' => $dados['perfil']
        ]);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM membro WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar($id, $dados)
    {
        $sql = "UPDATE membro SET nome=:nome, email=:email, sobre=:sobre, perfil=:perfil WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':sobre' => $dados['sobre'],
            ':perfil' => $dados['perfil'],
            ':id' => $id
        ]);
    }

    public function excluir($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM membro WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}

