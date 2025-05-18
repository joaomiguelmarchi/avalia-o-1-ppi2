<?php
include 'Usuario.php'; 

header('Content-Type: application/json');

$usuarios = Usuario::getAll();
$data = [];

if ($usuarios !== null) {
    foreach ($usuarios as $u) {
        $data[] = [
            'nome' => $u->nome,
            'email' => $u->email
        ];
    }
}

echo json_encode($data);
?>
