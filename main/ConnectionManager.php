<?php

    class ConnectionManager {

        static function getConnection() {
            $conn = new mysqli("localhost:3307", "root", "", "PROVA_PHP");
            return $conn;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conn = ConnectionManager::getConnection();
    ?>
</body>
</html>