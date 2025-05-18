<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #6e8efb, #a777e3);
      min-height: 100vh;
      padding: 40px 20px;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .dashboard-header h2 {
      color: #333;
    }

    .dashboard-buttons button {
      padding: 10px 16px;
      margin-left: 10px;
      border: none;
      border-radius: 8px;
      background-color: #6e8efb;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .dashboard-buttons button:hover {
      background-color: #5a7bfa;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      color: #333;
    }

    th {
      background-color: #f4f4f4;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    @media (max-width: 768px) {
      .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .dashboard-buttons {
        margin-top: 10px;
      }
    }
  </style>
</head>
  <?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");
  if(!isset($_SESSION["LOGGED_USER"])){
    die("Usuário não encontrado!");
  }
?>
<body>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <div></div>
      <div class="dashboard-buttons">
        <button onclick="location.href='../main/cadastro.php'">Cadastrar Usuário</button>
        <button onclick="location.href='../main/login.php'">Logout</button>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody id="tabela-usuarios">
      <?php
        include 'Usuario.php';

        foreach (Usuario::getAll() as $u) {
          echo("<tr><td>" . $u->nome . "</td><td>" . $u->email . "</td></tr>");
        }

        ?>
      </tbody>
    </table>
  </div>
  <script>
    function carregarUsuarios() {
      fetch('usuarios_api.php')
        .then(response => response.json())
        .then(data => {
          const tbody = document.getElementById('user-table');
          tbody.innerHTML = ''; 

          data.forEach(usuario => {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>${usuario.nome}</td><td>${usuario.email}</td>`;
            tbody.appendChild(tr);
          });
        })
        .catch(error => {
          console.error('Erro ao carregar usuários:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', carregarUsuarios);
  </script>
</body>
</html>
