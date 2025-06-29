<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once '../settings/db.php';

class Cadastro_Model {

    public function cadastrar($data) {
        global $pdo;

        try {
            $email = $data['usuario'];
            $senha = $data['senha'];
            $nome = $data['nome'];

            // Insere novo usuário
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->execute();

            $id_usuario = $pdo->lastInsertId();
            $this->registrarLogCadastro("Usuário cadastrado com sucesso", $id_usuario);

            return ['status' => true];

        } catch (Exception $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao cadastrar usuário: ' . $e->getMessage()];
        }
    }

    private function registrarLogCadastro($acao, $usuario_id = null) {
        global $pdo;

        try {
            $sql = "INSERT INTO logs (usuario_id, acao, data_hora) VALUES (:usuario_id, :acao, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuario_id, is_null($usuario_id) ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $stmt->bindParam(':acao', $acao, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao registrar log de cadastro: " . $e->getMessage());
        }
    }
}
