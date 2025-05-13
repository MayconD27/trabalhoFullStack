<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include_once '../settings/db.php';

function login($data) {
    global $pdo;
    try {
        $senha = $data['senha'];
        $email = $data['email'];

        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($usuario)) {
            unset($usuario['senha']);
            $_SESSION['usuario'] = $usuario; 
            setcookie("PHPSESSID", session_id(), [
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            registrarLogLogin("Login efetuado com sucesso",$usuario['id']);
            return $usuario;
        } else {
            registrarLogLogin("Falha ao realizar o login, email ou senha","");
            return [];
        }
    } catch (Exception $e) {
        error_log("Erro no login: " . $e->getMessage());
        registrarLogLogin("Erro ao realizar login","");
        return ['error' => 'Erro ao realizar login.'];
    }
}


function registrarLogLogin($acao, $usuario_id = null) {
    global $pdo;

    try {
        $sql = "INSERT INTO logs (usuario_id, acao, data_hora) VALUES (:usuario_id, :acao, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuario_id, is_null($usuario_id) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(':acao', $acao, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        error_log("Erro ao registrar log: " . $e->getMessage());
    }
}