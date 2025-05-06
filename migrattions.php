
<?php
function migrattions(){
    $version = 1;
    if ($version ==1){
        createdb();
    }
}
migrattions();

function createdb(){
    $host = 'localhost';
    $dbname = 'fullstack';
    $username = 'root';
    $password = '';
    $charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar tabela usuarios
    $sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome_usuario VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sqlUsuarios);

    // Criar tabela logs
    $sqlLogs = "CREATE TABLE IF NOT EXISTS logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT,
        acao VARCHAR(255) NOT NULL,
        data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
    )";
    $pdo->exec($sqlLogs);

    echo "Migração concluída com sucesso!";
} catch (PDOException $e) {
    echo "Erro na migração: " . $e->getMessage();
}};
?>
