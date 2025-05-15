<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

  include 'Usuario.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, #6e8efb, #a777e3);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: 0.3s;
      outline: none;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #6e8efb;
      box-shadow: 0 0 5px rgba(110, 142, 251, 0.5);
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #6e8efb;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #5a7bfa;
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      color: #777;
      font-size: 14px;
    }

    .footer-text a {
      color: #6e8efb;
      text-decoration: none;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Entrar na Conta</h2>
    <form action="processaLogin.php" method="post" id="formLogin">
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required />
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required />
      </div>
      <div class="footer-text">
        Não tem uma conta? <a href="#">Cadastre-se</a>
      </div>
      <button type="submit">Entrar</button>
      <input type="hidden" id="senhaHash" name="senhaHash">
    </form>
  </div>
</body>

<script>
    document.getElementById('formLogin').addEventListener('submit', function(event) {
      event.preventDefault();

      const senhaInput = document.getElementById('senha').value;
      const senhaHash = document.getElementById('senhaHash');

      hashSenha(senhaInput).then(function(hashedSenha) {
        senhaHash.value = hashedSenha;
        document.getElementById('formLogin').submit(); 
      }).catch(function(err) {
        alert("Erro ao gerar o hash da senha.");
      });
    });

    async function hashSenha(senha) {
      const encoder = new TextEncoder();
      const data = encoder.encode(senha);
      const hashBuffer = await crypto.subtle.digest('SHA-256', data);
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
      return hashHex;
    }
</script>

</html>
