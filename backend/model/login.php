<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include_once '../model/db.php';

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

            return $usuario;
        } else {
            return [];
        }
    } catch (Exception $e) {
        error_log("Erro no login: " . $e->getMessage());
        return ['error' => 'Erro ao realizar login.'];
    }
}
