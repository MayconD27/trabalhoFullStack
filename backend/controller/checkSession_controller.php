<?php


include_once "../model/login_model.php";

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

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
