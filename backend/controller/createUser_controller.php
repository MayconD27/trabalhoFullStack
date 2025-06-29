<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "../model/cadastro_model.php";

class Cadastro_Control {
    public function __construct() {
        $this->CADASTRO = new Cadastro_Model();
        $this->cadastrar();
    }

    private function cadastrar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);

                if (!isset($data['usuario']) || !isset($data['senha']) || !isset($data['nome'])) {
                    http_response_code(400);
                    echo json_encode([
                        'status' => false,
                        'message' => 'Nome, usuário e senha são obrigatórios.',
                        'code' => 400
                    ]);
                    return;
                }

                $result = $this->CADASTRO->cadastrar($data);

                if ($result['status']) {
                    echo json_encode([
                        'status' => true,
                        'message' => 'Usuário cadastrado com sucesso.',
                        'code' => 200
                    ]);
                } else {
                    echo json_encode([
                        'status' => false,
                        'message' => $result['message'] ?? 'Erro ao cadastrar usuário.',
                        'code' => 409
                    ]);
                }
            } else {
                throw new Exception('Método de requisição inválido.');
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => false,
                'message' => 'Erro no servidor.',
                'details' => $e->getMessage(),
                'code' => 500
            ]);
        }
    }
}

new Cadastro_Control();
