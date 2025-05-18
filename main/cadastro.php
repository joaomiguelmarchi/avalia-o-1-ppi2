<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

  include 'Usuario.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuário</title>
  <style>
    .infobar {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #4CAF50; /* ou #f44336 para erro */
        color: white;
        padding: 12px 15px;
        border-radius: 5px;
        font-family: sans-serif;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        max-width: 320px;
        min-width: 200px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        z-index: 1000;
    }

    .infobar.erro {
        background-color: #f44336;
    }

    .texto {
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .fechar {
        flex-shrink: 0;
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        padding: 0;
        margin: 0;
        line-height: 1;
        height: auto;
        width: auto;
    }
    
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #6e8efb, #a777e3);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #6e8efb;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }
  </style>
</head>

<?php
    function cadastrar_usuario() {
      $nome = $_REQUEST["nome"];
      $senha = $_REQUEST["senhaHash"];
      $email = $_REQUEST["email"];

      $usuario = new Usuario($nome, $email, $senha);
      $usuario->save();

      echo "
       <div class='infobar $tipo' id='infobar'>
        <span class='texto'>$mensagem</span>
        <button class='fechar' onclick='fecharInfobar()'>&times;</button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('infobar').style.display = 'none';
        }, 5000);
        function fecharInfobar() {
            document.getElementById('infobar').style.display = 'none';
        }
    </script>
      ";
    }

    if (isset($_REQUEST["nome"]) || isset($_REQUEST["senhaHash"]) || isset($_REQUEST["email"])) {
      cadastrar_usuario();
    }
?>

<body>
  <div class="container">
    <h2>Cadastro de Usuário</h2>
    <form action="cadastro.php" id="formCadastro" method="post">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
      </div>
      <button type="submit">Cadastrar</button>
      <input type="hidden" id="senhaHash" name="senhaHash">
    </form>
  </div>
</body>

<script>
  document.getElementById('formCadastro').addEventListener('submit', function(event) {
    event.preventDefault();

    var senha = document.getElementById('senha').value.trim();

    hashSenha(senha).then(function(hashedSenha) {
      document.getElementById('senhaHash').value = hashedSenha;
      document.getElementById('formCadastro').submit(); 
    }).catch(function(err) {
      alert("Erro ao gerar hash da senha.");
    });
  });

  async function hashSenha(senha) {
    const encoder = new TextEncoder();
    const data = encoder.encode(senha);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    const hashArray = Array.from(new Uint8Array(hashBuffer)); 
    const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join(''); 
    return hashHex;
  }
</script>

</html>
