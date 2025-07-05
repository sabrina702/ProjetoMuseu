<?php

function getDbConfig() {
    return [
        'host'     => getenv('DB_HOST') ?: 'mysql',
        'dbname'   => getenv('DB_NAME') ?: 'bdmuseu',  
        'username' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: 'rootpassword',
        'options'  => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ];
}

function conectarBD() {
    $config = getDbConfig();
    
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
        $conn = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        return $conn;
    } catch (PDOException $e) {
        die("Erro ao conectar no banco: " . $e->getMessage());
    }
}

function getDbErrorMessage($e) {
    return "<p class='error'>Erro de conexão com o banco de dados: " . $e->getMessage() . "</p>";
}
?>
