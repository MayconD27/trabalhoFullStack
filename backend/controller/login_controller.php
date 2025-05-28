<?php
// DEFINIR A ORIGEM CORRETA (onde roda o front)
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "../model/login_model.php";
class Login_Control{
    public function __construct(){
        $this->LOGIN = new Login_Model();
        $this->login();
    }
    private function login(){
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $json = file_get_contents('php://input');
                    $data = json_decode($json, true);

                    if (!isset($data['email']) || !isset($data['senha'])) {
                        http_response_code(400);
                        echo json_encode(['error' => 'Email e senha são obrigatórios.','code' => 400]);
                        return;
                    }
                    
                    $result = $this->LOGIN->login($data);

                    if (!empty($result) && !isset($result['error'])) {
                        echo json_encode([
                            "status" => true,
                            "message" => "Sucesso ao efetuar o login",
                            "response" => $result,
                            "code" => 200
                        ]);
                    } else {
                        echo json_encode([
                            "status" => false,
                            "message" => "Usuário ou senha inválidos.",
                            "code" => 403
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
                    'details' => $e->getMessage(),
                    'code' => 500
                ]);
            }
    }
    

}
new Login_Control();