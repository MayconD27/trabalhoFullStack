<?php
    $host = '177.185.252.253';
    $port = 48487;
    $db   = 'fullstack';
    $user = 'admin';
    $pass = 'admin';
    $charset = 'utf8mb4';

    $bd = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";


    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
        PDO::ATTR_EMULATE_PREPARES   => false,                  
    ];

    try {
        $pdo = new PDO($bd, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>
