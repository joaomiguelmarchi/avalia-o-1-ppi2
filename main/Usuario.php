<?php

    include 'ConnectionManager.php';

    class Usuario {

        public $id;
        public $nome;
        public $email;
        public $senha;

        function __construct($nome, $email, $senha) {
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }

        function save() {
            $connection = ConnectionManager::getConnection();
            $prepared_statement = $connection->prepare("INSERT INTO USUARIOS (NOME, SENHA, EMAIL) VALUES (?, ?, ?)");
            $prepared_statement->bind_param("sss", $this->nome, $this->senha, $this->email);

            if ($prepared_statement->execute()) {
                $this->id = $connection->insert_id;
            }
        }

    }

?>