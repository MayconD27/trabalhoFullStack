<?php
session_start();

// Headers CORS e JSON
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Debug opcional — remover em produção
// echo "Sessão atual:<br>";
// print_r($_SESSION);
// echo "<hr>";

if (isset($_SESSION['usuario'])) {
    echo json_encode([
        "status" => true,
        "message" => "Usuário está logado.",
        "usuario" => $_SESSION['usuario']
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Usuário não está logado."
    ]);
}
