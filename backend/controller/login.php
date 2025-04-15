<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include_once "../model/login.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    
    if (empty($data['email']) || empty($data['senha'])) {
        echo json_encode(['error' => 'Email e senha são obrigatórios.']);
        http_response_code(400); 
        return;
    }

    // Passa diretamente o array $data para a função login
    login($data);

} else {
    echo json_encode(['error' => 'Método de requisição inválido.']);
    http_response_code(405); 
}
?>
