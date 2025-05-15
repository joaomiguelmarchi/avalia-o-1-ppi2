<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'Usuario.php';

    if (isset($_REQUEST["senha"]) && isset($_REQUEST["email"])) {
        $senha = $_REQUEST["senhaHash"];
        $email = $_REQUEST["email"];
    
        $usuario = Usuario::getByEmailAndPassword($email, $senha);
    
        if ($usuario == null) {
            header("location: login.php?error=Não foi encontrado usuário com as credenciais fornecidas.");
        } else {
            $_SESSION["LOGGED_USER"] = $usuario;
            header("location: dashboard.php");
        }
    }
?>