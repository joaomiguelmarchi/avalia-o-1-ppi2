<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'ConnectionManager.php';

    class Usuario {

        public $id;
        public $nome;
        public $email;
        public $senha;

        function __construct($nome = null, $email = null, $senha = null) {
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }

        static function getByEmailAndPassword($email, $senha) {
            $connection = ConnectionManager::getConnection();
        
            $stmt = $connection->prepare("SELECT ID, NOME, SENHA, EMAIL FROM USUARIOS WHERE EMAIL = ? AND SENHA = ?");
            if ($stmt === false) {
                die("Erro no prepare: " . $connection->error);
            }

            $stmt->bind_param("ss", $email, $senha);
            $stmt->execute();
        
            $result = $stmt->get_result();
        
            if ($result->num_rows === 1) {
        
                $row = $result->fetch_assoc();

                $usuario = new Usuario();
                $usuario->id = $row['ID'];
                $usuario->nome = $row['NOME'];
                $usuario->email = $row['EMAIL'];
    
                return $usuario;
            }
        
            return null;
        }

        static function getAll() {
            $connection = ConnectionManager::getConnection();
        
            $stmt = $connection->prepare("SELECT NOME, EMAIL FROM USUARIOS");
            if ($stmt === false) {
                die("Erro no prepare: " . $connection->error);
            }

            $stmt->execute();
        
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                
                $usuarios = [];

                while ($row = $result->fetch_assoc()) {
                    $usuario = new Usuario();
                    $usuario->nome = $row['NOME'];
                    $usuario->email = $row['EMAIL'];

                    $usuarios[] = $usuario;
                }

                return $usuarios;
            }
        
            return null;
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