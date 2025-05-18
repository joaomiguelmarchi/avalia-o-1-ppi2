<?php
session_start();

// Limpa todos os dados da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Remove o cookie de sessão, se existir
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redireciona para a página de login (ou outra página)
header("Location: login.php");
exit();
?>