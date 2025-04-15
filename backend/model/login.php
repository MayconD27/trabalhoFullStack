<?php
    include_once '../model/db.php';
    function login($data){
        global $pdo;
        print_r($data);
        $senha = $data['senha'];
        $email = $data['email'];
    
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
    
        $usuario = $stmt->fetch();
        print_r($usuario);
        if (!empty($usuario)) {
            echo json_encode(["response" => $usuario]);
        } else {
            //echo json_encode(["error" => "Email ou senha inválidos."]);
        }
    }

?>