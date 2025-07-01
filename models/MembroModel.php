<?php
class Membro
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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

    public function listar()
    {
        $sql = "SELECT * FROM membro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    
}
