<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'Usuario.php';

    $usuario = Usuario::getByEmailAndPassword($_REQUEST["email"], $_REQUEST["senha"]);

    if ($usuario === null) {
        header("location: login.php?error=Não foi encontrado usuário com as credenciais fornecidas.");
    } else {
        $_SESSION["LOGGED_USER"] = $usuario;
        header("location: dashboard.php");
    }

?>