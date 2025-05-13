<?php
include_once '../model/login_model.php'; 


header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$user_id = $_SESSION['usuario']['id'] ?? null;

if ($user_id) {
    registrarLogLogin("Usuário efetuou logout", $user_id);
}

session_unset();
session_destroy();

echo json_encode([
    "status" => true,
    "message" => "Logout realizado com sucesso."
]);


