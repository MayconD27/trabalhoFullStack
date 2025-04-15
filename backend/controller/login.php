<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// 🔁 Trata requisição OPTIONS e encerra imediatamente
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "../model/login.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['email']) || !isset($data['senha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Email e senha são obrigatórios.']);
            return;
        }

        $result = login($data);

        if (!empty($result) && !isset($result['error'])) {
            echo json_encode([
                "status" => true,
                "message" => "Sucesso ao efetuar o login",
                "response" => $result
            ]);
        } else {
            echo json_encode([
                "status" => false,
                "message" => "Usuário ou senha inválidos."
            ]);
        }
    } else {
        throw new Exception('Método de requisição inválido.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Ocorreu um erro no servidor.',
        'details' => $e->getMessage()
    ]);
}
